<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'role_id', 'address_id', 'rijksregisternummer','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        if($this->role->name == "bibliothecaris" || "ontlener"){
            return true;
        }
        return false;
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function rentals(){
        return $this->hasMany('App\Rental');
    }
}
