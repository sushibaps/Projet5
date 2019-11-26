@extends('layouts.menu')

@section('title')
    Actualités publiées du site
@endsection

@section('content')
    <div class="container d-flex justify-content-around align-items-center flex-wrap">
        @foreach($actus as $actu)
            <div class="d-flex flex-column ml-5">
                <h2 class="text-center">{{$actu->title}}</h2>
                @if(isset($actu->photo))
                    <figure>
                        <img src="/photo/small/{{$actu->photo_id}}" alt="{!! $actu->photo->description !!}}">
                    </figure>
                @endif
                <p>{!! $actu->newsletter !!}</p>
                <p class="align-self-end font-italic">Publiée le : {{$actu->created_at->format('Y-m-d')}}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        <a href="/actus/create">Création d'actualités</a>
    </div>
@endsection
