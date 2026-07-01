@extends('layouts/lunas_order')
@section('content')
    <div class="app-wrapper">
        <!-- Header -->
        <div class="header">
            <button class="back-btn" onclick="history.back()">
                <a href="{{ url('history') }}" class="back-btn"
                    style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>
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
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <div class="dropdown-wrapper">
                    <button class="btn-action" id="btnProses" onclick="toggleDropdown()">
                        Proses
                        <svg class="arrow-down" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <div class="dropdown-item" onclick="selectAction('Selesai')">
                            Selesai
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup Success -->
    <div class="modal-overlay" id="successModal" style="display: none;">
        <div class="modal-success" onclick="event.stopPropagation()">
            <h2 class="modal-success-title">Status berhasil diubah</h2>
            <button class="btn-oke" onclick="redirectToHistory()">Oke</button>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function toggleDropdown() {
            const btn = document.getElementById('btnProses');
            const menu = document.getElementById('dropdownMenu');
            btn.classList.toggle('active');
            menu.classList.toggle('show');
        }

        function selectAction(action) {
            const btn = document.getElementById('btnProses');
            btn.innerHTML = action + ` <svg class="arrow-down" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>`;
            document.getElementById('dropdownMenu').classList.remove('show');
            btn.classList.remove('active');

            // ✅ Tampilkan modal success jika memilih "Selesai"
            if (action === 'Selesai') {
                setTimeout(() => {
                    document.getElementById('successModal').style.display = 'flex';
                }, 300);
            }
        }

        // ✅ Fungsi redirect ke history
        function redirectToHistory() {
            window.location.href = '{{ url("history") }}';
        }

        document.addEventListener('click', function (e) {
            const wrapper = document.querySelector('.dropdown-wrapper');
            if (!wrapper.contains(e.target)) {
                document.getElementById('dropdownMenu').classList.remove('show');
                document.getElementById('btnProses').classList.remove('active');
            }
        });
    </script>
@endpush