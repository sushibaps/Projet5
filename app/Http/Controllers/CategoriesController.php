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

    public function recurseUp($category)
    {
        $parents = Category::where('id', '=', $category->category_id)->get();
        foreach($parents as $upcat) {
            $category->parent = $upcat;
            $this->recurseUp($upcat);
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

    public function treeup($category)
    {
        $this->recurseUp($category);
        return $category;
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
            ->withCategories($categories)
            ->withAdmin($admin);
    }

    public function getList($displayId)
    {
        $categories = Category::where('level', 0)->orderBy('name')->get();
        $category = Category::where('id', '=', $displayId)->first();
        $category2 = Category::where('id', '=', $displayId)->get();
        $tree = $this->tree($category2);
        $treeUp = $this->treeup($category);
        if (Auth::guest() || !Auth::user()->isAdmin) {
            $admin = 0;
        } else {
            $admin = 1;
        }
        $count = Category::find($displayId)->photos()->count();
        $div = intdiv($count, 4);
        $view = view('frontend.galerie');
        if ($count > 0) {
            $photos = Category::find($displayId)->photos()->get();
            return $view
                ->withPhotos($photos)
                ->withCount($count)
                ->withDiv($div)
                ->withTree($tree)
                ->withTreeUp($treeUp)
                ->withDisplayId($displayId)
                ->withAdmin($admin);
        } else {
            return $view
                ->withMessage('Cette catégorie ne contient pas de photographies pour le moment')
                ->withTree($tree)
                ->withTreeUp($treeUp)
                ->withDisplayId($displayId)
                ->withAdmin($admin);
        }
    }
}
