<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tagihan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'kode_tagihan',
        'user_id',
        'sewa_kios_id',
        'histori_kios_id',
        'lokasi_id',
        'total_kwh',
        'diskon',
        'remarks',
        'tagihan_kwh',
        'tagihan_kios',
        'periode',
        'status_id'
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

    public function Status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function Pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class);
    }
}
