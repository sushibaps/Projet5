@extends('layouts.menu')

@section('title')
    Actualités publiées du site
@endsection

@section('content')
    <div class="container-fluid d-flex">
        @foreach($actus as $actu)
            <div class="d-flex flex-column">
                @if(isset($actu->photo))
                    <figure>
                        <img src="/photo/small/{!! $actu->photo->id !!}" alt="{!! $actu->photo->description !!}}">
                    </figure>
                @endif
                <p>{!! $actu->newsletter !!}</p>
            </div>
            @endforeach
    </div>
    <div class="mt-5">
        <a href="/actus/create">Création d'actualités</a>
    </div>
@endsection
