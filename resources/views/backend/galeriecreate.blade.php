@extends ('layouts.menu')

@section('title')
    Galerie
@endsection

@section('content')
    <h1 class="w-75 mt-5 text-center">Galerie de photos</h1>
    <div>
        <form action="/galerie" method="post">
            {{csrf_field()}}
            <div>
                <label for="name">Nom de la catégorie</label>
                <input type="text" id="name" name="name">
            </div>
            <div>
                <label for="level">Niveau de la catégorie</label>
                <input type="text" id="level" name="level">
            </div>
            <div>
                <textarea name="description" id="description" cols="100" rows="10" placeholder="Description de la catégorie"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection
