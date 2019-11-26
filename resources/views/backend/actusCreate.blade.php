@extends('layouts.menu')

@section('title')
    Création d'actualités (Admin)
@endsection

@section('content')
    <div class="container mt-5">
        {{Form::open(array('url' => '/actus/create', 'files' => true, 'class' => 'd-flex flex-column mt-5'))}}
        <div class="mb-5 mt-5 d-flex flex-column align-items-center">
            <label for="title" id="label" class="mb-3 label text-center garamond">Titre de l'actualité : </label>
            <input type="text" name="title" id="title"
                   class="mb-5 border-top-0 border-right-0 border-left-0 w-75 text-center">
        </div>
        <div class="mb-5 d-flex flex-column align-items-center">
            <label for="newsletter" class="mb-3 label text-center garamond">Contenu de l'actualité :</label>
            <textarea name="newsletter" id="newsletter" cols="80" rows="20"
                      placeholder="Entrez votre texte ici"></textarea>
        </div>
        <div class="d-flex flex-column justify-content-around">
            <div class="d-flex justify-content-center">
                <div v-on:click="display1" class="bg-light border choice text-center">Choisissez une photographie</div>
                <div v-on:click="display2" class="bg-light border choice text-center">Importez une photographie</div>
            </div>
            <div id="option1" style="display: none">
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
                                        <figure class="mb-3 homediv">
                                            <a href="#Modal{{$j}}" data-toggle="modal">
                                                <img src="/photo/{{$photos[$j]->id}}"
                                                     alt="{{$photos[$j]->description}}">
                                            </a>
                                        </figure>

                                        <div class="modal fade" id="Modal{{$j}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">{{$photos[$j]->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="/photo/{{$photos[$j]->id}}"
                                                             alt="{{$photos[$j]->description}}"
                                                             class="modalphoto">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" @click="setPhoto($event, {{$photos[$j]->id}})"
                                                           class="btn btn-primary d-flex justify-content-center align-items-center cart">
                                                            <i class="fas fa-check"></i>
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
                                                <img src="/photo/{{$photos[$j]->id}}"
                                                     alt="{{$photos[$j]->description}}">
                                            </a>
                                        </figure>

                                        <div class="modal fade" id="Modal{{$j}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">{{$photos[$j]->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="/photo/{{$photos[$j]->id}}"
                                                             alt="{{$photos[$j]->description}}"
                                                             class="modalphoto">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="photo_id{{$j}}" value="{{$photos[$j]->id}}">
                                                        <button type="submit"
                                                            class="btn btn-primary d-flex justify-content-center align-items-center cart">
                                                            <i class="fas fa-check"></i>
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
                                    <img src="/photo/{{$photo->id}}" alt="{{$photo->description}}">
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
                                            <img src="/photo/{{$photo->id}}" alt="{{$photo->description}}"
                                                 class="modalphoto">
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="photo_id{{$j}}" value="{{$photos[$j]->id}}">
                                            <button type="submit"
                                                class="btn btn-primary d-flex justify-content-center align-items-center cart">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                    <input type="hidden" name="photo_id" v-model="photoId">
            </div>
            <div id="option2" style="display: none">
                <div class="container-fluid d-flex flex-column align-items-center mt-5 mb-5">
                    <h1 class="w-25 mt-5 mb-5 formtitle garamond border-bottom">Création de photos</h1>
                    <div class="container mt-5 d-flex flex-column">
                        <div class="mb-5 d-flex flex-column align-items-center">
                            <label for="name" id="label" class="mb-3 label text-center garamond">Titre de la photographie : </label>
                            <input type="text" name="name" id="name" class="mb-5 border-top-0 border-right-0 border-left-0 w-75 text-center">
                        </div>
                        <div class="mb-5 d-flex flex-column align-items-center">
                            <label for="description" class="mb-3 label text-center garamond">Description de la photographie :</label>
                            <textarea name="description" id="description" cols="80" rows="20" placeholder="Entrez votre texte ici"></textarea>
                        </div>
                        <div class="mb-5">
                            <label for="price" class="mb-3 label text-center garamond">Prix de la photographie : </label>
                            <input type="number" name="price" value="0">
                        </div>
                        <div class="mb-5">
                            {{Form::file('data')}}
                        </div>
                        <button type="submit" class="btn btn-primary w-25">Envoyer</button>
                    </div>
                </div>
    </div>
@endsection

@section('script')
    <script>
        var vue = new Vue({
            el: '#vue',
            data: {
                photoId: null
            },
            methods: {
                display1: function () {
                    let option1 = document.getElementById('option1');
                    let option2 = document.getElementById('option2');
                    let btn = document.getElementById('btn');
                    option1.style.display = "block";
                    option2.style.display = "none";
                    btn.style.display = "none";
                },
                display2: function () {
                    let option1 = document.getElementById('option1');
                    let option2 = document.getElementById('option2');
                    let btn = document.getElementById('btn');
                    option1.style.display = "none";
                    option2.style.display = "block";
                    btn.style.display = "block";

                },
                setPhoto(e, photoId){
                    this.photoId = photoId;
                    if(this.photoId === null){
                        e.preventDefault();
                    }
                }
            }
        })
    </script>
@endsection
