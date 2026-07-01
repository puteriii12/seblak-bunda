@extends('layouts.dashboard')

@section('title', 'Dashboard Admin - Seblak Bunda')

@section('content')
<!-- Header -->
<!-- Header -->
<div class="header-gradient">
    <div class="container">
        <!-- Baris 1: Label "Your current address" -->
        <div class="address-text mb-2">Your current address</div>

        <!-- Baris 2: Address + Actions (SEJAJAR) -->
        <div class="d-flex align-items-center justify-content-between">
            <!-- Kiri: Current Address -->
            <div class="current-address flex-grow-1" id="userAddress">
                <i class="bi bi-geo-alt-fill me-2"></i>
                <span id="addressText" class="address-label">Mendeteksi lokasi...</span>
            </div>

            <!-- Kanan: Actions -->
            <div class="header-actions ms-3">
                <button id="refreshLocation" class="btn btn-sm" title="Refresh lokasi">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <form action="{{ route('logout') }}" method="POST" class="d-inline" id="logoutForm">
                    @csrf
                    <button type="submit" class="btn btn-sm" title="Logout"
                        style="border: none; background: transparent; color: var(--dark-text); cursor: pointer;">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Baris 3: Search Box -->
        <div class="search-box">
            <div class="d-flex align-items-center">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="What would you like to eat?">
            </div>
        </div>
    </div>
</div>

<!-- Restaurant Info -->
<div class="restaurant-header">
    <div class="container">
        <h1 class="restaurant-name">Seblak Bunda</h1>
        <p class="text-muted mb-2">Indonesian Resto</p>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <p class="mb-0"><i class="bi bi-geo-alt text-danger me-1"></i> Banjarsari, Cangkringan, Sleman</p>
            <a href="https://www.google.com/maps/search/?api=1&query=-7.6482276,110.4689396"
                target="_blank" class="see-maps">See on maps <i class="bi bi-box-arrow-up-right ms-1"></i></a>
        </div>
    </div>
</div>

<!-- Map -->
<div class="map-wrapper">
    <div class="container">
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1102.8817444666604!2d110.46739277704597!3d-7.647823568590191!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5d005f4bbc05%3A0x8b1d579a46d344e5!2sSeblak%20Prasmanan%20Bunda!5e0!3m2!1sid!2sid!4v1781520547227!5m2!1sid!2sid"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>

<!-- Info Banner -->
<div class="info-banner-wrapper">
    <div class="container">
        <div class="info-banner">
            <p>Pilih menu favoritmu, atur level pedas, dan tambahkan topping sesuai selera dengan proses pemesanan yang mudah dan cepat.</p>
        </div>
    </div>
</div>

<!-- Main Tabs -->
<div class="main-tabs">
    <div class="container">
        <div class="row g-2">
            <div class="col-6">
                <a href="{{ route('history') }}" class="btn tab-primary">Pesanan</a>
            </div>
            <div class="col-6">
                <a href="{{route('laporan.index')}}" class="btn tab-primary">Lihat Laporan Penjualan</a>
            </div>
        </div>
    </div>
</div>

<!-- Category Tabs -->
<div class="category-tabs">
    <div class="container">
        @php
        $categories = [
        'kerupuk' => ['label' => 'Kerupuk', 'target' => 'section-kerupuk'],
        'frozen_food' => ['label' => 'Frozen Food', 'target' => 'section-frozen'],
        'additional_topping' => ['label' => 'Additional Topping', 'target' => 'section-topping'],
        'sayur' => ['label' => 'Sayur', 'target' => 'section-sayur'],
        ];
        @endphp
        @foreach($categories as $key => $cat)
        <button class="category-tab {{ $loop->first ? 'active' : '' }}" data-target="{{ $cat['target'] }}">
            {{ $cat['label'] }}
        </button>
        @endforeach
    </div>
</div>

<!-- Menu Content -->
<div class="menu-section">
    <div class="container">

        {{-- Alert Success --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @php
        $categoryLabels = [
        'kerupuk' => 'Kerupuk',
        'frozen_food' => 'Frozen Food',
        'additional_topping' => 'Additional Topping',
        'sayur' => 'Sayur',
        ];
        $categoryIds = [
        'kerupuk' => 'section-kerupuk',
        'frozen_food' => 'section-frozen',
        'additional_topping' => 'section-topping',
        'sayur' => 'section-sayur',
        ];
        @endphp

        @forelse($menus as $category => $items)
        <div class="mb-4" id="{{ $categoryIds[$category] ?? 'section-'.$category }}">

            {{-- Judul kategori (tanpa tombol tambah menu) --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title mb-0">
                    {{ $categoryLabels[$category] ?? ucfirst(str_replace('_', ' ', $category)) }}
                </h2>
                @if($category === 'kerupuk')
                <a href="{{ url('tambah') }}" class="add-menu-btn">+Tambah Menu</a>
                @endif
            </div>

            @if($category === 'kerupuk')
            {{-- Kerupuk pakai grid layout --}}
            <div class="menu-grid">
                @foreach($items as $menu)
                <div class="menu-card {{ !$menu->is_available ? 'menu-unavailable' : '' }}">
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="menu-image">
                    <div class="menu-content">
                        <h3 class="menu-title">{{ $menu->name }}</h3>
                        <p class="menu-desc">{{ $menu->description }}</p>
                        <p class="menu-price">{{ $menu->formatted_price }}</p>
                        <div class="menu-actions">
                            <a href="{{ route('edit.menu', $menu->id) }}" class="btn-edit">Edit</a>
                            <button type="button" class="btn-delete"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-url="{{ route('menus.destroy', $menu->id) }}"
                                title="Hapus Menu">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            {{-- Kategori lain pakai horizontal layout --}}
            <div class="horizontal-menu">
                @foreach($items as $menu)
                <div class="horizontal-item {{ $menu->ketersediaan === 'tidak_tersedia' ? 'menu-unavailable' : '' }}">
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}">
                    <div class="horizontal-item-content">
                        <h3 class="menu-title">{{ $menu->name }}</h3>
                        <p class="menu-desc">{{ $menu->description }}</p>
                        <p class="menu-price">{{ $menu->formatted_price }}</p>
                        <div class="menu-actions">
                            <a href="{{ route('edit.menu', $menu->id) }}" class="btn-edit">Edit</a>
                            <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-url="{{ route('menus.destroy', $menu->id) }}" title="Hapus Menu">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
        @empty
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
            <p class="text-muted mt-3">Belum ada menu. <a href="{{ url('tambah') }}">Tambah menu pertama!</a></p>
        </div>
        @endforelse

    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="deleteModalLabel" style="color: var(--dark-text);">
                    <i class="text-danger me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Apakah Anda yakin ingin menghapus menu ini?</p>
            </div>
            <div class="modal-footer">

                <!-- Form ini akan diisi action-nya secara otomatis oleh JavaScript -->
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Category tab switching + SCROLL
    document.querySelectorAll('.category-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Update active class
            document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Scroll ke section yang dituju
            const targetId = this.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                // Hitung offset untuk sticky header
                const categoryTabs = document.querySelector('.category-tabs');
                const offset = categoryTabs.offsetHeight + 20;

                // Hitung posisi scroll
                const targetPosition = targetSection.getBoundingClientRect().top + window.pageYOffset - offset;

                // Smooth scroll
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Fungsi untuk mendapatkan lokasi pengguna
    function getUserLocation() {
        const addressText = document.getElementById('addressText');
        const refreshBtn = document.getElementById('refreshLocation');

        if (!navigator.geolocation) {
            addressText.textContent = 'Gunamarwan street No. 14';
            alert('Browser Anda tidak mendukung geolocation.');
            return;
        }

        addressText.textContent = 'Mendeteksi lokasi...';
        refreshBtn.disabled = true;

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                reverseGeocode(latitude, longitude);
            },
            function(error) {
                let errorMessage = 'Gunamarwan street No. 14';
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = 'Akses lokasi ditolak';
                        alert('Anda menolak akses lokasi. Silakan izinkan di pengaturan browser.');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = 'Lokasi tidak tersedia';
                        break;
                    case error.TIMEOUT:
                        errorMessage = 'Waktu deteksi habis';
                        break;
                    default:
                        errorMessage = 'Gagal mendeteksi lokasi';
                }
                addressText.textContent = errorMessage;
                refreshBtn.disabled = false;
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 300000
            }
        );
    }

    function reverseGeocode(lat, lon) {
        const addressText = document.getElementById('addressText');
        const refreshBtn = document.getElementById('refreshLocation');
        const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`;

        fetch(url, {
                headers: {
                    'Accept-Language': 'id'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data && data.display_name) {
                    const address = data.address;
                    let shortAddress = '';
                    if (address.road || address.street) shortAddress += (address.road || address.street) + ', ';
                    if (address.suburb || address.village || address.neighbourhood) shortAddress += (address.suburb || address.village || address.neighbourhood) + ', ';
                    if (address.city_district || address.town) shortAddress += (address.city_district || address.town) + ', ';
                    if (address.city || address.county) shortAddress += (address.city || address.county);
                    if (!shortAddress) shortAddress = data.display_name;
                    if (shortAddress.length > 50) shortAddress = shortAddress.substring(0, 50) + '...';
                    addressText.textContent = shortAddress;
                    localStorage.setItem('user_lat', lat);
                    localStorage.setItem('user_lon', lon);
                    localStorage.setItem('user_address', shortAddress);
                    localStorage.setItem('location_timestamp', Date.now().toString());
                } else {
                    addressText.textContent = 'Lokasi tidak ditemukan';
                }
                refreshBtn.disabled = false;
            })
            .catch(error => {
                console.error('Error geocoding:', error);
                addressText.textContent = 'Gagal memuat alamat';
                refreshBtn.disabled = false;
            });
    }

    document.getElementById('refreshLocation').addEventListener('click', getUserLocation);

    document.addEventListener('DOMContentLoaded', function() {
        const savedAddress = localStorage.getItem('user_address');
        const lastUpdate = localStorage.getItem('location_timestamp');
        const oneHour = 60 * 60 * 1000;

        if (savedAddress && lastUpdate && (Date.now() - parseInt(lastUpdate) < oneHour)) {
            document.getElementById('addressText').textContent = savedAddress;
        } else {
            getUserLocation();
        }
    });

    // Script untuk menangani Modal Hapus
    const deleteModal = document.getElementById('deleteModal');

    deleteModal.addEventListener('show.bs.modal', function(event) {
        // Tombol yang memicu modal
        const button = event.relatedTarget;

        // Ambil URL dari atribut data-url
        const url = button.getAttribute('data-url');

        // Temukan form di dalam modal dan ubah atribut action-nya
        const form = deleteModal.querySelector('#deleteForm');
        form.setAttribute('action', url);
    });
</script>
@endpush