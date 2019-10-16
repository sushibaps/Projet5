<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function list(){
        $categories = Category::all();
        return view ('frontend.galerie')->with([
            'categories' => $categories
        ]);
    }
}
