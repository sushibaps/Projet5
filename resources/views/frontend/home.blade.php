@extends ('layouts.menu')

@section('stylesheet')
    <link rel="stylesheet" href="{{asset('css/responsive/home.css')}}">
@endsection

@section('title')
    Julien Thuret | Photographe Artistique
@endsection

@section('prologue')
    <figure class="d-flex justify-content-center" id="figure">
        <figcaption class="border p-3 d-flex flex-column justify-content-center align-items-center garamond"
                    id="figcaption">
            <h1 class="display-4">Julien Thuret</h1>
            <p class="text-center">Photographe artistique</p>
        </figcaption>
    </figure>
@endsection

@section('content')
    <div class="marge d-flex flex-row container-fluid">
        @if(isset($photos) && isset($actus))
            <div class="d-flex flex-column w-75 pt-5 align-items-center">
                <h2 class="mt-5 border-bottom pb-3 w-50 text-center">Dernières photographies publiées</h2>
                @for($i = 0; $i < 3; $i++)
                    @if(isset($photos[$i]))
                        <div class="d-flex align-items-center justify-content-around flex-column p-5">
                            <figure
                                class="text-center d-flex flex-column align-items-center mb-5">
                                <a href="/photos" class="maxfig">
                                    <img src="/photo/medium/{{$photos[$i]->id}}" alt="{!! $photos[$i]->description !!}"
                                         class="accueilfigure">
                                </a>
                                <figcaption
                                    class="text-center mt-4 border-bottom mb-4 garamond figcaption">{{$photos[$i]->name}}
                                </figcaption>
                            </figure>
                        </div>
                    @endif
                @endfor
            </div>
            <div class="d-flex flex-column w-25 border-left align-items-center mt-5 border-dark">
                <h2 class="mt-5 border-bottom pb-3 w-50 text-center">Dernières actualités publiées</h2>
                @for($i = 0; $i < 3; $i++)
                    @if(isset($actus[$i]))
                        @if(isset($actus[$i]->photo_id))
                            <div
                                class="mt-5 d-flex align-items-center justify-content-around flex-column ml-5 mr-5 border-bottom border-dark">
                                <figure
                                    class="text-center d-flex flex-column align-items-center pt-5 mb-5 accueilfigure">
                                    <img src="/photo/medium/{{$actus[$i]->photo_id}}"
                                         alt="{!! $actus[$i]->newsletter !!}">
                                    <figcaption
                                        class="text-center mt-4 border-bottom w-25 mb-4 garamond figcaption">{{$actus[$i]->title}}
                                    </figcaption>
                                    <p>{!!$actus[$i]->newsletter!!}</p>
                                </figure>
                            </div>
                        @else
                            <div
                                class="mt-5 d-flex align-items-center justify-content-around flex-column ml-5 mr-5 border-bottom border-dark">
                                <figure
                                    class="text-center d-flex flex-column align-items-center pt-5 mb-5 accueilfigure">
                                    <a href="/actus" class="maxfig">
                                        <img src="/actusPhoto/medium/{{$actus[$i]->id}}"
                                             alt="{!! $actus[$i]->newsletter !!}">
                                    </a>
                                    <figcaption
                                        class="text-center mt-4 border-bottom w-25 mb-4 garamond figcaption">{{$actus[$i]->title}}
                                    </figcaption>
                                    <p>{!!$actus[$i]->newsletter!!}</p>
                                    <p class="align-self-end font-italic">Publiée le
                                        : {{$actus[$i]->created_at->format('d-m-Y')}}</p>
                                </figure>
                            </div>
                        @endif
                    @endif
                @endfor
            </div>
        @elseif(isset($photos))
            <div class="container d-flex flex-column pt-5 align-items-center">
                <h2 class="mt-5 border-bottom pb-3 w-50 text-center">Dernières photographies publiées</h2>
                @for($i = 0; $i < 3; $i++)
                    @if(isset($photos[$i]))
                        <div class="d-flex align-items-center justify-content-around flex-column p-5">
                            <figure
                                class="text-center d-flex flex-column align-items-center mb-5">
                                <a href="/photos" class="maxfig">
                                    <img src="/photo/medium/{{$photos[$i]->id}}" alt="{!! $photos[$i]->description !!}"
                                         class="accueilfigure">
                                </a>
                                <figcaption
                                    class="text-center mt-4 border-bottom mb-4 garamond figcaption">{{$photos[$i]->name}}
                                </figcaption>
                            </figure>
                        </div>
                    @endif
                @endfor
            </div>
        @else
            <div><p>Désolé, il n'y a aucune photographie ou actualité récente, le photographe a dû s'endormir sur son clavier :)</p></div>
        @endif
    </div>
@endsection

@section('script')
    <script>
        window.addEventListener('load', (event) => {
            document.getElementById('nav').classList.add('transparent');
            document.getElementsByTagName('div')[0].classList.remove('shadow-nav');
            document.getElementsByTagName('div')[0].classList.add('transparent');
            let balises = document.getElementsByTagName('a');
            let balisesli = document.getElementsByTagName('li');
            for (let i = 0; i < balises.length; i++) {
                balises[i].classList.add('text-white');
                balises[i].classList.remove('text-dark');
                balisesli[i].classList.add('menuwhite');
                balisesli[i].classList.remove('menu');
            }
        });

        window.addEventListener('scroll', (event) => {
            document.getElementsByTagName('div')[0].classList.add('shadow-nav');
            document.getElementById('nav').classList.remove('transparent');
            document.getElementsByTagName('div')[0].classList.remove('transparent');
            document.getElementsByClassName('fa-bars')[0].classList.add('text-dark');
            document.getElementsByClassName('fa-bars')[0].classList.remove('text-white');
            let balises = document.getElementsByTagName('a');
            let balisesli = document.getElementsByTagName('li');
            for (let i = 0; i < balises.length; i++) {
                balises[i].classList.add('text-dark');
                balises[i].classList.remove('text-white');
                balisesli[i].classList.add('menu');
                balisesli[i].classList.remove('menuwhite');
            }
            if (window.scrollY === 0) {
                document.getElementById('nav').classList.add('transparent');
                document.getElementsByTagName('div')[0].classList.add('transparent');
                document.getElementsByTagName('div')[0].classList.remove('shadow-nav');
                document.getElementsByClassName('fa-bars')[0].classList.add('text-white');
                document.getElementsByClassName('fa-bars')[0].classList.remove('text-dark');
                let balises = document.getElementsByTagName('a');
                for (let i = 0; i < balises.length; i++) {
                    balises[i].classList.add('text-white');
                    balises[i].classList.remove('text-dark');
                    balisesli[i].classList.add('menuwhite');
                    balisesli[i].classList.remove('menu');
                }
            }
            var decobutton = document.getElementById('decobutton')
            if (decobutton !== null) {
                decobutton.classList.remove('text-dark');
            }
        });
    </script>
@endsection
