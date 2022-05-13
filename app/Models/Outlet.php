<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Outlet extends Model
{
    use HasFactory;

    // protected $guarded = [
    //     'id',
    // ];

    protected $fillable = [
        'user_id',
        'type_rate_id',
        'name_kios',
        'luas_kios',
        'status_kios'
    ];

    public function Typerate(): BelongsTo
    {
        return $this->belongsTo(TypeRate::class,'type_rate_id');
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
