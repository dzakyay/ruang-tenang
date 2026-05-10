import Chart from 'chart.js/auto';

export function moodPage() {
    return {
        // ── Modal state ──────────────────────────────────────────────────────
        showMoodModal: window.__moodPageConfig?.showModal ?? false,
        selectedMood:  null,
        selectedScore: null,
        note:          '',
        loading:       false,
        errorMsg:      '',
        flashMsg:      '',

        // ── Chart state ──────────────────────────────────────────────────────
        chartDays:  7,
        chartInstance: null,

        // ── Calendar state ───────────────────────────────────────────────────
        calendarYear:    window.__thisYear,
        calendarMonth:   window.__thisMonth, // 1-based
        calendarEmotions: {},                // keyed by day number for viewed month

        // ── Computed calendar props ──────────────────────────────────────────
        get calendarMonthLabel() {
            const date = new Date(this.calendarYear, this.calendarMonth - 1, 1);
            return date.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });
        },
        get calendarDays() {
            const days = new Date(this.calendarYear, this.calendarMonth, 0).getDate();
            return Array.from({ length: days }, (_, i) => i + 1);
        },
        get calendarOffset() {
            // ISO weekday: Mon=1 … Sun=7 → offset 0-6
            const dow = new Date(this.calendarYear, this.calendarMonth - 1, 1).getDay();
            const iso = dow === 0 ? 7 : dow;
            return Array.from({ length: iso - 1 }, (_, i) => i + 1);
        },
        get isCurrentMonth() {
            return this.calendarYear  === window.__thisYear &&
                   this.calendarMonth === window.__thisMonth;
        },

        isToday(day) {
            return this.isCurrentMonth && day === window.__today;
        },

        // ── Lifecycle ────────────────────────────────────────────────────────
        init() {
            // Load current month emotions from SSR data
            this.calendarEmotions = window.__monthEmotions ?? {};

            // Build chart
            this.$nextTick(() => this.buildChart(window.__moodTrendData ?? []));
        },

        // ── Calendar navigation ──────────────────────────────────────────────
        prevMonth() {
            if (this.calendarMonth === 1) {
                this.calendarMonth = 12;
                this.calendarYear--;
            } else {
                this.calendarMonth--;
            }
            this.fetchCalendarEmotions();
        },
        nextMonth() {
            if (this.isCurrentMonth) return;
            if (this.calendarMonth === 12) {
                this.calendarMonth = 1;
                this.calendarYear++;
            } else {
                this.calendarMonth++;
            }
            // If we navigated back to current month, use SSR data
            if (this.isCurrentMonth) {
                this.calendarEmotions = window.__monthEmotions ?? {};
            } else {
                this.fetchCalendarEmotions();
            }
        },
        async fetchCalendarEmotions() {
            // If it's the current month, use SSR data (no extra request)
            if (this.isCurrentMonth) {
                this.calendarEmotions = window.__monthEmotions ?? {};
                return;
            }
            try {
                const url = `${window.__moodPageConfig.chartUrl}?month=${this.calendarMonth}&year=${this.calendarYear}&type=calendar`;
                const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                if (res.ok) {
                    this.calendarEmotions = await res.json();
                }
            } catch (e) {
                console.error('Failed to fetch calendar emotions', e);
            }
        },

        // ── Chart ────────────────────────────────────────────────────────────
        buildChart(data) {
            const canvas = document.getElementById('moodTrendChart');
            if (!canvas) return;

            if (this.chartInstance) {
                this.chartInstance.destroy();
                this.chartInstance = null;
            }

            if (!data || data.length === 0) return;

            this.chartInstance = new Chart(canvas, {
                type: 'line',
                data: {
                    labels: data.map(d => d.date),
                    datasets: [{
                        data:            data.map(d => d.score),
                        borderColor:     '#a07954',
                        backgroundColor: 'rgba(160,121,84,0.08)',
                        pointBackgroundColor: data.map(d => d.color),
                        pointRadius:     6,
                        pointHoverRadius: 8,
                        fill:            true,
                        tension:         0.4,
                        borderWidth:     2.5,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => {
                                    const d = data[ctx.dataIndex];
                                    return ` ${d.emoji}  ${d.mood}`;
                                },
                            },
                        },
                    },
                    scales: {
                        y: {
                            min: 1, max: 5,
                            ticks: {
                                stepSize: 1,
                                callback: v => ['','😔','😐','😊','😍','🔥'][v] ?? v,
                            },
                            grid: { color: 'rgba(0,0,0,0.04)' },
                        },
                        x: { grid: { display: false } },
                    },
                },
            });
        },

        async switchPeriod(days) {
            this.chartDays = days;
            try {
                const res  = await fetch(`${window.__moodPageConfig.chartUrl}?days=${days}`);
                const data = await res.json();
                this.buildChart(data);
            } catch (e) {
                console.error('Failed to fetch chart data', e);
            }
        },

        // ── Mood modal ───────────────────────────────────────────────────────
        selectMood(mood, score) {
            this.selectedMood  = mood;
            this.selectedScore = score;
            this.errorMsg      = '';
        },

        async submitMood() {
            if (!this.selectedMood) {
                this.errorMsg = 'Pilih mood terlebih dahulu.';
                return;
            }
            this.loading  = true;
            this.errorMsg = '';
            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
                const res   = await fetch(window.__moodPageConfig.storeUrl, {
                    method:  'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept':       'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({
                        mood:  this.selectedMood,
                        score: this.selectedScore,
                        note:  this.note,
                    }),
                });

                const data = await res.json();

                if (data.success) {
                    this.showMoodModal = false;
                    this.flashMsg      = 'Perasaanmu berhasil disimpan!';
                    setTimeout(() => { this.flashMsg = ''; }, 3000);

                    // Add dot to today's calendar if viewing current month
                    if (this.isCurrentMonth) {
                        this.calendarEmotions[window.__today] = {
                            mood:  data.emotion.mood,
                            color: data.emotion.color ?? '#a07954',
                            emoji: data.emotion.emoji ?? '😊',
                        };
                    }

                    // Refresh chart
                    const chartRes  = await fetch(`${window.__moodPageConfig.chartUrl}?days=${this.chartDays}`);
                    const chartData = await chartRes.json();
                    this.buildChart(chartData);
                } else {
                    this.errorMsg = data.message ?? 'Terjadi kesalahan.';
                }
            } catch (e) {
                this.errorMsg = 'Gagal menyimpan. Coba lagi.';
                console.error(e);
            } finally {
                this.loading = false;
            }
        },
    };
}
