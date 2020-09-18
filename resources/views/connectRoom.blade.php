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
<h6><bold>/!\Attention, à partir de ce point, nous partons du principe que vous avez déjà choisi votre langue, une fois connecté à la chambre, vous ne pourrez plus la changer/!\</bold></h6>
<form class="form-horizontal" method="POST" action="{{ route('connectRoom') }}">
{{ csrf_field() }}

<div class="form-group{{ $errors->has('room_url') ? ' has-error' : '' }}">
    <label for="room_url" class="col-md-4 control-label">{{ $room_url }}</label>
    <input id="text" type="text" class="form-control" value="{{ $room_url }}" name="room_url" required hidden>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-4 control-label">{{ __('main.password') }}</label>

    <div class="col-md-6">
        <input id="text" type="password" class="form-control" name="password" required>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group">
    <div class="col-md-8 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            {{ __('main.login') }}
        </button>
    </div>
</div>
</form>
<a href="{{ route('chooseRoom') }}"><button><i class="fas fa-reply"></i></button></a>
<p><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></p>
</body>
</html>