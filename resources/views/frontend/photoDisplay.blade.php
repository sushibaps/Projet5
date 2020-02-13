@extends('layouts.menu')

@section('title')
    {{$photo->name}}
@endsection

@section('content')
    <div class="container-fluid d-flex flex-column mt-5">
        <div class="container d-flex flex-column align-items-center mt-5">
            <h2 class="mb-5 border-bottom border-dark pb-2">{{$photo->name}}</h2>
            <figure>
                <img src="/photo/medium/{{$photo->id}}" alt="{!! $photo->description !!}" class="accueilfigure">
            </figure>
            <div class="container-fluid d-flex flex-column align-items-center">
                <p>{!! $photo->description !!}</p>
                <p class="align-self-end">Prix : {{$photo->price}} euros</p>
            </div>
        </div>
        <div class="container d-flex flex-column mt-5">
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
