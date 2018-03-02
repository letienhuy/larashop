<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "order";
    public function orderDetail(){
        return $this->hasMany('App\OrderDetail', 'order_id', 'id');
    }
    public function payment(){
        return $this->hasOne('App\Payment', 'order_id', 'id');
    }
    public function address(){
        return $this->hasOne('App\Address', 'id', 'address_id');
    }
}
