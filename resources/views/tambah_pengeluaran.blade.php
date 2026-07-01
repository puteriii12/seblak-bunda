@extends('layouts.tambah_pengeluaran')

@section('title', 'Tambah Transaksi - Seblak Bunda')

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <h1 class="page-title">Tambah Transaksi</h1>
</div>

{{-- Section Label --}}
<div class="section-label">Pengeluaran</div>

{{-- Info Card --}}
<div class="info-card">
    <div class="info-card-icon">
        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="6" width="28" height="20" rx="3" stroke="#5a1a1a" stroke-width="2"/>
            <circle cx="10" cy="16" r="3" stroke="#5a1a1a" stroke-width="2"/>
            <path d="M22 12h4M22 16h4M22 20h4" stroke="#5a1a1a" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    <div class="info-card-text">Isikan detail pengeluaran</div>
</div>

{{-- Form --}}
<form action="{{ route('store') }}" method="POST">
    @csrf

    <div class="form-group">
        <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Isikan nama pengeluaran" required>
        @error('name')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <input type="number" name="amount" class="form-input" value="{{ old('amount') }}" placeholder="Isikan total pengeluaran (cth 20000)" min="0" step="100" required>
        @error('amount')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <div class="date-input-wrapper">
            <input type="date" name="expense_date" class="form-input" value="{{ old('expense_date', date('Y-m-d')) }}" required>
        </div>
        @error('expense_date')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-submit">
        Buat
    </button>
</form>

@endsection