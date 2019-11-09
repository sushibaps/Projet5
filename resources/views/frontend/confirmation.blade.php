@extends('layouts.menu')

@section('title')
    Confirmation de votre commande
@endsection

@section('content')
    <h1>Confirmation de votre commande </h1>
    @foreach($baskets as $pouet)
        @foreach($pouet as $basket)
            @php
                $total = 0;
                $total += $basket->quantity * $basket->photo->price;
            @endphp
            <div class="container bg-light d-flex justify-content-around">
                <figure>
                    <img src="/photo/small/{{$basket->photo->id}}" alt="{{$basket->photo->description}}">
                </figure>
                <div>
                    <h2>{{$basket->photo->name}}</h2>
                    <p>{{$basket->photo->description}}</p>
                </div>
                <div>
                    <p>Quantité : {{$basket->quantity}}</p>
                    <p>Prix : {{$basket->quantity * $basket->photo->price}}</p>
                </div>
            </div>
        @endforeach
    @endforeach
    <p class="ml-auto">Prix total de votre commande : {{$total}}</p>
@endsection
