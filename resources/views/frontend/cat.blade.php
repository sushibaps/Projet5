@foreach($categories as $category)
    <div class="d-flex">
        <div class="d-flex">
            <a href="/galerie/{{$category['id']}}"
               class="categories p-2 d-flex flex-column align-items-center text-decoration-none text-dark m-2">
                <h2 class="font-weight-bold text-uppercase">{{$category['name']}}</h2>
                @auth()
                    @if(Auth::user()->isAdmin)
                        <p>Catégorie de niveau : {{$category['level']}}</p>
                    @endif
                @endauth
            </a>
            @auth()
                @if(Auth::user()->isAdmin)
                    <div class="align-self-end">
                        <a href="/galerie/modify/{{$category['id']}}" class="text-primary"><i class="fas fa-edit"></i></a>
                        <a href="/galerie/delete/{{$category['id']}}"
                           class="text-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                @endif
            @endauth
        </div>
        @include('frontend.cat', ['categories' => $category['children']])
    </div>
@endforeach
