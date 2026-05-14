@extends('layouts.admin')

@section('content')
<div class="px-6 lg:px-10 py-8 max-w-4xl mx-auto">
    <a href="{{ route('admin.encyclopedia.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-[#a07954] transition mb-8">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar
    </a>

    <div class="mb-6">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#614d3c] text-white text-[10px] font-bold tracking-widest uppercase shadow-sm">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ $encyclopedia->category }}
        </div>
    </div>

    <h1 class="text-5xl md:text-6xl font-serif font-bold text-[#614d3c] mb-8 leading-tight">
        {{ $encyclopedia->feeling }}
    </h1>

    @if($encyclopedia->quote)
    <div class="border-l-4 border-[#c9b5a3] pl-6 mb-12">
        <p class="text-xl md:text-2xl text-gray-600 font-light leading-relaxed">
            "{{ $encyclopedia->quote }}"
        </p>
    </div>
    @endif

    <div class="w-full h-80 md:h-[400px] rounded-[2rem] overflow-hidden shadow-lg mb-12 bg-gray-100">
        @if($encyclopedia->banner_url)
            <img src="{{ $encyclopedia->banner_url }}" alt="{{ $encyclopedia->feeling }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-400">
                <span>Tidak ada gambar banner</span>
            </div>
        @endif
    </div>

    <div class="prose prose-lg prose-stone max-w-none mb-16 text-gray-600 leading-relaxed">
        {!! nl2br(e($encyclopedia->content)) !!}
    </div>

    <div>
        <h2 class="text-3xl font-serif font-bold text-[#a07954] mb-8">Langkah Kecil untuk Tenang</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($encyclopedia->tips as $tip)
                <div class="bg-white rounded-[2rem] p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-full bg-[#a07954] text-white flex items-center justify-center mb-6">
                        @if(!empty($tip->icon))
                            {!! $tip->icon !!}
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-[#1c1917] mb-3">{{ $tip->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1">
                        {{ $tip->description }}
                    </p>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 italic">Belum ada tips praktis yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
