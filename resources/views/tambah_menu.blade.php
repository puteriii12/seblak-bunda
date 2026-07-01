@extends('layouts.tambah_menu')

@section('title', 'Tambah Menu - Seblak Bunda')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('dashboard') }}">
            <i class="bi bi-arrow-left me-2"></i>
            Seblak Bunda
        </a>
        <div class="ms-auto">
            <i class="bi bi-heart heart-icon"></i>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-form py-4">
    <div class="card-custom">
        <h1 class="section-title">Tambah Menu</h1>

        <form id="formMenu" action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Jenis Menu -->
            <div class="form-section">
                <label class="form-label">Jenis Menu</label>
                <div class="custom-select-wrapper">
                    <div class="custom-select" id="categorySelect">
                        <input type="hidden" id="category" name="category" required>
                        <div class="custom-select__trigger">
                            <span id="selectedText">Pilih</span>
                        </div>
                        <div class="custom-options">
                            <span class="custom-option" data-value="kerupuk">Kerupuk</span>
                            <span class="custom-option" data-value="frozen_food">Frozen Food</span>
                            <span class="custom-option" data-value="sayur">Sayur</span>
                            <span class="custom-option" data-value="additional_topping">Additional Topping</span>
                        </div>
                    </div>
                </div>
                @error('category')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Gambar -->
            <div class="form-section">
                <label class="form-label">Gambar</label>
                <div>
                    <label class="btn-upload" for="uploadGambar">
                        <i class="bi bi-cloud-upload"></i>
                        Pilih File
                    </label>
                    <input type="file" class="d-none" id="uploadGambar" name="image" accept=".jpg,.jpeg,.png" required>
                    <small class="text-muted ms-2" id="fileName">Belum ada file dipilih</small>
                </div>
                <!-- Error message untuk format file -->
                <small class="text-danger d-none" id="fileError">
                    <i class="bi bi-exclamation-circle"></i>
                    Format file harus JPG, JPEG, atau PNG
                </small>
                <!-- Info format yang diizinkan -->
                <small class="text-muted d-block mt-1">
                    <i class="bi bi-info-circle"></i>
                    Format yang diizinkan: JPG, JPEG, PNG (Maks. 2MB)
                </small>
                @error('image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Nama -->
            <div class="form-section">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Isikan nama menu" value="{{ old('name') }}" required>
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="form-section">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Isikan description" required>{{ old('description') }}</textarea>
                @error('description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Harga -->
            <div class="form-section">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Contoh: 10000" value="{{ old('price') }}" required autocomplete="off">
                <small class="text-muted">Masukkan angka tanpa titik atau koma</small>
                @error('price')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Ketersediaan Menu -->
            <div class="form-section">
                <label class="form-label d-block">Ketersediaan Menu</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ketersediaan" id="tersedia" value="tersedia" {{ old('ketersediaan', 'tersedia') == 'tersedia' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tersedia">
                            Tersedia
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ketersediaan" id="tidakTersedia" value="tidak_tersedia" {{ old('ketersediaan') == 'tidak_tersedia' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tidakTersedia">
                            Tidak Tersedia
                        </label>
                    </div>
                </div>
                @error('ketersediaan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <div class="container">
                    <div class="row g-2">
                        <div class="col-6">
                            <button type="submit" class="btn btn-simpan flex-fill">Simpan</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-batal flex-fill" onclick="batal()">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Alert Success -->
        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // ===== CUSTOM DROPDOWN LOGIC =====
    const customSelect = document.querySelector('.custom-select');
    const trigger = customSelect.querySelector('.custom-select__trigger');
    const options = customSelect.querySelectorAll('.custom-option');
    const selectedText = document.getElementById('selectedText');
    const hiddenInput = document.getElementById('category');

    // Toggle dropdown saat trigger diklik
    trigger.addEventListener('click', function(e) {
        e.stopPropagation();
        customSelect.classList.toggle('open');
    });

    // Pilih option
    options.forEach(option => {
        option.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const text = this.textContent;

            selectedText.textContent = text;
            hiddenInput.value = value;

            options.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');

            customSelect.classList.remove('open');
        });
    });

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        if (!customSelect.contains(e.target)) {
            customSelect.classList.remove('open');
        }
    });

    // ===== FILE UPLOAD HANDLER =====
    const uploadGambar = document.getElementById('uploadGambar');
    const fileNameDisplay = document.getElementById('fileName');
    const fileError = document.getElementById('fileError');

    // Format yang diizinkan
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png'];
    const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB

    uploadGambar.addEventListener('change', function(e) {
        const file = e.target.files[0];

        // Reset error state
        fileError.classList.add('d-none');

        // Jika tidak ada file dipilih
        if (!file) {
            fileNameDisplay.textContent = 'Belum ada file dipilih';
            fileNameDisplay.classList.remove('text-danger');
            fileNameDisplay.classList.add('text-muted');
            return;
        }

        // Ambil ekstensi file (lowercase)
        const fileName = file.name.toLowerCase();
        const fileExtension = fileName.split('.').pop();

        // Validasi ekstensi
        if (!ALLOWED_EXTENSIONS.includes(fileExtension)) {
            // Tampilkan error
            fileError.classList.remove('d-none');
            fileNameDisplay.textContent = '❌ File ditolak: ' + file.name;
            fileNameDisplay.classList.remove('text-muted');
            fileNameDisplay.classList.add('text-danger');

            // Reset input file
            uploadGambar.value = '';
            return;
        }

        // Validasi ukuran file
        if (file.size > MAX_FILE_SIZE) {
            fileError.textContent = '⚠️ Ukuran file terlalu besar! Maksimal 2MB';
            fileError.classList.remove('d-none');
            fileNameDisplay.textContent = '❌ File ditolak: ' + file.name;
            fileNameDisplay.classList.remove('text-muted');
            fileNameDisplay.classList.add('text-danger');

            // Reset input file
            uploadGambar.value = '';
            return;
        }

        // Validasi MIME type (double check)
        const allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedMimeTypes.includes(file.type)) {
            fileError.textContent = '❌ Tipe file tidak valid!';
            fileError.classList.remove('d-none');
            fileNameDisplay.textContent = '❌ File ditolak: ' + file.name;
            fileNameDisplay.classList.remove('text-muted');
            fileNameDisplay.classList.add('text-danger');

            uploadGambar.value = '';
            return;
        }

        // ✅ File valid - tampilkan nama
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        fileNameDisplay.textContent = `${file.name} (${fileSizeMB} MB)`;
        fileNameDisplay.classList.remove('text-danger');
        fileNameDisplay.classList.add('text-muted');

        console.log('File valid:', {
            name: file.name,
            type: file.type,
            size: fileSizeMB + ' MB'
        });
    });

    // ===== CANCEL BUTTON HANDLER =====
    function batal() {
        window.location.href = "{{ route('dashboard') }}";
    }

    // ===== PRICE FORMATTING =====
    const hargaInput = document.getElementById('price');

    hargaInput.addEventListener('input', function(e) {
        // Hanya izinkan angka
        let value = e.target.value.replace(/\D/g, '');

        // Hapus leading zeros
        value = value.replace(/^0+/, '');

        // Jika kosong, set ke 0
        if (value === '') {
            value = '0';
        }

        e.target.value = value;
    });

    // Format saat blur (untuk readability)
    hargaInput.addEventListener('blur', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value === '') value = '0';

        // Format dengan titik sebagai pemisah ribuan
        const formatted = parseInt(value).toLocaleString('id-ID');
        e.target.value = formatted;
    });

    // Kembalikan ke angka polos saat focus (untuk edit)
    hargaInput.addEventListener('focus', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value === '') value = '0';
        e.target.value = value;
    });
</script>
@endpush