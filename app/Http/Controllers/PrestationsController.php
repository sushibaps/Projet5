<?php

namespace App\Http\Controllers;

use App\Illustration;
use App\Prestation;
use Illuminate\Http\Request;

class PrestationsController extends Controller
{
    public function prestations()
    {
        $prestations = Prestation::all();
        foreach ($prestations as $prestation) {
            $stringlength = strlen($prestation->content);
            if ($stringlength > 200)
                $prestation->content = substr($prestation->content, 0, 300);
        }
        return view('frontend.prestations')
            ->withPrestations($prestations);
    }

    public function getIllustration($id){
        $illustration = Illustration::findOrFail($id);
        $prestation = $illustration->prestations()->firstOrFail();
        return response()->file(storage_path() . '/app/storage/medium/' . $prestation->title . $illustration->count . '.jpeg');
    }

    public function display($id){
        $prestation = Prestation::findOrFail($id);
        $prestation->content = strip_tags($prestation->content);
        $count = $prestation->illustrations()->count();
        return view('frontend.prestaDisplay')
            ->withPrestation($prestation)
            ->withCount($count);
    }
}
