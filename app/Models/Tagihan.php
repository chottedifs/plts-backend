<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user',
        'id_kios',
        'nilai_kwh_awal',
        'nilai_kwh_akhir',
        'total_kwh',
        'periode',
    ];


    /**
     * Get the user associated with the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user');
    }


    /**
     * Get the user associated with the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function outlet(): HasOne
    {
        return $this->hasOne(Outlet::class, 'id_outlet');
    }
}

