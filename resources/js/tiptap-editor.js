import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Placeholder from '@tiptap/extension-placeholder';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Underline from '@tiptap/extension-underline';
import TextAlign from '@tiptap/extension-text-align';
import { TextStyle } from '@tiptap/extension-text-style';
import { Color } from '@tiptap/extension-color';

/**
 * Alpine.js component factory for Tiptap rich text editor.
 * Usage:  x-data="tiptapEditor({ placeholder: '...', content: '...' })"
 */
export function tiptapEditor({ placeholder = 'Mulai menulis jurnal kamu...', content = '' } = {}) {
    return {
        editor: null,
        content,
        wordCount: 0,

        init() {
            const self = this;

            // --- PERBAIKAN: Mencegah Tiptap ter-render double ---
            // 1. Hancurkan instance editor lama jika sudah ada
            if (this.editor) {
                this.editor.destroy();
            }
            
            // 2. Kosongkan isi div (container) supaya benar-benar bersih
            if (this.$refs.editorContent) {
                this.$refs.editorContent.innerHTML = '';
            }
            // ----------------------------------------------------

            this.editor = new Editor({
                element: this.$refs.editorContent,
                extensions: [
                    StarterKit.configure({
                        heading: { levels: [1, 2, 3] },
                    }),
                    Placeholder.configure({ placeholder }),
                    Image.configure({ inline: false, allowBase64: true }),
                    Link.configure({ openOnClick: false, HTMLAttributes: { class: 'text-[#86654b] underline' } }),
                    Underline,
                    TextAlign.configure({ types: ['heading', 'paragraph'] }),
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
                    self.content = editor.getHTML();
                    self.wordCount = editor.getText().trim().split(/\s+/).filter(Boolean).length;
                    // keep the hidden input in sync
                    const hidden = document.getElementById('tiptap-content-input');
                    if (hidden) hidden.value = self.content;
                },
            });

            // Initialize word count
            this.wordCount = this.editor.getText().trim().split(/\s+/).filter(Boolean).length;
        },

        destroy() {
            this.editor?.destroy();
        },

        // ── Toolbar helpers ──────────────────────────────────────────────────────

        isActive(type, attrs = {}) {
            return this.editor?.isActive(type, attrs) ?? false;
        },

        toggleBold()         { this.editor?.chain().focus().toggleBold().run(); },
        toggleItalic()       { this.editor?.chain().focus().toggleItalic().run(); },
        toggleUnderline()    { this.editor?.chain().focus().toggleUnderline().run(); },
        toggleStrike()       { this.editor?.chain().focus().toggleStrike().run(); },
        toggleCode()         { this.editor?.chain().focus().toggleCode().run(); },
        toggleBulletList()   { this.editor?.chain().focus().toggleBulletList().run(); },
        toggleOrderedList()  { this.editor?.chain().focus().toggleOrderedList().run(); },
        toggleBlockquote()   { this.editor?.chain().focus().toggleBlockquote().run(); },
        toggleCodeBlock()    { this.editor?.chain().focus().toggleCodeBlock().run(); },
        undo()               { this.editor?.chain().focus().undo().run(); },
        redo()               { this.editor?.chain().focus().redo().run(); },

        setHeading(level)    { this.editor?.chain().focus().toggleHeading({ level }).run(); },
        setAlign(align)      { this.editor?.chain().focus().setTextAlign(align).run(); },

        setLink() {
            const url = window.prompt('Masukkan URL:');
            if (url) {
                this.editor?.chain().focus().setLink({ href: url }).run();
            } else if (url === '') {
                this.editor?.chain().focus().unsetLink().run();
            }
        },

        insertImage() {
            const url = window.prompt('URL gambar:');
            if (url) this.editor?.chain().focus().setImage({ src: url }).run();
        },

        setColor(color) {
            this.editor?.chain().focus().setColor(color).run();
        },
    };
}