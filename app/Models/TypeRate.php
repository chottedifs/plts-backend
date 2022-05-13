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


    /**
     * Get the user associated with the TypeRate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Outlet(): HasMany
    {
        return $this->hasMany(Outlet::class,'type_rate_id','id');
    }
}
