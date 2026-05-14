<x-app-layout>
    {{-- Data PHP → JS --}}
    <script>
        window.__dashboardConfig = {
            showModal: {{ $todayEmotion ? 'false' : 'true' }},
            storeUrl: '{{ route('mood.store') }}',
        };
        window.__moodSparklineData = @json($moodTrend);
    </script>

    <div x-data="dashboardPage()" class="px-6 lg:px-10 py-12 max-w-7xl mx-auto">

        {{-- Flash success --}}
        <div x-show="flashMsg" x-transition x-cloak
            class="fixed top-6 right-6 z-50 bg-white border border-green-200 text-green-700 text-sm font-medium px-5 py-3 rounded-2xl shadow-lg flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span x-text="flashMsg"></span>
        </div>

        {{-- Header --}}
        <div class="mb-10 flex items-start justify-between gap-6">
            <div class="min-w-0">
                <h1 class="text-4xl font-serif text-[#614d3c] mb-2 break-words">Selamat Pagi, {{ Auth::user()->name }}.
                </h1>
                <p class="text-gray-500">Semoga harimu dipenuhi ketenangan.</p>
            </div>
            @if($todayEmotion)
                <div class="hidden lg:flex shrink-0 whitespace-nowrap items-center gap-2 bg-white rounded-2xl px-4 py-2.5 shadow-sm border border-[#e8dbce]/50 text-sm text-[#614d3c]">
                    <span class="text-xl">{{ $todayEmotion->mood_emoji }}</span>
                    <span class="font-medium">{{ $todayEmotion->mood_label }}</span>
                    <span class="text-gray-400">hari ini</span>
                </div>
            @else
                <button @click="showMoodModal = true"
                    class="hidden lg:flex shrink-0 whitespace-nowrap items-center gap-2 bg-[#5c442b] text-white text-sm font-medium px-5 py-2.5 rounded-2xl hover:bg-[#4a3622] transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Catat Moodmu
                </button>
            @endif
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

            {{-- Tren Suasana Hati --}}
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-[#7a5c43]">Tren Suasana Hati</h2>
                    <a href="{{ route('mood') }}" class="text-sm text-gray-400 hover:text-[#7a5c43] transition">Lihat
                        Detail →</a>
                </div>

                @if($moodTrend->isNotEmpty())
                    <div class="flex-1 relative h-[220px]">
                        <canvas id="dashboardMoodChart"></canvas>
                    </div>
                @else
                    <div class="flex-1 flex flex-col items-center justify-center min-h-[220px] text-center">
                        <div class="w-14 h-14 bg-[#f4ebe1] rounded-2xl flex items-center justify-center text-2xl mb-4">😐
                        </div>
                        <p class="text-[#614d3c] font-medium">Belum ada data mood</p>
                        <p class="text-xs text-gray-400 mt-1">Catat perasaanmu pertama kali hari ini</p>
                    </div>
                @endif
            </div>

            {{-- Konsistensi Berjurnal --}}
            <div
                class="bg-[#5c442b] rounded-3xl p-8 text-white flex flex-col justify-between shadow-[0_10px_30px_rgba(92,68,43,0.3)] relative overflow-hidden">
                <svg class="absolute -bottom-10 -right-10 w-48 h-48 text-white/10" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path d="M21 3C21 3 14 3 8 9C2 15 2 21 2 21C2 21 8 21 14 15C20 9 21 3 21 3Z" />
                </svg>
                <div class="relative z-10">
                    <h2 class="text-white/80 font-serif text-lg mb-4">Konsistensi Berjurnal</h2>
                    <div class="mb-4">
                        <span class="text-6xl font-bold font-serif">{{ $journalDaysThisMonth }}</span>
                        <span class="text-3xl font-serif"> Hari</span>
                    </div>
                    <p class="text-white/70 text-sm leading-relaxed mb-8">
                        @if($journalDaysThisMonth > 0)
                            Kamu telah meluangkan waktu untuk dirimu sendiri secara konsisten.
                        @else
                            Mulailah menulis jurnalmu hari ini dan bangun kebiasaan refleksi diri.
                        @endif
                    </p>
                </div>

                <a href="{{ route('journal.index') }}"
                    class="relative z-10 block w-full bg-white text-[#5c442b] text-center font-semibold py-3.5 rounded-xl hover:bg-gray-50 transition shadow-sm">
                    Mulai Menulis
                </a>
            </div>
        </div>

        {{-- Ensiklopedia Perasaan Banner --}}
        <div class="relative bg-gray-200 rounded-3xl overflow-hidden shadow-sm">
            <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                alt="Mountains" class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-r from-[#e3dcd1]/90 to-transparent"></div>
            <div class="relative z-10 p-10 lg:p-14 max-w-xl">
                <h2 class="text-3xl font-serif font-bold text-[#614d3c] mb-3">Ensiklopedia Perasaan</h2>
                <p class="text-gray-700 mb-8 leading-relaxed">Temukan perasaan yang membuat anda menyesakkan dan
                    membingungkan.</p>
                <a href="{{ route('encyclopedia.index') }}"
                    class="inline-block bg-[#614d3c] text-white px-8 py-3 rounded-xl font-medium hover:bg-[#4a3b2d] transition shadow-md">
                    Jelajahi Sekarang
                </a>
            </div>
        </div>

        <!-- Modal Mood Tracker -->
        <div x-show="showMoodModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
            <!-- Overlay -->
            <div x-show="showMoodModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0 bg-white/80 backdrop-blur-sm"></div>

            <!-- Modal Content -->
            <div x-show="showMoodModal" @click.away="showMoodModal = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-[#F9F7F4] rounded-[2rem] p-8 sm:p-10 max-w-md w-full shadow-2xl z-10 flex flex-col items-center border border-[#e8dbce]/50">

                <div class="w-12 h-1 bg-[#d4c3b3] rounded-full mb-8"></div>

                <h2 class="text-3xl font-serif text-[#1c1917] text-center mb-10 leading-tight">Bagaimana
                    perasaanmu<br>hari ini?</h2>

                <div class="flex justify-between w-full mb-8 px-2">
                    @foreach($moods as $key => $moodData)
                        <button type="button" @click="selectMood('{{ $key }}', {{ $moodData['score'] }})"
                            class="flex flex-col items-center gap-2 group outline-none">
                            <div :class="selectedMood === '{{ $key }}'
                                        ? 'bg-[#a07954] -translate-y-2 shadow-[0_8px_20px_rgba(160,121,84,0.4)] w-16 h-16 text-3xl'
                                        : 'bg-white group-hover:-translate-y-1 w-12 h-12 sm:w-14 sm:h-14 text-2xl'"
                                class="rounded-2xl flex items-center justify-center shadow-sm transition-all duration-300">
                                {{ $moodData['emoji'] }}
                            </div>
                            <span :class="selectedMood === '{{ $key }}' ? 'text-[#a07954]' : 'text-gray-400'"
                                class="text-[10px] font-bold uppercase tracking-wide transition-colors">
                                {{ $moodData['label'] }}
                            </span>
                        </button>
                    @endforeach
                </div>

                <p x-show="errorMsg" x-text="errorMsg" class="text-red-500 text-sm mb-4 text-center"></p>

                <div class="w-full text-left mb-8">
                    <label class="block text-xs font-semibold text-[#614d3c] mb-2 tracking-wide">Ceritakan sedikit
                        (opsional)</label>
                    <textarea x-model="note" rows="3"
                        class="w-full bg-white border-0 rounded-2xl p-4 text-sm resize-none focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]"
                        placeholder="Apa yang ada di pikiranmu..."></textarea>
                </div>

                <button @click="submitMood()" :disabled="loading"
                    class="w-full bg-[#5c442b] text-white py-3.5 rounded-xl font-medium shadow-[0_4px_14px_rgba(92,68,43,0.3)] hover:bg-[#4a3622] hover:-translate-y-0.5 transition duration-300 mb-4 disabled:opacity-60 flex items-center justify-center gap-2">
                    <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>
                    <span x-text="loading ? 'Menyimpan...' : 'Simpan Perasaan'"></span>
                </button>
                <button @click="showMoodModal = false"
                    class="text-sm font-medium text-gray-400 hover:text-[#614d3c] transition">
                    Nanti Saja
                </button>
            </div>
        </div>

    </div>
</x-app-layout>