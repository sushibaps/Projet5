@extends ('layouts.menu')

@section('title')
    Création de catégorie
@endsection

@section('content')
    <div>
        <form @if(isset($oldcategory))
              action="/galerie/modify"
              @else
              action="/galerie"
              @endif
              method="post" class="container mt-5">
            {{csrf_field()}}

            <h1 class="text-center align-self-center display-3 mt-5 mb-5 categorytitle">Création de catégorie</h1>
            <div class="d-flex flex-column mt-5 mb-5 pb-5 border rounded-lg p-3">
                @include('frontend.listCat', ['categories' => $tree])
            </div>

            @if(isset($oldcategory))
                <input type="hidden" name="id" value="{{$oldcategory->id}}">
            @endif

            <div class="mt-5 mb-5">
                <label for="name" class="mr-5">Nom de la catégorie : </label>
                <input type="text" id="name" name="name"
                       @if(isset($oldcategory))
                       value="{{$oldcategory->name}}"
                    @endif
                    class="border-top-0 border-right-0 border-left-0"
                >
            </div>
            <div class="mb-5">
                <textarea name="description" id="description" cols="100" rows="15"
                          placeholder="Description de la catégorie">
                    @if(isset($oldcategory))
                        {!! $oldcategory->description !!}
                    @endif
                </textarea>
            </div>

            @if($div > 0)
                <div class="container-fluid mt-5 d-flex justify-content-around">
                    @for($i = 0; $i < 4; $i++)
                        <div class="col-3">
                            @if($i > 0)
                                @php
                                    $newdiv = $count / 4;
                                      $k = ($i + 1)/4;
                                      $m = $k * $count;
                                      $p = floor($m);
                                @endphp
                                @for($j = floor($newdiv * $i); $j < $p; $j++)
                                    <figure class="mb-3 homediv checkfigure p-0">
                                        <input type="checkbox" name="photo{{$photos[$j]->id}}" class="checkbox m-0"
                                               @if(isset($oldphotos))
                                               @foreach($oldphotos as $oldphoto)
                                               @if($oldphoto->id == $photos[$j]->id)
                                               checked
                                            @endif
                                            @endforeach
                                            @endif>
                                        <img src="/photo/small/{{$photos[$j]->id}}"
                                             alt="{!! $photos[$j]->description !!}}">
                                    </figure>
                                @endfor
                            @else
                                @for($j = 0; $j < (intdiv($count, 4)); $j++)
                                    <figure class="mb-3 homediv checkfigure">
                                        <input type="checkbox" name="photo{{$photos[$j]->id}}" class="checkbox"
                                               @if(isset($oldphotos))
                                               @foreach($oldphotos as $oldphoto)
                                               @if($oldphoto->id == $photos[$j]->id)
                                               checked
                                            @endif
                                            @endforeach
                                            @endif>
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
                            <input type="checkbox" name="photo{{$photo->id}}" class="checkbox"
                                   @if(isset($oldphotos))
                                   @foreach($oldphotos as $oldphoto)
                                   @if($oldphoto->id == $photos[$j]->id)
                                   checked
                                @endif
                                @endforeach
                                @endif>
                            <img src="/photo/small/{{$photo->id}}" alt="{!! $photo->description !!}}">
                        </figure>
                    @endforeach
                </div>
            @endif
            <button type="submit" class="btn btn-primary mb-5 ml-auto">Créer</button>
        </form>
    </div>
@endsection
