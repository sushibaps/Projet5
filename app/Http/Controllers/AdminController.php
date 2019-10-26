<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    public function photoCreate(){
        return view ('backend.photoCreate');
    }

    public function categoryCreate(){
        return view ('backend.galeriecreate');
    }

    public function delete(){
        $category = new Category();
        $category->name = \request('name');
        Category::where('name', '=', $category->name)->delete();
        return redirect('/galerie');
    }

    public function categoryStore(){
        $category = new Category();
        $category->name = \request('name');
        $category->level = \request('level');
        $category->save();

        return redirect('/galerie');
    }

    public function photoStore(Request $request){
        $path = $request->file('data')->store('storage/uploads');
        $name = $request->input('name');
        $description = $request->input('description');
        $location = $request->input('location');
        $price = $request->input('price');
        $photo = new Photo();
        $photo->name = $name;
        $photo->path = $path;
        $photo->description = $description;
        $photo->location = $location;
        $photo->price = $price;
        $photo->save();
        $this->resizeSmall($path, $name);
        $this->resizeMedium($path, $name);

        return redirect('/photos');
    }

    public function resizeSmall($path, $name){
        // open an image file
        $img = Image::make(storage_path() . '/app/' . $path);
        // now you are able to resize the instance
        $img->resize(320, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        // finally we save the image as a new file
        $img->save(storage_path() . '/app/storage/small/' . $name . '.jpeg');
    }

    public function resizeMedium($path, $name){
        $img = Image::make(storage_path() . '/app/' . $path);
        $img->resize(720, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(storage_path() . '/app/storage/medium/' . $name . '.jpeg');
    }
}
