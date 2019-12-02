@extends ('layouts.menu')

@section('title')
    Page d'accueil de mon site
@endsection

@section('prologue')
    <figure class="d-flex justify-content-center" id="figure">
        <figcaption class="border p-3 d-flex flex-column justify-content-center align-items-center garamond"
                    id="figcaption">
            <h2 class="display-4">Julien Thuret</h2>
            <p class="text-center">Photographe artistique</p>
        </figcaption>
    </figure>
@endsection

@section('content')
    <div class="marge">
        @if(isset($photo))
            <div class="container mt-5 d-flex align-items-center justify-content-around flex-column pt-5 pb-5">
                <h2>Dernière photographie publiée</h2>
                <figure class="text-center d-flex flex-column align-items-center mt-5 pt-5 mb-5 accueilfigure">
                    <a href="/photos" class="maxfig">
                        <img src="/photo/large/{{$photo->id}}" alt="{!! $photo->description !!}">
                    </a>
                    <figcaption
                        class="text-center mt-4 border-bottom w-25 mb-4 garamond figcaption">{{$photo->name}}
                    </figcaption>
                    <p>{!!$photo->description!!}</p>
                    <p class="align-self-end font-italic">Publiée le : {{$photo->created_at->format('Y-m-d')}}</p>
                </figure>
            </div>
        @elseif(isset($actu))
            <div class="container mt-5 d-flex align-items-center justify-content-around flex-column pt-5 pb-5">
                <h2>Dernière actualité publiée</h2>
                <figure class="text-center d-flex flex-column align-items-center mt-5 pt-5 mb-5 accueilfigure">
                    <a href="/basket/home/{{$actu->photo->id}}" class="maxfig">
                        <img src="/photo/medium/{{$actu->photo->id}}" alt="{!! $actu->photo->description !!}">
                    </a>
                    <figcaption
                        class="text-center mt-4 border-bottom w-25 mb-4 garamond figcaption">{{$actu->title}}
                    </figcaption>
                    <p>{!!$actu->newsletter!!}</p>
                    <p class="align-self-end font-italic">Publiée le : {{$actu->created_at->format('d-m-Y')}}</p>
                </figure>
            </div>
        @else
            <div><p>Aucune actualité récente</p></div>
            <figure>
                <img src="/photo/pouet" alt="caca">
            </figure>
        @endif
    </div>
@endsection

@section('script')
    <script>
        window.addEventListener('load', (event) => {
            document.getElementById('nav').classList.add('transparent');
            document.getElementsByTagName('div')[0].classList.add('transparent');
            let balises = document.getElementsByTagName('a');
            let balisesli = document.getElementsByTagName('li');
            for(let i = 0; i < balises.length; i++){
                balises[i].classList.add('text-white');
                balises[i].classList.remove('text-dark');
                balisesli[i].classList.add('menuwhite');
                balisesli[i].classList.remove('menu');
            }
        });

        window.addEventListener('scroll', (event) => {
            document.getElementById('nav').classList.remove('transparent');
            document.getElementsByTagName('div')[0].classList.remove('transparent');
            let balises = document.getElementsByTagName('a');
            let balisesli = document.getElementsByTagName('li');
            for(let i = 0; i < balises.length; i++){
                balises[i].classList.add('text-dark');
                balises[i].classList.remove('text-white');
                balisesli[i].classList.add('menu');
                balisesli[i].classList.remove('menuwhite');
            }
            if(window.scrollY === 0){
                document.getElementById('nav').classList.add('transparent');
                document.getElementsByTagName('div')[0].classList.add('transparent');
                let balises = document.getElementsByTagName('a');
                for(let i = 0; i < balises.length; i++){
                    balises[i].classList.add('text-white');
                    balises[i].classList.remove('text-dark');
                    balisesli[i].classList.add('menuwhite');
                    balisesli[i].classList.remove('menu');
                }
            }
            document.getElementById('cartbutton').classList.remove('text-dark');
            document.getElementById('decobutton').classList.remove('text-dark');
        });
    </script>
@endsection
