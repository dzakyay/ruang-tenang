// Alpine component for dashboard (mood modal + sparkline chart)
export function dashboardPage() {
    const config = window.__dashboardConfig || {};

    return {
        showMoodModal: config.showModal ?? false,
        selectedMood: null,
        selectedScore: null,
        note: '',
        loading: false,
        errorMsg: null,
        flashMsg: null,

        init() {
            this.$nextTick(() => this.initSparkline(window.__moodSparklineData || []));
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

        initSparkline(trend) {
            if (!trend.length) return;
            const ctx = document.getElementById('dashboardMoodChart');
            if (!ctx || !window.Chart) return;

            new window.Chart(ctx, {
                type: 'line',
                data: {
                    labels: trend.map(d => d.date ?? d.label),
                    datasets: [{
                        data: trend.map(d => d.score),
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
                                    const d = trend[ctx.dataIndex];
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
    };
}
