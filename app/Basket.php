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
        'userId',
        'photoId',
        'totalPrice'
    ];

    public function basket(){
        return $this->belongsTo("App\Basket");
    }
}
