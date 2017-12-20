<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOrder extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
