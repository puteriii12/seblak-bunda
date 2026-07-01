@extends('layouts.login')

@section('title', 'Login - Seblak Bunda')

@section('content')
<!-- Container utama -->
<div class="login-card">

    <!-- Bagian Header -->
    <div class="header-bg">
        <div class="logo-placeholder">
            <!-- PERBAIKAN: Hapus atribut height/width hardcoded agar responsif -->
            <img src="logo_seblak.png" alt="Logo Seblak Bunda">
        </div>
        <h3 class="fw-semibold" style="color: #640D14;">Login</h3>
    </div>

    <!-- Bagian Form -->
    <div class="px-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ url('/proses-login') }}" method="POST">
            @csrf

            <!-- Input Email -->
            <div class="custom-input-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                    </span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@gmail.com" required>
                </div>
            </div>

            <!-- Input Password -->
            <div class="custom-input-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                        </svg>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    <button class="btn-toggle-password" type="button" id="togglePassword" aria-label="Toggle password visibility">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="toggleIcon">
                            <path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16c.57-.23 1.18-.36 1.83-.36zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="btn btn-login w-100" style="color: #640D14;">Login</button>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- Script show/hide password -->
<script>
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    // Icon BUKA (mata terbuka - password terlihat)
    const iconOpen = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>';

    // Icon TUTUP (mata tertutup dengan garis coret - password tersembunyi)
    const iconClosed = '<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16c.57-.23 1.18-.36 1.83-.36zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>';

    togglePasswordBtn.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Ganti icon: BUKA (mata terbuka) atau TUTUP (mata tertutup)
        if (type === 'text') {
            // Password TERLIHAT - tampilkan icon BUKA (mata terbuka)
            toggleIcon.innerHTML = iconOpen;
        } else {
            // Password TERSEMBUNYI - tampilkan icon TUTUP (mata dengan coretan)
            toggleIcon.innerHTML = iconClosed;
        }
    });
</script>
@endpush