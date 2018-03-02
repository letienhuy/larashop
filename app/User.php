<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    use Notifiable;

    protected $table = "user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function address(){
        return $this->hasMany('App\Address', 'user_id', 'id');
    }
    public function order(){
        return $this->hasMany('App\Order', 'user_id', 'id');
    }
    public function rate(){
        return $this->hasMany('App\Rate', 'user_id', 'id');
    }
    public function defaultAvatar(){
        return asset('assets/images/default-image.jpg');
    }
}
