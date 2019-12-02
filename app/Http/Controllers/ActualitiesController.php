<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use App\Actualite;

class ActualitiesController extends Controller
{
    public function list($id){
        $actu = Actualite::where('id', '=', $id)->first();
        return view ('frontend.actusDisplay')
            ->withActu($actu);
    }

    public function getPhoto($id){
        $actu = Actualite::findOrFail($id);
        return response()->file(storage_path() . '/app/' . $actu->path);
    }

    public function getMiniature($id){
        $actu = Actualite::findOrFail($id);
        return response()->file(storage_path() . '/app/storage/small/' . $actu->photo_name . '.jpeg');
    }

    public function getMedium($id){
        $actu = Actualite::findOrFail($id);
        return response()->file(storage_path() . '/app/storage/medium/' . $actu->photo_name . '.jpeg');
    }

    public function getLarge($id){
        $actu = Actualite::findOrFail($id);
        return response()->file(storage_path() . '/app/storage/large/' . $actu->photo_name . '.jpeg');
    }
}
