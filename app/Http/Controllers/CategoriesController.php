<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
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


    public function list()
    {
        $categories = Category::where('level', 0)->orderBy('name')->get();
        $tree = $this->tree($categories);
        if (Auth::guest() || !Auth::user()->isAdmin) {
            $admin = 0;
        } else {
            $admin = 1;
        }
        return view('frontend.galerie')
            ->withTree($tree)
            ->withAdmin($admin);
    }

    public function getList($displayId)
    {
        $categories = Category::where('level', 0)->orderBy('name')->get();
        $tree = $this->tree($categories);
        if (Auth::guest() || !Auth::user()->isAdmin) {
            $admin = 0;
        } else {
            $admin = 1;
        }
        $count = Category::find($displayId)->photos()->count();
        if ($count > 0) {
            $photos = Category::find($displayId)->photos()->get();
            return view('frontend.galerie')
                ->withPhotos($photos)
                ->withDisplayId($displayId)
                ->withTree($tree)
                ->withAdmin($admin);
        } else {
            return view('frontend.galerie')
                ->withMessage('Cette catégorie ne contient pas de photographies pour le moment')
                ->withTree($tree)
                ->withAdmin($admin);
        }
    }
}
