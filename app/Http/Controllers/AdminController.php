<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Actualite;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    public function actusCreate()
    {
        $photos = Photo::orderBy('id', "desc")->get();
        $count = $photos->count();
        $div = intdiv($count, 4);
        return view('backend.actusCreate')->with([
            'photos' => $photos,
            'count' => $count,
            'div' => $div
        ]);
    }

    public function actusStore(Request $request)
    {
        $actu = new Actualite();
        $actu->title = $request->input('title');
        $actu->newsletter = $request->input('newsletter');
        if ($request->has('photo_id')) {
            $actu->photo_id = $request->input('photo_id');
        } else {
            $photo = new Photo();
            $path = $request->file('data')->store('storage/uploads');
            $name = $request->input('name');
            $photo->name = $request->input('name');
            $photo->path = $path;
            $photo->description = $request->input('description');
            $photo->price = $request->input('price');
            $photo->save();
            $this->resize($path, $name, 'small');
            $this->resize($path, $name, 'medium');
            $this->resize($path, $name, 'large');
            $actu->photo_id = $photo->id;
        }
        $actu->save();
        return redirect('/actus');
    }

    public function recurse($category)
    {
        foreach ($category->children as $souscat) {
            $this->recurse($souscat);
        }
    }

    public function tree($categories)
    {
        $tree = [];
        foreach ($categories as $category) {
            $this->recurse($category);
            $cat = $category->toArray();
            array_push($tree, $cat);
        }
        return $tree;
    }

    public function categoryCreate()
    {
        $categories = Category::where('level', 0)->orderBy('name')->get();
        $tree = $this->tree($categories);
        $photos = Photo::orderBy('id', "desc")->get();
        $count = $photos->count();
        $div = intdiv($count, 4);
        return view('backend.galeriecreate')
            ->withTree($tree)
            ->withPhotos($photos)
            ->withCount($count)
            ->withDiv($div);

    }

    public function delete()
    {
        $category = new Category();
        $category->name = \request('name');
        Category::where('name', '=', $category->name)->delete();
        return redirect('/galerie');
    }

    public function categoryStore(Request $request)
    {
        $count = Category::all()->count();
        if ($count > 0) {
            $category = new Category();
            $oldcategories = Category::all();
            $level = 0;
            foreach ($oldcategories as $oldcategory) {
                if ($request->has('category' . $oldcategory->id)) {
                    $category->category_id = $oldcategory->id;
                    if ($oldcategory->level >= $level) {
                        $level = $oldcategory->level + 1;
                    }
                }
            }
            $category->level = $level;
        } else {
            $category = new Category();
            $category->level = 0;
        }
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        $photos = Photo::all();
        foreach($photos as $photo){
            if($request->has('photo' . $photo->id)){
                $category->photos()->attach($photo->id);
            }
        }

        return redirect('/galerie');
    }

    public function photoCreate()
    {
        $categories = Category::where('level', 0)->orderBy('name')->get();
        $tree = $this->tree($categories);
        return view('backend.photoCreate')
            ->withTree($tree);
    }

    public function photoStore(Request $request)
    {
        $path = $request->file('data')->store('storage/uploads');
        $name = $request->input('name');
        $description = $request->input('description');
        $location = $request->input('location');
        $price = $request->input('price');
        $photo = new Photo();
        $photo->name = $name;
        $photo->path = $path;
        $photo->description = $description;
        $photo->price = $price;
        $photo->save();
        $this->resize($path, $name, 'small');
        $this->resize($path, $name, 'medium');
        $this->resize($path, $name, 'large');
        $categories = Category::all();
        foreach($categories as $category){
            if($request->has('category' . $category->id)){
                $photo->categories()->attach($category->id);
            }
        }

        return redirect('/photos');
    }

    public function resize($path, $name, $format)
    {
        // open an image file
        $img = Image::make(storage_path() . '/app/' . $path);
        // now you are able to resize the instance
        switch ($format) {
            case ('small') :
                $width = 320;
                break;
            case ('medium'):
                $width = 720;
                break;
            case ('large'):
                $width = 1200;
                break;
        }
        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        // finally we save the image as a new file
        $img->save(storage_path() . '/app/storage/' . $format . '/' . $name . '.jpeg');
    }
}
