<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeKwh extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_tarif',
        'price'
    ];

    // public function Tagihan(): HasMany
    // {
    //     return $this->hasMany(Tagihan::class,'type_kwh_id','id');
    // }
}
