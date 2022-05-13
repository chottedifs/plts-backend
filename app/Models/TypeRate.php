<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeRate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'price'
    ];

    public function Outlet(): HasMany
    {
        return $this->hasMany(Outlet::class,'type_rate_id','id');
    }
}
