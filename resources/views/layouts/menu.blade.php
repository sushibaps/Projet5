<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fontawesome and Bootstrap loading -->
    <link href="{{ asset('@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- Global CSS file loading -->
    @yield('stylesheet')
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <!-- Google Font loading -->
    <link href="https://fonts.googleapis.com/css?family=Manjari|Source+Sans+Pro|EB+Garamond&display=swap"
          rel="stylesheet">

    <!-- App.js -->
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <!-- Script declaration -->
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    <!-- Ion-Icons Installation -->
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <!-- TinyMCE Integration -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <title>@yield('title')</title>
</head>
<body>
<div class="container-fluid d-flex justify-content-center scroll transparent">
    <nav
        class="container-fluid d-flex align-items-center border-bottom transparent navbar navbar-expand-lg pb-0"
        id="nav">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse h-100" id="navbarTogglerDemo01">
            <ul class="list-unstyled d-flex justify-content-between align-items-center width-80 mb-0 h-100"
                id="menulist">
                <li class="menu h-100 d-flex justify-content-center align-items-center width-20"><a href="/"
                                                                                                    class="text-dark text-decoration-none">Accueil</a>
                </li>
                <li class="menu h-100 d-flex justify-content-center align-items-center width-20"><a href="/galerie"
                                                                                                    class="text-dark text-decoration-none">Catégories</a>
                </li>
                <li class="menu h-100 d-flex justify-content-center align-items-center width-20"><a href="/photos"
                                                                                                    class="text-dark text-decoration-none">Photographies</a>
                </li>
                <li class="menu h-100 d-flex justify-content-center align-items-center width-20"><a href="/actus"
                                                                                                    class="text-dark text-decoration-none">Actualités</a>
                </li>
                <li class="menu h-100 d-flex justify-content-center align-items-center width-20"><a href="/prestations"
                                                                                                    class="text-dark text-decoration-none">Services</a>
                </li>
            </ul>
            @guest
                <a class="ml-auto text-dark text-decoration-none d-flex justify-content-center align-items-center bouton"
                   id="logbutton"
                   href="/login">
                    <ion-icon name="finger-print"></ion-icon>
                    Log In</a>
            @endguest
            @auth
                <a class="ml-auto text-danger text-decoration-none d-flex justify-content-center align-items-center boutondeco border border-danger rounded p-2"
                   id="decobutton"
                   href="/logout">
                    <i class="fas fa-sign-out-alt mr-1"></i>
                    Déconnexion
                </a>
            @endauth
        </div>
    </nav>
</div>

<header class="min-vw-100 d-flex flex-column justify-content-center fixed-top header">
    @yield('prologue')
</header>

<section class="min-vh-100" id="vue">
    @yield('content')
</section>


<footer class="d-flex flex-column align-items-center justify-content-around pt-5 bg-white">
    <div class="container d-flex justify-content-around border-top border-bottom pt-4">
        <div class="d-flex flex-column">
            <h2 class="socialtitles mb-3" id="instatitle">Retrouvez-moi sur Instagram</h2>
            <ul class="list-unstyled d-flex justify-content-around align-items-center social">
                <li><a href="https://www.instagram.com/julienthuret/"
                       class="text-secondary border border-secondary rounded-circle d-flex justify-content-center align-items-center mt-3 mb-3"
                       target="_blank"><i
                            class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
        <div class="d-flex flex-column">
            <h2 class="socialtitles mb-3">À propos</h2>
            <a href="" class="text-dark text-decoration-none">Mentions légales</a>
            <a href="/contact" class="text-dark text-decoration-none">Nous contacter</a>
        </div>
    </div>
    <p class="text-secondary mt-4">Copyright 2019 © Julien Thuret. Tous droits réservés</p>
</footer>
<script>
    document.getElementById('nav').classList.remove('transparent');
    document.getElementsByTagName('div')[0].classList.remove('transparent');
</script>
@yield('script')
</body>
</html>
