<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_phone',
        'spicy_level',
        'order_type',
        'payment_method',
        'note',
        'status',
        'total',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY');
    }
}