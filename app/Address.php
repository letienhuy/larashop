<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = "user_address";
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function order(){
        return $this->hasMany('App\User', 'address_id', 'id');
    }
}
