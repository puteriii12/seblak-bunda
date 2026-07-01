@extends('layouts.qris')

@section('content')

    <!-- QRIS Image -->
    <div class="qris-image-container">
        <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS Payment" class="qris-image">
    </div>

    <!-- Process Section -->
    <div class="process-section">
        <h2 class="process-title">Proses Pembayaran</h2>
        <p class="process-desc">
            Silahkan lakukan proses<br>pembayaran terlebih dahulu ya
        </p>
    </div>

    <!-- Button Section -->
    <div class="btn-section">
        <a href="/upload" class="btn-cek-pembayaran">
            Cek Pembayaran
        </a>
    </div>
@endsection