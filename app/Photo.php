<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'id',
        'name',
        'path',
        'description',
        'location',
        'price'
    ];

    public function photo(){
        return $this->belongsTo("App\Photo");
    }

    public function categories(){
        return $this->belongsToMany('\App\Category');
    }
}
