<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'is_available',
    ];

    // Cast is_available ke boolean
    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'integer',
    ];

    // Format harga: Rp 10.000
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // URL gambar
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : 'https://via.placeholder.com/400x300/ff8c42/fff?text=No+Image';
    }

    // ✅ Accessor untuk kompatibilitas dengan Blade lama
    public function getKetersediaanAttribute()
    {
        return $this->is_available ? 'tersedia' : 'tidak_tersedia';
    }
}