<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';
    protected $fillable = [
        'name',
        'amount',
        'expense_date',
        'description',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->expense_date)->locale('id')->isoFormat('dddd, D MMMM YYYY');
    }

    public function getShortDateAttribute()
    {
        return Carbon::parse($this->expense_date)->locale('id')->isoFormat('dddd, D MMM YYYY');
    }
}