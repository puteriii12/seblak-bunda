@extends('layouts.detail_pesanan')

@section('title', 'Kelola Pesanan - Seblak Bunda')

@section('content')
<div class="app-wrapper">
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">
            <a href="/order_user" class="back-btn" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">
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
                    <span class="info-label">Nomor Pesanan</span>
                    <span class="info-value">2134382493894</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Waktu Pemesanan</span>
                    <span class="info-value">18 Jan 2026 | 13.00</span>
                </div>
            </div>
        </div>

        <!-- Daftar Pesanan -->
        <div class="section">
            <h2 class="section-title">Daftar Pesanan</h2>
            <div class="order-list-card">
                <div class="order-item">
                    <div class="item-image">
                        <img src="dpkeju.jpg" alt="Dimsum Keju">
                    </div>
                    <div class="item-details">
                        <div class="item-name">Dimsum Keju</div>
                        <div class="item-qty">2x</div>
                    </div>
                    <span class="item-price">Rp. 2.000</span>
                </div>

                <div class="order-item">
                    <div class="item-image">
                        <img src="bakso1.jpg" alt="Bakso">
                    </div>
                    <div class="item-details">
                        <div class="item-name">Bakso</div>
                        <div class="item-qty">2x</div>
                    </div>
                    <span class="item-price">Rp. 1.000</span>
                </div>

                <div class="total-row">
                    <span class="total-label">TOTAL</span>
                    <span class="total-value">Rp. 3.000</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection