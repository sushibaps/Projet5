<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotosController extends Controller
{
    public function list(){
        $photos = Photo::orderBy('id', "desc")->get();
        $count = $photos->count();
        $div = intdiv($count, 4);
        return view ('frontend.photos')->with([
            'photos' => $photos,
            'count' => $count,
            'div' => $div
        ]);
    }

    public function display($id){
        $photo = Photo::findOrFail($id);
        return view('frontend.photoDisplay')
            ->withPhoto($photo);
    }

    public function getFile($id){
            $photo = Photo::findOrFail($id);
            return response()->file(storage_path() . '/app/' . $photo->path);

    }

    public function getMiniature($id){
        $photo = Photo::findOrFail($id);
        return response()->file(storage_path() . '/app/storage/small/' . $photo->name . '.jpeg');
    }

    public function getMedium($id){
        $photo = Photo::findOrFail($id);
        return response()->file(storage_path() . '/app/storage/medium/' . $photo->name . '.jpeg');
    }

    public function getLarge($id){
        $photo = Photo::findOrFail($id);
        return response()->file(storage_path() . '/app/storage/large/' . $photo->name . '.jpeg');
    }
}
