@extends('layouts.menu')

@section('title')
    Liste des catégories de photographies
@endsection

@section('content')
    <h1 class="text-center align-self-center display-3 mt-5 mb-5 categorytitle">Thèmes</h1>
    <div class="d-flex flex-column mt-5 mb-5 align-items-center container">
        <div class="d-flex flex-column justify-content-around mt-5 pb-5 border-bottom">
            @include('frontend.cat', ['categories' => $tree])
        </div>
    </div>

    @if(isset($photos))
        <div class="container d-flex justify-content-around mt-5 mb-5">
            @foreach($photos as $photo)
                @guest()
                    <figure>
                        <img src="/photo/small/{{$photo->id}}" alt="{!! $photo->description !!}">
                    </figure>
                @endguest()

                @auth()
                    @if(Auth::user()->isAdmin)
                        <figure class="caca homediv">
                            <a href="#Modal{{$photo->id}}" data-toggle="modal">
                                <img src="/photo/medium/{{$photo->id}}" alt="{!! $photo->description !!}">
                            </a>
                        </figure>

                        <div class="modal fade" id="Modal{{$photo->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$photo->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="/photo/medium/{{$photo->id}}" alt="{!! $photo->description !!}"
                                             class="modalphoto">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/photo/delete/{{$photo->id}}"
                                           class="btn btn-danger d-flex justify-content-center align-items-center cart">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
            @endforeach
        </div>
    @elseif(isset($message))
        <div class="container text-center">
            <p>{{$message}}</p>
        </div>
    @endif

    @auth
        @if(Auth::user()->isAdmin)
            <a href="/galerie/create">Création de catégories</a>
            <br>
            <a href="/photo">Consulter uniquement les photographies</a>
        @endif
    @endauth
@endsection
