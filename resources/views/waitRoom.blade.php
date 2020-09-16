<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    <title>{{ config('app.name', 'Lolitadventure') }}</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
        body {
            background-color: pink;
    color: white;
    font-family: "Xiomara";
    text-align: center;
    width: 100%;
    height: 100vh;
    font-size: 5vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0;
        }
    </style>
</head>
<body>
<p>{{ $url }}</p>
<img src="img/loader.svg" id="loaderImg" alt="chat trop kawaii qui tourne"><p id="loaderTexte">En attente de gens</p>
<p id="number_person">1</p>
<button onclick="Ready()">On est assez, vas y lance le jeu</button>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script>
var token = "{{ Session::token() }}"
var number_personn = document.getElementById("number_person").innerHTML;
var room = "{{ $url }}";
function Ready() {
    $.post("https://lolitadventure.fr/everybodyhere", {
        '_token' : token,
        room : room,
        number_personn : number_personn
    });
}
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>