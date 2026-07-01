@extends('layouts.pengeluaran')

@section('title', 'Pengeluaran - Seblak Bunda')

@section('content')
    {{-- Header --}}
    <div class="expense-header">
        <div class="header-top">
            <a href="/laporan" class="back-btn">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="page-title">Laporan Penjualan</h1>
        </div>

        <div class="period-section">
            <span class="show-label">Show:</span>
            <div class="period-dropdown">
                <button class="period-btn" onclick="toggleDropdown()">
                    <span id="selectedPeriod">
                        @if($period === 'hari') Hari ini
                        @elseif($period === 'minggu') Minggu ini
                        @elseif($period === 'bulan') Bulan ini
                        @elseif($period === 'tahun') Tahun ini
                        @else Semua
                        @endif
                    </span>
                    <i class="bi bi-chevron-down"></i>
                </button>
                <div class="period-dropdown-menu" id="periodDropdown">
                    <div class="period-item {{ $period === 'hari' ? 'active' : '' }}"
                        onclick="selectPeriod('hari', 'Hari ini')">Hari ini</div>
                    <div class="period-item {{ $period === 'minggu' ? 'active' : '' }}"
                        onclick="selectPeriod('minggu', 'Minggu ini')">Minggu ini</div>
                    <div class="period-item {{ $period === 'bulan' ? 'active' : '' }}"
                        onclick="selectPeriod('bulan', 'Bulan ini')">Bulan ini</div>
                    <div class="period-item {{ $period === 'tahun' ? 'active' : '' }}"
                        onclick="selectPeriod('tahun', 'Tahun ini')">Tahun ini</div>
                    <div class="period-item {{ $period === 'semua' ? 'active' : '' }}"
                        onclick="selectPeriod('semua', 'Semua')">Semua</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert-custom alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Total Card --}}
    <div class="total-card">
        <div class="total-icon">
            <i class="bi bi-cash-stack"></i>
        </div>
        <div class="total-info">
            <div class="total-label">Total pengeluaran</div>
            <div class="total-value">Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- Expense Groups --}}
    <div class="expense-groups">
        @if($groupedExpenses->isEmpty())
            <div class="empty-state">
                <i class="bi bi-receipt"></i>
                <h3>Belum Ada Pengeluaran</h3>
                <p>Klik tombol + untuk menambah pengeluaran baru</p>
            </div>
        @else
            @foreach($groupedExpenses as $date => $pengeluaranByDate)
                <div class="expense-group">
                    <div class="group-header">
                        <div class="group-date">{{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        </div>
                        <div class="group-total">Pengeluaran: Rp {{ number_format($pengeluaranByDate->sum('amount'), 0, ',', '.') }}
                        </div>
                    </div>

                    @foreach($pengeluaranByDate as $expense)
                        <div class="expense-item">
                            <div class="expense-icon">
                                <i class="bi bi-receipt"></i>
                            </div>
                            <div class="expense-info">
                                <div class="expense-name">{{ $expense->name }}</div>
                                @if($expense->description)
                                    <div class="expense-desc">{{ $expense->description }}</div>
                                @endif
                            </div>
                            <div class="expense-amount">-Rp {{ number_format($expense->amount, 0, ',', '.') }}</div>
                            <div class="expense-actions">
                                <a href="{{ route('edit', $expense->id) }}" class="btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('destroy', $expense->id) }}" method="POST" style="display: inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

    {{-- Floating Action Button --}}
    <a href="{{ route('create') }}" class="fab" title="Tambah Pengeluaran">
        <i class="bi bi-plus"></i>
    </a>

@endsection

@push('scripts')
    <script>
        function toggleDropdown() {
            document.getElementById('periodDropdown').classList.toggle('show');
        }

        function selectPeriod(period, label) {
            document.getElementById('selectedPeriod').textContent = label;
            document.querySelectorAll('.period-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.classList.add('active');
            document.getElementById('periodDropdown').classList.remove('show');

            // Reload dengan filter periode
            window.location.href = '{{ route('index') }}?period=' + period;
        }

        window.onclick = function (event) {
            if (!event.target.matches('.period-btn') && !event.target.matches('.period-btn *')) {
                document.querySelectorAll('.period-dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        }
    </script>
@endpush