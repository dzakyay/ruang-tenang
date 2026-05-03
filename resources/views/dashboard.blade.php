<x-app-layout>
    <div x-data="{ showMoodModal: true }" class="px-10 py-12 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-serif text-[#614d3c] mb-2">Selamat Pagi, {{ Auth::user()->name }}.</h1>
            <p class="text-gray-500">Semoga harimu dipenuhi ketenangan.</p>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Tren Suasana Hati (Chart Placeholder) -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-xl font-bold text-[#7a5c43]">Tren Suasana Hati</h2>
                    <button class="text-sm text-gray-500 flex items-center gap-1 hover:text-[#7a5c43]">
                        7 Hari Terakhir
                        <x-icons.chevron-down class="w-4 h-4" />
                    </button>
                </div>

                <!-- Chart SVG Placeholder mimicking the curve -->
                <div class="flex-1 relative flex items-center justify-center min-h-[250px]">
                    <svg class="absolute inset-0 w-full h-full text-[#e8dbce]" preserveAspectRatio="none" viewBox="0 0 500 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 150 C 50 50, 100 200, 150 150 C 200 100, 250 50, 300 150 C 350 250, 400 100, 500 150" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                    </svg>

                    <div class="text-center z-10 bg-white/60 backdrop-blur-sm p-4 rounded-xl mt-12">
                        <div class="inline-flex justify-center items-center w-8 h-8 rounded-full bg-[#f4ebe1] text-[#a07954] mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        </div>
                        <p class="text-[#614d3c] font-medium text-sm">Grafik Tren Suasana Hati</p>
                        <p class="text-xs text-gray-400 mt-1">Data menunjukkan ketenangan yang stabil minggu ini.</p>
                    </div>
                </div>
            </div>

            <!-- Konsistensi Berjurnal -->
            <div class="bg-[#5c442b] rounded-3xl p-8 text-white flex flex-col justify-between shadow-[0_10px_30px_rgba(92,68,43,0.3)] relative overflow-hidden">
                <!-- Abstract leaf decoration -->
                <svg class="absolute -bottom-10 -right-10 w-48 h-48 text-white/10" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M21 3C21 3 14 3 8 9C2 15 2 21 2 21C2 21 8 21 14 15C20 9 21 3 21 3Z"/>
                </svg>

                <div class="relative z-10">
                    <h2 class="text-white/80 font-serif text-lg mb-4">Konsistensi Berjurnal</h2>
                    <div class="mb-4">
                        <span class="text-6xl font-bold font-serif">12</span>
                        <span class="text-3xl font-serif"> Hari</span>
                    </div>
                    <p class="text-white/70 text-sm leading-relaxed mb-8">
                        Kamu telah meluangkan waktu untuk dirimu sendiri secara konsisten. Teruskan perjalanan baik ini.
                    </p>
                </div>

                <a href="{{ route('journal.create') }}" class="relative z-10 block w-full bg-white text-[#5c442b] text-center font-semibold py-3.5 rounded-xl hover:bg-gray-50 transition shadow-sm">
                    Mulai Menulis
                </a>
            </div>
        </div>

        <!-- Ensiklopedia Perasaan Banner -->
        <div class="relative bg-gray-200 rounded-3xl overflow-hidden shadow-sm">
            <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Mountains" class="absolute inset-0 w-full h-full object-cover opacity-60">
            <!-- Overlay gradient to make text readable -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#e3dcd1]/90 to-transparent"></div>

            <div class="relative z-10 p-10 lg:p-14 max-w-xl">
                <h2 class="text-3xl font-serif font-bold text-[#614d3c] mb-3">Ensiklopedia Perasaan</h2>
                <p class="text-gray-700 mb-8 leading-relaxed">
                    Temukan perasaan yang membuat anda menyesakkan dan membingungkan.
                </p>
                <a href="{{ route('encyclopedia.index') }}" class="inline-block bg-[#614d3c] text-white px-8 py-3 rounded-xl font-medium hover:bg-[#4a3b2d] transition shadow-md">
                    Jelajahi Sekarang
                </a>
            </div>
        </div>

        <!-- Modal Mood Tracker -->
        <div x-show="showMoodModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
            <!-- Overlay -->
            <div x-show="showMoodModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-white/80 backdrop-blur-sm"></div>

            <!-- Modal Content -->
            <div x-show="showMoodModal"
                 @click.away="showMoodModal = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative bg-[#F9F7F4] rounded-[2rem] p-8 sm:p-10 max-w-md w-full shadow-2xl z-10 flex flex-col items-center border border-[#e8dbce]/50">

                <div class="w-12 h-1 bg-[#d4c3b3] rounded-full mb-8"></div>

                <h2 class="text-3xl font-serif text-[#1c1917] text-center mb-10 leading-tight">Bagaimana perasaanmu<br>hari ini?</h2>

                <div class="flex justify-between w-full mb-8 px-2">
                    <!-- Sedih -->
                    <button class="flex flex-col items-center gap-2 group outline-none">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:-translate-y-1 transition duration-300">😔</div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Sedih</span>
                    </button>
                    <!-- Biasa -->
                    <button class="flex flex-col items-center gap-2 group outline-none">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:-translate-y-1 transition duration-300">😐</div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Biasa</span>
                    </button>
                    <!-- Senang (Active) -->
                    <button class="flex flex-col items-center gap-2 outline-none">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-[#a07954] rounded-2xl flex items-center justify-center text-3xl shadow-[0_8px_20px_rgba(160,121,84,0.4)] -translate-y-2">😊</div>
                        <span class="text-[10px] font-bold text-[#a07954] uppercase tracking-wide">Senang</span>
                    </button>
                    <!-- Sangat -->
                    <button class="flex flex-col items-center gap-2 group outline-none">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:-translate-y-1 transition duration-300">😍</div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Sangat</span>
                    </button>
                    <!-- Semangat -->
                    <button class="flex flex-col items-center gap-2 group outline-none">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:-translate-y-1 transition duration-300">🔥</div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Semangat</span>
                    </button>
                </div>

                <div class="w-full text-left mb-8">
                    <label class="block text-xs font-semibold text-[#614d3c] mb-2 tracking-wide">Ceritakan sedikit (opsional)</label>
                    <textarea class="w-full bg-white border-0 rounded-2xl p-4 text-sm resize-none focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]" rows="3" placeholder="Apa yang ada di pikiranmu..."></textarea>
                </div>

                <button @click="showMoodModal = false" class="w-full bg-[#5c442b] text-white py-3.5 rounded-xl font-medium shadow-[0_4px_14px_rgba(92,68,43,0.3)] hover:bg-[#4a3622] hover:-translate-y-0.5 transition duration-300 mb-4">
                    Simpan Perasaan
                </button>
                <button @click="showMoodModal = false" class="text-sm font-medium text-gray-400 hover:text-[#614d3c] transition">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
