<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SewaKios extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'relasi_kios_id',
        'status_sewa'
    ];

    public function Tagihan(): HasOne
    {
        return $this->hasOne(Tagihan::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function RelasiKios(): BelongsTo
    {
        return $this->belongsTo(RelasiKios::class);
    }
}
