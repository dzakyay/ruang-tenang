<x-app-layout>
<div class="px-6 md:px-10 py-10 max-w-4xl mx-auto">

    {{-- Back --}}
    <a href="{{ route('journal.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-[#614d3c] transition mb-8">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Jurnal
    </a>

    {{-- Flash --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             class="mb-6 flex items-center gap-3 bg-green-50 border border-green-100 text-green-700 text-sm font-medium px-5 py-3 rounded-2xl shadow-sm">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Main Card --}}
    <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-[#e8dbce]/40">

        {{-- Hero Banner --}}
        <div class="w-full h-56 md:h-80 overflow-hidden bg-gradient-to-br from-[#e8ddd4] to-[#d4c3b3]">
            @if ($journal->banner_url)
                <img src="{{ $journal->banner_url }}" alt="{{ $journal->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-[#c9b5a3]/50" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="p-8 md:p-14">

            {{-- Header --}}
            <div class="mb-8">
                <div class="flex items-center justify-between gap-4 flex-wrap mb-4">
                    <span class="text-xs text-gray-400 font-medium">{{ $journal->created_at->translatedFormat('l, d F Y') }}</span>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('journal.edit', $journal) }}"
                           class="inline-flex items-center gap-1.5 text-xs font-medium text-[#86654b] hover:text-[#614d3c] bg-[#faf8f5] hover:bg-[#f0ebe4] px-3 py-1.5 rounded-lg transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
                            </svg>
                            Edit
                        </a>
                        <form method="POST" action="{{ route('journal.destroy', $journal) }}"
                              onsubmit="return confirm('Hapus jurnal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 text-xs font-medium text-red-400 hover:text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#1c1917] mb-4 tracking-tight">{{ $journal->title }}</h1>

                @if ($journal->description)
                    <p class="text-gray-500 text-lg leading-relaxed">{{ $journal->description }}</p>
                @endif
            </div>

            <hr class="border-[#e8dbce] mb-10">

            {{-- Body: rendered Tiptap HTML --}}
            @if ($journal->content)
                <div class="prose prose-stone prose-lg max-w-none text-gray-600 leading-relaxed
                            prose-headings:font-serif prose-headings:text-[#1c1917]
                            prose-a:text-[#86654b] prose-a:no-underline hover:prose-a:underline
                            prose-blockquote:border-[#d4c3b3] prose-blockquote:text-gray-500 prose-blockquote:italic
                            prose-code:bg-[#f0ebe4] prose-code:text-[#614d3c] prose-code:rounded
                            prose-img:rounded-2xl prose-img:shadow-sm">
                    {!! $journal->content !!}
                </div>
            @else
                <p class="text-gray-300 italic text-center py-12">Jurnal ini belum memiliki isi. <a href="{{ route('journal.edit', $journal) }}" class="text-[#86654b] hover:underline">Mulai menulis →</a></p>
            @endif

            {{-- Media image (if separate) --}}
            @if ($journal->media_url)
                <div class="mt-10 rounded-2xl overflow-hidden shadow-sm">
                    <img src="{{ $journal->media_url }}" alt="Media jurnal" class="w-full object-cover">
                </div>
            @endif

        </div>
    </div>

</div>
</x-app-layout>
