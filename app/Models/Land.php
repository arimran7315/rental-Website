<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    public function rents()
    {
        return $this->hasMany(Rent::class, 'land_id');
    }
}
