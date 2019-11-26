<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'name',
        'level',
        'category_id']; // Peuvent être remplis par l'utilisateur

    public function parent(){
        return $this->belongsTo("\App\Category");
    }

    public function children(){
        return $this->hasMany('\App\Category');
    }

    public function photos(){
        return $this->belongsToMany('\App\Photo');
    }

}
