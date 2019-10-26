<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use App\Basket;

class BasketsController extends Controller
{
    public function home($photoId)
    {
        $photo = Photo::findOrFail($photoId);
        return view('frontend.basket')->with([
            'photo' => $photo
        ]);
    }

    /**
     * Cette fonction permet d'acheter une photo et de l'ajouter au panier
     *
     * @param $photoId id de la photo à acheter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function list($photoId)
    {
        if (Auth::guest()) {
            return redirect('/login')->with([
                'message' => "Vous devez vous authentifier pour effectuer cette action"
            ]);
        } else {
            $basket = new Basket();
            $basket->user_id = Auth::id();
            $basket->quantity = \request('quantity');
            $basket->photo_id = $photoId;
            $basket->save();
            return redirect('/basket/menu');
        }
    }

    public function menu()
    {
        if (Auth::guest()) {
            return redirect('/login')->with([
                'message' => "Vous devez vous authentifier pour effectuer cette action"
            ]);
        } else {
            try {
                $count = Basket::all()->count();
                if($count > 0){
                    $baskets = Basket::where('user_id', '=', Auth::id())->get();
                    return view('frontend.basketRecap')->with([
                        'baskets' => $baskets
                    ]);
                } else
                    return view('frontend.basketRecap')->with([
                        'message' => "Pas de contenu dans le panier"
                    ]);
            } catch (Exception $exception) {
                return view('frontend.basketRecap')->with([
                    'exception' => $exception
                ]);
            }
        }
    }

    public function delete()
    {
        $basket = Basket::where('user_id', '=', \request('user_id'))->delete();
        return redirect('/');
    }
}
