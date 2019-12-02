@extends('layouts.menu')

@section('title')
    {{$actu->title}}
@endsection

@section('content')
    <div class="container-fluid d-flex flex-column align-items-center mt-5 mb-5">
        <div class="container d-flex flex-column justify-content-around align-items-center mt-5">
            <h2 class="mb-3">{{$actu->title}}</h2>
            @if(isset($actu->photo_name))
                <figure>
                    <img src="/actusPhoto/medium/{{$actu->id}}" alt="{!! $actu->title !!}">
                </figure>
            @else
                <figure>
                    <img src="/photo/small/{{$actu->photo->id}}" alt="{!! $actu->photo->description !!}">
                </figure>
            @endif
            <p>{!! $actu->newsletter !!}</p>
            <p class="align-self-end">Publiée le : {{$actu->created_at->format('d-m-Y')}}</p>
        </div>
        @auth
            @if(Auth::user()->isAdmin)
                <div class="d-flex flex-column justify-content-around align-self-end mt-5">
                    <a href="/actus/update/{{$actu->id}}" class="text-primary"><i class="fas fa-edit"></i> Modifier l'actualité</a>
                    <a href="/actus/delete/{{$actu->id}}" class="text-danger"><i class="fas fa-trash-alt"> Supprimer l'actualité</i></a>
                </div>
            @endif
        @endauth
    </div>
@endsection
