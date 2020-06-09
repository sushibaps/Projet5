@extends('layouts.menu')

@section('title')
    Prestations
@endsection

@section('content')
    @auth
        @if(Auth::user()->isAdmin)
            <a href="/prestations/create">Création de prestations</a>
        @endif
    @endauth
    <div class="container-fluid d-flex justify-content-center">
        <h1 class="mt-5 w-50 text-center"><u>Prestations et tarifs</u></h1>
    </div>
    @foreach($prestations as $prestation)
        <main class="container-fluid mt-5 mb-5 pt-5 pb-5">
            <article class="container d-flex justify-content-between mt-5 p-5">
                <aside class="width-30">
                    <figure>
                        <img src="/illustration/{{$prestation->main_id}}"
                             alt="Illustration principale de la prestation {!! $prestation->title !!}">
                    </figure>
                </aside>
                <section class="width-60">
                    <h1>{{$prestation->title}}</h1>
                    <p>{!! $prestation->content !!}</p>
                    <p>Prix de la prestation : {{$prestation->price}}</p>
                    <a href="/prestation/display/{{$prestation->id}}" class="text-decoration-none d-inline-block w-100 text-right">Plus de détails ...</a>
                </section>
            </article>
        </main>
    @endforeach
@endsection
