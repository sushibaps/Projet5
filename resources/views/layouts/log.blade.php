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
    <!-- Global CSS file loading -->
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <!-- Google Font loading -->
    <link href="https://fonts.googleapis.com/css?family=Manjari|Source+Sans+Pro|EB+Garamond&display=swap"
          rel="stylesheet">
    <!-- Ion-Icons Installation -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

    <title>@yield('title')</title>
</head>
<body>
<figure id="landscape">
    <img src="{{asset('images/landscape.jpg')}}" alt="Landscape">
</figure>
<div id="lock" class="border rounded d-flex flex-column align-items-center">
    <div>
        <ion-icon name="lock" id="ion"></ion-icon>
    </div>
    <form action="/login" method="post" id="loginform" class="mt-5">
        {{csrf_field()}}
        <div class="form-group">
            <label for="email">Votre adresse mail</label>
            <input type="email" name="email" value="{{old('email', '')}}" class="form-control" placeholder="Entrez votre identifiant">
        </div>
        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" value="{{old('password', '')}}" class="form-control" placeholder="Entrez votre mot de passe">
        </div>
        <button class="btn deepblue mt-2" type="submit">S'identifier</button>
    </form>
    <small class="mt-3">Pas encore de compte? <a href="/account">Créez-en un !</a></small>
</div>
@yield('content')
</body>
</html>
