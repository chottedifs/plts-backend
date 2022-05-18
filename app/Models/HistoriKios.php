<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriKios extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'sewa_kios_id',
        'tgl_awal_sewa',
        'tgl_akhir_sewa'
    ];

    public function Tagihan(): HasOne
    {
        return $this->hasOne(Tagihan::class);
    }
}