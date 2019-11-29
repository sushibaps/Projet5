@extends('layouts.menu')

@section('title')
    Création d'actualités (Admin)
@endsection

@section('content')
    <div class="container-fluid d-flex flex-column align-items-center mt-5">
        <h1 class="w-25 mt-5 mb-5 formtitle garamond border-bottom">Création d'actualité</h1>
        {{Form::open(array('url' => '/actus/create', 'files' => true, 'class' => 'd-flex flex-column mt-5 container'))}}
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
        <div class="d-flex flex-column justify-content-around w-100">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-around w-50 mt-5">
                    <div v-on:click="display1" class="border choice text-center p-2 rounded-lg">Choisissez une photographie
                    </div>
                    <div v-on:click="display2" class="border choice text-center p-2 rounded-lg">Importez une photographie
                    </div>
                </div>
            </div>
            <div id="option1" style="display: none" class="border rounded-lg mt-5 p-5 pt-0 box-shadow-sm">
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
                                                        <input type="hidden" v-bind:name="'photo' + photoId">
                                                        <button type="submit"
                                                                @click="setPhoto($event, {{$photos[$j]->id}})"
                                                                class="btn btn-success d-flex justify-content-center align-items-center actupicture">
                                                            <i class="fas fa-check mr-2"></i> Confirmer
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
                                                        <input type="hidden" name="photo{{$photos[$j]->id}}"
                                                               value="{{$photos[$j]->id}}">
                                                        <button type="submit"
                                                                class="btn btn-success d-flex justify-content-center align-items-center actupicture">
                                                            <i class="fas fa-check mr-2"></i> Confirmer
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
                                            <input type="hidden" name="photo{{$photos[$j]->id}}"
                                                   value="{{$photos[$j]->id}}">
                                            <button type="submit"
                                                    class="btn btn-success d-flex justify-content-center align-items-center actupicture">
                                                <i class="fas fa-check mr-2"></i> Confirmer
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
            <div id="option2" style="display: none" class="border rounded-lg mt-5 p-5 pt-0 box-shadow-sm">
                <div class="container-fluid d-flex flex-column align-items-center mb-5">
                    <h1 class="w-50 mt-5 mb-5 formtitle garamond border-bottom text-center">Création de photos</h1>
                    <div class="container mt-5 d-flex flex-column">
                        <div class="mb-5 d-flex flex-column align-items-center">
                            <label for="name" id="label" class="mb-3 label text-center garamond">Titre de la
                                photographie : </label>
                            <input type="text" name="name" id="name"
                                   class="mb-5 border-top-0 border-right-0 border-left-0 w-75 text-center">
                        </div>
                        <div class="mb-5 d-flex flex-column">
                            <label for="description" class="mb-3 label text-center garamond">Description de la
                                photographie :</label>
                            <textarea name="description" id="description" cols="80" rows="20"
                                      placeholder="Entrez votre texte ici"></textarea>
                        </div>
                        <div class="mb-5">
                            <label for="price" class="mb-3 label text-center garamond">Prix de la photographie
                                : </label>
                            <input type="number" name="price" value="0">
                        </div>
                        <div class="mb-5">
                            {{Form::file('data')}}
                        </div>
                        <button type="submit" class="btn btn-primary w-25">Envoyer</button>
                    </div>
                </div>
            </div>
        </div>
        {{Form::close()}}
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
                    let choice1 = document.getElementsByClassName('choice')[0];
                    let choice2 = document.getElementsByClassName('choice')[1];
                    let btn = document.getElementById('btn');
                    option1.style.display = "block";
                    choice1.classList.add("focus");
                    option2.style.display = "none";
                    choice2.classList.remove("focus");
                    btn.style.display = "none";
                },
                display2: function () {
                    let option1 = document.getElementById('option1');
                    let option2 = document.getElementById('option2');
                    let choice1 = document.getElementsByClassName('choice')[0];
                    let choice2 = document.getElementsByClassName('choice')[1];
                    let btn = document.getElementById('btn');
                    option1.style.display = "none";
                    choice1.classList.remove("focus");
                    option2.style.display = "block";
                    choice2.classList.add("focus");
                    btn.style.display = "block";

                },
                setPhoto(e, photoId) {
                    this.photoId = photoId;
                    if (this.photoId === null) {
                        e.preventDefault();
                    }
                }
            }
        })
    </script>
@endsection
