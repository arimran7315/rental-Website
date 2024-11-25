<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    public function land()
    {
        return $this->belongsTo(Land::class, 'land_id');
    }
}
