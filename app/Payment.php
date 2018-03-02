<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = "payment";
    public function order(){
        return $this->hasOne('App\Order', 'id', 'order_id');
    }
}
