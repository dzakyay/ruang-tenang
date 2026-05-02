<x-app-layout>
    <!-- State Management with Alpine -->
    <div x-data="{ hasJournals: false, showAddModal: false }" class="px-10 py-12 max-w-7xl mx-auto min-h-full flex flex-col relative">
        
        <!-- ================= EMPTY STATE ================= -->
        <div x-show="!hasJournals" class="flex-1 flex flex-col items-center justify-center h-full pt-32">
            <!-- Book Icon -->
            <svg class="w-24 h-24 text-[#d4c3b3] mb-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm8 2v4h-2V8h2z"/>
            </svg>
            <h2 class="text-2xl font-light text-gray-400 mb-8">Jurnal yang anda tambahkan muncul di sini</h2>
            <button @click="showAddModal = true" class="px-6 py-2.5 bg-[#614d3c] text-white rounded-xl font-medium shadow-sm hover:bg-[#4a3b2d] transition">
                Tambah Jurnal Pertama
            </button>
            
            <!-- Development toggle for demonstration -->
            <button @click="hasJournals = true" class="mt-12 text-xs text-gray-300 hover:text-gray-500 underline">Lihat versi dengan data (Populated State)</button>
        </div>

        <!-- ================= POPULATED STATE ================= -->
        <div x-show="hasJournals" style="display: none;">
            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-4xl font-serif text-[#1c1917] mb-2 font-bold">Teruskan menulis jurnal anda</h1>
                <p class="text-gray-500">Setiap kata adalah jejak perjalananmu menuju diri yang lebih tenang.</p>
                <p class="text-gray-500">Mari luangkan waktu sejenak untuk meninjau kembali apa yang telah kamu lalui.</p>
            </div>

            <!-- Streak Banner -->
            <div class="w-full bg-[#614d3c] rounded-[2rem] p-10 flex items-center justify-between shadow-lg mb-12 relative overflow-hidden">
                <div class="relative z-10 w-full text-center lg:text-left flex items-center justify-center gap-3">
                    <span class="text-5xl lg:text-6xl font-bold text-white tracking-tight">12 Hari</span>
                    <span class="text-4xl lg:text-5xl font-serif text-white/90 font-light">beruntun!</span>
                </div>
                <!-- Huge Book Icon Right -->
                <svg class="absolute right-0 top-1/2 transform -translate-y-1/2 w-64 h-64 text-white/10 -mr-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm8 2v4h-2V8h2z"/>
                </svg>
            </div>

            <!-- Jurnal List Section -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-[#614d3c] flex items-center gap-3">
                        <svg class="w-6 h-6 text-[#c9b5a3]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm8 2v4h-2V8h2z"/>
                        </svg>
                        Jurnal anda
                    </h2>
                    <button @click="showAddModal = true" class="px-6 py-2 bg-[#614d3c] text-white rounded-xl font-medium shadow-sm hover:bg-[#4a3b2d] transition">
                        Tambah
                    </button>
                </div>

                <!-- Horizontal Scrollable Cards -->
                <div class="flex overflow-x-auto pb-6 -mx-4 px-4 gap-6 snap-x hide-scrollbar">
                    <!-- Card 1 -->
                    <a href="{{ route('journal.show') }}" class="min-w-[240px] h-64 bg-[#f9f7f4] rounded-[2rem] flex flex-col relative overflow-hidden shadow-sm hover:shadow-md transition snap-start group border border-[#e8dbce]/50">
                        <!-- Left Accent Color -->
                        <div class="absolute left-0 top-0 bottom-0 w-6 bg-[#86654b]"></div>
                        <div class="h-20 bg-[#e3dcd1]/50 ml-6"></div>
                        <div class="flex-1 p-6 pl-10 flex items-center">
                            <h3 class="text-2xl font-bold text-[#1c1917] group-hover:text-[#86654b] transition">Jurnal 1</h3>
                        </div>
                    </a>
                    
                    <!-- Card 2 -->
                    <a href="#" class="min-w-[240px] h-64 bg-[#f9f7f4] rounded-[2rem] flex flex-col relative overflow-hidden shadow-sm hover:shadow-md transition snap-start group border border-[#e8dbce]/50">
                        <div class="absolute left-0 top-0 bottom-0 w-6 bg-[#86654b]"></div>
                        <div class="h-20 bg-[#e3dcd1]/50 ml-6"></div>
                        <div class="flex-1 p-6 pl-10 flex items-center">
                            <h3 class="text-2xl font-bold text-[#1c1917] group-hover:text-[#86654b] transition">Jurnal 2</h3>
                        </div>
                    </a>

                    <!-- Card 3 -->
                    <a href="#" class="min-w-[240px] h-64 bg-[#f9f7f4] rounded-[2rem] flex flex-col relative overflow-hidden shadow-sm hover:shadow-md transition snap-start group border border-[#e8dbce]/50">
                        <div class="absolute left-0 top-0 bottom-0 w-6 bg-[#86654b]"></div>
                        <div class="h-20 bg-[#e3dcd1]/50 ml-6"></div>
                        <div class="flex-1 p-6 pl-10 flex items-center">
                            <h3 class="text-2xl font-bold text-[#1c1917] group-hover:text-[#86654b] transition">Jurnal 3</h3>
                        </div>
                    </a>

                    <!-- Card 4 -->
                    <a href="#" class="min-w-[240px] h-64 bg-[#f9f7f4] rounded-[2rem] flex flex-col relative overflow-hidden shadow-sm hover:shadow-md transition snap-start group border border-[#e8dbce]/50">
                        <div class="absolute left-0 top-0 bottom-0 w-6 bg-[#86654b]"></div>
                        <div class="h-20 bg-[#e3dcd1]/50 ml-6"></div>
                        <div class="flex-1 p-6 pl-10 flex items-center">
                            <h3 class="text-2xl font-bold text-[#1c1917] group-hover:text-[#86654b] transition">Jurnal 4</h3>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Bottom Section: Calendar & Stats -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kalender Aktif -->
                <div class="lg:col-span-2 bg-white rounded-[2rem] p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-xl font-bold text-[#86654b]">Kalender Aktif</h2>
                        <div class="flex items-center gap-4">
                            <button class="text-gray-400 hover:text-[#7a5c43]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <span class="text-sm font-medium text-gray-500">Oktober 2023</span>
                            <button class="text-gray-400 hover:text-[#7a5c43]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Simplified Calendar Grid -->
                    <div class="grid grid-cols-7 gap-y-6 text-center mb-8">
                        <!-- Header -->
                        <div class="text-xs font-bold text-gray-400">M</div>
                        <div class="text-xs font-bold text-gray-400">S</div>
                        <div class="text-xs font-bold text-gray-400">S</div>
                        <div class="text-xs font-bold text-gray-400">R</div>
                        <div class="text-xs font-bold text-gray-400">K</div>
                        <div class="text-xs font-bold text-gray-400">J</div>
                        <div class="text-xs font-bold text-gray-400">S</div>

                        <!-- Days -->
                        <div class="text-sm text-gray-300">28</div>
                        <div class="text-sm text-gray-300">29</div>
                        <div class="text-sm text-gray-300">30</div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-sm font-bold text-gray-800">1</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-[#d4b996]"></span>
                        </div>
                        <div class="text-sm font-medium text-gray-600">2</div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-sm font-bold text-gray-800">3</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f1e6d8]"></span>
                        </div>
                        <div class="text-sm font-medium text-gray-600">4</div>

                        <div class="text-sm font-medium text-gray-600">5</div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-sm font-bold text-gray-800">6</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f1e6d8]"></span>
                        </div>
                        <div class="text-sm font-medium text-gray-600">7</div>
                        <div class="text-sm font-medium text-gray-600">8</div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-sm font-bold text-gray-800">9</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f1e6d8]"></span>
                        </div>
                        <div class="text-sm font-medium text-gray-600">10</div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-sm font-bold text-gray-800">11</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-[#d4b996]"></span>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-6 border-t border-gray-100 pt-6">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#e3dcd1]"></span>
                            <span class="text-xs text-gray-500">Mengedit</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#d4b996]"></span>
                            <span class="text-xs text-gray-500">Membuat</span>
                        </div>
                    </div>
                </div>

                <!-- Stats & Tips -->
                <div class="flex flex-col gap-6">
                    <!-- Total Jurnal -->
                    <div class="bg-[#e3dcd1] rounded-[2rem] p-8 text-center flex-1 flex flex-col justify-center shadow-inner relative overflow-hidden">
                        <!-- Background texture line -->
                        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#614d3c_1px,transparent_1px)] [background-size:16px_16px]"></div>
                        
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold text-[#1c1917] mb-2 tracking-wide uppercase">Total</h3>
                            <div class="text-8xl font-bold font-serif text-[#614d3c] my-4 leading-none">4</div>
                            <p class="text-xs font-bold text-gray-600 uppercase tracking-widest mt-2">Jurnal Telah Dibuat</p>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="bg-white rounded-[2rem] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30 flex items-start gap-4">
                        <div class="text-[#d4b996] bg-[#F7F4F0] p-2 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-[#1c1917] uppercase tracking-wide mb-1">Tips</h4>
                            <p class="text-xs text-gray-500 leading-relaxed">Coba tuliskan satu hal kecil yang membuatmu bersyukur hari ini.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <button @click="hasJournals = false" class="mt-12 text-xs text-gray-300 hover:text-gray-500 underline w-full text-center">Lihat versi kosong (Empty State)</button>
        </div>


        <!-- ================= ADD JOURNAL MODAL ================= -->
        <div x-show="showAddModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <!-- Overlay -->
            <div x-show="showAddModal" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-white/80 backdrop-blur-sm"></div>

            <!-- Modal Content -->
            <div x-show="showAddModal" 
                 @click.away="showAddModal = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative bg-white rounded-[2rem] p-8 md:p-10 max-w-xl w-full shadow-2xl z-10 border border-gray-100">
                
                <h2 class="text-3xl font-serif text-[#1c1917] text-center mb-8 font-bold">Tambah Jurnal Baru</h2>

                <!-- Image Upload Placeholder -->
                <div class="w-full h-40 bg-gray-200 rounded-[1.5rem] mb-6 relative overflow-hidden group cursor-pointer border border-gray-100">
                    <img src="https://images.unsplash.com/photo-1544830230-58c0c97cb4fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Placeholder" class="w-full h-full object-cover opacity-60">
                    <div class="absolute inset-0 bg-black/10 flex items-center justify-center group-hover:bg-black/20 transition">
                        <span class="text-white font-medium italic drop-shadow-md">Ubah gambar banner</span>
                    </div>
                </div>

                <form>
                    <div class="mb-4">
                        <input type="text" class="w-full bg-[#f9f7f4] border-0 rounded-2xl px-5 py-4 text-sm font-medium placeholder-gray-400 focus:ring-2 focus:ring-[#86654b] outline-none" placeholder="Nama Jurnal">
                    </div>
                    
                    <div class="mb-8">
                        <textarea class="w-full bg-[#f9f7f4] border-0 rounded-2xl px-5 py-4 text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#86654b] outline-none resize-none" rows="3" placeholder="Deskripsi Jurnal"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <button type="button" @click="showAddModal = false" class="px-8 py-3 rounded-xl text-sm font-medium text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 transition shadow-sm">
                            Batal
                        </button>
                        <button type="button" @click="showAddModal = false; hasJournals = true" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#614d3c] hover:bg-[#4a3b2d] transition shadow-[0_4px_14px_rgba(97,77,60,0.3)]">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
