@extends ('layouts.menu')

@section ('title')
    Test de formulaire
@endsection

@section ('content')
    <div class="container-fluid d-flex flex-column align-items-center mt-5 mb-5">
        <h1 class="w-25 mt-5 mb-5 formtitle garamond border-bottom">Création de photos</h1>
        <div class="container mt-5">
            {{Form::open(array('url' => '/photos/create', 'files' => true, 'class' => 'd-flex flex-column'))}}
            <div class="mb-5 d-flex flex-column align-items-center">
                <label for="name" id="label" class="mb-3 label text-center garamond">Titre de la photographie : </label>
                <input type="text" name="name" id="name" class="mb-5 border-top-0 border-right-0 border-left-0 w-75 text-center">
            </div>
            <div class="mb-5 d-flex flex-column align-items-center">
                <label for="description" class="mb-3 label text-center garamond">Description de la photographie :</label>
                <textarea name="description" id="description" cols="80" rows="20" placeholder="Entrez votre texte ici"></textarea>
            </div>
            <div class="mb-5">
                <label for="price" class="mb-3 label text-center garamond">Prix de la photographie : </label>
                <input type="number" name="price" value="0">
            </div>
            <div class="mb-5">
                {{Form::file('data')}}
            </div>
            <button type="submit" class="btn btn-primary w-25">Envoyer</button>
            {{Form::close()}}
        </div>
    </div>
@endsection


