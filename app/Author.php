<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name'
    ];

    public function records(){
        return $this->hasMany('App\Record','auteur_id');
    }


}
