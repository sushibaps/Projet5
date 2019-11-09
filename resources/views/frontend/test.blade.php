@extends('layouts.menu')

@section('title')
    TEST pour l'utilisation de v-for
@endsection

@section('content')
    <div class="container-fluid d-flex mt-5">
        <div class="container d-flex flex-column">
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
                    <div class="d-flex flex-column">
                        <form action="">
                            <div>
                                <div>
                                    <p>Quantité :</p>
                                    <input type="number" min="1" v-model="panier.quantity" @change="compute(panier)">
                                    <input type="hidden" v-bind:name="panier.id" v-bind:value="panier.photo_id">
                                </div>
                                <div>
                                    <p>Prix unitaire : {{ panier.price }}</p>
                                    <p>Prix total : {{ panier.total }}</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="mt-5">Prix total de votre panier : {{ total }}</p>
            @endverbatim
        </div>

    </div>

@endsection


@section('script')

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
            }
        });
    </script>

@endsection
