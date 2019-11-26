@extends('layouts.menu')

@section('title')
    TEST pour l'utilisation de tree
@endsection

@section('content')
    <ul>
        @include('frontend.cat', ['categories' => $tree])
    </ul>
@endsection
