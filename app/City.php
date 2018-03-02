<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "city";
    public function district(){
        return $this->hasMany('App\District', 'city_id', 'id');
    }
}
