<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use App\Basket;

class BasketsController extends Controller
{

    /**
     * @param $photoId id de la photo réservée par l'utilisateur
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
        try {
            $basket = Basket::where('photo_id', '=', $photoId)->firstOrFail();
            $basket->quantity = $basket->quantity + \request('quantity');
            $basket->save();
        } catch (ModelNotFoundException $exception) {
            $basket = new Basket();
            $basket->user_id = Auth::id();
            $basket->quantity = \request('quantity');
            $basket->photo_id = $photoId;
            $basket->save();
        }
        return redirect('/basket/menu');
    }

    public function update($photoId, $quantity)
    {
        $basket = Basket::where('photo_id', '=', $photoId)->firstOrFail();
        $basket->quantity = $quantity;
        $basket->save();

        return redirect('/basket/menu');
    }

    public function menu()
    {
        if (Auth::guest()) {
            return redirect('/login')->with([
                'message' => "Vous devez vous authentifier pour effectuer cette action"
            ]);
        } else {
            try {
                $baskets = Basket::where('user_id', '=', Auth::id())->get();
                if ($baskets->count() > 0) {
                    $count = $baskets->count();
                    $paniers = [];
                    foreach ($baskets as $basket) {
                        $panier['id'] = $basket->id;
                        $panier['quantity'] = $basket->quantity;
                        $panier['price'] = $basket->photo->price;
                        $panier['photo_id'] = $basket->photo->id;
                        $panier['photo_name'] = $basket->photo->name;
                        $panier['photo_description'] = strip_tags($basket->photo->description);
                        array_push($paniers, $panier);
                    }
                    $paniers = json_encode($paniers);
                    return view('frontend.basketRecap')->with([
                        'paniers' => $paniers,
                        'count' => $count
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

    public function confirm(Request $request){
        $count = \request('count');
        $baskets = [];
        for($i = 0; $i < $count; $i++){
            $id = \request('panier' . $i);
            $basket = Basket::where('id', '=', $id)->get();
            array_push($baskets, $basket);
        }
        return view('frontend.confirmation')->with([
            'baskets' => $baskets
        ]);
    }

    public function delete()
    {
        Basket::where('user_id', '=', Auth::id())->delete();
        return redirect('/basket/menu');
    }

    public function deleteItem($panierId)
    {
        Basket::where('id', '=', $panierId)->delete();
        return redirect('/basket/menu');
    }
}
