<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table = "district";
    public function city(){
        return $this->hasOne('App\City', 'id', 'city_id');
    }
    public function commune(){
        return $this->hasMany('App\Commune', 'district_id', 'id');
    }
}
