<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Gunakan property standar agar kompatibel dengan semua versi Laravel
    // dan menghindari bug pada atribut PHP 8 di Laravel 13.
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Method casts() sudah didukung di Laravel 11+. 
    // (Jika Anda pakai Laravel 10 ke bawah, ubah menjadi protected $casts = [...];)
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}