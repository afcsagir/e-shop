<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function soldProducts ()
    {
    	return $this->hasMany('App\SoldProducts');
    }

    public function return()
    {
    	return $this->hasMany('App\Return');
    }
}
