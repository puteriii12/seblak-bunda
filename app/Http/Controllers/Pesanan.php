<?php

namespace App\Http\Controllers;

class Pesanan extends Controller
{
    public function history() {
        return view('kelola_pesanan_admin');
    }

    public function pesan_qris() {
        return view('detail_order_qris');
    }

    public function pesan_kasir() {
        return view('bayar_kasir');
    }

    public function sudah_bayar() {
        return view('lunas_order');
    }
}
