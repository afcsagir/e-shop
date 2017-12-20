<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist_Item extends Model
{
    public function wishList()
    {
    	return $this->belongsTo('App\Wishlist');
    }

    public function variance()
    {
        return $this->belongsTo('App\Variance', 'variance_id');
    }
}
