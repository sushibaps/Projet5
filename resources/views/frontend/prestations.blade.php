@extends('layouts.menu')

@section('title')
    Prestations
@endsection

@section('content')
    @auth
        @if(Auth::user()->isAdmin)
            <a href="/prestations/create">Création de prestations</a>
        @endif
    @endauth
    <div class="container-fluid d-flex justify-content-center">
        <h1 class="mt-5 w-50 text-center"><u>Prestations et tarifs</u></h1>
    </div>

    <main class="container-fluid mt-5 mb-5 pt-5 pb-5">
        <article class="container d-flex justify-content-between mt-5">
            <aside class="width-30">
                <figure>
                    <img src="{{asset('images/Amsterdam.jpg')}}"
                         alt="image de fond de je sais plus quoi">
                </figure>
            </aside>
            <section class="width-60">
                <h1>Lorem Ipsum</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis cursus commodo sapien, ut blandit erat
                    rutrum
                    ac. Proin auctor risus ipsum, vel mollis lacus maximus non. Cras eu elementum nisi, ac dapibus
                    nulla.
                    Fusce
                    justo nisi, eleifend vel rhoncus quis, mollis nec ipsum. Sed et justo sit amet ex pulvinar suscipit
                    nec
                    vitae justo. Donec eget purus varius, iaculis quam quis, euismod mi. Vestibulum ante ipsum primis in
                    faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus non consequat dolor. Morbi
                    faucibus
                    consectetur massa. Pellentesque in purus at justo placerat hendrerit id et ipsum</p>
                <p>Prix de départ : 100€ / heure.</p>
            </section>
        </article>
    </main>

    <hr>

    <main class="container-fluid mt-5 mb-5 pt-5 pb-5">
        <article class="container d-flex justify-content-between mt-5">
            <section class="width-60">
                <h1>Lorem Ipsum</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis cursus commodo sapien, ut blandit erat
                    rutrum
                    ac. Proin auctor risus ipsum, vel mollis lacus maximus non. Cras eu elementum nisi, ac dapibus
                    nulla.
                    Fusce
                    justo nisi, eleifend vel rhoncus quis, mollis nec ipsum. Sed et justo sit amet ex pulvinar suscipit
                    nec
                    vitae justo. Donec eget purus varius, iaculis quam quis, euismod mi. Vestibulum ante ipsum primis in
                    faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus non consequat dolor. Morbi
                    faucibus
                    consectetur massa. Pellentesque in purus at justo placerat hendrerit id et ipsum</p>
                <p>Prix de départ : 100€ / heure.</p>
            </section>
            <aside class="width-30">
                <figure>
                    <img src="{{asset('images/b8UeSKOoK4HcOWEQBOgHcJ9osmMohKe3zHgxdmEW.jpeg')}}"
                         alt="image de fond de je sais plus quoi">
                </figure>
            </aside>
        </article>
    </main>

    <hr>

    <main class="container-fluid mt-5 mb-5 pt-5 pb-5">
        <article class="container d-flex flex-column justify-content-between mt-5">
            <section class="w-100 d-flex flex-column align-items-center mb-5">
                <h1 class="mb-5">Lorem Ipsum</h1>
                <figure class="w-50">
                    <img src="{{asset('images/DPP_00026.jpg')}}"
                         alt="image de fond de je sais plus quoi">
                </figure>
            </section>
            <section>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis cursus commodo sapien, ut blandit erat
                    rutrum
                    ac. Proin auctor risus ipsum, vel mollis lacus maximus non. Cras eu elementum nisi, ac dapibus
                    nulla.
                    Fusce
                    justo nisi, eleifend vel rhoncus quis, mollis nec ipsum. Sed et justo sit amet ex pulvinar suscipit
                    nec
                    vitae justo. Donec eget purus varius, iaculis quam quis, euismod mi. Vestibulum ante ipsum primis in
                    faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus non consequat dolor. Morbi
                    faucibus
                    consectetur massa. Pellentesque in purus at justo placerat hendrerit id et ipsum</p>
                <p>Prix de départ : 100€ / heure.</p>
            </section>
        </article>
    </main>
@endsection
