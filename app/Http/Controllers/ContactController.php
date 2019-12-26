<?php

namespace App\Http\Controllers;

use App\Mail\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function store(Request $request)
    {
        Mail::to('matthias.bapseres@gmail.com')
            ->send(new ContactRequest([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => strip_tags($request->input('message'))
        ]));
        return view('frontend.confirm');
    }
}
