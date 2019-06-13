<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'titel', 'auteur_id', 'isbn', 'jaartal', 'uitgave', 'beschrijving', 'aantal', 'photo_id'
    ];

    public function author()
    {
        return $this->belongsTo('App\Author', 'auteur_id')->withTrashed();
    }

    public function rentals()
    {
        return $this->hasMany('App\Rental');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

}
