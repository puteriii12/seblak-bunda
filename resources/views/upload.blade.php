@extends('layouts.up')

@section('content')

    {{-- Icon --}}
    <div class="icon-container">
        <div class="icon-circle">
            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 24L20 52C20 54 22 56 24 56H40C42 56 44 54 44 52L48 24" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16 24H48" stroke="white" stroke-width="3" stroke-linecap="round"/>
                <path d="M24 24V16C24 12 28 8 32 8C36 8 40 12 40 16V24" stroke="white" stroke-width="3" stroke-linecap="round"/>
                <circle cx="27" cy="36" r="2" fill="white"/>
                <circle cx="37" cy="36" r="2" fill="white"/>
                <path d="M28 42C28 42 30 44 32 44C34 44 36 42 36 42" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </div>
    </div>

    {{-- Content --}}
    <div class="content-section">
        <h2 class="content-title">Proses Pembayaran</h2>
        <p class="content-desc">Silahkan upload bukti pembayaran</p>
    </div>

    {{-- Upload Button --}}
    <div class="upload-section">
        <button class="btn-upload" id="uploadBtn" onclick="document.getElementById('fileInput').click()">
            Upload File
        </button>
        <input type="file" id="fileInput" accept="image/*,.pdf" onchange="handleFileSelect(event)">
    </div>

    {{-- Submit Button --}}
    <div class="submit-section">
        <button class="btn-submit" id="submitBtn" onclick="kirimBukti()" disabled>
            Kirim
        </button>
    </div>
@endsection

@push('scripts')
<script>
    let selectedFile = null;

    function handleFileSelect(event) {
        const file = event.target.files[0];
        const uploadBtn = document.getElementById('uploadBtn');
        const submitBtn = document.getElementById('submitBtn');

        if (file) {
            selectedFile = file;
            uploadBtn.textContent = file.name;
            submitBtn.disabled = false;
        }
    }

    function kirimBukti() {
        if (!selectedFile) return;

        const submitBtn = document.getElementById('submitBtn');
        submitBtn.textContent = 'Mengirim...';
        submitBtn.disabled = true;

        setTimeout(() => {
            window.location.href = "/order_sukses";
        }, 1500);
    }
</script>
@endpush