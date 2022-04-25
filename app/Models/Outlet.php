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
        'name_outlet',
        'id_user',
        'id_rate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class, 'id_rate');
    }
}
