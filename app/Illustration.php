<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Illustration extends Model
{
    /**
     * Illustrations of the services provided by the photographer
     */

    public function prestations(){
        return $this->belongsToMany('App\Prestation');
    }
}
