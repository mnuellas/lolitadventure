<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lolitadventure') }}</title>
    <link href="{{ asset('css/createRoom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
    <main>
        <section>
            <h4>Create a room</h4>
            <form class="form-horizontal" method="POST" action="{{ route('createRoom') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('room_url') ? ' has-error' : '' }}">
                <label for="room_url" class="col-md-4 control-label">{{ __('room.url') }} : </label>

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

            <div id="sets_div">
                    @foreach ($sets as $set)
                    @if ($set != "")
                        <div class="set_div">
                        @if ($set == $defaultSet)
                            <label for="{{ $set }}" class="">
                            <img class="defaultSet" src="{{ url('/images/sets/plateau/' . $set . '/plateau.png') }}">
                            </label>
                            <input type="radio" id="{{ $set }}" name="set" value="{{ $set }}" onclick="changeSet('{{$set}}')" checked>
                        @else
                            <label for="{{ $set }}" class="">
                            <img src="{{ url('/images/sets/plateau/' . $set . '/plateau.png') }}">
                            </label>
                            <input type="radio" id="{{ $set }}" name="set" value="{{ $set }}" onclick="changeSet('{{$set}}')">
                        @endif
                        </div>
                    @endif
                    @endforeach
                    </div>
                    <div id="deck">
                    <p>{{ __('user.decks') }} : </p>
                    @foreach ($privileges as $deck)
                    @if ($deck != "")
                        @foreach ($playing as $play)
                        @if ($play != "")
                            @if ($play == $deck)
                            <label for="{{ $play }}" class="col-md-4 control-label">{{ $play }} :</label>
                            <input type="checkbox" id="{{ $play }}" name="play" value="{{ $play }}" onclick="addDeck('{{$play}}')" checked>
                            @else
                            <label for="{{ $deck }}" class="col-md-4 control-label">{{ $deck }} :</label>
                            <input type="checkbox" id="{{ $deck }}" name="play" value="{{ $deck }}" onclick="addDeck('{{$play}}')">
                            @endif
                        @endif
                        @endforeach
                    @endif
                    @endforeach
                    </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('room.create') }}
                    </button>
                </div>
            </div>
            </form>
            <a href="{{ route('chooseRoom') }}"><button class="btn btn-danger"> {{ __('room.return') }}</button></a>
            <p><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></p>
        </section>
    </main>
</body>

</html>