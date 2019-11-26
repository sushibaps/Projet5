@foreach($categories as $category)
    <div class="d-flex flex-column bg-light ml-3">
        <a href="/galerie/{{$category['id']}}"
           class="categories p-2 d-flex bg-light justify-content-center align-items-center text-decoration-none text-dark m-2">
            <h2 class="font-weight-bold text-uppercase">{{$category['name']}}</h2>
            @auth()
                @if(Auth::user()->isAdmin)
                    <div>
                        <p>Catégorie de niveau : {{$category['level']}}</p>
                        <form action="/galerie/delete" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="name" value="{{$category['name']}}">
                            <button type="submit" class="btn btn-danger">Supprimer la catégorie</button>
                        </form>
                    </div>
                @endif
            @endauth
        </a>
        @include('frontend.cat', ['categories' => $category['children']])
    </div>
@endforeach
