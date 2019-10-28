@extends('layouts.menu')

@section('title')
    Votre Panier
@endsection

@section('content')
    @if(isset($exception))
        <p>{{$exception}}</p>
    @elseif(isset($message))
        <p>{{$message}}</p>
    @else
        <div class="container">
            <h1 class="mt-5">Votre panier : </h1>
        </div>
        @foreach($baskets as $basket)
            @if(isset($basket) || $basket!== null)
                <div class="container-fluid pt-5">
                    <div
                        class="container d-flex justify-content-between border rounded-lg bg-light mb-5 p-5 box-shadow">
                        @if(isset($basket->photo))
                            <figure class="miniature m-3">
                                <img src="/photo/small/{{$basket->photo->id}}" alt="{!! $basket->photo->description !!}">
                            </figure>
                            <div class="d-flex flex-column h-auto">
                                <h2 class="garamond text-center">{{$basket->photo->name}}</h2>
                                <p class="">{!! $basket->photo->description !!}</p>
                            </div>
                        @endif
                        <div class="d-flex flex-column justify-content-center">
                            <p>Quantité : </p>
                            <form action="/basket/list/{{$basket->photo->id}}" method="post"
                                  class="d-flex flex-column justify-content-around">
                                {{csrf_field()}}
                                <input type="number" name="quantity" min="1" value="{{$basket->quantity}}">
                                <button type="submit" class="btn btn-primary mt-3 w-75 align-self-end">Modifier</button>
                            </form>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <p>{{$basket->photo->price * $basket->quantity}} euros</p>
                        </div>
                        <form action="/basket/delete/item" method="post" class="d-flex flex-column justify-content-end">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="basket_id" value="{{$basket->id}}">
                            <button type="submit" class="text-danger delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            @else
                <p>Pas de contenu dans le panier désolé</p>
            @endif
        @endforeach
        <form action="/basket/delete" method="post" class="mt-5 d-flex justify-content-end container">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_id" value="{{$basket->user_id}}">
            <button type="submit" class="btn btn-danger">Supprimer le contenu du panier</button>
        </form>
    @endif
@endsection
