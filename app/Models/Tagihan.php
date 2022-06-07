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
        'sewa_kios_id',
        'histori_kios_id',
        'lokasi_id',
        'total_kwh',
        'tagihan_kwh',
        'tagihan_kios',
        'total_tagihan',
        'periode',
        'status_bayar',
    ];

    public function SewaKios(): BelongsTo
    {
        return $this->belongsTo(SewaKios::class);
    }

    public function HistoriKios(): BelongsTo
    {
        return $this->belongsTo(HistoriKios::class);
    }

    public function Lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class);
    }
}
