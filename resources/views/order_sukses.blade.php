@extends('layouts.order_sukses')

@section('title', 'Order Sukses - Seblak Bunda')

@section('content')

    {{-- Success Icon --}}
    <div class="success-icon">
        <div class="icon-circle">
            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                <path class="checkmark" d="M16 32l20 20 32-32" />
            </svg>
        </div>
    </div>

    {{-- Title --}}
    <h1 class="success-title">Order Sukses</h1>

    {{-- Message --}}
    <p class="success-message">
        Silahkan tunggu!! Pesanan sedang diproses yaa, terimakasih
    </p>

    {{-- Button --}}
    <a href="/order_user" class="btn-cek-riwayat">
        Cek Riwayat
    </a>

@endsection

@push('scripts')
    <script>
        // Optional: Clear cart after successful order
        localStorage.removeItem('seblakBundaCart');

        // Optional: Auto redirect after delay
        // setTimeout(() => {
        //     window.location.href = '/order-history';
        // }, 5000); // Redirect after 5 seconds
    </script>
@endpush