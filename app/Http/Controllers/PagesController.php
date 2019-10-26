<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Photo;

class PagesController extends Controller
{
    public function home()
    {
        $nb = Photo::all()->max('id');
        if ($nb !== null) {
            $photo = Photo::findOrFail($nb);
            return view('frontend.home')->with([
                'photo' => $photo
            ]);
        } else
            return view('frontend.home');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function galerie()
    {

        return view('frontend.galerie');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
