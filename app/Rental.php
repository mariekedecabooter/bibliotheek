<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'record_id', 'user_id', 'date_in', 'date_out', 'date_returned'
    ];

    public function user(){
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function record(){
        return $this->belongsTo('App\Record')->withTrashed();
    }
}
