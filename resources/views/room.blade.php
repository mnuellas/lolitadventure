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
<body>
        <div id="winDiv" style="display:none">
        	<div class="centerWin">
        		<p>{{ __('main.gameOnline.winner') }}</p>
        		<p>{{ __('main.gameOnline.visitFB') }}</p>
        		<p>Facebook : <a href="https://www.facebook.com/lolitadventure/">Lolitadventure</a></p>
        	</div>
        	<div class="buttonWin">
        		<button onclick="Reset()"><p>{{ __('main.gameOnline.reload') }}</p> {{ __('main.gameOnline.notSafe') }}</button>
        		<button onclick="HardReset()"><p>{{ __('main.gameOnline.safeReload') }}</p>{{ __('main.gameOnline.useData') }}</button>
        	</div>
        </div>
        <div id="loader" style="z-index:20; text-align: center;">
        	<p style="margin-bottom: 10px">/!\ {{ __('main.welcome.fauteMessage') }} /!\</p><img src="img/loader.svg" id="loaderImg" alt="chat trop kawaii qui tourne"><p id="loaderTexte">{{ __('loader.14') }}</p>
        	<p>{{ __('main.welcome.Facebook1') }}<a href="https://www.facebook.com/lolitadventure/">Facebook</a>{{ __('main.welcome.Facebook2') }}</p>
        </div>
        <div id="cache" style="display:none;"></div>
        <img id="de" src="De/de1.png" style="display:none;" alt="Dé 6 équilibré avec des coeurs pour les trous">
        <div id="welcomeDiv" style="display:none;"></div>
        <div class="container">
        	<div class="col" style="width: 80%">
        		<img class="carte" id="carte" alt ="carte action ou événement, plus d'informations seront fournies lors du tirage de celles-ci">
        		<div id="ActionDiv"></div>
        		<div id="QuizzDiv">
        			<img src='{{asset("img/Quizz.png")}}' id="questionCard">
        			<p id='question'></p><br />
        			<ol>
        				<li><button id='rep0' class='QuizzLi'></button></li>
        				<li><button id='rep1' class='QuizzLi'></button></li>
        				<li><button id='rep2' class='QuizzLi'></button></li>
        			</ol>
        		</div>
        		<section id="canvasSection" style="height: 100%; width:100%">
        			<canvas id="c"></canvas>
        		  </section>
			 </div>
			 <div id="menu" class="col">
        		<div id="PP">
					<p id="tourp">{{ __('main.turn') }}<span id="tour"> Joueuse 1</span></p>
				</div>
        		<ul id="ulProfil">
        		</ul>
        	</div>
        </div>
        <div id="preload" style="display:none">
      @foreach ($action as $carte)
        <img class="" src="{{ url('/images/cartes/Actions/' .  app()->getLocale() . '/' . $carte->url) }}" id="{{ $carte->url }}" />
      @endforeach
      @foreach ($event as $carte)
        <img class="" src="{{ url('/images/cartes/Event/' .  app()->getLocale() . '/' . $carte->url) }}" id="{{ $carte->url }}" />
      @endforeach
	  </div>
<script>
	var plateauURL = "{{ url('/images/sets/plateau/' . $plateau . '/plateau.png') }}";
    var pionURL = "{{ $plateau }}";
    var room = "{{ $room }}";
	var number_players = "{{ $players }}";
	var player_number = "{{ $player_nbr }}" - 1;
	function rename(id) {
		// on cache le span avec le nom et on affiche l'input
		$("#span_j_" + id).hide();
		$("#input_j_" + id).show();
		// sur un focusout, on met la nouvelle valeur dans le span
		$("#input_j_" + id).focusout(function() {
			let new_val = $(this).val();
			$.post("https://lolitadventure.fr/print_rename", {
				'_token' : "{{ csrf_token() }}",
				room : room,
				id : id,
				value : new_val,
			});
		})
		// pareil pour la touche entrée
		$("#input_j_" + id).on('keypress', function(e) {
			if (e.which == 13) {
				let new_val = $(this).val();
				$.post("https://lolitadventure.fr/print_rename", {
					'_token' : "{{ csrf_token() }}",
					room : room,
					id : id,
					value : new_val,
				});
			}
		})
	}
	
	function Reset()
	{
		$("#winDiv").hide();
		for (var i = 0; i < pions.length; i++)
		{
			pions[i].id = 0;
			pions[i].animate('top', plateau[0].top, { onChange: canvas.renderAll.bind(canvas) });
			pions[i].animate('left', plateau[0].left, { onChange: canvas.renderAll.bind(canvas) });
		}
		clearTimeout();
		$("#ulProfil > li").remove();
		$("span").html("");
		ThrowDice();
	}

	function HardReset()
	{
		location.reload();
	}
</script>
		</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset(join('', array('js/carte', strtoupper(app()->getLocale()), '.js'))) }}"></script> -->
    <script src="{{ asset('js/echo.js') }}"></script>
    <script>
    var remainingTurns = "{{ __('main.gameOnline.remainingTurns') }}";
    var hitSpacebar = "{{ __('main.gameOnline.hitSpacebar') }}";
    var remaingSpacebarHits1 = "{{ __('main.gameOnline.remainingSpacebarHits1') }}";
    var remaingSpacebarHits2 = "{{ __('main.gameOnline.remainingSpacebarHits2') }}";
    var lang = "{{ app()->getLocale() }}";
    var Tuto = {
      0 : "<p><span class=\"tutoTitle\">{{ __('main.gameOnline.tuto.1') }}</span><br />{{ __('main.gameOnline.tuto.2') }}<br />{{ __('main.gameOnline.tuto.3') }}\
    		<address>Email : <a href=\"mailto:lolitadventure.fr@gmail.com\">m.imagianne@gmail.com</a><br />Facebook : <a href=\"https://www.facebook.com/lolitadventure\">Lolitadventure</a>\
    		</address><br />{{ __('main.gameOnline.tuto.4') }}<br />{{ __('main.gameOnline.tuto.5') }}<br />{{ __('main.gameOnline.tuto.6') }}<br />\
    	{{ __('main.gameOnline.tuto.7') }}<br /> 	{{ __('main.gameOnline.tuto.8') }}<br />{{ __('main.gameOnline.tuto.9') }}<br />{{ __('main.gameOnline.tuto.10') }}</p><button id=\"clickMe\">{{ __('main.gameOnline.tuto.11') }}</button>",
    	1 : "{{ __('main.gameOnline.tuto.12') }}<br />{{ __('main.gameOnline.tuto.13') }}<br />{{ __('main.gameOnline.tuto.14') }}<br /><button id='clickMe'>{{  __('main.gameOnline.tuto.15') }}</button><button class=\"skipMe\" id=\"skipTuto\">{{  __('main.gameOnline.tuto.15b') }}</button>",
    	2 : "<h2 style='color:#fc97b5'>Tutoriel</h2><p>{{ __('main.gameOnline.tuto.16') }}<br /></p><button id='clickMe'>{{ __('main.gameOnline.tuto.17') }}</button>",
    	3 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.gameOnline.tuto.18') }}<br />\
    		{{ __('main.gameOnline.tuto.19') }}<br />{{ __('main.gameOnline.tuto.20') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Event/" + lang + "/Event1.png'></div>\
    		<button id='clickMe'>{{ __('main.gameOnline.tuto.21') }} ♥</button>",
    	4 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.gameOnline.tuto.22') }}<br />\
    		{{ __('main.gameOnline.tuto.23') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='img/Quizz.png'></div>\
    		<button id='clickMe'>{{ __('main.gameOnline.tuto.21') }} ♪♫</button>",
    	5 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.gameOnline.tuto.24') }}<br />\
    		{{ __('main.gameOnline.tuto.25') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action1.png'></div>\
    		<button id='clickMe'>{{ __('main.gameOnline.tuto.26') }}</button>",
    	6 : "<div style='display: flex;flex-direction:row;justify-content:space-around; align-items: center;'><div style='max-width:50%'><p>{{ __('main.gameOnline.tuto.27') }}<br />{{ __('main.gameOnline.tuto.28') }}<br />\
    		{{ __('main.gameOnline.tuto.29') }}<br />{{ __('main.gameOnline.tuto.30') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action1.png'></div>\
    		<button id='clickMe'>{{ __('main.gameOnline.tuto.31') }}</button>",
    	7 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.gameOnline.tuto.32') }}<br />\
    		{{ __('main.gameOnline.tuto.33') }}<br />{{ __('main.gameOnline.tuto.34') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action12.png'></div>\
    		<button id='clickMe'>{{ __('main.gameOnline.tuto.35') }}</button>",
    	8 : "<div style='display: flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.gameOnline.tuto.36') }}<br />\
    		{{ __('main.gameOnline.tuto.37') }}<br />{{ __('main.gameOnline.tuto.38') }}</p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action9.png'></div>\
    		<button id='clickMe'>{{ __('main.gameOnline.tuto.39') }}</button>",
    	9 : "<div style='display:flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.gameOnline.tuto.40') }}<br />\
    		{{ __('main.gameOnline.tuto.41') }}<br />{{ __('main.gameOnline.tuto.42') }}<br />\
    		{{ __('main.gameOnline.tuto.43') }}<br /></p></div><img style='height:65vh; width:25vw;border:1px solid black' src='http://lolitadventure.fr/images/cartes/Actions/" + lang + "/Action12.png'></div>\
    		<button id='clickMe'>{{ __('main.gameOnline.tuto.44') }}</button>",
      10 : "<div style='display:flex;flex-direction:row;justify-content:space-around;align-items: center;'><div style='max-width:50%'><p>{{ __('main.gameOnline.tuto.45') }}<br /></div></div>\
        <button id='clickMe'>{{ __('main.gameOnline.tuto.46') }}</button>",
    }
    </script>
  </footer>
</html>