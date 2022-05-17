<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kios extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_kios',
        'luas_kios',
        'aktif'
    ];

    public function RelasiKios(): HasOne
    {
        return $this->hasOne(RelasiKios::class, 'kios_id', 'id');
    }
}
