<?php

namespace App\Models;

use App\Models\Lokasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Petugas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'lokasi_id',
        'nip',
        'no_hp',
        'jenis_kelamin',
        'status_petugas'
    ];

    public function Lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id');
    }
}
