@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto" x-data="{ showDeleteModal: false, deleteId: null, deleteUrl: '' }" @open-delete.window="showDeleteModal = true; deleteId = $event.detail.id; deleteUrl = $event.detail.url; document.getElementById('deleteForm').action = $event.detail.url">

    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Perpustakaan Ensiklopedia Emosi</p>
            <h2 class="text-3xl font-serif font-bold text-[#1c1917] mb-2">Kelola Ensiklopedia Emosi</h2>
            <p class="text-sm text-gray-500 max-w-2xl leading-relaxed">
                Kelola berbagai artikel emosi untuk membantu pengguna memahami kondisi mental mereka.
            </p>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.encyclopedia.index') }}">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <div class="relative w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ $search }}"
                       class="w-full pl-11 pr-4 py-3 bg-white border border-[#e8dbce]/50 rounded-xl text-sm focus:ring-2 focus:ring-[#a07954] outline-none shadow-sm transition"
                       placeholder="Cari nama emosi...">
            </div>

            <div class="flex w-full sm:w-auto items-center gap-4">
                <div class="relative w-full sm:w-48">
                    <select name="category" onchange="this.form.submit()"
                            class="w-full appearance-none bg-white border border-[#e8dbce]/50 rounded-xl px-4 py-3 text-sm text-gray-600 focus:ring-2 focus:ring-[#a07954] outline-none shadow-sm transition">
                        <option value="semua" {{ !$category || $category === 'semua' ? 'selected' : '' }}>Semua Kategori</option>
                        <option value="Positif"   {{ $category === 'Positif'   ? 'selected' : '' }}>Positif</option>
                        <option value="Sulit"     {{ $category === 'Sulit'     ? 'selected' : '' }}>Sulit</option>
                        <option value="Reflektif" {{ $category === 'Reflektif' ? 'selected' : '' }}>Reflektif</option>
                    </select>
                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </div>

                <a href="{{ route('admin.encyclopedia.create') }}"
                   class="bg-[#a07954] text-white px-6 py-3 rounded-xl text-sm font-medium hover:bg-[#8c6746] transition shadow-md whitespace-nowrap flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah
                </a>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30 overflow-hidden">

        <div class="grid grid-cols-12 gap-4 bg-[#e8dbce]/30 px-6 py-4 border-b border-[#e8dbce]/50 text-xs font-serif font-bold text-[#614d3c] tracking-wider">
            <div class="col-span-5">Nama Emosi</div>
            <div class="col-span-3">Kategori</div>
            <div class="col-span-2">Diperbarui</div>
            <div class="col-span-2 text-center">Aksi</div>
        </div>

        <div class="divide-y divide-[#e8dbce]/30">
            @forelse($entries as $entry)
                <div class="grid grid-cols-12 gap-4 px-6 py-5 items-center hover:bg-[#FAF8F5] transition duration-200">
                    <div class="col-span-5 flex items-center gap-4">
                        @if($entry->banner_url)
                            <img src="{{ $entry->banner_url }}" class="w-12 h-12 rounded-2xl object-cover flex-shrink-0" alt="{{ $entry->feeling }}">
                        @else
                            <div class="w-12 h-12 bg-[#F9F7F4] rounded-2xl flex items-center justify-center flex-shrink-0 text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        @endif
                        <p class="text-sm font-bold text-[#1c1917]">{{ $entry->feeling }}</p>
                    </div>
                    <div class="col-span-3">
                        <span class="bg-[#e8dbce]/50 text-[#614d3c] text-xs font-bold px-3 py-1.5 rounded-full">{{ $entry->category }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-sm text-gray-500">{{ $entry->updated_at->format('d M Y') }}</span>
                    </div>
                    <div class="col-span-2 flex justify-center items-center gap-2">
                        <a href="{{ route('admin.encyclopedia.show', $entry) }}"
                           class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-[#a07954] hover:border-[#a07954] transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                        <a href="{{ route('admin.encyclopedia.edit', $entry) }}"
                           class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-blue-500 hover:border-blue-500 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        </a>
                        <button @click="showDeleteModal = true; deleteUrl = '{{ route('admin.encyclopedia.destroy', $entry) }}'; $nextTick(() => document.getElementById('deleteForm').action = '{{ route('admin.encyclopedia.destroy', $entry) }}')"
                                class="w-8 h-8 rounded-full bg-white border border-[#e8dbce] flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-500 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center text-gray-400">
                    <p class="text-sm">Belum ada entri. <a href="{{ route('admin.encyclopedia.create') }}" class="text-[#a07954] font-medium">Tambah sekarang</a></p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="bg-[#e8dbce]/30 px-6 py-4 border-t border-[#e8dbce]/50 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span class="text-sm text-[#614d3c] font-medium">
                Menampilkan {{ $entries->firstItem() }}–{{ $entries->lastItem() }} dari {{ $entries->total() }} data
            </span>
            {{ $entries->links() }}
        </div>
    </div>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-white/60 backdrop-blur-sm" @click="showDeleteModal = false"></div>
        <div class="relative bg-[#efece6] rounded-3xl p-8 max-w-sm w-full shadow-2xl z-10 flex flex-col items-center border border-[#e8dbce]/50 text-center">
            <div class="w-14 h-14 bg-[#a07954] text-white rounded-full flex items-center justify-center mb-6 shadow-md">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <h3 class="text-xl font-serif font-bold text-[#1c1917] mb-2">Yakin ingin menghapus?</h3>
            <p class="text-sm text-gray-600 mb-8 leading-relaxed">Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-4 w-full">
                <button @click="showDeleteModal = false"
                        class="flex-1 bg-white border border-[#e8dbce] text-[#614d3c] font-medium py-3 rounded-xl hover:bg-gray-50 transition">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-[#a07954] text-white font-medium py-3 rounded-xl hover:bg-[#8c6746] transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
