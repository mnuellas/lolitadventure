<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Enfin un jeu pour les lolitas !" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        	<title>Lolitadventure</title>
        	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        	<link rel="stylesheet" href="{{ asset('css/css.css') }}">
        	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        	<script src="{{ asset('js/fabric.min.js') }}"></script>
        	<script src="{{ asset('js/jquery.transit.min.js') }}"></script>
          <script>
            var interval;
            var loaderList = ["{{ __('loader.1') }}", "{{ __('loader.2') }}", "{{ __('loader.3') }}", "{{ __('loader.4') }}", "{{ __('loader.5') }}", "{{ __('loader.6') }}", "{{ __('loader.7') }}", "{{ __('loader.8') }}", "{{ __('loader.9') }}", "{{ __('loader.10') }}", "{{ __('loader.11') }}", "{{ __('loader.12') }}", "{{ __('loader.13') }}"];
            function Loader(){
              interval = setInterval(function(){
                var list = loaderList;
                var random = parseInt(Math.random() * list.length);
                $("#loaderTexte").text(list[random]);
              }, 3000);
            }
            Loader();
          </script>
        </head>
        @yield('content')
  <footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset(join('', array('js/carte', strtoupper(app()->getLocale()), '.js'))) }}"></script> -->
    <script src="{{ asset('js/withFabricTest.js') }}"></script>
    <script>
    var remainingTurns = "{{ __('main.game.remainingTurns') }}";
    var hitSpacebar = "{{ __('main.game.hitSpacebar') }}";
    var remaingSpacebarHits1 = "{{ __('main.game.remainingSpacebarHits1') }}";
    var remaingSpacebarHits2 = "{{ __('main.game.remainingSpacebarHits2') }}";
    var lang = "{{ $lang }}";
    var Tuto = {
      0 : "<p><span class=\"tutoTitle\">{{ __('main.game.tuto.1') }}</span><br />{{ __('main.game.tuto.2') }}<br />{{ __('main.game.tuto.3') }}\
    		<address>Email : <a href=\"mailto:lolitadventure.fr@gmail.com\">m.imagianne@gmail.com</a><br />Facebook : <a href=\"https://www.facebook.com/lolitadventure\">Lolitadventure</a>\
    		</address><br />{{ __('main.game.tuto.4') }}<br />{{ __('main.game.tuto.5') }}<br />{{ __('main.game.tuto.6') }}<br />\
    	{{ __('main.game.tuto.7') }}<br /> 	{{ __('main.game.tuto.8') }}<br />{{ __('main.game.tuto.9') }}<br />{{ __('main.game.tuto.10') }}</p><button id=\"clickMe\">{{ __('main.game.tuto.11') }}</button>",
    	1 : "{{ __('main.game.tuto.12') }}<br />{{ __('main.game.tuto.13') }}<br />{{ __('main.game.tuto.14') }}<br /><input id=\"nb_player\" value=1 type=\"number\"><button id='clickMe'>{{  __('main.game.tuto.15') }}</button>",
    	2 : "<h2 style='color:#fc97b5'>Tutoriel</h2><p>{{ __('main.game.tuto.16') }}<br /></p><button id='clickMe'>{{ __('main.game.tuto.17') }}</button>",
    	3 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.game.tuto.18') }}<br />\
    		{{ __('main.game.tuto.19') }}<br />{{ __('main.game.tuto.20') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Event/" + lang + "/Event1.png'></div>\
    		<button id='clickMe'>{{ __('main.game.tuto.21') }} ♥</button>",
    	4 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.game.tuto.22') }}<br />\
    		{{ __('main.game.tuto.23') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='img/Quizz.png'></div>\
    		<button id='clickMe'>{{ __('main.game.tuto.21') }} ♪♫</button>",
    	5 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.game.tuto.24') }}<br />\
    		{{ __('main.game.tuto.25') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action1.png'></div>\
    		<button id='clickMe'>{{ __('main.game.tuto.26') }}</button>",
    	6 : "<div style='display: flex;flex-direction:row;justify-content:space-around; align-items: center;'><div style='max-width:50%'><p>{{ __('main.game.tuto.27') }}<br />{{ __('main.game.tuto.28') }}<br />\
    		{{ __('main.game.tuto.29') }}<br />{{ __('main.game.tuto.30') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action1.png'></div>\
    		<button id='clickMe'>{{ __('main.game.tuto.31') }}</button>",
    	7 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.game.tuto.32') }}<br />\
    		{{ __('main.game.tuto.33') }}<br />{{ __('main.game.tuto.34') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action12.png'></div>\
    		<button id='clickMe'>{{ __('main.game.tuto.35') }}</button>",
    	8 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.game.tuto.36') }}<br />\
    		{{ __('main.game.tuto.37') }}<br />{{ __('main.game.tuto.38') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action9.png'></div>\
    		<button id='clickMe'>{{ __('main.game.tuto.39') }}</button>",
    	9 : "<div style='display:flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.game.tuto.40') }}<br />\
    		{{ __('main.game.tuto.41') }}<br />{{ __('main.game.tuto.42') }}<br />\
    		{{ __('main.game.tuto.43') }}<br /></p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action12.png'></div>\
    		<button id='clickMe'>{{ __('main.game.tuto.44') }}</button>",
      10 : "<div style='display:flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.game.tuto.45') }}<br /></div></div>\
        <button id='clickMe'>{{ __('main.game.tuto.46') }}</button>",
    }
    </script>
  </footer>
</html>
