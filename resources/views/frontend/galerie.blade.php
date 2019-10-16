@extends('layouts.menu')

@section('title')
    Liste des catégories de photographies
@endsection

@section('content')
    <h1 class="text-center align-self-center display-3 mt-5 mb-5 categorytitle">Thèmes</h1>
    <div class="d-flex mt-5 mb-5 justify-content-center flex-wrap container">
        @foreach($categories as $category)
            <a href="" class="categories p-2 d-flex justify-content-center align-items-center text-decoration-none text-dark m-2">
                <h2 class="font-weight-bold text-uppercase">{{$category->name}}</h2>
                <!-- <p>Catégorie de niveau : {{$category->level}}</p>
                <form action="/galerie/delete" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="name" value="{{$category->name}}">
                    <button type="submit">Supprimer la catégorie</button>
                </form> -->
            </a>
        @endforeach
    </div>

    <a href="/galerie/create">Création de catégories</a>
    <br>
    <a href="/photo">Consulter uniquement les photographies</a>
@endsection
