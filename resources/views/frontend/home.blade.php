@extends ('layouts.menu')

@section('title')
    Page d'accueil de mon site
@endsection

@section('prologue')
    <figure class="d-flex justify-content-center" id="figure">
        <figcaption class="border p-3 d-flex flex-column justify-content-center align-items-center garamond" id="figcaption">
            <h2 class="display-4">Julien Thuret</h2>
            <p class="text-center">Photographe artistique</p>
        </figcaption>
    </figure>
@endsection

@section('content')
    @if(isset($photo))
        <div class="container mt-5 d-flex align-items-center justify-content-around flex-column pt-5 mb-5">
            <figure class="text-center d-flex flex-column align-items-center mt-5 pt-5 mb-5 accueilfigure">
                <img src="/photo/large/{{$photo->id}}" alt="Photographie">
                <figcaption class="text-center mt-4 border-bottom w-25 mb-4 garamond figcaption">{{$photo->name}}</figcaption>
                <p>{!!$photo->description!!}</p>
                <p class="align-self-end font-italic">Publiée le : {{$photo->created_at->format('Y-m-d')}}</p>
            </figure>
        </div>
    @else
        <div><p>Aucune actualité récente</p></div>
        <figure>
            <img src="/photo/pouet" alt="caca">
        </figure>
    @endif
@endsection
