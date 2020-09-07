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
<form class="form-horizontal" method="POST" action="{{ route('createRoom') }}">
{{ csrf_field() }}

<div class="form-group{{ $errors->has('room_url') ? ' has-error' : '' }}">
    <label for="room_url" class="col-md-4 control-label">{{ __('room.url') }}</label>

    <div class="col-md-6">
        <input id="room_url" type="text" class="form-control" name="room_url" value="{{ old('room_url') }}" required autofocus>

        @if ($errors->has('room_url'))
            <span class="help-block">
                <strong>{{ $errors->first('room_url') }}</strong>
            </span>
        @endif
    </div>
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
<a href="{{ route('chooseRoom') }}"><button >Create a new room</button></a>
<p><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></p>
</body>
</html>