@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto" x-data="{ showDeleteModal: false, itemToDelete: null }">

    <!-- Top Row: Title and Profile -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Perpustakaan Ensiklopedia Emosi</p>
            <h2 class="text-3xl font-serif font-bold text-[#1c1917] mb-2">Kelola Ensiklopedia Emosi</h2>
            <p class="text-sm text-gray-500 max-w-2xl leading-relaxed">
                Kelola berbagai artikel emosi untuk membantu pengguna memahami dan menavigasi kondisi mental mereka dengan lebih tenang.
            </p>
        </div>
        <!-- Profile Image -->
        <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden shadow-sm flex-shrink-0">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Admin Profile" class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Filters and Action -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
        <div class="relative w-full sm:w-96">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" class="w-full pl-11 pr-4 py-3 bg-white border border-[#e8dbce]/50 rounded-xl text-sm focus:ring-2 focus:ring-[#a07954] focus:border-[#a07954] outline-none shadow-sm transition" placeholder="Cari nama emosi atau kata kunci...">
        </div>

        <div class="flex w-full sm:w-auto items-center gap-4">
            <div class="relative w-full sm:w-48">
                <select class="w-full appearance-none bg-white border border-[#e8dbce]/50 rounded-xl px-4 py-3 text-sm text-gray-600 focus:ring-2 focus:ring-[#a07954] focus:border-[#a07954] outline-none shadow-sm transition">
                    <option>Semua Kategori</option>
                    <option>Takut & Cemas</option>
                    <option>Positif & Damai</option>
                    <option>Sedih & Terasing</option>
                </select>
                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            <a href="{{ route('admin.encyclopedia.create') }}" class="w-full sm:w-auto bg-[#a07954] text-white px-6 py-3 rounded-xl text-sm font-medium hover:bg-[#8c6746] transition shadow-md whitespace-nowrap flex justify-center items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah
            </a>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30 overflow-hidden">
        
        <!-- Table Header -->
        <div class="grid grid-cols-12 gap-4 bg-[#e8dbce]/30 px-6 py-4 border-b border-[#e8dbce]/50 text-xs font-serif font-bold text-[#614d3c] tracking-wider text-center sm:text-left">
            <div class="col-span-12 sm:col-span-4 sm:pl-12">Nama Emosi</div>
            <div class="col-span-12 sm:col-span-3">Kategori</div>
            <div class="col-span-12 sm:col-span-3">Terakhir Diperbarui</div>
            <div class="col-span-12 sm:col-span-2 text-center">Aksi</div>
        </div>

        <!-- Table Body -->
        <div class="divide-y divide-[#e8dbce]/30">
            
            <!-- Row 1 -->
            <div class="grid grid-cols-12 gap-4 px-6 py-5 items-center hover:bg-[#FAF8F5] transition duration-200">
                <div class="col-span-12 sm:col-span-4 flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                    <div class="w-12 h-12 bg-[#F9F7F4] rounded-2xl flex items-center justify-center flex-shrink-0 text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-[#1c1917]">Anxiety (Kecemasan)</p>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-3 flex justify-center sm:justify-start">
                    <span class="bg-[#e8dbce]/50 text-[#614d3c] text-xs font-bold px-3 py-1.5 rounded-full">Takut & Cemas</span>
                </div>
                <div class="col-span-12 sm:col-span-3 flex justify-center sm:justify-start">
                    <span class="text-sm text-gray-500">12 Oct 2023</span>
                </div>
                <div class="col-span-12 sm:col-span-2 flex justify-center items-center gap-3">
                    <button class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-[#a07954] hover:border-[#a07954] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                    <button class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-blue-500 hover:border-blue-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </button>
                    <button @click="showDeleteModal = true; itemToDelete = 1" class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="grid grid-cols-12 gap-4 px-6 py-5 items-center hover:bg-[#FAF8F5] transition duration-200">
                <div class="col-span-12 sm:col-span-4 flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                    <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center flex-shrink-0 text-red-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-[#1c1917]">Gratitude (Syukur)</p>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-3 flex justify-center sm:justify-start">
                    <span class="bg-[#e8dbce]/50 text-[#614d3c] text-xs font-bold px-3 py-1.5 rounded-full">Positif & Damai</span>
                </div>
                <div class="col-span-12 sm:col-span-3 flex justify-center sm:justify-start">
                    <span class="text-sm text-gray-500">10 Oct 2023</span>
                </div>
                <div class="col-span-12 sm:col-span-2 flex justify-center items-center gap-3">
                    <button class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-[#a07954] hover:border-[#a07954] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                    <button class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-blue-500 hover:border-blue-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </button>
                    <button @click="showDeleteModal = true; itemToDelete = 2" class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="grid grid-cols-12 gap-4 px-6 py-5 items-center hover:bg-[#FAF8F5] transition duration-200">
                <div class="col-span-12 sm:col-span-4 flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center flex-shrink-0 text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-[#1c1917]">Loneliness (Kesepian)</p>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-3 flex justify-center sm:justify-start">
                    <span class="bg-[#e8dbce]/50 text-[#614d3c] text-xs font-bold px-3 py-1.5 rounded-full">Sedih & Terasing</span>
                </div>
                <div class="col-span-12 sm:col-span-3 flex justify-center sm:justify-start">
                    <span class="text-sm text-gray-500">05 Oct 2023</span>
                </div>
                <div class="col-span-12 sm:col-span-2 flex justify-center items-center gap-3">
                    <button class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-[#a07954] hover:border-[#a07954] transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                    <button class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-blue-500 hover:border-blue-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </button>
                    <button @click="showDeleteModal = true; itemToDelete = 3" class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="bg-[#e8dbce]/30 px-6 py-4 border-t border-[#e8dbce]/50 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span class="text-sm text-[#614d3c] font-medium">Menampilkan 1-3 dari 124 data</span>
            <div class="flex gap-1">
                <button class="w-8 h-8 rounded-lg bg-transparent text-gray-400 hover:bg-[#e8dbce]/50 flex items-center justify-center transition disabled:opacity-50" disabled>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="w-8 h-8 rounded-lg bg-[#a07954] text-white flex items-center justify-center text-sm font-medium transition shadow-sm">1</button>
                <button class="w-8 h-8 rounded-lg bg-transparent text-[#614d3c] hover:bg-[#e8dbce]/50 flex items-center justify-center text-sm font-medium transition">2</button>
                <button class="w-8 h-8 rounded-lg bg-transparent text-[#614d3c] hover:bg-[#e8dbce]/50 flex items-center justify-center text-sm font-medium transition">3</button>
                <button class="w-8 h-8 rounded-lg bg-transparent text-[#614d3c] hover:bg-[#e8dbce]/50 flex items-center justify-center transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
        <!-- Backdrop -->
        <div x-show="showDeleteModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 backdrop-blur-none"
             x-transition:enter-end="opacity-100 backdrop-blur-sm"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 backdrop-blur-sm"
             x-transition:leave-end="opacity-0 backdrop-blur-none"
             class="fixed inset-0 bg-white/60 backdrop-blur-sm"
             @click="showDeleteModal = false"></div>

        <!-- Modal Content -->
        <div x-show="showDeleteModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative bg-[#efece6] rounded-3xl p-8 max-w-sm w-full shadow-2xl z-10 flex flex-col items-center border border-[#e8dbce]/50 text-center">
            
            <div class="w-14 h-14 bg-[#a07954] text-white rounded-full flex items-center justify-center mb-6 shadow-md">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>

            <h3 class="text-xl font-serif font-bold text-[#1c1917] mb-2">Yakin ingin menghapus?</h3>
            <p class="text-sm text-gray-600 mb-8 leading-relaxed">
                Tindakan ini tidak dapat dibatalkan. Menghapus entri ini akan secara permanen menghilangkan data emosi dari catatan klinis pasien.
            </p>

            <div class="flex gap-4 w-full">
                <button @click="showDeleteModal = false" class="flex-1 bg-white border border-[#e8dbce] text-[#614d3c] font-medium py-3 rounded-xl hover:bg-gray-50 transition shadow-sm">
                    Batal
                </button>
                <button @click="showDeleteModal = false" class="flex-1 bg-[#a07954] text-white font-medium py-3 rounded-xl hover:bg-[#8c6746] transition shadow-md">
                    Hapus
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
