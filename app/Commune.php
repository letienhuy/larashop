<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    //
    protected $table = "commune";
    public function district(){
        return $this->hasOne('App\District', 'id', 'district_id');
    }
}
