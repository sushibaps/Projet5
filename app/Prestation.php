<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    /**
     * Services provided by the photographer
     */

    public function illustrations(){
        return $this->belongsToMany('App\Illustration');
    }
}
