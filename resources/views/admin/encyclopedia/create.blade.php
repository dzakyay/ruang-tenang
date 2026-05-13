@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-8">
        <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Perpustakaan Ensiklopedia Emosi</p>
        <h2 class="text-3xl font-serif font-bold text-[#1c1917] mb-2">Tambah Entri Emosi</h2>
        <p class="text-sm text-gray-500 max-w-2xl leading-relaxed">
            Lengkapi perpustakaan emosi dengan informasi yang membantu pengguna memahami kondisi batin mereka.
        </p>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.encyclopedia.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-[#efece6] rounded-[2rem] p-8 sm:p-12 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/50"
          x-data="encyclopediaForm()">
        @csrf

        <!-- 1. Informasi Dasar -->
        <div class="mb-10">
            <h3 class="text-lg font-serif font-bold text-[#1c1917] mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#a07954]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Informasi Dasar
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Emosi <span class="text-red-400">*</span></label>
                    <input type="text" name="feeling" value="{{ old('feeling') }}"
                           class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] transition"
                           placeholder="Contoh: Kedamaian" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <select name="category"
                                class="w-full appearance-none bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] transition">
                            <option value="Positif"   {{ old('category') === 'Positif'   ? 'selected' : '' }}>Positif</option>
                            <option value="Sulit"     {{ old('category') === 'Sulit'     ? 'selected' : '' }}>Sulit</option>
                            <option value="Reflektif" {{ old('category') === 'Reflektif' ? 'selected' : '' }}>Reflektif</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Banner -->
        <div class="mb-10">
            <h3 class="text-lg font-serif font-bold text-[#1c1917] mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#a07954]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Aset Visual
            </h3>
            <div x-data="{ preview: null }">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Banner</label>
                <div class="w-full bg-white border-2 border-dashed border-[#d4c3b3] rounded-2xl flex flex-col items-center justify-center py-10 cursor-pointer hover:bg-gray-50 transition relative overflow-hidden"
                     @click="$refs.bannerInput.click()">
                    <template x-if="preview">
                        <img :src="preview" class="absolute inset-0 w-full h-full object-cover rounded-2xl opacity-40">
                    </template>
                    <svg class="w-8 h-8 text-gray-400 mb-3 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    <span class="text-sm font-medium text-[#1c1917] relative z-10">Klik untuk upload banner</span>
                    <span class="text-xs text-gray-400 mt-1 relative z-10">JPG, JPEG, PNG, WEBP maks 5MB</span>
                </div>
                <input type="file" name="banner" x-ref="bannerInput" accept="image/jpg,image/jpeg,image/png,image/webp" class="hidden"
                       @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
            </div>
        </div>

        <!-- 3. Narasi & Konten -->
        <div class="mb-10">
            <h3 class="text-lg font-serif font-bold text-[#1c1917] mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#a07954]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Narasi & Konten
            </h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat <span class="text-red-400">*</span></label>
                    <textarea name="description" rows="2" required
                              class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] resize-none transition"
                              placeholder="Tuliskan ringkasan singkat emosi ini...">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan Validasi / Quote</label>
                    <input type="text" name="quote" value="{{ old('quote') }}"
                           class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] transition"
                           placeholder='"Ketenangan bukanlah ketiadaan badai..."'>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konten Utama</label>
                    <textarea name="content" rows="6"
                              class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] resize-none transition"
                              placeholder="Mulai menulis konten edukasi di sini...">{{ old('content') }}</textarea>
                </div>
            </div>
        </div>

        <!-- 4. Tips Praktis -->
        <div class="mb-10">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-serif font-bold text-[#1c1917] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#a07954]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    Tips Praktis
                </h3>
                <button type="button" @click="openTipModal()"
                        class="text-[#a07954] text-sm font-semibold hover:text-[#8c6746] transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Tips
                </button>
            </div>

            <div class="space-y-4">
                <template x-for="(tip, index) in tips" :key="tip.id">
                    <div class="bg-[#FAF8F5] rounded-2xl p-4 flex gap-4 items-start border border-[#e8dbce]/30">
                        <div class="w-8 h-8 rounded-full bg-[#d4c3b3] text-white flex items-center justify-center text-sm font-bold flex-shrink-0 mt-1"
                             x-text="index + 1"></div>
                        <div class="flex-1 space-y-2">
                            <input type="text" :name="'tips[' + index + '][title]'" x-model="tip.title"
                                   class="w-full bg-transparent border-0 border-b border-[#e8dbce] px-0 py-1 text-sm font-semibold text-[#1c1917] focus:ring-0 focus:border-[#a07954] outline-none transition"
                                   placeholder="Judul Tips">
                            <input type="text" :name="'tips[' + index + '][body]'" x-model="tip.body"
                                   class="w-full bg-transparent border-0 border-b border-[#e8dbce] px-0 py-1 text-xs text-gray-500 focus:ring-0 focus:border-[#a07954] outline-none transition"
                                   placeholder="Deskripsi tips...">
                        </div>
                        <button type="button" @click="removeTip(tip.id)" class="text-gray-400 hover:text-red-500 p-2 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </template>
                <p x-show="tips.length === 0" class="text-sm text-gray-400 text-center py-4">Belum ada tips. Klik "Tambah Tips" untuk mulai.</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row justify-end gap-4 mt-12 pt-6 border-t border-[#e8dbce]/50">
            <a href="{{ route('admin.encyclopedia.index') }}"
               class="w-full sm:w-auto bg-white border border-[#e8dbce] text-[#614d3c] text-center font-medium px-8 py-3 rounded-xl hover:bg-gray-50 transition shadow-sm">
                Batal
            </a>
            <button type="submit"
                    class="w-full sm:w-auto bg-[#a07954] text-white font-medium px-8 py-3 rounded-xl hover:bg-[#8c6746] transition shadow-md">
                Simpan Entri
            </button>
        </div>

        <!-- Tip Modal -->
        <div x-show="showTipModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-white/60 backdrop-blur-sm" @click="showTipModal = false"></div>
            <div class="relative bg-[#efece6] rounded-3xl p-8 max-w-sm w-full shadow-2xl z-10 border border-[#e8dbce]/50">
                <h3 class="text-xl font-serif font-bold text-[#1c1917] mb-6">Tambah Tips Praktis</h3>
                <div class="space-y-4 mb-8">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Tips</label>
                        <input type="text" x-model="newTipTitle"
                               class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none transition"
                               placeholder="Contoh: Pernapasan Perut">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea rows="3" x-model="newTipBody"
                                  class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none transition resize-none"
                                  placeholder="Jelaskan langkah-langkahnya..."></textarea>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button type="button" @click="showTipModal = false"
                            class="flex-1 bg-white border border-[#e8dbce] text-[#614d3c] font-medium py-3 rounded-xl hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="button" @click="addTipFromModal()"
                            class="flex-1 bg-[#a07954] text-white font-medium py-3 rounded-xl hover:bg-[#8c6746] transition">
                        Tambah
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
function encyclopediaForm() {
    return {
        tips: [],
        showTipModal: false,
        newTipTitle: '',
        newTipBody: '',
        openTipModal() { this.newTipTitle = ''; this.newTipBody = ''; this.showTipModal = true; },
        addTipFromModal() {
            if (!this.newTipTitle.trim()) return;
            this.tips.push({ id: Date.now(), title: this.newTipTitle, body: this.newTipBody });
            this.showTipModal = false;
        },
        removeTip(id) { this.tips = this.tips.filter(t => t.id !== id); },
    };
}
</script>
@endpush
