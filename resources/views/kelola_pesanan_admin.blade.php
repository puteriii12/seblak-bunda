@extends('layouts.kelola_pesanan_admin')

@section('content')
<div class="app-wrapper">

    <!-- Mobile Status Bar -->
    <div class="status-bar">
        <span>9:41</span>
        <div class="status-icons">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M1 9l2 2c4.97-4.97 13.03-4.97 18 0l2-2C16.93 2.93 7.08 2.93 1 9zm8 8l3 3 3-3c-1.65-1.66-4.34-1.66-6 0zm-4-4l2 2c2.76-2.76 7.24-2.76 10 0l2-2C15.14 9.14 8.87 9.14 5 13z" />
            </svg>
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z" />
            </svg>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <h1 class="header-title">Order</h1>
        <button class="home-btn" onclick="window.location.href='dashboard'">Home</button>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-nav">
        <button class="tab-item active" onclick="showTab('dinein',this)">
            Dine In
            <span class="badge">1</span>
        </button>
        <button class="tab-item" onclick="showTab('takeaway',this)">
            Take Away
            <span class="badge">1</span>
        </button>
        <button class="tab-item" onclick="showTab('selesai',this)">
            Selesai
        </button>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <div class="search-bar">
            <div class="search-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <input type="text" class="search-input" placeholder="Cari order pelanggan" id="searchInput">
        </div>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- DINE IN -->
        <div id="dinein" class="page active">
            <div class="section-header">
                <h2 class="section-title">Hari ini</h2>
                <p class="section-subtitle">4 Order</p>
            </div>

            <div class="orders-grid">
                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">Angelina</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge qris">QRIS</span>
                        <a href="/detail_order_qris" class="arrow-link"
                            style="text-decoration: none; color: inherit; font-size: 1.2em; font-weight: bold;">
                            <span class="arrow">›</span>
                        </a>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">Putri</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge cashier-dark">Bayar Kasir</span>
                        <a href="{{ url('bayar-kasir') }}" class="arrow-link"
                            style="text-decoration: none; color: inherit; font-size: 1.2em; font-weight: bold;">
                            <span class="arrow">›</span>
                        </a>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">Yosi</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge cashier-light">Bayar Kasir</span>
                        <span class="arrow">›</span>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">Rania</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge qris">QRIS</span>
                        <span class="arrow">›</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAKEAWAY -->
        <div id="takeaway" class="page">
            <div class="section-header">
                <h2 class="section-title">Hari ini</h2>
                <p class="section-subtitle">4 Order</p>
            </div>

            <div class="orders-grid">
                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">Angelina</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge qris">QRIS</span>
                        <a href="{{ url('bayar-qris') }}" class="arrow-link"
                            style="text-decoration: none; color: inherit; font-size: 1.2em; font-weight: bold;">
                            <span class="arrow">›</span>
                        </a>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">Putri</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge qris">QRIS</span>
                        <span class="arrow">›</span>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">Yosi</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge qris">QRIS</span>
                        <span class="arrow">›</span>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">Rania</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge qris">QRIS</span>
                        <span class="arrow">›</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SELESAI -->
        <div id="selesai" class="page">
            <div class="section-header">
                <h2 class="section-title">Hari ini</h2>
                <p class="section-subtitle">4 Order</p>
            </div>
            <div class="orders-grid" id="selesai-list"></div>

            <div class="date-section">
                <div class="section-header">
                    <h2 class="section-title">Senin, 17 Mei 2026</h2>
                    <p class="section-subtitle">4 Order</p>
                </div>
                <div class="orders-grid" id="history-list"></div>
            </div>
        </div>

    </div>

    <!-- Home Indicator (Mobile only) -->
    <div class="home-indicator"></div>
</div>
@endsection
@push('scripts')
<script>
    function createCard(name, payment) {
        const badgeClass = payment === 'Bayar Kasir' ? 'cashier-light' : 'qris';
        return `
                <div class="order-card">
                    <div class="order-info">
                        <span class="item-count">2 Item</span>
                        <span class="customer-name">${name}</span>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge ${badgeClass}">${payment}</span>
                        <span class="arrow">›</span>
                    </div>
                </div>`;
    }

    const selesaiData = [
        ["Angelina", "QRIS"],
        ["Putri", "Bayar Kasir"],
        ["Yosi", "Bayar Kasir"],
        ["Rania", "QRIS"]
    ];

    let html = '';
    selesaiData.forEach(item => {
        html += createCard(item[0], item[1]);
    });
    document.getElementById('selesai-list').innerHTML = html;
    document.getElementById('history-list').innerHTML = html;

    function showTab(id, el) {
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('active');
        });
        document.getElementById(id).classList.add('active');
        document.querySelectorAll('.tab-item').forEach(tab => {
            tab.classList.remove('active');
        });
        el.classList.add('active');
    }

    document.getElementById('searchInput').addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        const activePage = document.querySelector('.page.active');
        if (!activePage) return;
        activePage.querySelectorAll('.order-card').forEach(card => {
            card.style.display = card.innerText.toLowerCase().includes(keyword) ? 'flex' : 'none';
        });
    });
</script>
@endpush