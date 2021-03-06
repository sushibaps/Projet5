@extends('layouts.menu')

@section('title')
    Liste des catégories de photographies
@endsection

@section('content')

    @if(isset($treeUp))
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @include('frontend.breadcrumb', ['category' => $treeUp, 'displayId' => $displayId])
            </ol>
        </nav>
        <div class="container-fluid">
            <ul class="d-flex flex-column w-25 list-unstyled">
                @include('frontend.children', ['categories' => $tree])
            </ul>
            @if(isset($photos))
                <div class="container d-flex justify-content-around mt-5 mb-5 w-75">
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
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="/photo/medium/{{$photo->id}}"
                                                     alt="{!! $photo->description !!}"
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
        </div>
    @else
        <h1 class="text-center align-self-center display-3 mt-5 mb-5 categorytitle">Thèmes</h1>
        <div class="d-flex flex-column mt-5 mb-5 align-items-center container">
            <div class="d-flex justify-content-between mt-5 pb-5">
                {{--@include('frontend.cat', ['categories' => $tree])--}}
                @foreach ($categories as $category)
                    <a href="/galerie/{{$category->id}}"
                       class="categories p-2 d-flex flex-column align-items-center text-decoration-none text-dark m-2">
                        <h2 class="font-weight-bold text-uppercase">{{$category->name}}</h2>
                    </a>
                @endforeach
            </div>
        </div>
    @endif


    @auth
        @if(Auth::user()->isAdmin)
            <a href="/galerie/create">Création de catégories</a>
        @endif
    @endauth

@endsection
