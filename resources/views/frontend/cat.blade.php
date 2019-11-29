@foreach($categories as $category)
    <div class="d-flex">
        <a href="/galerie/{{$category['id']}}"
           class="categories p-2 d-flex flex-column align-items-center text-decoration-none text-dark m-2">
            <h2 class="font-weight-bold text-uppercase">{{$category['name']}}</h2>
            @auth()
                @if(Auth::user()->isAdmin)
                    <p>Catégorie de niveau : {{$category['level']}}</p>
                    <a href="/galerie/delete/{{$category['id']}}"
                       class="text-danger align-self-end">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                @endif
            @endauth
        </a>
        @include('frontend.cat', ['categories' => $category['children']])
    </div>
@endforeach
