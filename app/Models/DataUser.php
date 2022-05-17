<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'rekening',
        'nik',
        'no_hp',
        'jenis_kelamin',
        'status_user'
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
