<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tagihan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // 'user_id',
        'outlet_id',
        'nilai_kwh_awal',
        'nilai_kwh_akhir',
        'total_kwh',
        'jumlah_tagihan',
        'periode',
        'status_pembayaran'
    ];

    // public function User(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function Outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }
}

