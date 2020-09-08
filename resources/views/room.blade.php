<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
<p>Room</p>
<p><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

<!-- <script src="/socket.io/socket.io.js"></script> -->
<!-- //{{ Request::getHost() }}:6001 -->
<script src="{{ asset('js/app.js') }}"></script>
</html>