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
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <!-- Search -->
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" class="block w-full pl-11 pr-4 py-3 bg-white border-none rounded-2xl text-sm placeholder-gray-400 focus:ring-2 focus:ring-primary shadow-[0_2px_10px_rgba(0,0,0,0.02)] transition" placeholder="Cari perasaan...">
            </div>

            <!-- Filters -->
            <div class="flex flex-wrap items-center gap-3">
                <button class="px-6 py-2.5 rounded-full text-sm font-medium bg-[#614d3c] text-white shadow-sm transition">Semua</button>
                <button class="px-6 py-2.5 rounded-full text-sm font-medium bg-[#d4c3b3] text-gray-700 hover:bg-[#c9b5a3] transition">Sulit</button>
                <button class="px-6 py-2.5 rounded-full text-sm font-medium bg-[#d4c3b3] text-gray-700 hover:bg-[#c9b5a3] transition">Positif</button>
                <button class="px-6 py-2.5 rounded-full text-sm font-medium bg-[#d4c3b3] text-gray-700 hover:bg-[#c9b5a3] transition">Reflektif</button>
            </div>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Card 1: Burnout -->
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col group hover:-translate-y-1 transition duration-300">
                <div class="h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542644917-768a415a995e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Candle" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-serif text-[#1c1917] mb-3">Burnout (Kelelahan Mental)</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-1">
                        Perasaan ketika sumber daya batinmu terasa terkuras habis. Ini adalah sinyal dari tubuh untuk berhenti sejenak dan memulihkan energi yang.
                    </p>
                    <a href="#" class="inline-flex items-center text-[#d4b996] font-medium text-sm group-hover:text-[#a07954] transition">
                        Pelajari lebih dalam
                        <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Card 2: Kecemasan -->
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col group hover:-translate-y-1 transition duration-300">
                <div class="h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1579546929518-9e396f3cc809?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Wave" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-serif text-[#1c1917] mb-3">Kecemasan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-1">
                        Rasa tidak tenang akan masa depan yang belum terjadi. Kecemasan mengajak kita untuk kembali berlabuh pada nafas dan saat ini.
                    </p>
                    <a href="{{ route('encyclopedia.show') }}" class="inline-flex items-center text-[#d4b996] font-medium text-sm group-hover:text-[#a07954] transition">
                        Pelajari lebih dalam
                        <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Card 3: Kebahagiaan -->
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col group hover:-translate-y-1 transition duration-300">
                <div class="h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1490750967868-88cb4eca8929?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Flower" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-serif text-[#1c1917] mb-3">Kebahagiaan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-1">
                        Percikan cahaya dalam keseharian. Kebahagiaan bukan hanya tujuan, melainkan cara kita menghargai momen-momen kecil yang bermakna.
                    </p>
                    <a href="#" class="inline-flex items-center text-[#d4b996] font-medium text-sm group-hover:text-[#a07954] transition">
                        Pelajari lebih dalam
                        <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Card 4: Kesepian -->
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col group hover:-translate-y-1 transition duration-300">
                <div class="h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542223189-67a03fa0f0bd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Forest" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-serif text-[#1c1917] mb-3">Kesepian</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-1">
                        Kerinduan akan koneksi dan pemahaman. Kesepian adalah ruang sunyi yang mengundangmu untuk berteman dengan diri sendiri terlebih dahulu.
                    </p>
                    <a href="#" class="inline-flex items-center text-[#f0e6d2] font-medium text-sm group-hover:text-[#a07954] transition">
                        Pelajari lebih dalam
                        <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Card 5: Ketenangan -->
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col group hover:-translate-y-1 transition duration-300">
                <div class="h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1518837695005-2083093ee35b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Water" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-serif text-[#1c1917] mb-3">Ketenangan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-1">
                        Keadaan di mana hati merasa cukup dan damai. Ini adalah tempat di mana badai emosi mereda dan kejernihan pikiran mulai muncul.
                    </p>
                    <a href="#" class="inline-flex items-center text-[#f0e6d2] font-medium text-sm group-hover:text-[#a07954] transition">
                        Pelajari lebih dalam
                        <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Card 6: Kesedihan -->
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col group hover:-translate-y-1 transition duration-300">
                <div class="h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1515694346937-94d85e41e6f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Rain" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-serif text-[#1c1917] mb-3">Kesedihan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-1">
                        Emosi yang membantu kita melepaskan apa yang telah pergi. Kesedihan adalah proses penyembuhan alami yang melunakkan kekakuan hati.
                    </p>
                    <a href="#" class="inline-flex items-center text-[#f0e6d2] font-medium text-sm group-hover:text-[#a07954] transition">
                        Pelajari lebih dalam
                        <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
