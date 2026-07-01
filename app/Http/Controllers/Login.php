<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function Auth()
    {
        // Jika user sudah login, langsung redirect ke dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil data input
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard (atau halaman yang sebelumnya ingin diakses)
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil! Selamat datang.');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error & mempertahankan input email
        return back()
            ->with('error', 'Email atau password salah!')
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
