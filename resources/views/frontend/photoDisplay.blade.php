@extends('layouts.menu')

@section('title')
    {{$photo->name}}
@endsection

@section('content')
    <div class="container-fluid d-flex flex-column">
        <div>
            <h2>{{$photo->name}}</h2>
            <figure>
                <img src="/photo/medium/{{$photo->id}}" alt="{!! $photo->description !!}">
            </figure>
            <div>
                <p>{!! $photo->description !!}</p>
                <p>{{$photo->price}}</p>
            </div>
        </div>
        <div>
            <a href="/basket/home/{{$photo->id}}"
               class="btn btn-primary d-flex justify-content-center align-items-center cart">
                <ion-icon name="cart"></ion-icon>
            </a>
            @auth
                @if(Auth::user()->isAdmin)
                    <div class="d-flex flex-column justify-content-around align-self-end mt-5">
                        <a href="/photos/update/{{$photo->id}}" class="text-primary"><i class="fas fa-edit"></i> Modifier la photographie</a>
                        <a href="/photos/delete/{{$photo->id}}" class="text-danger"><i class="fas fa-trash-alt"> Supprimer la photographie</i></a>
                    </div>
                @endif
            @endauth
        </div>
    </div>
@endsection
