<x-app-layout>
    <div class="px-10 py-12 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10">
            <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Analisis Jurnal</p>
            <h1 class="text-4xl font-serif font-bold text-[#614d3c] mb-2 italic">Mengenal Dirimu Lebih Dalam</h1>
            <p class="text-gray-500 max-w-2xl">Luangkan waktu sejenak untuk melihat bagaimana perasaanmu berkembang selama bulan ini.</p>
        </div>

        <!-- Top Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Tren Suasana Hati -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-xl font-bold text-[#7a5c43]">Tren Suasana Hati</h2>
                    <button class="text-sm text-gray-500 flex items-center gap-1 hover:text-[#7a5c43]">
                        7 Hari Terakhir
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                </div>
                
                <!-- Chart SVG Placeholder -->
                <div class="flex-1 relative flex items-center justify-center min-h-[250px]">
                    <svg class="absolute inset-0 w-full h-full text-[#614d3c]" preserveAspectRatio="none" viewBox="0 0 500 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 180 C 50 80, 100 150, 150 160 C 200 180, 250 100, 300 40 C 350 10, 400 180, 500 200" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
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

            <!-- Right Column Stats -->
            <div class="flex flex-col gap-6">
                <!-- Mood Rata-rata -->
                <div class="bg-[#5c442b] rounded-3xl p-8 text-white relative overflow-hidden shadow-[0_10px_30px_rgba(92,68,43,0.3)] flex-1 flex flex-col justify-center">
                    <svg class="absolute bottom-0 right-0 w-24 h-24 text-white/10 transform translate-x-4 translate-y-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 3C21 3 14 3 8 9C2 15 2 21 2 21C2 21 8 21 14 15C20 9 21 3 21 3Z"/>
                    </svg>
                    <div class="relative z-10">
                        <p class="text-xs font-medium tracking-wider text-white/60 uppercase mb-2">Mood Rata-rata</p>
                        <h3 class="text-3xl font-serif italic text-white/90">Tenang & Damai</h3>
                    </div>
                </div>

                <!-- Hari Paling Bahagia -->
                <div class="bg-white rounded-3xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex-1 flex flex-col justify-center">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium tracking-wider text-gray-400 uppercase mb-1">Hari Paling Bahagia</p>
                            <p class="text-lg font-bold text-[#614d3c]">Kamis, 12 Okt</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 italic">"Hari yang penuh dengan rasa syukur dan pernapasan dalam."</p>
                </div>
            </div>
        </div>

        <!-- Kalender Suasana Hati -->
        <div class="bg-white rounded-3xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-[#7a5c43]">Kalender Suasana Hati</h2>
                <div class="flex items-center gap-4">
                    <button class="text-gray-400 hover:text-[#7a5c43]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <span class="font-medium text-[#614d3c]">Mei 2026</span>
                    <button class="text-gray-400 hover:text-[#7a5c43]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-4 mb-8 text-center">
                <!-- Days Header -->
                <div class="text-sm font-medium text-gray-400 py-2">M</div>
                <div class="text-sm font-medium text-gray-400 py-2">S</div>
                <div class="text-sm font-medium text-gray-400 py-2">S</div>
                <div class="text-sm font-medium text-gray-400 py-2">R</div>
                <div class="text-sm font-medium text-gray-400 py-2">K</div>
                <div class="text-sm font-medium text-gray-400 py-2">J</div>
                <div class="text-sm font-medium text-gray-400 py-2">S</div>

                <!-- Calendar Days (Static Example) -->
                <!-- Week 1 -->
                <div class="text-gray-300 py-4 flex flex-col items-center">28</div>
                <div class="text-gray-300 py-4 flex flex-col items-center">29</div>
                <div class="text-gray-300 py-4 flex flex-col items-center">30</div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">1</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#d4b996]"></span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">2</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">3</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#f1e6d8]"></span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">4</span>
                </div>

                <!-- Week 2 -->
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">5</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">6</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#614d3c]"></span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">7</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">8</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">9</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#f1e6d8]"></span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">10</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">11</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#d4b996]"></span>
                </div>

                <!-- Week 3 -->
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">12</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">13</span>
                </div>
                <div class="bg-[#F7F4F0] rounded-2xl py-4 flex flex-col items-center gap-1">
                    <span class="text-[#614d3c] font-bold">14</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#614d3c]"></span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">15</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">16</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">17</span>
                </div>
                <div class="py-4 flex flex-col items-center gap-1">
                    <span class="text-gray-700">18</span>
                </div>

                <!-- Week 4 -->
                <div class="py-4 flex flex-col items-center gap-1"><span class="text-gray-700">19</span></div>
                <div class="py-4 flex flex-col items-center gap-1"><span class="text-gray-700">20</span></div>
                <div class="py-4 flex flex-col items-center gap-1"><span class="text-gray-700">21</span></div>
                <div class="py-4 flex flex-col items-center gap-1"><span class="text-gray-700">22</span></div>
                <div class="py-4 flex flex-col items-center gap-1"><span class="text-gray-700">23</span></div>
                <div class="py-4 flex flex-col items-center gap-1"><span class="text-gray-700">24</span></div>
                <div class="py-4 flex flex-col items-center gap-1"><span class="text-gray-700">25</span></div>
            </div>

            <!-- Legend -->
            <div class="flex items-center justify-center gap-6 pt-6 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#614d3c]"></span>
                    <span class="text-xs text-gray-500 font-medium">Sangat Baik</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#d4b996]"></span>
                    <span class="text-xs text-gray-500 font-medium">Tenang</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#f1e6d8]"></span>
                    <span class="text-xs text-gray-500 font-medium">Netral</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-gray-200"></span>
                    <span class="text-xs text-gray-500 font-medium">Tanpa Entri</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
