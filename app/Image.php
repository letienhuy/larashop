<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = "image";
    public function product(){
        return $this->belongsTo('App\Product', 'image_id', 'id');
    }
}
