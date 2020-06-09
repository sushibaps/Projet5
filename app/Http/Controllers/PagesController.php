<?php

namespace App\Http\Controllers;

use App\Actualite;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use App\Prestation;
use App\Illustration;

class PagesController extends Controller
{
    public function actus()
    {
        $actus = Actualite::all();
        foreach ($actus as $actu) {
            $stringlength = strlen($actu->newsletter);
            if ($stringlength > 120)
                $actu->newsletter = substr($actu->newsletter, 0, 200);
        }
        return view('frontend.actus')->with([
            'actus' => $actus
        ]);
    }

    public function home()
    {
        try {

            $nbPhoto = Photo::all()->max('id');
            if ($nbPhoto !== null) {
                if ($nbPhoto > 3) {
                    $photos = Photo::where('id', '>=', $nbPhoto - 3)->orderBy('id', 'desc')->get();
                    for ($i = 0; $i < 3; $i++) {
                        $stringLength = strlen($photos[$i]->description);
                        if ($stringLength > 120) {
                            $photos[$i]->description = substr($photos[$i]->description, 0, 119);
                        }
                    }
                } else {
                    $photos = Photo::where('id', '>=', 0)->orderBy('id', 'desc')->get();
                    for ($i = 0; $i <= $nbPhoto; $i++) {
                        $stringLength = strlen($photos[$i]->description);
                        if ($stringLength > 120) {
                            $photos[$i]->description = substr($photos[$i]->description, 0, 119);
                        }
                    }
                }
            }

            $nbActu = Actualite::all()->max('id');
            if ($nbActu !== null) {
                if ($nbActu > 3) {
                    $actus = Actualite::where('id', '>=', $nbActu - 3)->orderBy('id', 'desc')->get();
                    for ($i = 0; $i < 3; $i++) {
                        $stringLength = strlen($actus[$i]->description);
                        if ($stringLength > 120) {
                            $actus[$i]->description = substr($actus[$i]->description, 0, 119);
                        }
                    }
                } else {
                    $actus = Actualite::where('id', '>=', 0)->orderBy('id', 'desc')->get();
                    for ($i = 0; $i <= $nbActu; $i++) {
                        $stringLength = strlen($actus[$i]->description);
                        if ($stringLength > 120) {
                            $actus[$i]->description = substr($actus[$i]->description, 0, 119);
                        }
                    }
                }
            }


            if ($nbPhoto !== null && $nbActu !== null) {
                return view('frontend.home')
                    ->withPhotos($photos)
                    ->withActus($actus);
            } elseif ($nbPhoto !== null) {
                return view('frontend.home')
                    ->withPhotos($photos);
            } elseif ($nbActu !== null) {
                return view('frontend.home')
                    ->withActus($actus);
            } else return view('frontend.home');

        } catch (ModelNotFoundException $exception) {
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
}
