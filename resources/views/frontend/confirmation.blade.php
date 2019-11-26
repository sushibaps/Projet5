@extends('layouts.menu')

@section('title')
    Confirmation de votre commande
@endsection

@section('content')
    <h1 class="text-center mt-5 mb-5">Confirmation de votre commande </h1>
    @php
        $total = 0;
    @endphp
    @foreach($baskets as $pouet)
        @foreach($pouet as $basket)
            @php
                $total += $basket->quantity * $basket->photo->price;
            @endphp
            <div class="container bg-light d-flex justify-content-around mb-5 mt-5">
                <figure>
                    <img src="/photo/small/{{$basket->photo->id}}" alt="{{$basket->photo->description}}">
                </figure>
                <div>
                    <h2>{{$basket->photo->name}}</h2>
                    <p>{!! $basket->photo->description !!}</p>
                </div>
                <div>
                    <p>Quantité : {{$basket->quantity}}</p>
                    <p>Prix : {{$basket->quantity * $basket->photo->price}}</p>
                </div>
            </div>
        @endforeach
    @endforeach
    <div class="container d-flex justify-content-end">
        <p>Prix total de votre commande : {{$total}}</p>
    </div>
    <div class="container text-center mt-5 bg-success p-3 rounded-lg">
        <p class="text-white font-20">Merci de votre commande, notre service des ventes va entrer en contact avec vous sous 48h afin de régler les détails de paiement et d'acheminement de votre commande.</p>
    </div>
@endsection
