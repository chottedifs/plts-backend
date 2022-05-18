<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_lokasi'
    ];

    public function RelasiKios(): HasMany
    {
        return $this->hasMany(RelasiKios::class, 'lokasi_id', 'id');
    }

    public function Petugas(): HasMany
    {
        return $this->hasMany(Petugas::class, 'lokasi_id', 'id');
    }
}
