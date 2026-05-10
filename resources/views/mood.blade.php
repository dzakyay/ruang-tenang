<x-app-layout>
    @php
        $firstDay    = now()->startOfMonth();
        $daysInMonth = (int) now()->daysInMonth;
        $offset      = $firstDay->dayOfWeekIso - 1;
        $today       = (int) now()->day;
        $monthLabel  = $firstDay->translatedFormat('F Y');
    @endphp

    <script>
        window.__moodPageConfig = {
            showModal: {{ $todayEmotion ? 'false' : 'true' }},
            storeUrl:  '{{ route('mood.store') }}',
        };
        window.__moodTrendData = @json($trendData);
    </script>

    <div x-data="moodPage()" class="px-6 lg:px-10 py-12 max-w-7xl mx-auto">

        {{-- Flash --}}
        <div x-show="flashMsg" x-transition x-cloak
             class="fixed top-6 right-6 z-50 bg-white border border-green-200 text-green-700 text-sm font-medium px-5 py-3 rounded-2xl shadow-lg flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span x-text="flashMsg"></span>
        </div>

        {{-- Header --}}
        <div class="mb-10 flex items-start justify-between gap-4">
            <div>
                <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-2">Analisis Jurnal</p>
                <h1 class="text-4xl font-serif font-bold text-[#614d3c] mb-2 italic">Mengenal Dirimu Lebih Dalam</h1>
                <p class="text-gray-500 max-w-2xl">Luangkan waktu sejenak untuk melihat bagaimana perasaanmu berkembang selama bulan ini.</p>
            </div>
            @if(!$todayEmotion)
                <button @click="showMoodModal = true"
                        class="flex-shrink-0 flex items-center gap-2 bg-[#5c442b] text-white text-sm font-medium px-5 py-3 rounded-2xl hover:bg-[#4a3622] transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Catat Mood Hari Ini
                </button>
            @else
                <div class="flex-shrink-0 flex items-center gap-2 bg-white rounded-2xl px-4 py-2.5 shadow-sm border border-[#e8dbce]/50 text-sm text-[#614d3c]">
                    <span class="text-xl">{{ $todayEmotion->mood_emoji }}</span>
                    <span class="font-medium">{{ $todayEmotion->mood_label }}</span>
                    <span class="text-gray-400">sudah dicatat</span>
                </div>
            @endif
        </div>

        {{-- Top Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

            {{-- Trend Chart --}}
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-[#7a5c43]">Tren Suasana Hati</h2>
                    <div class="flex gap-2">
                        <button @click="switchPeriod(7)"
                                :class="chartDays === 7 ? 'bg-[#5c442b] text-white' : 'bg-[#f4ebe1] text-[#614d3c] hover:bg-[#e8dbce]'"
                                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition">7 Hari</button>
                        <button @click="switchPeriod(30)"
                                :class="chartDays === 30 ? 'bg-[#5c442b] text-white' : 'bg-[#f4ebe1] text-[#614d3c] hover:bg-[#e8dbce]'"
                                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition">30 Hari</button>
                    </div>
                </div>

                @if($trendData->isNotEmpty())
                    <div class="flex-1 relative h-[220px]">
                        <canvas id="moodTrendChart"></canvas>
                    </div>
                @else
                    <div class="flex-1 flex flex-col items-center justify-center min-h-[220px] text-center">
                        <div class="w-14 h-14 bg-[#f4ebe1] rounded-2xl flex items-center justify-center text-2xl mb-4">📊</div>
                        <p class="text-[#614d3c] font-medium">Belum ada data mood</p>
                        <p class="text-xs text-gray-400 mt-1">Mulai catat perasaanmu hari ini</p>
                    </div>
                @endif
            </div>

            {{-- Stats Right Column --}}
            <div class="flex flex-col gap-6">
                {{-- Mood Rata-rata --}}
                <div class="bg-[#5c442b] rounded-3xl p-8 text-white relative overflow-hidden shadow-[0_10px_30px_rgba(92,68,43,0.3)] flex-1 flex flex-col justify-center">
                    <svg class="absolute bottom-0 right-0 w-24 h-24 text-white/10 transform translate-x-4 translate-y-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 3C21 3 14 3 8 9C2 15 2 21 2 21C2 21 8 21 14 15C20 9 21 3 21 3Z"/>
                    </svg>
                    <div class="relative z-10">
                        <p class="text-xs font-medium tracking-wider text-white/60 uppercase mb-2">Mood Rata-rata</p>
                        @if($avgScore > 0)
                            <h3 class="text-3xl font-serif italic text-white/90">{{ $avgMoodLabel }}</h3>
                        @else
                            <h3 class="text-xl font-serif italic text-white/60">Belum ada data</h3>
                        @endif
                    </div>
                </div>

                {{-- Hari Paling Bahagia --}}
                <div class="bg-white rounded-3xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex-1 flex flex-col justify-center">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium tracking-wider text-gray-400 uppercase mb-1">Hari Paling Bahagia</p>
                            @if($happiestEmotion)
                                <p class="text-lg font-bold text-[#614d3c]">{{ $happiestEmotion->created_at->translatedFormat('l, d M') }}</p>
                            @else
                                <p class="text-base font-medium text-gray-400">Belum ada data</p>
                            @endif
                        </div>
                    </div>
                    @if($happiestEmotion?->note)
                        <p class="text-sm text-gray-500 italic">"{{ $happiestEmotion->note }}"</p>
                    @elseif($happiestEmotion)
                        <p class="text-sm text-gray-400 flex items-center gap-1">
                            <span class="text-lg">{{ $happiestEmotion->mood_emoji }}</span> {{ $happiestEmotion->mood_label }}
                        </p>
                    @else
                        <p class="text-sm text-gray-400 italic">Catat moodmu untuk melihat hari terbaik bulanmu.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kalender Suasana Hati --}}
        <div class="bg-white rounded-3xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-[#7a5c43]">Kalender Suasana Hati</h2>
                <span class="font-medium text-[#614d3c]">{{ $monthLabel }}</span>
            </div>

            <div class="grid grid-cols-7 gap-1 sm:gap-2 mb-8 text-center">
                @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $dayLabel)
                    <div class="text-xs font-semibold text-gray-400 py-2">{{ $dayLabel }}</div>
                @endforeach

                @for($i = 0; $i < $offset; $i++)
                    <div></div>
                @endfor

                @for($day = 1; $day <= $daysInMonth; $day++)
                    @php $emotion = $monthEmotions->get($day); @endphp
                    <div class="{{ $day === $today ? 'bg-[#F7F4F0] rounded-2xl ring-2 ring-[#d4b996]' : '' }} py-3 sm:py-4 flex flex-col items-center gap-1 transition">
                        <span class="{{ $day === $today ? 'text-[#614d3c] font-bold' : 'text-gray-600' }} text-sm">{{ $day }}</span>
                        @if($emotion)
                            <span class="w-2 h-2 rounded-full" style="background-color: {{ $emotion['color'] }}" title="{{ $emotion['emoji'] }}"></span>
                        @else
                            <span class="w-2 h-2"></span>
                        @endif
                    </div>
                @endfor
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 pt-6 border-t border-gray-100">
                @foreach($moods as $moodData)
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $moodData['color'] }}"></span>
                        <span class="text-xs text-gray-500 font-medium">{{ $moodData['emoji'] }} {{ $moodData['label'] }}</span>
                    </div>
                @endforeach
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-gray-200"></span>
                    <span class="text-xs text-gray-500 font-medium">Tanpa Entri</span>
                </div>
            </div>
        </div>

        {{-- Modal Mood Input --}}
        <div x-show="showMoodModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="showMoodModal = false"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-white/80 backdrop-blur-sm"></div>

            <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-[#F9F7F4] rounded-[2rem] p-8 sm:p-10 max-w-md w-full shadow-2xl z-10 flex flex-col items-center border border-[#e8dbce]/50">

                <div class="w-12 h-1 bg-[#d4c3b3] rounded-full mb-8"></div>
                <h2 class="text-3xl font-serif text-[#1c1917] text-center mb-10 leading-tight">Bagaimana perasaanmu<br>hari ini?</h2>

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
                    <label class="block text-xs font-semibold text-[#614d3c] mb-2 tracking-wide">Ceritakan sedikit (opsional)</label>
                    <textarea x-model="note" rows="3"
                              class="w-full bg-white border-0 rounded-2xl p-4 text-sm resize-none focus:ring-2 focus:ring-[#a07954] outline-none shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]"
                              placeholder="Apa yang ada di pikiranmu..."></textarea>
                </div>

                <button @click="submitMood()" :disabled="loading"
                        class="w-full bg-[#5c442b] text-white py-3.5 rounded-xl font-medium shadow-[0_4px_14px_rgba(92,68,43,0.3)] hover:bg-[#4a3622] hover:-translate-y-0.5 transition duration-300 mb-4 disabled:opacity-60 flex items-center justify-center gap-2">
                    <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <span x-text="loading ? 'Menyimpan...' : 'Simpan Perasaan'"></span>
                </button>
                <button @click="showMoodModal = false" class="text-sm font-medium text-gray-400 hover:text-[#614d3c] transition">
                    Nanti Saja
                </button>
            </div>
        </div>

    </div>
</x-app-layout>
