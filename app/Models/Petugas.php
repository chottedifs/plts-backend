<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lokasi;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Petugas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'email',
        'password',
        'login_id',
        'lokasi_id',
        'nip',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'status_petugas'
    ];

    public function Lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id');
    }

    public function Login(): BelongsTo
    {
        return $this->belongsTo(Login::class, 'login_id', 'id');
    }
}
