<?php

namespace App\Http\Controllers;

use App\Category;
use App\Illustration;
use App\Photo;
use App\Actualite;
use App\Prestation;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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

    public function actusDelete($id){
        $actu = Actualite::where('id', '=', $id)->findOrFail();
        if(isset($actu->path) && $actu->path !== 0){
            Storage::delete($actu->path);
        }
        $actu->delete();
        return redirect('/actus');
    }

    public function actusStore(Request $request)
    {
        if($request->has('id')){
            $count = Actualite::where('id', '=', $request->input('id'))->count();
            if($count > 0){
                $actu = Actualite::where('id', '=', $request->input('id'))->first();
            }
        } else {
            $actu = new Actualite();
        }
        $actu->title = $request->input('title');
        $actu->newsletter = $request->input('newsletter');
        $images = Photo::all();
        foreach ($images as $image) {
            if ($request->has('photo' . $image->id)) {
                $actu->photo_id = $request->input('photo' . $image->id);
            }
        }
        if (isset($actu->photo_id)) {
            $actu->path = null;
            $actu->photo_name = null;
            $actu->save();
        } else {
            $path = $request->file('data')->store('storage/uploads');
            $actu->path = $path;
            $actu->photo_name = $actu->title;
            $this->resize($path, $actu->photo_name, 'small');
            $this->resize($path, $actu->photo_name, 'medium');
            $this->resize($path, $actu->photo_name, 'large');
            $actu->save();
        }

        return redirect('/actus');
    }

    public function ActusUpdate($id)
    {
        $actu = Actualite::where('id', '=', $id)->first();
        $photos = Photo::orderBy('id', "desc")->get();
        $count = $photos->count();
        $div = intdiv($count, 4);
        return view('backend.actusCreate')
            ->with([
                'photos' => $photos,
                'count' => $count,
                'div' => $div,
                'actu' => $actu
            ]);
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

    public function delete($id)
    {
        $category = Category::where('id', '=', $id)->first();
        $category->photos()->detach();
        Category::where('id', '=', $id)->delete();
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
        foreach ($photos as $photo) {
            if ($request->has('photo' . $photo->id)) {
                $category->photos()->attach($photo->id);
            }
        }

        return redirect('/galerie');
    }

    public function categoryModify($id)
    {
        $categories = Category::where('level', 0)->orderBy('name')->get();
        $tree = $this->tree($categories);
        $photos = Photo::orderBy('id', "desc")->get();
        $count = $photos->count();
        $div = intdiv($count, 4);
        $oldcategory = Category::where('id', '=', $id)->firstOrFail();
        $oldphotos = $oldcategory->photos()->get();
        return view('backend.galeriecreate')
            ->withTree($tree)
            ->withPhotos($photos)
            ->withCount($count)
            ->withDiv($div)
            ->withOldcategory($oldcategory)
            ->withOldphotos($oldphotos);
    }

    public function categoryUpdate(Request $request)
    {
        $category = Category::where('id', '=', $request->input('id'))->first();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        $category->photos()->detach();
        $photos = Photo::all();
        foreach ($photos as $photo) {
            if ($request->has('photo' . $photo->id)) {
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

    public function photosDelete($id){
        $photo = Photo::where('id', '=', $id)->firstOrFail();
        Storage::delete($photo->path);
        Storage::delete('storage/small/' . $photo->name . '.jpeg');
        Storage::delete('storage/medium/' . $photo->name . '.jpeg');
        Storage::delete('storage/large/' . $photo->name . '.jpeg');
        $photo->delete();
        return redirect('/photos');
    }

    public function photoStore(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        if($request->has('id')){
            $photo = Photo::findOrFail($request->input('id'));
            $path = $photo->path;
        } else {
            $photo = new Photo();
            $path = $request->file('data')->store('storage/uploads');
            $photo->path = $path;
        }
        $this->resize($path, $name, 'small');
        $this->resize($path, $name, 'medium');
        $this->resize($path, $name, 'large');
        $photo->name = $name;
        $photo->description = $description;
        $photo->price = $price;
        $photo->save();
        $photo->categories()->detach();
        $categories = Category::all();
        foreach ($categories as $category) {
            if ($request->has('category' . $category->id)) {
                $photo->categories()->attach($category->id);
            }
        }

        return redirect('/photos');
    }

    public function photosUpdate($id){
        $photo = Photo::findOrFail($id);
        $categories = Category::where('level', 0)->orderBy('name')->get();
        $tree = $this->tree($categories);
        return view('backend.photoCreate')
            ->withPhoto($photo)
            ->withTree($tree);
    }

    public function prestaCreate(){
        return view('backend.prestaCreate');
    }

    public function prestaStore(Request $request){
        $prestation = new Prestation();
        $prestation->title = $request->input('title');
        $prestation->content = $request->input('content');
        $prestation->price = $request->input('price');
        if ($request->has('main')){
            $illustration = new Illustration();
            $path = $request->file('main')->store('storage/uploads');
            $this->resize($path, $prestation->title . 50, 'medium');
            $illustration->path = $path;
            $illustration->count = 50;
            $illustration->save();
            $prestation->main_id = $illustration->id;
            $prestation->save();
        }
        if($request->has('illustrations')){
            $table = $request->file('illustrations');
            foreach($table as $key => $image){
                $illustration = new Illustration();
                $path = $image->store('storage/uploads');
                $this->resize($path, $prestation->title . $key, 'medium');
                $illustration->path = $path;
                $illustration->count = $key;
                $illustration->save();
                $prestation->illustrations()->attach($illustration->id);
            }
        }
        return redirect('/prestations');
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
