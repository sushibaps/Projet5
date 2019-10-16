@extends ('layouts.menu')

@section ('title')
    Contact
@endsection

@section ('content')
    <h1 class="w-75 mt-5 text-center">Formulaire de contact</h1>
    {{Form::open(array('url' => '/contact'))}}
    {{Form::label('surname', 'Nom de famille')}}
    {{Form::text('surname')}}
    {{Form::label('name', 'Prénom')}}
    {{Form::text('name')}}
    {{Form::textarea('message', 'Votre message')}}
    {{Form::submit('Envoyer')}}
    {{Form::close()}}
@endsection
