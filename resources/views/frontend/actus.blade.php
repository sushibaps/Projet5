@extends('layouts.menu')

@section('title')
    Actualités publiées du site
@endsection

@section('content')
    <div class="container d-flex justify-content-around align-items-center flex-wrap mt-5">
        @foreach($actus as $actu)
            <a href="/actus/{{$actu->id}}" class="text-decoration-none text-dark">
                <div class="d-flex flex-column ml-5 align-items-center">
                    <h2 class="text-center">{{$actu->title}}</h2>
                    @if(isset($actu->photo_name))
                        <figure>
                            <img src="/actusPhoto/small/{{$actu->id}}" alt="{!! $actu->title !!}">
                        </figure>
                    @else
                        <figure>
                            <img src="/photo/small/{{$actu->photo->id}}" alt="{!! $actu->photo->description !!}">
                        </figure>
                    @endif
                    <p>{!! $actu->newsletter !!}</p>
                    <p class="align-self-end font-italic">Publiée le : {{$actu->created_at->format('Y-m-d')}}</p>
                </div>
            </a>
        @endforeach
    </div>
    @auth
        @if(Auth::user()->isAdmin)
            <div class="mt-5">
                <a href="/actus/create">Création d'actualités</a>
            </div>
        @endif
    @endauth
@endsection
