@extends ('layouts.menu')

@section('title')
    Galerie
@endsection

@section('content')
    <div>
        <form action="/galerie" method="post" class="container">
            {{csrf_field()}}

            <h1 class="text-center align-self-center display-3 mt-5 mb-5 categorytitle">Catégories</h1>
            <div class="d-flex flex-column mt-5 mb-5 align-items-center container">
                <div class="d-flex justify-content-around mt-5 pb-5 border-bottom">
                    @include('frontend.listCat', ['categories' => $tree])
                </div>
            </div>

            <div class="mt-5 mb-5">
                <label for="name">Nom de la catégorie</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="mb-5">
                <textarea name="description" id="description" cols="100" rows="15"
                          placeholder="Description de la catégorie"></textarea>
            </div>

            @if($div > 0)
                <div class="container-fluid mt-5 d-flex justify-content-around">
                    @for($i = 0; $i < 4; $i++)
                        <div class="col-3">
                            @if($i > 0)
                                @php
                                    $k = ($i + 1)/4;
                                    $m = $k * $count;
                                    $p = floor($m);
                                @endphp
                                @for($j = ($div * $i); $j < $p; $j++)
                                    <figure class="mb-3 homediv checkfigure p-0">
                                        <input type="checkbox" name="photo{{$photos[$j]->id}}" class="checkbox m-0">
                                        <img src="/photo/small/{{$photos[$j]->id}}"
                                             alt="{!! $photos[$j]->description !!}}">
                                    </figure>
                                @endfor
                            @else
                                @for($j = 0; $j < (intdiv($count, 4)); $j++)
                                    <figure class="mb-3 homediv checkfigure">
                                        <input type="checkbox" name="photo{{$photos[$j]->id}}" class="checkbox">
                                        <img src="/photo/small/{{$photos[$j]->id}}"
                                             alt="{!! $photos[$j]->description !!}}">
                                    </figure>
                                @endfor
                            @endif
                        </div>
                    @endfor
                </div>
            @else
                <div class="container-fluid mt-5 d-flex flex-column justify-content-around">
                    @foreach($photos as $photo)
                        <figure class="caca homediv checkfigure">
                            <input type="checkbox" name="photo{{$photo->id}}" class="checkbox">
                            <img src="/photo/small/{{$photo->id}}" alt="{!! $photo->description !!}}">
                        </figure>
                    @endforeach
                </div>
            @endif
            <button type="submit" class="btn btn-primary mb-5 ml-auto">Créer</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        var vue = new Vue({
            el: "#vue",
            data:
        })

    </script>
@endsection
