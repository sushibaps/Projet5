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

    public function category(){
        return $this->belongsTo("\App\Category");
    }

}
