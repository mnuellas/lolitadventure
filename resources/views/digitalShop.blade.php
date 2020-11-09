<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lolitadventure') }}</title>
    <link href="/{{ asset('css/shop.css') }}" rel="stylesheet">
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
    <!-- <li>
      <h4>{{ __('main.news') }}</h4>
      <div class="slideshow-container">
        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="https://dummyimage.com/16:9x1080" style="width:100%">
          <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="https://dummyimage.com/16:9x1080" style="width:100%">
          <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="https://dummyimage.com/16:9x1080" style="width:100%">
          <div class="text">Caption Three</div>
        </div>
        <a class="prev" onclick="plusSlides(3)">&#10094;</a>
        <a class="next" onclick="plusSlides(2)">&#10095;</a>
      </div>
      <br>
      <div style="text-align:center">
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      </div>
    </li> -->
    <li>
      <div class="row">
        <div class="column">
          <div class="card">
            <img src="https://picsum.photos/250" alt="Jane" style="width:100%">
            <div class="container">
              <h2>Jane Doe</h2>
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p><button class="buttonA">{{ __('shop.knowMore') }}</button><button class="buttonB" onclick="add2cart('Jane Doe')">buy</button></p>
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
    <li>
      <div class="hero-image">
        <div class="hero-text">
          <h1>{{ __('shop.buyBoard') }}</h1>
          <p>{{ __('shop.whyBuyBoard1') }}</p>
          <button class="hero-button">{{ __('shop.buy') }}</button>
        </div>
      </div>
    </li>
  </ul>
<div class="footer">
  <a href="">FaceBook</a><a href="">Instagram</a><a href="#contact">Contact</a>
  <p id="right_footer">Lolitadventure all right reserved&#169;</p>
</div>
<footer>
  <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
      clearTimeout(Jean);
      showSlides(slideIndex + n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
      clearTimeout(Jean);
      showSlides(n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      slideIndex = (n % slides.length) + 1;
      if (n < 1)
        slideIndex = slides.length;
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      Jean = setTimeout(showSlides, 5000, slideIndex++);
    }
  </script>
</footer>
</body>
