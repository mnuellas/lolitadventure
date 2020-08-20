<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lolitadventure') }}</title>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <link href="{{ asset('css/profil.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
  <header>
    <div class="topnav">
      <a href="{{ url('/') }}" style="font-size:25px">Lolitadventure</a>
      <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
          {{ __('main.logout') }}
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
      <a href="{{ route('shop') }}">{{ __('main.shop') }}</a>
      <a href="{{ route('shop') }}">{{ __('main.panier') }}</a>
  </div>
  </header>
  <main>
    <section>
      <h3 style="color: pink;font-size: 1.5em;">{{ __('user.infos') }}</h3>
        <div id="info_username" class="info">
          <p>{{ __('user.name') }} : {{ $user }}</p><button onclick="changeUsername()">{{ __('user.change_it') }}</button>
        </div>
        <form id="info_username_form" style="display:none" class="form-horizontal" method="POST" action="{{ route('change_username') }}" onsubmit="submited()">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">{{ __('user.new_name') }} :</label>
            <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ $user }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
          </div>
          <button type="submit" class="btn">
              {{ __('user.valid') }}
          </button>
        </form>

        <div id="info_email" class="info">
        <p>{{ __('user.mail') }} : {{ $email }}</p><button onclick="changeEmail()">{{ __('user.change_it') }}</button>
        </div>
        <form id="info_email_form" style="display:none" class="form-horizontal" method="POST" action="{{ route('change_email') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">{{ __('user.new_mail') }} :</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ $email }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
          </div>
          <button type="submit" class="btn btn-primary">
              {{ __('user.valid') }}
          </button>
        </form>
          <p>{{ __('user.board') }} :</p>
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
      <div>
        <p>
      </div>
    </section>
  </main>
  <script>
    function changeUsername() {
      document.getElementById('info_username').style.display = 'none';
      document.getElementById('info_username_form').style.display = 'flex';
    }
    function changeEmail() {
      document.getElementById('info_email').style.display = 'none';
      document.getElementById('info_email_form').style.display = 'flex';
    }
    function addDeck(play) {
      let deck = document.getElementsByName('play');
      let count_check = 0;
      for (let i = 0; i < deck.length; i++){
        if (deck[i].checked)
          count_check++;
      }
      if (count_check == 0) {
        console.log("error");
        deck[0].click();
      } else {
        AjaxrequestProfil('add_deck', play)
      }
    }

    function changeSet(set) {
      AjaxrequestProfil('change_set', set);
    }

    function AjaxrequestProfil(request, data){
      $.ajax({
          type: 'GET', //THIS NEEDS TO BE GET
          url: '/' + request,
          data: {
            deck : data
          },
          success: function (data) {

        }
      });
    }
  </script>
</body>
</html>
