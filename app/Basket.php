<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    // The attributes that will be filled by the customer
    protected $fillable = [
        'quantity'
    ];

    // The attributes that should be hidden for the array
    protected $hidden = [
        'user_id',
        'photo_id',
        'total_price'
    ];

    public function photo(){
        return $this->belongsTo("App\Photo", "photo_id");
    }

    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }
}
