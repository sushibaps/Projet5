@extends ('layouts.menu')

@section ('title')
    Test de formulaire
@endsection

@section ('content')
    <div class="container-fluid d-flex flex-column align-items-center mt-5">
        <h1 class="w-25 mt-5 mb-5 formtitle garamond border-bottom">Création de photos</h1>
        <div class="container mt-5">
            {{Form::open(array('url' => '/photos/create', 'files' => true, 'class' => 'container'))}}
            <div class="mb-5 d-flex flex-column align-items-center">
                {{Form::label('name', 'Titre de la photographie : ', ['class' => 'mb-3 label text-center garamond'])}}
                {{Form::text('name', '', ['class' => 'mb-5 border-top-0 border-right-0 border-left-0 w-50'])}}
            </div>
            <div class="mb-3">
                {{Form::textarea('description', '', ['placeholder' => 'Description de la photographie', 'rows' => '20'])}}
            </div>
            <div class="mb-3">
                {{Form::number('price', '0')}}
            </div>
            <div class="mb-3">
                {{Form::file('data')}}
            </div>
            {{Form::submit('Envoyer', ['class' => 'btn btn-primary'])}}
            {{Form::close()}}
        </div>
    </div>
@endsection


