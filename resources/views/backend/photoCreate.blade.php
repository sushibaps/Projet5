@extends ('layouts.menu')

@section ('title')
    Test de formulaire
@endsection

@section ('content')
    <div class="container-fluid d-flex flex-column align-items-center mt-5 mb-5">
        <h1 class="w-25 mt-5 mb-5 formtitle garamond border-bottom">Création de photos</h1>
        <div class="container mt-5">
            @if(isset($photo))
                {{Form::open(array('url' => '/photos/update', 'class' => 'd-flex flex-column'))}}
            @else
                {{Form::open(array('url' => '/photos/create', 'files' => true, 'class' => 'd-flex flex-column'))}}
            @endif
            <div class="mb-5 d-flex flex-column align-items-center">
                <label for="name" id="label" class="mb-3 label text-center garamond">Titre de la photographie : </label>
                <input type="text" name="name" id="name"
                       class="mb-5 border-top-0 border-right-0 border-left-0 w-75 text-center"
                       @if(isset($photo))
                       value="{{$photo->name}}"
                    @endif>
            </div>
            <div class="mb-5 d-flex flex-column align-items-center">
                <label for="description" class="mb-3 label text-center garamond">Description de la photographie
                    :</label>
                <textarea name="description" id="description" cols="80" rows="20"
                          placeholder="Entrez votre texte ici">
                    @if(isset($photo))
                        {!! $photo->description !!}
                    @endif
                </textarea>
            </div>
            <div class="mb-5">
                <label for="price" class="mb-3 label text-center garamond">Prix de la photographie : </label>
                <input type="number" name="price"
                       @if(isset($photo))
                       value="{{$photo->price}}"
                       @else
                       value="0"
                    @endif>
            </div>
            @if(isset($photo))
                <input type="hidden" name="id" value="{{$photo->id}}">
            @else
                <div class="mb-5">
                    {{Form::file('data')}}
                </div>
            @endif
            <div>
                <div class="d-flex flex-column justify-content-around mt-5 pb-5 border-bottom bg-light">
                    @include('frontend.listCat', ['categories' => $tree])
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-25">Envoyer</button>
            {{Form::close()}}
        </div>
    </div>
@endsection


