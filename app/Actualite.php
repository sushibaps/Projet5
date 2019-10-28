<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    //The attributes that will be filled by the user
    protected $fillable = [
        'newsletter',
        'photo_id'
    ];

    public function photo(){
        return $this->belongsTo('App\Photo', 'photo_id');
    }
}
