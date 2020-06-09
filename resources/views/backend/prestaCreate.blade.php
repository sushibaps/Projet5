@extends('layouts.menu')

@section('title')
    Création de prestations
@endsection

@section('content')
    <div class="container-fluid d-flex flex-column align-items-center mt-5 mb-5">
        <h1 class="w-25 mt-5 mb-5 formtitle garamond border-bottom text-center">Création de prestations</h1>
        <div class="container mt-5">
            @if(isset($prestation))
                {{Form::open(array('url' => '/prestations/update', 'class' => 'd-flex flex-column'))}}
            @else
                {{Form::open(array('url' => '/prestations/create', 'files' => true, 'class' => 'd-flex flex-column'))}}
            @endif
            <div class="mb-5 d-flex flex-column align-items-center">
                <label for="title" id="label" class="mb-3 label text-center garamond">Intitulé de la prestation
                    : </label>
                <input type="text" name="title" id="title"
                       class="mb-5 border-top-0 border-right-0 border-left-0 w-75 text-center"
                       @if(isset($prestation))
                       value="{{$prestation->title}}"
                       @endif required>
            </div>
            <div class="mb-5 d-flex flex-column align-items-center">
                <label for="description" class="mb-3 label text-center garamond">Contenu de la prestation : </label>
                <textarea name="content" id="content" cols="80" rows="20"
                          placeholder="Entrez votre texte ici" required>
                    @if(isset($prestation))
                        {!! $prestation->content !!}
                    @endif
                </textarea>
            </div>
            <div class="mb-5">
                <label for="price" class="mb-3 label text-center garamond">Prix horaire de la prestation : </label>
                <input type="number" name="price"
                       @if(isset($prestation))
                       value="{{$prestation->price}}"
                       @else
                       value="0"
                    @endif>
            </div>
            @if(isset($prestation))
                <input type="hidden" name="id" value="{{$prestation->id}}">
            @endif

            <div class="mb-5">
                <input type="file" name="main" accept=".jpg" required>
            </div>

            <div class="mb-5">
                <input type="file" name="illustrations[]" accept=".jpg" multiple>
            </div>

            <button type="submit" class="btn btn-primary w-25">Envoyer</button>
            {{Form::close()}}
        </div>
    </div>
@endsection
