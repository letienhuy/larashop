<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    public function product(){
        return $this->hasMany('App\Product', 'cat_id', 'id');
    }
    public function parent(){
        return $this->hasOne('App\Category', 'id', 'parent_id');
    }
    public function child(){
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }
}
