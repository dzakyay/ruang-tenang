@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto flex flex-col h-[calc(100vh-2rem)] lg:h-[calc(100vh-5rem)] overflow-hidden">

    <!-- Top Row -->
    <div class="flex justify-between items-start mb-4 flex-shrink-0">
        <h2 class="text-2xl lg:text-3xl font-serif font-bold text-[#614d3c]">Selamat Datang, Admin.</h2>
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-3 gap-4 mb-4 flex-shrink-0">
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-[#e8dbce]/30 text-center">
            @if($totalUsers > 0)
                <p class="text-2xl font-serif font-bold text-[#a07954]">{{ $totalUsers }}</p>
            @else
                <p class="text-sm font-medium text-gray-400">Belum ada user</p>
            @endif
            <p class="text-xs text-gray-500 mt-1">Total Pengguna</p>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-[#e8dbce]/30 text-center">
            <p class="text-2xl font-serif font-bold text-[#a07954]">{{ $totalEmotions }}</p>
            <p class="text-xs text-gray-500 mt-1">Total Mood Dicatat</p>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-[#e8dbce]/30 text-center">
            <p class="text-2xl font-serif font-bold text-[#a07954]">{{ $totalEncyclopedia }}</p>
            <p class="text-xs text-gray-500 mt-1">Entri Ensiklopedia</p>
        </div>
    </div>

    <!-- Banner -->
    <div class="relative bg-gray-200 rounded-3xl overflow-hidden shadow-sm mb-4 h-24 lg:h-28 flex-shrink-0">
        <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=1200&q=80"
             alt="Mountains" class="absolute inset-0 w-full h-full object-cover opacity-80">
        <div class="absolute inset-0 bg-gradient-to-r from-[#e3dcd1]/90 to-transparent"></div>
        <div class="relative z-10 p-5 lg:p-8 h-full flex flex-col justify-center">
            <h3 class="text-xl lg:text-2xl font-serif text-[#614d3c] mb-1">Ringkasan Hari Ini</h3>
            <p class="text-xs lg:text-sm text-gray-700">Pantau kesejahteraan komunitas dengan tenang dan penuh empati.</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 min-h-0">

        <!-- Emosi Paling Banyak -->
        <div class="bg-white rounded-[2rem] p-5 lg:p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30 flex flex-col h-full min-h-0 overflow-hidden">
            <h3 class="text-lg lg:text-xl font-serif font-bold text-[#1c1917] mb-1">Entri Ensiklopedia</h3>
            <p class="text-xs text-gray-500 mb-4">Daftar emosi yang tersedia</p>

            <div class="space-y-3 flex-1 overflow-y-auto pr-2 min-h-0">
                @forelse($topFeelings as $entry)
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-medium text-[#614d3c] truncate">{{ $entry->feeling }}</span>
                        <span class="text-xs bg-[#f4ebe1] text-[#a07954] px-2 py-1 rounded-full flex-shrink-0 ml-2">{{ $entry->category }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">Belum ada entri.</p>
                @endforelse
            </div>

            <div class="mt-4 bg-[#F9F7F4] rounded-xl p-4 border border-[#e8dbce]/50 flex-shrink-0">
                <p class="text-[11px] lg:text-xs text-[#614d3c] font-medium leading-relaxed">
                    Total {{ $totalEncyclopedia }} entri emosi tersedia untuk pengguna.
                </p>
            </div>
        </div>

        <!-- Korelasi Mood vs Waktu -->
        <div class="bg-white rounded-[2rem] p-5 lg:p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30 flex flex-col h-full min-h-0">
            <div class="flex justify-between items-start mb-4 flex-shrink-0">
                <div>
                    <h3 class="text-lg font-serif font-bold text-[#1c1917] mb-1">Tren Mood Pengguna</h3>
                    <p class="text-xs text-gray-500">Rata-rata skor mood (30 hari terakhir)</p>
                </div>
                <span class="bg-[#F9F7F4] text-[#a07954] text-[10px] font-semibold px-3 py-1 rounded-full border border-[#e8dbce]/50 flex items-center gap-1.5 whitespace-nowrap">
                    <div class="w-1.5 h-1.5 bg-[#a07954] rounded-full"></div>
                    Mood Score
                </span>
            </div>

            <div class="flex-1 relative min-h-0 w-full">
                <canvas id="adminStressChart"></canvas>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4 border-t border-gray-100 pt-4 flex-shrink-0">
                <div class="border-l-2 border-gray-200 pl-3">
                    <p class="text-[10px] text-gray-500 mb-0.5">Total Entri Mood</p>
                    <p class="text-base lg:text-lg font-serif text-[#a07954]">{{ $totalEmotions }}</p>
                </div>
                <div class="border-l-2 border-gray-200 pl-3">
                    <p class="text-[10px] text-gray-500 mb-0.5">Total Pengguna</p>
                    <p class="text-base lg:text-lg font-serif text-[#614d3c]">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('adminStressChart').getContext('2d');
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(160, 121, 84, 0.2)');
    gradient.addColorStop(1, 'rgba(160, 121, 84, 0)');

    const rawData = @json($moodTrend);
    const labels     = rawData.length ? rawData.map(d => d.date)      : ['Belum ada data'];
    const dataPoints = rawData.length ? rawData.map(d => d.avg_score) : [0];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Avg Mood Score',
                data: dataPoints,
                borderColor: '#a07954',
                backgroundColor: gradient,
                borderWidth: 3,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointBackgroundColor: '#a07954',
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#614d3c',
                    padding: 12,
                    displayColors: false,
                    callbacks: { label: ctx => 'Avg Score: ' + ctx.parsed.y }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#9ca3af', maxTicksLimit: 6 } },
                y: { display: false, min: 0, max: 5 }
            },
            interaction: { intersect: false, mode: 'index' },
        }
    });
});
</script>
@endpush
