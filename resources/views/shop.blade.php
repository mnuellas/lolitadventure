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
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
</head>
<body>
  <!-- <div id="cache">
    <p class="hero-textCache">{{ __('shop.underConstruction') }}<br>
    OK <a href="{{ url('/') }}">{{ __('shop.goHome') }}</a><br />
    {{ __('shop.goFacebook1') }} <a href="">Facebook</a> {{ __('shop.goFacebook2') }}</p>
  </div> -->
  <header>
    <div class="topnav">
      <a href="{{ url('/') }}" style="font-size:25px">Lolitadventure</a>
      <a href="{{ route('profil') }}">Compte</a>
      <a href="#panier" class="notification"><i class="fas fa-shopping-cart"></i><span class="badge">1</span></a>
  </div>
  </header>

  <ul id="shop_ul">
    <li>
      <!-- <h4>{{ __('main.news') }}</h4> -->
      <!-- Slideshow container -->
      <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="/storage/plateauHP.png" style="width:100%; max-height:100%">
          <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="/storage/plateauSP.png" style="width:100%; max-height:100%">
          <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="https://dummyimage.com/16:9x1080" style="width:100%">
          <div class="text">Caption Three</div>
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(3)">&#10094;</a>
        <a class="next" onclick="plusSlides(2)">&#10095;</a>
      </div>
      <br>
      <!-- The dots/circles -->
      <div style="text-align:center">
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      </div>
    </li>
    <!-- <li>
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
    </li> -->
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
  <footer class="footer">
    <a href="https://www.facebook.com/lolitadventure">FaceBook</a><a href="https://www.instagram.com/lolitadventure/">Instagram</a><a href="#contact">Contact</a>
    <p id="right_footer">Lolitadventure all right reserved&#169;</p>
  </footer>
</body>
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
</html>
