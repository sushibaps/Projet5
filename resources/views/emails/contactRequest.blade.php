<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Prise de contact</title>
</head>
<body>

<div class="container mt-5 height-80 font-20">
    <div class="container-fluid d-flex flex-column justify-content-around align-items-center ">
        <h2 class="mt-5 pb-2 mb-5 border-bottom">Prise de contact sur mon beau site</h2>
        <p class="mt-3">Réception d'une prise de contact avec les éléments suivants :</p>
        <ul class="mt-3 list-unstyled container-fluid d-flex flex-column justify-content-around">
            <li class="mt-3"><strong>Nom</strong> : {{ $contact['name'] }}</li>
            <li class="mt-3"><strong>Email</strong> : {{ $contact['email'] }}</li>
            <li class="mt-3"><strong>Message</strong> : {{ $contact['message'] }}</li>
        </ul>
    </div>
</div>

</body>
</html>
