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
            $nb = Photo::all()->max('id');
            $count = Actualite::all()->count();
            if($nb !== null || $count !== 0){
                $actu = Actualite::findOrFail($count);
                $photo = Photo::findOrFail($nb);
                if($actu->created_at->format('U') > $photo->created_at->format('U')){
                    return view('frontend.home')
                        ->withActu($actu);
                } else{
                    return view('frontend.home')->with([
                        'photo' => $photo
                    ]);
                }
            } else {
                return view('frontend.home');
            }

        } catch(ModelNotFoundException $exception) {
            $photo = Photo::findOrFail($nb);
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
