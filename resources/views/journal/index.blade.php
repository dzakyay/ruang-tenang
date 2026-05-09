<x-app-layout>
    {{-- ─────────────────────────────────────────────────────────────────────── --}}
    {{-- Page State managed by Alpine                                            --}}
    {{-- hasJournals  → driven by real server data                               --}}
    {{-- showAddModal → toggles the create-journal modal                        --}}
    {{-- ─────────────────────────────────────────────────────────────────────── --}}
    <div
        x-data="{
            hasJournals: {{ $journals->isNotEmpty() ? 'true' : 'false' }},
            showAddModal: {{ session('showAddModal', false) ? 'true' : 'false' }},
            bannerPreview: null,
            bannerName: null,
            handleBanner(event) {
                const file = event.target.files[0];
                if (!file) return;
                this.bannerName = file.name;
                const reader = new FileReader();
                reader.onload = (e) => { this.bannerPreview = e.target.result; };
                reader.readAsDataURL(file);
            },
            triggerBanner() {
                this.$refs.bannerInput.click();
            }
        }"
        class="px-6 md:px-10 py-12 max-w-7xl mx-auto min-h-full flex flex-col relative"
    >

        {{-- ════════════════════ SUCCESS / ERROR FLASH ════════════════════ --}}
        @if (session('success'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="fixed top-6 right-6 z-[100] flex items-center gap-3 bg-white border border-green-100 text-green-700 text-sm font-medium px-5 py-3 rounded-2xl shadow-lg"
            >
                <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- ════════════════════ VALIDATION ERRORS ════════════════════ --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-100 rounded-2xl p-5">
                <p class="text-sm font-semibold text-red-700 mb-2">Terdapat beberapa kesalahan:</p>
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ════════════════════ EMPTY STATE ════════════════════ --}}
        <div x-show="!hasJournals" class="flex-1 flex flex-col items-center justify-center h-full pt-32" style="display: none;">
            {{-- Illustrated empty icon --}}
            <div class="w-28 h-28 rounded-full bg-[#F7F4F0] flex items-center justify-center mb-8 shadow-inner">
                <svg class="w-14 h-14 text-[#d4c3b3]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <h2 class="text-2xl font-light text-gray-400 mb-3 text-center">Jurnal kamu akan muncul di sini</h2>
            <p class="text-sm text-gray-300 mb-10 text-center max-w-xs">Mulai menulis untuk merekam momen, perasaan, dan perjalanan hidupmu.</p>
            <button
                @click="showAddModal = true"
                id="btn-empty-add-journal"
                class="px-7 py-3 bg-[#614d3c] text-white rounded-2xl font-medium shadow-[0_4px_14px_rgba(97,77,60,0.25)] hover:bg-[#4a3b2d] hover:shadow-[0_6px_20px_rgba(97,77,60,0.35)] transition-all duration-200"
            >
                Tambah Jurnal Pertama
            </button>
            <button @click="hasJournals = true" class="mt-12 text-xs text-gray-300 hover:text-gray-500 underline">Lihat versi dengan data (Populated State)</button>
        </div>

        {{-- ════════════════════ POPULATED STATE ════════════════════ --}}
        <div x-show="hasJournals" style="display: none;">

            {{-- Header --}}
            <div class="mb-10">
                <h1 class="text-4xl font-serif text-[#1c1917] mb-2 font-bold">Teruskan menulis jurnal kamu</h1>
                <p class="text-gray-500">Setiap kata adalah jejak perjalananmu menuju diri yang lebih tenang.</p>
            </div>

            {{-- Streak Banner --}}
            <div class="w-full bg-[#614d3c] rounded-[2rem] p-10 flex items-center justify-between shadow-lg mb-12 relative overflow-hidden">
                <div class="relative z-10 w-full text-center lg:text-left flex flex-col sm:flex-row items-center justify-center gap-3">
                    <span class="text-5xl lg:text-6xl font-bold text-white tracking-tight">{{ $journals->count() }}</span>
                    <span class="text-4xl lg:text-5xl font-serif text-white/90 font-light">{{ $journals->count() === 1 ? 'Jurnal' : 'Jurnal' }} dibuat</span>
                </div>
                <svg class="absolute right-0 top-1/2 transform -translate-y-1/2 w-64 h-64 text-white/10 -mr-10" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>

            {{-- Journal List Section --}}
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-[#614d3c] flex items-center gap-3">
                        <svg class="w-6 h-6 text-[#c9b5a3]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                        Jurnal kamu
                    </h2>
                    <button
                        @click="showAddModal = true"
                        id="btn-add-journal"
                        class="px-6 py-2 bg-[#614d3c] text-white rounded-xl font-medium shadow-sm hover:bg-[#4a3b2d] transition"
                    >
                        Tambah
                    </button>
                </div>

                {{-- Horizontal Scrollable Cards --}}
                <div class="flex overflow-x-auto pb-6 -mx-4 px-4 gap-6 snap-x hide-scrollbar">
                    @foreach ($journals as $journal)
                    <a
                        href="{{ route('journal.show', $journal) }}"
                        class="min-w-[240px] h-64 rounded-[2rem] flex flex-col relative overflow-hidden shadow-sm hover:shadow-md transition snap-start group border border-[#e8dbce]/50"
                        style="background-color: #f9f7f4;"
                    >
                        {{-- Banner thumbnail if available --}}
                        @if ($journal->banner_url)
                            <div class="h-24 overflow-hidden ml-6">
                                <img src="{{ $journal->banner_url }}" alt="{{ $journal->title }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition">
                            </div>
                        @else
                            <div class="h-24 bg-[#e3dcd1]/50 ml-6"></div>
                        @endif

                        {{-- Left Accent --}}
                        <div class="absolute left-0 top-0 bottom-0 w-6 bg-[#86654b]"></div>

                        <div class="flex-1 p-6 pl-10 flex flex-col justify-center">
                            <h3 class="text-lg font-bold text-[#1c1917] group-hover:text-[#86654b] transition line-clamp-2">{{ $journal->title }}</h3>
                            @if ($journal->description)
                                <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $journal->description }}</p>
                            @endif
                            <p class="text-[10px] text-gray-300 mt-2">{{ $journal->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($journals->hasPages())
                    <div class="mt-6">
                        {{ $journals->links() }}
                    </div>
                @endif
            </div>

            {{-- Bottom Section: Calendar & Stats --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Kalender Aktif (static decorative for now) --}}
                <div class="lg:col-span-2 bg-white rounded-[2rem] p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-xl font-bold text-[#86654b]">Kalender Aktif</h2>
                        <span class="text-sm font-medium text-gray-500">{{ now()->translatedFormat('F Y') }}</span>
                    </div>

                    <div class="grid grid-cols-7 gap-y-4 text-center mb-8">
                        @foreach (['M','S','S','R','K','J','S'] as $day)
                            <div class="text-xs font-bold text-gray-400">{{ $day }}</div>
                        @endforeach

                        @php
                            $startOfMonth = now()->startOfMonth();
                            $daysInMonth = now()->daysInMonth;
                            $startDow = $startOfMonth->dayOfWeek; // 0 = Sun, need Mon-start
                            $offset = ($startDow + 6) % 7; // shift to Mon=0
                            $journalDays = $journals->pluck('created_at')->map(fn($d) => $d->day)->unique()->flip();
                        @endphp

                        @for ($i = 0; $i < $offset; $i++)
                            <div></div>
                        @endfor

                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @if (isset($journalDays[$day]))
                                <div class="flex flex-col items-center gap-1">
                                    <span class="text-sm font-bold text-gray-800">{{ $day }}</span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#d4b996]"></span>
                                </div>
                            @elseif ($day === now()->day)
                                <div class="flex flex-col items-center">
                                    <span class="w-7 h-7 rounded-full bg-[#614d3c] text-white text-sm font-bold flex items-center justify-center">{{ $day }}</span>
                                </div>
                            @else
                                <div class="text-sm font-medium text-gray-400">{{ $day }}</div>
                            @endif
                        @endfor
                    </div>

                    <div class="flex items-center justify-center gap-6 border-t border-gray-100 pt-6">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#d4b996]"></span>
                            <span class="text-xs text-gray-500">Ada Jurnal</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-[#614d3c] flex items-center justify-center">
                                <span class="text-[8px] text-white font-bold">{{ now()->day }}</span>
                            </span>
                            <span class="text-xs text-gray-500">Hari Ini</span>
                        </div>
                    </div>
                </div>

                {{-- Stats & Tips --}}
                <div class="flex flex-col gap-6">
                    <div class="bg-[#e3dcd1] rounded-[2rem] p-8 text-center flex-1 flex flex-col justify-center shadow-inner relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#614d3c_1px,transparent_1px)] [background-size:16px_16px]"></div>
                        <div class="relative z-10">
                            <h3 class="text-lg font-bold text-[#1c1917] mb-2 tracking-wide uppercase">Total</h3>
                            <div class="text-8xl font-bold font-serif text-[#614d3c] my-4 leading-none">{{ $journals->total() }}</div>
                            <p class="text-xs font-bold text-gray-600 uppercase tracking-widest mt-2">Jurnal Telah Dibuat</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30 flex items-start gap-4">
                        <div class="text-[#d4b996] bg-[#F7F4F0] p-2 rounded-xl flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-[#1c1917] uppercase tracking-wide mb-1">Prompt Harian</h4>
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $dailyPrompt }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <button @click="hasJournals = false" class="mt-12 text-xs text-gray-300 hover:text-gray-500 underline w-full text-center">Lihat versi kosong (Empty State)</button>
        </div>


        {{-- ════════════════════ ADD JOURNAL MODAL ════════════════════ --}}
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

                {{-- ── FORM (real submission) ── --}}
                <form
                    id="form-add-journal"
                    action="{{ route('journal.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    {{-- Banner Upload --}}
                    <div class="mb-6">
                        {{-- Hidden file input --}}
                        <input
                            type="file"
                            name="banner"
                            id="banner-input"
                            accept="image/jpeg,image/png,image/webp"
                            x-ref="bannerInput"
                            class="hidden"
                            @change="handleBanner($event)"
                        >

                        {{-- Clickable preview area --}}
                        <div
                            @click="triggerBanner()"
                            class="w-full h-40 rounded-[1.5rem] overflow-hidden relative group cursor-pointer border-2 border-dashed border-[#d4c3b3] hover:border-[#86654b] transition-colors"
                            :class="bannerPreview ? 'border-transparent' : ''"
                        >
                            {{-- Image preview --}}
                            <img
                                x-show="bannerPreview"
                                :src="bannerPreview"
                                alt="Preview banner"
                                class="w-full h-full object-cover"
                            >

                            {{-- Placeholder when no image --}}
                            <div
                                x-show="!bannerPreview"
                                class="w-full h-full flex flex-col items-center justify-center gap-2 bg-[#faf8f5]"
                            >
                                <svg class="w-8 h-8 text-[#d4c3b3] group-hover:text-[#86654b] transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                                <span class="text-sm text-[#c9b5a3] group-hover:text-[#86654b] transition-colors font-medium">Pilih gambar banner</span>
                                <span class="text-xs text-gray-300">JPG, PNG, atau WebP · maks. 3 MB</span>
                            </div>

                            {{-- Hover overlay when image is selected --}}
                            <div
                                x-show="bannerPreview"
                                class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition flex items-center justify-center"
                            >
                                <span class="text-white text-sm font-medium opacity-0 group-hover:opacity-100 transition drop-shadow-md">Ubah gambar</span>
                            </div>
                        </div>

                        {{-- Filename indicator --}}
                        <p x-show="bannerName" class="text-xs text-[#86654b] mt-2 pl-1 truncate" x-text="'📎 ' + bannerName"></p>
                    </div>

                    {{-- Title --}}
                    <div class="mb-4">
                        <input
                            type="text"
                            name="title"
                            id="journal-title"
                            value="{{ old('title') }}"
                            class="w-full bg-[#f9f7f4] border-0 rounded-2xl px-5 py-4 text-sm font-medium placeholder-gray-400 focus:ring-2 focus:ring-[#86654b] outline-none"
                            placeholder="Nama Jurnal *"
                            required
                        >
                    </div>

                    {{-- Description --}}
                    <div class="mb-8">
                        <textarea
                            name="description"
                            id="journal-description"
                            class="w-full bg-[#f9f7f4] border-0 rounded-2xl px-5 py-4 text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#86654b] outline-none resize-none"
                            rows="3"
                            placeholder="Deskripsi singkat jurnal (opsional)"
                        >{{ old('description') }}</textarea>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-4">
                        <button
                            type="button"
                            @click="showAddModal = false"
                            class="px-8 py-3 rounded-xl text-sm font-medium text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 transition shadow-sm"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            id="btn-submit-journal"
                            class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#614d3c] hover:bg-[#4a3b2d] transition shadow-[0_4px_14px_rgba(97,77,60,0.3)] flex items-center gap-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Jurnal
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
