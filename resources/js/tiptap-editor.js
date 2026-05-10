import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Placeholder from '@tiptap/extension-placeholder';
import ImageResize from 'tiptap-extension-resize-image';
import TextAlign from '@tiptap/extension-text-align';
import { TextStyle } from '@tiptap/extension-text-style';
import { Color } from '@tiptap/extension-color';

/**
 * Alpine.js component factory for Tiptap rich text editor.
 *
 * StarterKit v3 already includes: Bold, Italic, Strike, Underline, Link,
 * BulletList, OrderedList, Blockquote, Heading, Code, CodeBlock, etc.
 * We only add extensions NOT in StarterKit: Image, TextAlign, TextStyle, Color, Placeholder.
 *
 * Usage:
 *   <script id="tiptap-initial-content" type="application/json">{{ json_encode($content) }}</script>
 *   <div x-data="tiptapEditor()" x-init="init()"
 *        data-placeholder="..." data-content-id="tiptap-initial-content">
 *
 * All toolbar buttons MUST have @mousedown.prevent to keep editor focus.
 */
export function tiptapEditor() {
    console.log('tiptapEditor factory called!');
    let editor = null; // Local non-reactive variable to prevent Alpine proxy issues

    return {
        content:  '',
        wordCount: 0,
        _initialized: false,

        active: {
            bold: false,
            italic: false,
            underline: false,
            strike: false,
            bulletList: false,
            orderedList: false,
            blockquote: false,
            heading1: false,
            heading2: false,
            heading3: false,
        },

        init() {
            console.log('tiptapEditor init called!', { initialized: this._initialized });
            if (this._initialized) return;
            this._initialized = true;

            const self = this;

            const placeholder = this.$el.dataset.placeholder ?? 'Mulai menulis...';

            // Read content from a <script type="application/json"> tag
            const contentId = this.$el.dataset.contentId;
            let content = '';
            if (contentId) {
                const scriptEl = document.getElementById(contentId);
                if (scriptEl) {
                    try {
                        content = JSON.parse(scriptEl.textContent.trim());
                    } catch (e) {
                        console.warn('tiptapEditor: could not parse initial content JSON', e);
                    }
                }
            }

            this.content = content;

            if (this.$refs.editorContent) {
                this.$refs.editorContent.innerHTML = '';
            }

            editor = new Editor({
                element: this.$refs.editorContent,
                extensions: [
                    // StarterKit v3 already includes:
                    // Bold, Italic, Strike, Underline, Link, BulletList,
                    // OrderedList, Blockquote, Heading, Code, CodeBlock,
                    // HardBreak, HorizontalRule, ListItem, Paragraph, Text
                    StarterKit.configure({
                        heading: { levels: [1, 2, 3] },
                        link: {
                            openOnClick:    false,
                            HTMLAttributes: { class: 'text-[#86654b] underline' },
                        },
                    }),
                    Placeholder.configure({ placeholder }),
                    ImageResize,
                    TextAlign.configure({ types: ['heading', 'paragraph', 'image'] }),
                    TextStyle,
                    Color,
                ],
                content,
                editorProps: {
                    attributes: {
                        class: 'prose prose-stone prose-lg max-w-none min-h-[320px] focus:outline-none px-1',
                    },
                },
                onUpdate({ editor }) {
                    const html = editor.getHTML();

                    // Keep hidden input in sync (immediate, no Alpine)
                    const hidden = document.getElementById('tiptap-content-input');
                    if (hidden) hidden.value = html;

                    // Defer Alpine reactive update after Tiptap commits the transaction
                    Promise.resolve().then(() => {
                        self.content   = html;
                        self.wordCount = editor.getText().trim().split(/\s+/).filter(Boolean).length || 0;
                    });
                },
                onSelectionUpdate({ editor }) {
                    self.updateActiveStates(editor);
                },
                onTransaction({ editor }) {
                    self.updateActiveStates(editor);
                }
            });

            this.wordCount = editor.getText().trim().split(/\s+/).filter(Boolean).length || 0;
            this.updateActiveStates();
        },

        updateActiveStates() {
            if (!editor) return;
            // Defer to avoid mismatched transaction errors with Alpine
            Promise.resolve().then(() => {
                this.active.bold = editor.isActive('bold');
                this.active.italic = editor.isActive('italic');
                this.active.underline = editor.isActive('underline');
                this.active.strike = editor.isActive('strike');
                this.active.bulletList = editor.isActive('bulletList');
                this.active.orderedList = editor.isActive('orderedList');
                this.active.blockquote = editor.isActive('blockquote');
                this.active.heading1 = editor.isActive('heading', { level: 1 });
                this.active.heading2 = editor.isActive('heading', { level: 2 });
                this.active.heading3 = editor.isActive('heading', { level: 3 });
            });
        },

        destroy() {
            editor?.destroy();
        },

        isActive(type, attrs = {}) {
            return editor?.isActive(type, attrs) ?? false;
        },

        toggleBold()        { editor?.chain().focus().toggleBold().run(); },
        toggleItalic()      { editor?.chain().focus().toggleItalic().run(); },
        toggleUnderline()   { editor?.chain().focus().toggleUnderline().run(); },
        toggleStrike()      { editor?.chain().focus().toggleStrike().run(); },
        toggleCode()        { editor?.chain().focus().toggleCode().run(); },
        toggleBulletList()  { editor?.chain().focus().toggleBulletList().run(); },
        toggleOrderedList() { editor?.chain().focus().toggleOrderedList().run(); },
        toggleBlockquote()  { editor?.chain().focus().toggleBlockquote().run(); },
        toggleCodeBlock()   { editor?.chain().focus().toggleCodeBlock().run(); },
        undo()              { editor?.chain().focus().undo().run(); },
        redo()              { editor?.chain().focus().redo().run(); },

        setHeading(level)   { editor?.chain().focus().toggleHeading({ level }).run(); },
        setAlign(align)     { editor?.chain().focus().setTextAlign(align).run(); },

        insertImage() {
            // Buat elemen input file sementara
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            
            input.onchange = async (e) => {
                const file = e.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('image', file);

                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                try {
                    // Upload ke server
                    const response = await fetch('/journal/upload-image', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    if (response.ok) {
                        const data = await response.json();
                        if (data.url) {
                            editor?.chain().focus().setImage({ src: data.url }).run();
                        }
                    } else {
                        console.error('Gagal mengunggah gambar');
                        alert('Gagal mengunggah gambar.');
                    }
                } catch (error) {
                    console.error('Error uploading image:', error);
                    alert('Terjadi kesalahan saat mengunggah gambar.');
                }
            };

            input.click();
        },

        setColor(color) {
            editor?.chain().focus().setColor(color).run();
        },
    };
}