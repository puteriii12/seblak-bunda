@extends('layouts.laporan')

@section('content')
    <!-- Header -->
    <div class="report-header">
        <div class="header-top">
            <a href="/dashboard" class="back-btn">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="page-title">Laporan Penjualan</h1>
        </div>

        <div class="period-section">
            <span class="show-label">Show:</span>
            <div class="period-dropdown">
                <button class="period-btn" onclick="toggleDropdown()">
                    <span id="selectedPeriod">
                        @php
                            $periodLabels = [
                                'hari' => 'Hari ini',
                                'minggu' => 'Minggu ini',
                                'bulan' => 'Bulan ini',
                                'tahun' => 'Tahun ini',
                                'semua' => 'Semua',
                            ];
                        @endphp
                        {{ $periodLabels[$chartData['period']] ?? 'Bulan ini' }}
                    </span>
                    <i class="bi bi-chevron-down"></i>
                </button>
                <div class="period-dropdown-menu" id="periodDropdown">
                    <div class="period-item {{ $chartData['period'] === 'hari' ? 'active' : '' }}"
                        onclick="selectPeriod('hari', 'Hari ini')">Hari ini</div>
                    <div class="period-item {{ $chartData['period'] === 'minggu' ? 'active' : '' }}"
                        onclick="selectPeriod('minggu', 'Minggu ini')">Minggu ini</div>
                    <div class="period-item {{ $chartData['period'] === 'bulan' ? 'active' : '' }}"
                        onclick="selectPeriod('bulan', 'Bulan ini')">Bulan ini</div>
                    <div class="period-item {{ $chartData['period'] === 'tahun' ? 'active' : '' }}"
                        onclick="selectPeriod('tahun', 'Tahun ini')">Tahun ini</div>
                    <div class="period-item {{ $chartData['period'] === 'semua' ? 'active' : '' }}"
                        onclick="selectPeriod('semua', 'Semua')">Semua</div>
                </div>
            </div>
        </div>

        <div class="expense-btn-container">
            <a href="/pengeluaran" class="expense-btn"> Pengeluaran </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card full-width">
            <div class="stat-icon pink">
                <i class="bi bi-cart3"></i>
            </div>
            <div class="stat-label">Total transaksi</div>
            <div class="stat-value" id="totalTransactions">0</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon pink">
                <i class="bi bi-wallet2"></i>
            </div>
            <div class="stat-label">Total pendapatan</div>
            <div class="stat-value" id="totalIncome">Rp 0</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon dark-red">
                <i class="bi bi-arrow-down-circle"></i>
            </div>
            <div class="stat-label">Total pengeluaran</div>
            <div class="stat-value" id="totalExpense">Rp 0</div>
        </div>
    </div>

    <!-- Daily Income Chart -->
    <div class="chart-section">
        <h3 class="chart-title">Pendapatan Harian</h3>
        <div class="chart-legend">
            <div class="legend-item">
                <div class="legend-dot blue"></div>
                <span>Pendapatan</span>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="dailyChart"></canvas>
        </div>
    </div>

    <!-- Income vs Expense Chart -->
    <div class="chart-section">
        <h3 class="chart-title">Pendapatan vs Pengeluaran</h3>
        <div class="chart-legend">
            <div class="legend-item">
                <div class="legend-dot blue"></div>
                <span>Pendapatan</span>
            </div>
            <div class="legend-item">
                <div class="legend-dot green"></div>
                <span>Pengeluaran</span>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="comparisonChart"></canvas>
        </div>
    </div>

    <!-- Payment Method -->
    <div class="payment-section">
        <h3 class="chart-title">Metode Pembayaran</h3>
        <div class="payment-content">
            <div class="donut-container">
                <canvas id="paymentChart"></canvas>
            </div>
            <div class="payment-list">
                <div class="payment-item">
                    <div class="payment-info">
                        <div class="legend-dot green"></div>
                        <span class="payment-label">Tunai</span>
                    </div>
                    <span class="payment-value" id="cashStats">0 (0%)</span>
                </div>
                <div class="payment-item">
                    <div class="payment-info">
                        <div class="legend-dot blue" style="background: #f59e0b;"></div>
                        <span class="payment-label">QRIS</span>
                    </div>
                    <span class="payment-value" id="qrisStats">0 (0%)</span>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // ===== DATA DARI BACKEND =====
        const chartData = @json($chartData);

        let currentPeriod = chartData.period || 'bulan';
        let chartsInitialized = false;
        let dailyChart, compChart, payChart;

        // ===== DROPDOWN FUNCTIONS =====
        function toggleDropdown() {
            document.getElementById('periodDropdown').classList.toggle('show');
        }

        function selectPeriod(period, label) {
            document.getElementById('selectedPeriod').textContent = label;

            document.querySelectorAll('.period-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.closest('.period-item').classList.add('active');

            document.getElementById('periodDropdown').classList.remove('show');

            // Reload halaman dengan filter periode baru
            window.location.href = '{{ route("laporan.index") }}?period=' + period;
        }

        // Close dropdown when click outside
        window.onclick = function (event) {
            if (!event.target.matches('.period-btn') && !event.target.matches('.period-btn *')) {
                document.querySelectorAll('.period-dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        }

        // ===== NAVIGATION =====
        function goBack() {
            window.history.back();
        }

        // ===== FORMAT ANGKA =====
        function formatRupiah(value) {
            if (value >= 1000000) {
                return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
            } else if (value >= 1000) {
                return 'Rp ' + (value / 1000).toFixed(0) + 'rb';
            }
            return 'Rp ' + value.toLocaleString('id-ID');
        }

        // ===== CHART INITIALIZATION =====
        function initCharts() {
            if (chartsInitialized) return;

            // Update stats cards
            updateStats(chartData.stats, chartData.payment);

            // Daily Income Chart (Line)
            const dailyCtx = document.getElementById('dailyChart').getContext('2d');
            dailyChart = new Chart(dailyCtx, {
                type: 'line',
                data: {
                    labels: chartData.daily.labels,
                    datasets: [{
                        label: 'Pendapatan',
                        data: chartData.daily.income,
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e3a5f',
                            padding: 12,
                            callbacks: {
                                label: function (context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    if (value >= 1000000) return (value / 1000000) + 'jt';
                                    if (value >= 1000) return (value / 1000) + 'k';
                                    return value;
                                }
                            },
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Comparison Chart (Bar)
            const compCtx = document.getElementById('comparisonChart').getContext('2d');
            compChart = new Chart(compCtx, {
                type: 'bar',
                data: {
                    labels: chartData.comparison.labels,
                    datasets: [
                        {
                            label: 'Pendapatan',
                            data: chartData.comparison.income,
                            backgroundColor: '#2563eb',
                            borderRadius: 6
                        },
                        {
                            label: 'Pengeluaran',
                            data: chartData.comparison.expense,
                            backgroundColor: '#10b981',
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e3a5f',
                            padding: 12,
                            callbacks: {
                                label: function (context) {
                                    return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    if (value >= 1000000) return (value / 1000000) + 'jt';
                                    if (value >= 1000) return (value / 1000) + 'k';
                                    return value;
                                }
                            },
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Payment Method Chart (Doughnut)
            const payCtx = document.getElementById('paymentChart').getContext('2d');
            payChart = new Chart(payCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Tunai', 'QRIS'],
                    datasets: [{
                        data: [chartData.payment.cash, chartData.payment.qris],
                        backgroundColor: ['#10b981', '#f59e0b'],
                        borderWidth: 0,
                        cutout: '65%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e3a5f',
                            padding: 12,
                            callbacks: {
                                label: function (context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(0) : 0;
                                    return context.label + ': ' + percentage + '%';
                                }
                            }
                        }
                    }
                }
            });

            chartsInitialized = true;
        }

        function updateStats(stats, payment) {
            document.getElementById('totalTransactions').textContent = stats.transactions.toLocaleString('id-ID');
            document.getElementById('totalIncome').textContent = formatRupiah(stats.income);
            document.getElementById('totalExpense').textContent = formatRupiah(stats.expense);

            document.getElementById('cashStats').textContent = `${payment.cash} (${payment.cashPercent}%)`;
            document.getElementById('qrisStats').textContent = `${payment.qris} (${payment.qrisPercent}%)`;
        }

        // Initialize on load
        window.addEventListener('load', function () {
            setTimeout(initCharts, 100);
        });
    </script>
@endpush