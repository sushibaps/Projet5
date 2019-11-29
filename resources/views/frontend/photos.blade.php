@extends('layouts.menu')

@section('title')
    Photographies de Monsieur Dupond
@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center mt-5 mb-5">
        <h1 class="w-25php text-center border-bottom mt-5 mb-5 pb-3 figcaption">Liste des photographies</h1>
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
                        @for($j = floor($newdiv * $i); $j < $p ; $j++)
                            <figure class="mb-3 homediv">
                                <a href="#Modal{{$j}}" data-toggle="modal">
                                    <img src="/photo/medium/{{$photos[$j]->id}}" alt="{{$photos[$j]->description}}">
                                </a>
                            </figure>

                            <div class="modal fade" id="Modal{{$j}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$photos[$j]->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="/photo/{{$photos[$j]->id}}" alt="{{$photos[$j]->description}}"
                                                 class="modalphoto">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/basket/home/{{$photos[$j]->id}}"
                                               class="btn btn-primary d-flex justify-content-center align-items-center cart">
                                                <ion-icon name="cart"></ion-icon>
                                            </a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @else
                        @for($j = 0; $j < (intdiv($count, 4)); $j++)
                            <figure class="mb-3 homediv">
                                <a href="#Modal{{$j}}" data-toggle="modal">
                                    <img src="/photo/medium/{{$photos[$j]->id}}" alt="{{$photos[$j]->description}}">
                                </a>
                            </figure>

                            <div class="modal fade" id="Modal{{$j}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$photos[$j]->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="/photo/{{$photos[$j]->id}}" alt="{{$photos[$j]->description}}"
                                                 class="modalphoto">
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/basket/home/{{$photos[$j]->id}}"
                                               class="btn btn-primary d-flex justify-content-center align-items-center cart">
                                                <ion-icon name="cart"></ion-icon>
                                            </a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            @endfor
        </div>
    @else
        <div class="container-fluid mt-5 d-flex flex-column justify-content-around">
            @foreach($photos as $photo)
                <figure class="caca homediv">
                    <a href="#Modal{{$photo->id}}" data-toggle="modal">
                        <img src="/photo/medium/{{$photo->id}}" alt="{{$photo->description}}">
                    </a>
                </figure>

                <div class="modal fade" id="Modal{{$photo->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{$photo->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="/photo/{{$photo->id}}" alt="{{$photo->description}}" class="modalphoto">
                            </div>
                            <div class="modal-footer">
                                <a href="/basket/home/{{$photo->id}}"
                                   class="btn btn-primary d-flex justify-content-center align-items-center cart">
                                    <ion-icon name="cart"></ion-icon>
                                </a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <br/>
    @auth
        @if(Auth::user()->isAdmin)
            <a href="/photos/create">Création de photo</a>
        @endif
    @endauth
@endsection
