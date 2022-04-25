<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    // protected $guarded = [
    //     'id',
    // ];

    protected $fillable = [
        // 'id_user',
        'id_rate',
        'name_kios',
        'luas_kios',
        'status_kios'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id_user');
    // }

    public function rate()
    {
        return $this->belongsTo(Rate::class, 'id_rate');
    }

    /**
     * Get the user that owns the Outlet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }
}
