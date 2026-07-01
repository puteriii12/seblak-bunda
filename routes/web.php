<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Login;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\Pesanan;
use Illuminate\Support\Facades\Route;

// Halaman Katalog
Route::get('/', function () {
    return view('katalog');
})->name('katalog');

// Halaman checkout
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/qrcode', function () {
    return view('qrcode');
})->name('qrcode');

Route::get('/upload', function () {
    return view('upload');
})->name('upload');

Route::get('/orderstatus', function () {
    return view('orderstatus');
})->name('orderstatus');

Route::get('/order_user', function () {
    return view('order_user');
})->name('orderuser');

Route::get('/detail_pesanan', function () {
    return view('detail_pesanan');
})->name('detail_pesanan');

Route::get('/detail_order_qris', function () {
    return view('detail_order_qris');
})->name('detail_order_qris');

Route::get('/order_sukses', function () {
    return view('order_sukses');
})->name('order_sukses');

// Halaman login
Route::get('/login', [Login::class, 'Auth'])->name('login');
Route::post('/proses-login', [Login::class, 'prosesLogin'])->name('proses.login');

//Proses Logout
Route::post('/logout', [Login::class, 'logout'])->name('logout');

// Halaman dashboard 
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman tambah menu
Route::get('/tambah', [DashboardController::class, 'tambah'])->name('tambah.menu');
Route::post('/menus', [DashboardController::class, 'store'])->name('menus.store');
Route::delete('/menus/{id}', [DashboardController::class, 'destroy'])->name('menus.destroy');

// Halaman Edit menu
Route::get('/edit/{id}', [DashboardController::class, 'edit'])->name('edit.menu');
Route::put('/menus/{id}', [DashboardController::class, 'update'])->name('menus.update');

//Halaman Pesanan Admin
Route::get('/history', [Pesanan::class, 'history'])->name('history');
Route::get('/bayar-qris', [Pesanan::class, 'pesan_qris'])->name('bayar.qris');
Route::get('/bayar-kasir', [Pesanan::class, 'pesan_kasir'])->name('bayar.kasir');
Route::get('/sudah-bayar', [Pesanan::class, 'sudah_bayar'])->name('sudah.bayar');

//Laporan penjualan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('index');
Route::get('/pengeluaran/tambah', [PengeluaranController::class, 'create'])->name('create');
Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('store');
Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('edit');
Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('update');
Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('destroy');