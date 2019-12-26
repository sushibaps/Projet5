@extends ('layouts.menu')

@section ('title')
    Contact
@endsection

@section ('content')
    <div class="container-fluid d-flex flex-column align-items-center mt-5">
        <h1 class="w-75 mt-5 text-center">Formulaire de contact</h1>
        {{Form::open(array('url' => '/contact', 'class' => 'container mt-5'))}}
        <div class="container d-flex flex-column mt-5 mb-5 justify-content-around">
            <div class="d-flex mb-5 w-75">
                {{Form::label('name', 'Nom complet :', array('class' => 'mr-5'))}}
                {{Form::text('name', '', array('class' => 'mb-5 ml-5 form-control w-25'))}}
            </div>
            <div class="d-flex w-75">
                {{Form::label('email', 'Adresse email :', array('class' => 'mr-5'))}}
                {{Form::email('email', '', array('class' => 'mb-5 ml-5 form-control w-25'))}}
            </div>
            <div>
                {{Form::label('message', 'Votre message :', array('class' => 'mb-3'))}}
                {{Form::textarea('message', '', array('placeholder' => 'Votre message'))}}
            </div>
        </div>
        <div class="container d-flex flex-column align-items-end">
            {{Form::submit('Envoyer', array('class' => 'btn btn-primary'))}}
        </div>
        {{Form::close()}}
    </div>
@endsection
