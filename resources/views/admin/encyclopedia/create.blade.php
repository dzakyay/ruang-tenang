@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Top Title -->
    <div class="mb-8">
        <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Perpustakaan Ensiklopedia Emosi</p>
        <h2 class="text-3xl font-serif font-bold text-[#1c1917] mb-2">Tambah Entri Emosi</h2>
        <p class="text-sm text-gray-500 max-w-2xl leading-relaxed">
            Lengkapi perpustakaan emosi dengan informasi yang membantu pengguna memahami kondisi batin mereka secara lebih tenang dan mendalam.
        </p>
    </div>

    <!-- Main Form Container -->
    <form action="#" method="POST" class="bg-[#efece6] rounded-[2rem] p-8 sm:p-12 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/50" x-data="encyclopediaForm()">
        
        <!-- 1. Informasi Dasar -->
        <div class="mb-10">
            <h3 class="text-lg font-serif font-bold text-[#1c1917] mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#a07954]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Informasi Dasar
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Emosi</label>
                    <input type="text" class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] transition" placeholder="Contoh: Kedamaian">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <div class="relative">
                        <select class="w-full appearance-none bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] transition">
                            <option>Positif</option>
                            <option>Negatif</option>
                            <option>Netral</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Aset Visual -->
        <div class="mb-10">
            <h3 class="text-lg font-serif font-bold text-[#1c1917] mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#a07954]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Aset Visual
            </h3>
            
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Banner Upload</label>
                <div class="w-full bg-white border-2 border-dashed border-[#d4c3b3] rounded-2xl flex flex-col items-center justify-center py-10 cursor-pointer hover:bg-gray-50 transition">
                    <svg class="w-8 h-8 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    <span class="text-sm font-medium text-[#1c1917]">Klik atau seret file banner ke sini</span>
                    <span class="text-xs text-gray-400 mt-1">PNG, JPG up to 5MB (1200x400px)</span>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Icon Selection</label>
                <div class="flex flex-wrap gap-3">
                    <template x-for="icon in icons" :key="icon.id">
                        <label class="cursor-pointer relative">
                            <input type="radio" name="icon" :value="icon.id" x-model="selectedIcon" class="sr-only">
                            <div :class="selectedIcon === icon.id ? 'bg-[#a07954] text-white border-[#a07954]' : 'bg-transparent text-gray-500 border-[#d4c3b3] hover:border-[#a07954]'" 
                                 class="w-12 h-12 rounded-xl border flex items-center justify-center transition-colors">
                                <span x-html="icon.svg"></span>
                            </div>
                        </label>
                    </template>
                </div>
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
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea rows="2" class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] resize-none transition" placeholder="Tuliskan ringkasan singkat emosi ini..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan Validasi / Quote</label>
                    <input type="text" class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] transition" placeholder="&quot;Ketenangan bukanlah ketiadaan badai...&quot;">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konten Utama Emosi</label>
                    <textarea rows="6" class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] resize-none transition" placeholder="Mulai menulis konten edukasi secara mendalam di sini..."></textarea>
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
                <button type="button" @click="openTipModal()" class="text-[#a07954] text-sm font-semibold hover:text-[#8c6746] transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Tips
                </button>
            </div>

            <div class="space-y-4">
                <template x-for="(tip, index) in tips" :key="tip.id">
                    <div class="bg-[#FAF8F5] rounded-2xl p-4 flex gap-4 items-start border border-[#e8dbce]/30">
                        <div class="w-8 h-8 rounded-full bg-[#d4c3b3] text-white flex items-center justify-center text-sm font-bold flex-shrink-0 mt-1" x-text="index + 1"></div>
                        <div class="flex-1 space-y-3">
                            <input type="text" x-model="tip.title" class="w-full bg-transparent border-0 border-b border-[#e8dbce] px-0 py-1 text-sm font-semibold text-[#1c1917] focus:ring-0 focus:border-[#a07954] outline-none transition placeholder-gray-400" placeholder="Judul Tips">
                            <input type="text" x-model="tip.desc" class="w-full bg-transparent border-0 border-b border-[#e8dbce] px-0 py-1 text-xs text-gray-500 focus:ring-0 focus:border-[#a07954] outline-none transition placeholder-gray-400" placeholder="Deskripsi atau langkah-langkah...">
                        </div>
                        <button type="button" @click="removeTip(tip.id)" class="text-gray-400 hover:text-red-500 p-2 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <!-- Submit Actions -->
        <div class="flex flex-col sm:flex-row justify-end gap-4 mt-12 pt-6 border-t border-[#e8dbce]/50">
            <a href="{{ route('admin.encyclopedia.index') }}" class="w-full sm:w-auto bg-white border border-[#e8dbce] text-[#614d3c] text-center font-medium px-8 py-3 rounded-xl hover:bg-gray-50 transition shadow-sm">
                Batal
            </a>
            <button type="submit" class="w-full sm:w-auto bg-[#a07954] text-white font-medium px-8 py-3 rounded-xl hover:bg-[#8c6746] transition shadow-md">
                Simpan Entri
            </button>
        </div>

        <!-- Add Tip Modal -->
        <div x-show="showTipModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
            <!-- Backdrop -->
            <div x-show="showTipModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 backdrop-blur-none"
                 x-transition:enter-end="opacity-100 backdrop-blur-sm"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 backdrop-blur-sm"
                 x-transition:leave-end="opacity-0 backdrop-blur-none"
                 class="fixed inset-0 bg-white/60 backdrop-blur-sm"
                 @click="showTipModal = false"></div>

            <!-- Modal Content -->
            <div x-show="showTipModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative bg-[#efece6] rounded-3xl p-8 max-w-sm w-full shadow-2xl z-10 flex flex-col border border-[#e8dbce]/50">
                
                <h3 class="text-xl font-serif font-bold text-[#1c1917] mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#a07954]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    Tambah Tips Praktis
                </h3>

                <div class="space-y-4 mb-8">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Tips</label>
                        <input type="text" x-model="newTipTitle" class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none transition" placeholder="Contoh: Pernapasan Perut">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Tips</label>
                        <textarea rows="3" x-model="newTipDesc" class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#a07954] outline-none transition resize-none" placeholder="Jelaskan langkah-langkah praktisnya..."></textarea>
                    </div>
                </div>

                <div class="flex gap-4 w-full">
                    <button type="button" @click="showTipModal = false" class="flex-1 bg-white border border-[#e8dbce] text-[#614d3c] font-medium py-3 rounded-xl hover:bg-gray-50 transition shadow-sm">
                        Batal
                    </button>
                    <button type="button" @click="addTipFromModal()" class="flex-1 bg-[#a07954] text-white font-medium py-3 rounded-xl hover:bg-[#8c6746] transition shadow-md">
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
        selectedIcon: 1,
        icons: [
            { id: 1, svg: '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' },
            { id: 2, svg: '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>' },
            { id: 3, svg: '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>' },
            { id: 4, svg: '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>' },
            { id: 5, svg: '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>' },
            { id: 6, svg: '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>' }
        ],
        showTipModal: false,
        newTipTitle: '',
        newTipDesc: '',
        tips: [
            { id: Date.now(), title: 'Ambil napas dalam selama 5 hitungan ketika merasa tegang.', desc: 'Fokuskan pada udara yang masuk melalui hidung dan keluar melalui mulut secara perlahan.' },
            { id: Date.now() + 1, title: 'Ambil karung goni', desc: 'Cari rumah termewah di sekitarmu, lalu........' }
        ],
        openTipModal() {
            this.newTipTitle = '';
            this.newTipDesc = '';
            this.showTipModal = true;
        },
        addTipFromModal() {
            if (this.newTipTitle.trim() === '') return;
            this.tips.push({ 
                id: Date.now(), 
                title: this.newTipTitle, 
                desc: this.newTipDesc 
            });
            this.showTipModal = false;
        },
        removeTip(id) {
            this.tips = this.tips.filter(tip => tip.id !== id);
        }
    }
}
</script>
@endpush
