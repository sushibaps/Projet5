<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'id',
        'name',
        'path',
        'category_id' //Peuvent être remplis par l'utilisateur
    ];

    public function photo(){
        return $this->belongsTo("App\Photo");
    }
}
