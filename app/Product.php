<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "product";
    public function category(){
        return $this->belongsTo('App\Category', 'cat_id', 'id');
    }
    public function orderDetail(){
        return $this->belongsTo('App\OrderDetail', 'product_id', 'id');
    }
    public function image(){
        return $this->hasMany('App\Image', 'product_id', 'id');
    }
    public function comment(){
        return $this->hasMany('App\Comment', 'product_id', 'id')->where('comment_id', 0);
    }
    public function rate(){
        return $this->hasMany('App\Rate', 'product_id', 'id');
    }
    public function defaultImage(){
        return asset('assets/images/default-image.jpg');
    }
    public function keywords(){
        return explode(',',$this->keywords);
    }
}
