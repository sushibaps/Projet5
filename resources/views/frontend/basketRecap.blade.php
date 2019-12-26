@extends('layouts.menu')

@section('title')
    Votre Panier
@endsection

@section('content')
    @if(isset($exception))
        <p>{{$exception}}</p>
    @elseif(isset($message))
        <p>{{$message}}</p>
    @elseif(isset($paniers))
        <div class="container">
            <h1 class="mt-5">Votre panier : </h1>
        </div>
        <div class="container-fluid d-flex mt-5">
            <form action="/basket/confirm" method="post" class="container d-flex flex-column">
                {{csrf_field()}}
                @verbatim
                    <div class="d-flex justify-content-around bg-light border rounded-lg mt-5"
                         v-for="(panier, index) in paniers">
                        <figure class="miniature m-3">
                            <img v-bind:src=" '/photo/small/' + panier.photo_id"
                                 v-bind:alt="panier.photo_description">
                        </figure>
                        <div>
                            <h2> Titre : {{ panier.photo_name }}</h2>
                            <p> Description : {{ panier.photo_description }}</p>
                        </div>
                        <div>
                            <p>Quantité :</p>
                            <input type="number" min="1" name="quantity" v-model="panier.quantity"
                                   @change="compute(panier)">
                            <input type="hidden" v-bind:name="'panier' + index" v-bind:value="panier.id">
                        </div>
                        <div>
                            <p>Prix unitaire : {{ panier.price }}</p>
                            <p>Prix total : {{ panier.total }}</p>
                        </div>
                        <a v-bind:href="'/basket/update/' + panier.photo_id + '/' + panier.quantity">Modifier</a>
                        <a v-bind:href="pouet(panier.id)" class="text-danger"><i
                                class="fas fa-trash-alt"></i></a>
                    </div>
                    <input type="hidden" name="number" v-bind:value="index">
                    <p class="mt-5 ml-auto">Prix total de votre panier : {{ total }}</p>
                    <a href="/basket/delete/" class="text-danger ml-auto mb-5">Supprimer votre panier</a>
                @endverbatim
                <input type="hidden" name="count" value="{{$count}}">
                <button type="submit" class="btn btn-primary w-25 ml-auto">Confirmer votre achat</button>
            </form>
        </div>
    @endif
@endsection


@section('script')
    @if(isset($paniers))
        <script>
            var vue = new Vue({
                el: "#vue",
                data: {
                    paniers: {!! $paniers !!}
                },
                methods: {
                    compute(panier) {
                        panier.total = panier.quantity * panier.price;
                        this.$forceUpdate();
                    }
                },
                computed: {
                    total() {
                        let result = 0;
                        for (panier of this.paniers) {
                            result += panier.price * panier.quantity;
                        }
                        return result;
                    }
                },
                mounted() {
                    for (panier of this.paniers) {
                        panier.total = panier.price * panier.quantity;
                    }
                    this.paniers = [...this.paniers];
                },
                pouet(panierId){
                    var req = new XMLHttpRequest();
                    req.open("GET", "/basket/delete/item/" + panierId);
                    req.addEventListener("load", function () {
                        console.log(req.responseText);
                    });
                    req.send(null);
                }
            });
        </script>
    @endif

@endsection
