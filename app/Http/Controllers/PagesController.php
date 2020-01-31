<?php

namespace App\Http\Controllers;

use App\Actualite;
use App\Basket;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use mysql_xdevapi\Exception;

class PagesController extends Controller
{
    public function actus(){
        $actus = Actualite::all();
        return view('frontend.actus')->with([
            'actus' => $actus
        ]);
    }

    public function home()
    {
        try {
            $nbPhoto = Photo::all()->max('id');
            if($nbPhoto > 3)
                $photos = Photo::where('id', '>=', $nbPhoto-3)->get();
            else
                $photos = Photo::where('id', '>', 0)->get();

            $nbActu = Actualite::all()->max('id');
            if($nbActu > 3)
                $actus = Actualite::where('id', '>=', $nbActu-3)->get();
            else
                $actus = Actualite::where('id', '>', 0)->get();

            if($nbPhoto !== null || $nbActu !== null){
                return view('frontend.home')
                    ->withPhotos($photos)
                    ->withActus($actus);
            } else {
                return view('frontend.home');
            }

        } catch(ModelNotFoundException $exception) {
            $photo = Photo::findOrFail($nbPhoto);
            return view('frontend.home')->with([
                'photo' => $photo
            ]);
        }
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

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function services(){
        return view('frontend.services');
    }

    public function testMenu(){
        try {
            $nbPhoto = Photo::all()->max('id');
            if($nbPhoto > 3)
                $photos = Photo::where('id', '>=', $nbPhoto-3)->get();
            else
                $photos = Photo::where('id', '>', 0)->get();

            $nbActu = Actualite::all()->max('id');
            if($nbActu > 3)
                $actus = Actualite::where('id', '>=', $nbActu-3)->get();
            else
                $actus = Actualite::where('id', '>', 0)->get();

            if($nbPhoto !== null || $nbActu !== null){
                return view('frontend.testHome')
                    ->withPhotos($photos)
                    ->withActus($actus);
            } else {
                return view('frontend.testHome');
            }
        } catch(ModelNotFoundException $exception) {
            $photo = Photo::findOrFail($nbPhoto);
            return view('frontend.testHome')->with([
                'photo' => $photo
            ]);
        }
    }
}
