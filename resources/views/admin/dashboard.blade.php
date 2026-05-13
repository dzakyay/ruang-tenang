@extends('layouts.admin')

@section('content')
<!-- Perubahan 1: Menambahkan h-height tetap di semua layar dan overflow-hidden -->
<div class="max-w-6xl mx-auto flex flex-col h-[calc(100vh-2rem)] lg:h-[calc(100vh-5rem)] overflow-hidden">

    <!-- Top Row: Title and Profile -->
    <div class="flex justify-between items-start mb-4 flex-shrink-0">
        <h2 class="text-2xl lg:text-3xl font-serif font-bold text-[#614d3c]">Selamat Pagi, Admin</h2>
        <!-- Profile Image -->
        <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden shadow-sm">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Admin Profile" class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Banner -->
    <!-- Perubahan 2: Mengurangi tinggi banner menjadi h-24/lg:h-28 agar lebih ringkas -->
    <div class="relative bg-gray-200 rounded-3xl overflow-hidden shadow-sm mb-4 h-24 lg:h-28 flex-shrink-0">
        <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
             alt="Mountains" class="absolute inset-0 w-full h-full object-cover opacity-80">
        <div class="absolute inset-0 bg-gradient-to-r from-[#e3dcd1]/90 to-transparent"></div>
        <div class="relative z-10 p-5 lg:p-8 h-full flex flex-col justify-center">
            <h3 class="text-xl lg:text-2xl font-serif text-[#614d3c] mb-1">Ringkasan Hari Ini</h3>
            <p class="text-xs lg:text-sm text-gray-700">Pantau kesejahteraan komunitas dengan tenang dan penuh empati.</p>
        </div>
    </div>

    <!-- Main Grid -->
    <!-- Perubahan 3: Memastikan grid mengambil sisa layar (flex-1) dan tidak tumpah (min-h-0) -->
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 min-h-0">
        
        <!-- Emosi Paling Banyak Dilihat -->
        <div class="bg-white rounded-[2rem] p-5 lg:p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30 flex flex-col h-full min-h-0 overflow-hidden">
            <h3 class="text-lg lg:text-xl font-serif font-bold text-[#1c1917] mb-1">Emosi Paling Banyak Dilihat</h3>
            <p class="text-xs text-gray-500 mb-4">Peringkat minat emosional pembaca minggu ini</p>

            <!-- List Emosi bisa di-scroll jika kepanjangan -->
            <div class="space-y-4 flex-1 overflow-y-auto pr-2 min-h-0">
                <!-- Item 1 -->
                <div>
                    <div class="flex justify-between text-sm font-semibold text-[#614d3c] mb-2">
                        <span>Kecemasan Antisipatif</span>
                        <span>42%</span>
                    </div>
                    <div class="w-full bg-[#FAF8F5] rounded-full h-2.5 overflow-hidden">
                        <div class="bg-[#a07954] h-2.5 rounded-full" style="width: 42%"></div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div>
                    <div class="flex justify-between text-sm font-semibold text-[#614d3c] mb-2">
                        <span>Syukur Mendalam</span>
                        <span>28%</span>
                    </div>
                    <div class="w-full bg-[#FAF8F5] rounded-full h-2.5 overflow-hidden">
                        <div class="bg-[#728C69] h-2.5 rounded-full" style="width: 28%"></div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div>
                    <div class="flex justify-between text-sm font-semibold text-[#614d3c] mb-2">
                        <span>Kesepian Transien</span>
                        <span>15%</span>
                    </div>
                    <div class="w-full bg-[#FAF8F5] rounded-full h-2.5 overflow-hidden">
                        <div class="bg-[#614d3c] h-2.5 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
            </div>

            <!-- Insight Box -->
            <div class="mt-4 bg-[#F9F7F4] rounded-xl p-4 border border-[#e8dbce]/50 flex-shrink-0">
                <p class="text-[11px] lg:text-xs text-[#614d3c] font-medium leading-relaxed">
                    Insight: Peningkatan pencarian 'Kecemasan' terpantau pada malam hari jam 22:00 - 01:00.
                </p>
            </div>
        </div>

        <!-- Korelasi Suasana Hati vs Waktu Chart -->
        <div class="bg-white rounded-[2rem] p-5 lg:p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e8dbce]/30 flex flex-col h-full min-h-0">
            <div class="flex justify-between items-start mb-4 flex-shrink-0">
                <div>
                    <h3 class="text-lg lg:text-l font-serif font-bold text-[#1c1917] mb-1">Korelasi Suasana Hati vs Waktu</h3>
                    <p class="text-xs text-gray-500">Pola stress mingguan (30 Hari Terakhir)</p>
                </div>
                <span class="bg-[#F9F7F4] text-[#a07954] text-[10px] font-semibold px-3 py-1 rounded-full border border-[#e8dbce]/50 flex items-center gap-1.5 whitespace-nowrap">
                    <div class="w-1.5 h-1.5 bg-[#a07954] rounded-full"></div>
                    Indeks Stress
                </span>
            </div>

            <!-- Chart Container -->
            <div class="flex-1 relative min-h-0 w-full">
                <canvas id="adminStressChart"></canvas>
            </div>

            <!-- Chart Legends / Summary -->
            <div class="grid grid-cols-2 gap-4 mt-4 border-t border-gray-100 pt-4 flex-shrink-0">
                <div class="border-l-2 border-gray-200 pl-3">
                    <p class="text-[10px] text-gray-500 mb-0.5">Rata-rata Stress</p>
                    <p class="text-base lg:text-lg font-serif text-[#728C69]">Rendah</p>
                </div>
                <div class="border-l-2 border-gray-200 pl-3">
                    <p class="text-[10px] text-gray-500 mb-0.5">Puncak Stress</p>
                    <p class="text-base lg:text-lg font-serif text-[#a07954]">Hari Senin</p>
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
    
    // Gradient for line chart
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(160, 121, 84, 0.2)');   
    gradient.addColorStop(1, 'rgba(160, 121, 84, 0)');

    // Dummy data from backend
    const rawData = @json($moodTrend ?? []);
    
    // If no data, use default dummy data
    const labels = rawData.length ? rawData.map(item => item.date) : ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
    const dataPoints = rawData.length ? rawData.map(item => item.avg_score) : [2, 1.5, 3.5, 1, 4.5, 3];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Indeks Stress',
                data: dataPoints,
                borderColor: '#a07954',
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#a07954',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#a07954',
                pointRadius: 0,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Ini sudah sangat tepat untuk membuat chart menyesuaikan div parent-nya
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#614d3c',
                    padding: 12,
                    titleFont: { family: 'Inter', size: 13 },
                    bodyFont: { family: 'Inter', size: 12 },
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Level Stress: ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: {
                        font: { family: 'Inter', size: 11 },
                        color: '#9ca3af',
                        maxTicksLimit: 4
                    }
                },
                y: {
                    display: false,
                    min: 0,
                    max: 5
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
        }
    });
});
</script>
@endpush