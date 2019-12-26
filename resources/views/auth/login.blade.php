@extends ('layouts.log')

@section('title')
    Connexion ou Inscription
@endsection

@section('content')
    @if(isset($message))
        <p>{{$message}}</p>
    @endif
@endsection
