@extends('layouts.menu')

@section('title')
    Votre panier
@endsection

@section('content')
    <h1 class="display-4 mb-5 mt-5 ml-5">{{$photo->name}}</h1>
    <div class="container-fluid mt-5">
        <div class="container-fluid d-flex mb-5 justify-content-between">
            <figure class="miniature m-3">
                <img src="/photo/medium/{{$photo->id}}" alt="{{$photo->description}}">
            </figure>
            <div class="bg-light box-shadow border rounded-lg p-5 mt-3" id="container">
                <p class="cart">1. Choisir la quantité</p>
                <form action="/basket/list/{{$photo->id}}" method="post"
                      class="d-flex flex-column justify-content-around">
                    {{csrf_field()}}
                    <input type="number" name="quantity" class="form-control" value="1" min="1">
                    <p class="cart mt-5">Prix : {{$photo->price}} €</p>
                    <button type="submit" class="btn btn-primary mt-5 w-75 align-self-end">Ajouter au panier</button>
                </form>
            </div>
        </div>
        <div class="container d-flex flex-column justify-content-between bg-light box-shadow border rounded-lg p-5 mt-3 ml-4">
            <h2 class="mb-5">Description de la photographie</h2>
            <p class="font-italic">{{$photo->description}}</p>
        </div>
    </div>
@endsection
