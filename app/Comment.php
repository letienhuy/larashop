<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comment";
    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function product(){
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
    public function reply_comment(){
        return $this->hasMany('App\Comment', 'comment_id', 'id');
    }
}
