<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //
    protected $table = "rate";
    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function product(){
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
