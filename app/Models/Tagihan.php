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
        // 'type_kwh_id',
        'nilai_kwh_awal',
        'nilai_kwh_akhir',
        'total_kwh',
        'jumlah_tagihan_kwh',
        'total_tagihan',
        'periode',
        'status_pembayaran'
    ];

    public function Outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    // public function TypeKwh(): BelongsTo
    // {
    //     return $this->belongsTo(TypeKwh::class, 'type_kwh_id');
    // }
}

