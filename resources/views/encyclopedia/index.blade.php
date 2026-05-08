<x-app-layout>
    <div class="px-10 py-12 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10 max-w-3xl">
            <h1 class="text-5xl font-serif text-[#1c1917] mb-4">Ensiklopedia Perasaan</h1>
            <p class="text-gray-600 text-lg leading-relaxed">
                Setiap emosi memiliki pesan yang ingin disampaikan. Mari mengenali dan memahami bahasa batinmu dengan lebih lembut di dalam perpustakaan perasaan ini.
            </p>
        </div>

        <!-- Top Bar: Search & Filters -->
        <form method="GET" action="{{ route('encyclopedia.index') }}">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <!-- Search -->
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ $search }}"
                           class="block w-full pl-11 pr-4 py-3 bg-white border-none rounded-2xl text-sm placeholder-gray-400 focus:ring-2 focus:ring-primary shadow-[0_2px_10px_rgba(0,0,0,0.02)] transition"
                           placeholder="Cari perasaan...">
                </div>

                <!-- Filters -->
                <div class="flex flex-wrap items-center gap-3">
                    @foreach(['semua' => 'Semua', 'Sulit' => 'Sulit', 'Positif' => 'Positif', 'Reflektif' => 'Reflektif'] as $value => $label)
                        <button type="submit" name="category" value="{{ $value }}"
                                class="px-6 py-2.5 rounded-full text-sm font-medium transition
                                       {{ $category === $value
                                           ? 'bg-[#614d3c] text-white shadow-sm'
                                           : 'bg-[#d4c3b3] text-gray-700 hover:bg-[#c9b5a3]' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </form>

        <!-- Empty State -->
        @if ($entries->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="w-20 h-20 rounded-full bg-[#f4ebe1] flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-[#a07954]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-serif text-[#614d3c] mb-2">Tidak ada perasaan ditemukan</h3>
                <p class="text-gray-400 text-sm">Coba kata kunci atau kategori yang berbeda.</p>
            </div>

        <!-- Grid Cards -->
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($entries as $entry)
                    <div class="bg-white rounded-[2rem] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col group hover:-translate-y-1 transition duration-300">
                        <div class="h-56 overflow-hidden">
                            @if ($entry->banner_url)
                                <img src="{{ $entry->banner_url }}" alt="{{ $entry->feeling }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#f4ebe1] to-[#e8dbce]"></div>
                            @endif
                        </div>
                        <div class="p-8 flex flex-col flex-1">
                            <span class="text-[10px] font-bold tracking-widest uppercase text-[#a07954] mb-2">{{ $entry->category }}</span>
                            <h3 class="text-2xl font-serif text-[#1c1917] mb-3">{{ $entry->feeling }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-1">
                                {{ $entry->description }}
                            </p>
                            <a href="{{ route('encyclopedia.show', $entry) }}"
                               class="inline-flex items-center text-[#d4b996] font-medium text-sm group-hover:text-[#a07954] transition">
                                Pelajari lebih dalam
                                <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $entries->links() }}
            </div>
        @endif

    </div>
</x-app-layout>
