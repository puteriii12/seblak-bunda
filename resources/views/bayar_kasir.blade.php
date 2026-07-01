@extends('layouts/bayar_kasir')
@section('content')

    <div class="app-wrapper">
        <!-- Header -->
        <div class="header">
            <button class="back-btn" onclick="history.back()">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <h1 class="header-title">Detail Pesanan</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Informasi Pemesan -->
            <div class="section">
                <h2 class="section-title">Informasi Pemesan</h2>
                <div class="info-card">
                    <div class="info-row">
                        <span class="info-label">Ahmad Akakom</span>
                        <span class="info-value">Dine In</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">No Telp</span>
                        <span class="info-value">0987654329</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Waktu Pemesanan</span>
                        <span class="info-value">18 Mei 2026 | 13.00</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Metode Pembayaran</span>
                        <span class="info-value">QRIS</span>
                    </div>
                </div>
            </div>

            <!-- Daftar Pesanan -->
            <div class="section">
                <h2 class="section-title">Daftar Pesanan</h2>
                <div class="order-list-card">
                    <div class="order-item">
                        <div class="item-image">
                            <img src="{{ asset('images/dpkeju.jpg') }}" alt="Dimsum Keju">
                        </div>
                        <div class="item-details">
                            <div class="item-name">Dimsum Keju</div>
                            <div class="item-qty">2x</div>
                        </div>
                        <span class="item-price">Rp. 2.000</span>
                    </div>

                    <div class="order-item">
                        <div class="item-image">
                            <img src="{{ asset('images/bakso1.jpg') }}" alt="Bakso">
                        </div>
                        <div class="item-details">
                            <div class="item-name">Bakso</div>
                            <div class="item-qty">2x</div>
                        </div>
                        <span class="item-price">Rp. 1.000</span>
                    </div>

                    <div class="info-row" style="margin-top: 10px;">
                        <span class="info-label">Level Pedas</span>
                        <span class="info-value">5</span>
                    </div>

                    <div class="total-row">
                        <span class="total-label">TOTAL</span>
                        <span class="total-value">Rp. 3.000</span>
                    </div>

                    <div class="payment-status-row">
                        <span class="info-label">Status Pembayaran</span>
                        <div class="status-dropdown-wrapper">
                            <button class="btn-status-dropdown" id="btnStatus" onclick="toggleStatusDropdown()">
                                Pending
                                <svg class="arrow-down" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div class="status-dropdown-menu" id="statusDropdownMenu">
                                <a href="{{ url('sudah-bayar') }}" class="status-dropdown-item"
                                    style="text-decoration: none; color: inherit; display: block; padding: 10px;">
                                    Lunas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        function toggleStatusDropdown() {
            const btn = document.getElementById('btnStatus');
            const menu = document.getElementById('statusDropdownMenu');
            btn.classList.toggle('active');
            menu.classList.toggle('show');
        }

        function selectStatus(status) {
            const btn = document.getElementById('btnStatus');
            btn.innerHTML = status + ` <svg class="arrow-down" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>`;
            document.getElementById('statusDropdownMenu').classList.remove('show');
            btn.classList.remove('active');
        }

        document.addEventListener('click', function (e) {
            const wrapper = document.querySelector('.status-dropdown-wrapper');
            if (!wrapper.contains(e.target)) {
                document.getElementById('statusDropdownMenu').classList.remove('show');
                document.getElementById('btnStatus').classList.remove('active');
            }
        });
    </script>
@endpush