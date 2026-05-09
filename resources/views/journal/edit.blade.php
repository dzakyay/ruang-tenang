<x-app-layout>
    <div class="px-6 md:px-10 py-10 max-w-4xl mx-auto">

        {{-- Back --}}
        <a href="{{ route('journal.show', $journal) }}"
            class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-[#614d3c] transition mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-100 rounded-2xl p-5">
                <p class="text-sm font-semibold text-red-700 mb-2">Terdapat beberapa kesalahan:</p>
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('journal.update', $journal) }}" method="POST" enctype="multipart/form-data" x-data="{
            bannerPreview: '{{ $journal->banner_url }}',
            bannerName: null,
            handleBanner(e) {
                const f = e.target.files[0];
                if (!f) return;
                this.bannerName = f.name;
                const r = new FileReader();
                r.onload = ev => { this.bannerPreview = ev.target.result; };
                r.readAsDataURL(f);
            }
        }">
            @csrf
            @method('PATCH')

            <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-[#e8dbce]/40">

                {{-- Banner --}}
                <div class="relative w-full h-56 md:h-72 group cursor-pointer" @click="$refs.bannerInput.click()">
                    <img x-show="bannerPreview" :src="bannerPreview" alt="Preview banner"
                        class="w-full h-full object-cover">
                    <div x-show="!bannerPreview"
                        class="w-full h-full bg-gradient-to-br from-[#e8ddd4] to-[#d4c3b3] flex flex-col items-center justify-center gap-3">
                        <svg class="w-10 h-10 text-[#a07954]/60 group-hover:text-[#614d3c] transition-colors"
                            fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span
                            class="text-sm font-medium text-[#a07954]/70 group-hover:text-[#614d3c] transition-colors">Klik
                            untuk pilih gambar banner</span>
                    </div>
                    <div x-show="bannerPreview"
                        class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition flex items-center justify-center">
                        <span
                            class="text-white text-sm font-medium opacity-0 group-hover:opacity-100 transition drop-shadow">Ubah
                            banner</span>
                    </div>
                </div>
                <input type="file" name="banner" x-ref="bannerInput" accept="image/jpeg,image/png,image/webp"
                    class="hidden" @change="handleBanner($event)">

                <div class="p-8 md:p-12">

                    {{-- Title --}}
                    <input type="text" name="title" value="{{ old('title', $journal->title) }}"
                        placeholder="Judul Jurnal..."
                        class="w-full text-3xl md:text-4xl font-serif font-bold text-[#1c1917] bg-transparent border-none outline-none placeholder-gray-300 mb-4"
                        required>

                    {{-- Description --}}
                    <textarea name="description" placeholder="Deskripsi singkat (opsional)..." rows="2"
                        class="w-full text-base text-gray-500 bg-transparent border-none outline-none resize-none placeholder-gray-300 mb-8">{{ old('description', $journal->description) }}</textarea>

                    <hr class="border-[#e8dbce] mb-8">

                    {{-- ── Tiptap Editor ── --}}
                    <div x-data="tiptapEditor({ placeholder: 'Tulis isi jurnal kamu di sini...', content: `{!! addslashes($journal->content ?? '') !!}` })"
                        x-init="init()" @destroy="destroy()">

                        <input type="hidden" name="content" id="tiptap-content-input" :value="content">

                        {{-- Toolbar --}}
                        <div
                            class="flex flex-wrap items-center gap-1 mb-4 p-2 bg-[#faf8f5] rounded-xl border border-[#e8dbce]/60 sticky top-4 z-10">

                            <button type="button" @click="setHeading(1)"
                                :class="isActive('heading',{level:1}) ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition">H1</button>
                            <button type="button" @click="setHeading(2)"
                                :class="isActive('heading',{level:2}) ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition">H2</button>
                            <button type="button" @click="setHeading(3)"
                                :class="isActive('heading',{level:3}) ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition">H3</button>

                            <div class="w-px h-5 bg-[#e8dbce] mx-1"></div>

                            <button type="button" @click="toggleBold()"
                                :class="isActive('bold') ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="p-1.5 rounded-lg transition" title="Bold">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M15.6 11.79c.97-.67 1.65-1.77 1.65-2.79 0-2.26-1.75-4-4-4H7v14h7.04c2.09 0 3.71-1.7 3.71-3.79 0-1.52-.86-2.82-2.15-3.42zM10 6.5h3c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-3v-3zm3.5 9H10v-3h3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z" />
                                </svg>
                            </button>
                            <button type="button" @click="toggleItalic()"
                                :class="isActive('italic') ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="p-1.5 rounded-lg transition" title="Italic">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 4v3h2.21l-3.42 8H6v3h8v-3h-2.21l3.42-8H18V4z" />
                                </svg>
                            </button>
                            <button type="button" @click="toggleUnderline()"
                                :class="isActive('underline') ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="p-1.5 rounded-lg transition" title="Underline">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17c3.31 0 6-2.69 6-6V3h-2.5v8c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11V3H6v8c0 3.31 2.69 6 6 6zm-7 2v2h14v-2H5z" />
                                </svg>
                            </button>
                            <button type="button" @click="toggleStrike()"
                                :class="isActive('strike') ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="p-1.5 rounded-lg transition" title="Strikethrough">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M6.85 7.08C6.85 4.37 9.45 3 12.24 3c1.64 0 3 .49 3.9 1.28.77.65 1.46 1.73 1.46 3.24h-2.37c0-.69-.22-1.31-.61-1.74-.51-.57-1.36-.86-2.38-.86-1.71 0-2.99.79-2.99 2.18 0 .65.31 1.2.94 1.64h-3.24c-.19-.48-.3-.98-.3-1.66zM3 13h18v-2H3v2zm7.57 5.82c.67.44 1.54.69 2.62.69 1.16 0 2.1-.29 2.63-.8.53-.52.77-1.14.77-1.79h-2.23c0 .46-.23.85-.68 1.11-.34.19-.77.29-1.24.29-1.5 0-2.09-.45-2.09-1.09h-2.21c0 .98.34 1.77 1.43 2.41v-.82z" />
                                </svg>
                            </button>

                            <div class="w-px h-5 bg-[#e8dbce] mx-1"></div>

                            <button type="button" @click="toggleBulletList()"
                                :class="isActive('bulletList') ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="p-1.5 rounded-lg transition" title="Bullet list">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z" />
                                </svg>
                            </button>
                            <button type="button" @click="toggleOrderedList()"
                                :class="isActive('orderedList') ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="p-1.5 rounded-lg transition" title="Numbered list">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M2 17h2v.5H3v1h1v.5H2v1h3v-4H2v1zm1-9h1V4H2v1h1v3zm-1 3h1.8L2 13.1v.9h3v-1H3.2L5 10.9V10H2v1zm5-6v2h14V5H7zm0 14h14v-2H7v2zm0-6h14v-2H7v2z" />
                                </svg>
                            </button>
                            <button type="button" @click="toggleBlockquote()"
                                :class="isActive('blockquote') ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="p-1.5 rounded-lg transition" title="Blockquote">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z" />
                                </svg>
                            </button>

                            <div class="w-px h-5 bg-[#e8dbce] mx-1"></div>

                            <button type="button" @click="setLink()"
                                :class="isActive('link') ? 'bg-[#614d3c] text-white' : 'text-gray-500 hover:bg-[#f0ebe4]'"
                                class="p-1.5 rounded-lg transition" title="Link">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z" />
                                </svg>
                            </button>
                            <button type="button" @click="insertImage()"
                                class="p-1.5 rounded-lg text-gray-500 hover:bg-[#f0ebe4] transition" title="Image URL">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                                </svg>
                            </button>

                            <div class="w-px h-5 bg-[#e8dbce] mx-1"></div>

                            <button type="button" @click="undo()"
                                class="p-1.5 rounded-lg text-gray-500 hover:bg-[#f0ebe4] transition" title="Undo">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.5 8c-2.65 0-5.05.99-6.9 2.6L2 7v9h9l-3.62-3.62c1.39-1.16 3.16-1.88 5.12-1.88 3.54 0 6.55 2.31 7.6 5.5l2.37-.78C21.08 11.03 17.15 8 12.5 8z" />
                                </svg>
                            </button>
                            <button type="button" @click="redo()"
                                class="p-1.5 rounded-lg text-gray-500 hover:bg-[#f0ebe4] transition" title="Redo">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.4 10.6C16.55 8.99 14.15 8 11.5 8c-4.65 0-8.58 3.03-9.96 7.22L3.9 16c1.05-3.19 4.05-5.5 7.6-5.5 1.95 0 3.73.72 5.12 1.88L13 16h9V7l-3.6 3.6z" />
                                </svg>
                            </button>

                            <div class="ml-auto text-xs text-gray-300 pr-1" x-text="wordCount + ' kata'"></div>
                        </div>

                        <div x-ref="editorContent" class="min-h-[320px] focus-within:outline-none"></div>
                    </div>

                </div>
            </div>

            {{-- Action bar --}}
            <div class="mt-6 flex items-center justify-between gap-4">
                <a href="{{ route('journal.show', $journal) }}"
                    class="px-6 py-3 rounded-xl text-sm font-medium text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 transition shadow-sm">
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#614d3c] hover:bg-[#4a3b2d] transition shadow-[0_4px_14px_rgba(97,77,60,0.3)] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <style>
        .tiptap.ProseMirror p.is-editor-empty:first-child::before {
            content: attr(data-placeholder);
            float: left;
            color: #adb5bd;
            pointer-events: none;
            height: 0;
        }

        .tiptap blockquote {
            border-left: 4px solid #d4c3b3;
            padding-left: 1rem;
            color: #6b7280;
            font-style: italic;
        }

        .tiptap a {
            color: #86654b;
            text-decoration: underline;
        }

        .tiptap code {
            background: #f0ebe4;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.875em;
        }

        .tiptap pre {
            background: #1c1917;
            color: #e8ddd4;
            padding: 1rem;
            border-radius: 0.75rem;
            overflow-x: auto;
        }

        .tiptap img {
            border-radius: 0.75rem;
            max-width: 100%;
            margin: 1rem auto;
            display: block;
        }
    </style>
</x-app-layout>