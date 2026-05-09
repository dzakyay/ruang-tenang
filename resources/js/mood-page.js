let _moodChart = null;

// Alpine component for mood tracker & chart page
export function moodPage() {
    const config = window.__moodPageConfig || {};

    return {
        showMoodModal: config.showModal ?? false,
        selectedMood: null,
        selectedScore: null,
        note: '',
        loading: false,
        errorMsg: null,
        flashMsg: null,
        chartDays: 7,
        activeData: [],   // chartInstance TIDAK disini (bukan reactive)

        init() {
            this.$nextTick(() => this.initChart(window.__moodTrendData || []));
        },

        selectMood(mood, score) {
            this.selectedMood = mood;
            this.selectedScore = score;
            this.errorMsg = null;
        },

        async submitMood() {
            if (!this.selectedMood) {
                this.errorMsg = 'Pilih dulu bagaimana perasaanmu.';
                return;
            }
            this.loading = true;
            this.errorMsg = null;
            try {
                const res = await fetch(config.storeUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        mood: this.selectedMood,
                        score: this.selectedScore,
                        note: this.note,
                    }),
                });
                const data = await res.json();
                if (data.success) {
                    this.showMoodModal = false;
                    this.flashMsg = 'Perasaanmu telah disimpan ✓';
                    setTimeout(() => this.flashMsg = null, 4000);
                } else {
                    this.errorMsg = data.message || 'Terjadi kesalahan.';
                }
            } catch {
                this.errorMsg = 'Gagal menyimpan. Coba lagi.';
            } finally {
                this.loading = false;
            }
        },

        initChart(initialData) {
            const ctx = document.getElementById('moodTrendChart');
            if (!ctx || !window.Chart) return;

            // Hancurkan chart lama jika ada
            if (_moodChart) {
                _moodChart.destroy();
                _moodChart = null;
            }

            this.activeData = initialData;

            // Simpan ke module variable, BUKAN this.chartInstance
            _moodChart = new window.Chart(ctx, {
                type: 'line',
                data: {
                    labels: initialData.map(d => d.label ?? d.date),
                    datasets: [{
                        data: initialData.map(d => d.score),
                        borderColor: '#a07954',
                        backgroundColor: 'rgba(160,121,84,0.08)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#a07954',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#614d3c',
                            bodyColor: '#614d3c',
                            borderColor: '#e8dbce',
                            borderWidth: 1,
                            padding: 10,
                            callbacks: {
                                label: (ctx) => {
                                    const d = this.activeData[ctx.dataIndex];
                                    return d ? `${d.emoji} ${d.mood}` : '';
                                },
                            },
                        },
                    },
                    scales: {
                        y: {
                            min: 0,
                            max: 6,
                            grid: { color: 'rgba(0,0,0,0.04)' },
                            ticks: {
                                stepSize: 1,
                                color: '#a09080',
                                font: { size: 11 },
                                callback: v => ['', '😔', '😐', '😊', '😍', '🔥'][v] ?? '',
                            },
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#a09080', font: { size: 11 } },
                        },
                    },
                },
            });
        },

        async switchPeriod(days) {
            if (!_moodChart) return;   // pakai module variable
            this.chartDays = days;
            try {
                const res = await fetch(`/mood/chart-data?days=${days}`, {
                    headers: { Accept: 'application/json' },
                });
                const data = await res.json();
                this.activeData = data;
                _moodChart.data.labels = data.map(d => d.label ?? d.date);
                _moodChart.data.datasets[0].data = data.map(d => d.score);
                _moodChart.update();   // tidak ada lagi stack overflow
            } catch (e) {
                console.error('Gagal memuat data chart:', e);
            }
        },
    };
}
