<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lolitadventure') }}</title>
    <link href="{{ asset('css/realShop.css') }}" rel="stylesheet">
</head>
<body>
  <div id="cache">
    <p class="hero-textCache">{{ __('shop.underConstruction') }}<br>
    OK <a href="{{ url('/') }}">{{ __('shop.goHome') }}</a></p>
  </div>
  <header>
    <div class="topnav">
      <a href="{{ url('/') }}" style="font-size:25px">Lolitadventure</a>
      <a href="{{ route('home') }}">Compte</a>
      <a href="#panier">Panier</a>
  </div>
  </header>

  <ul id="shop_ul">
    <li>
      <div class="hero-image">
        <div class="hero-text">
          <h1>{{ __('shop.buyBoard') }}</h1>
          <p>{{ __('shop.whyBuyBoard1') }}</p>
          <button class="hero-button">{{ __('shop.buy') }}</button>
        </div>
      </div>
    </li>
    <li>
      <div class="hero-image">
        <div class="hero-text">
          <h1>{{ __('shop.buyApp') }}</h1>
          <p>{{ __('shop.whyBuyApp1') }}</p>
          <button class="hero-button">{{ __('shop.buy') }}</button>
        </div>
      </div>
    </li>
    <li>
      <h4>Tous les articles</h4>
      <div class="row">
        <div class="column">
          <div class="card">
            <img src="https://picsum.photos/250" alt="Jane" style="width:100%">
            <div class="container">
              <h2>Jane Doe</h2>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p><button class="buttonA">{{ __('shop.knowMore') }}</button><button class="buttonB">buy</button></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <img src="https://picsum.photos/250" alt="Mike" style="width:100%">
            <div class="container">
              <h2>Mike Ross</h2>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p><button class="buttonA">{{ __('shop.knowMore') }}</button><button class="buttonB">buy</button></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <img src="https://picsum.photos/250" alt="Mike" style="width:100%">
            <div class="container">
              <h2>Mike Ross</h2>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p><button class="buttonA">{{ __('shop.knowMore') }}</button><button class="buttonB">buy</button></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <img src="https://picsum.photos/250" alt="John" style="width:100%">
            <div class="container">
              <h2>John Doe</h2>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p><button class="buttonA">{{ __('shop.knowMore') }}</button><button class="buttonB">buy</button></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <img src="https://picsum.photos/250" alt="Test" style="width:100%">
            <div class="container">
              <h2>Mike Ross</h2>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p><button class="buttonA">{{ __('shop.knowMore') }}</button><button class="buttonB">buy</button></p>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
  <div class="footer">
    <a href="">FaceBook</a><a href="">Instagram</a><a href="#contact">Contact</a>
    <p id="right_footer">Lolitadventure all right reserved&#169;</p>
  </div>
</body>
</html>
