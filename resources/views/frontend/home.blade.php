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
    <div class="marge d-flex flex-row container-fluid">
        @if(isset($photos) || isset($actus))
            <div class="d-flex flex-column w-75 pt-5 align-items-center">
                <h2 class="mt-5 border-bottom pb-3 w-50 text-center">Dernières photographies publiées</h2>
                @for($i = 0; $i < 3; $i++)
                    @if(isset($photos[$i]))
                        <div class="d-flex align-items-center justify-content-around flex-column p-5">
                            <figure
                                class="text-center d-flex flex-column align-items-center mb-5 accueilfigure">
                                <a href="/photos" class="maxfig">
                                    <img src="/photo/medium/{{$photos[$i]->id}}" alt="{!! $photos[$i]->description !!}">
                                </a>
                                <figcaption
                                    class="text-center mt-4 border-bottom w-25 mb-4 garamond figcaption">{{$photos[$i]->name}}
                                </figcaption>
                                <p>{!!$photos[$i]->description!!}</p>
                                <p class="align-self-end font-italic">Publiée le
                                    : {{$photos[$i]->created_at->format('Y-m-d')}}</p>
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
                                    <p class="align-self-end font-italic">Publiée le
                                        : {{$actus[$i]->created_at->format('d-m-Y')}}</p>
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
        @else
            <div><p>Aucune actualité récente</p></div>
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
                let balises = document.getElementsByTagName('a');
                for (let i = 0; i < balises.length; i++) {
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
