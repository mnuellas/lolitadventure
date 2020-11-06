@extends('layouts.gameScript')
@section('content')
        <body>
        <div id="winDiv" style="display:none">
        	<div class="centerWin">
        		<p>{{ __('main.game.winner') }}</p>
        		<p>{{ __('main.game.visitFB') }}</p>
        		<p>Facebook : <a href="https://www.facebook.com/lolitadventure/">Lolitadventure</a></p>
        	</div>
        	<div class="buttonWin">
        		<button onclick="Reset()"><p>{{ __('main.game.reload') }}</p> {{ __('main.game.notSafe') }}</button>
        		<button onclick="HardReset()"><p>{{ __('main.game.safeReload') }}</p>{{ __('main.game.useData') }}</button>
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
        		<div id="map">
					<div class="flag-span"><a href="{{ route('fr') }}"><img src="img/fr.png" class="flag"></a><a href="{{ route('en') }}"><img src="img/gb.png" class="flag"></a></div>
					<div class="line" id="higher"></div>
					@guest
						<a href="{{ route('login') }}" class="mapA"><i class="fas fa-fw fa-scroll iconL"></i> {{ __('main.login') }} <i class="fas fa-fw fa-scroll iconR"></i></a>
					<div class="line"></div>
						<a href="{{ route('register') }}" class="mapA"><i class="fas fa-fw fa-heart iconL"></i> {{ __('main.register') }} <i class="fas fa-fw fa-heart iconR"></i></a>
					<div class="line"></div>
					@endguest
					@auth
					<a href="{{ route('profil') }}" class="mapA"><i class="fas fa-fw fa-hat-wizard iconL"></i> {{ __('main.profil') }} <i class="fas fa-fw fa-hat-wizard iconR"></i></a>
					<div class="line"></div>
					@endauth
						<a href="{{ route('lexicon') }}" class="mapA" target="_blank"><i class="fa fa-fw fa-envelope iconL"></i> {{ __('main.lexicon') }} <i class="fas fa-fw fa-envelope iconR"></i></a>
					<div class="line"></div>
						<a href="{{ route('chooseRoom') }}" class="mapA"><i class="fas fa-fw fa-gamepad iconL"></i> Multi <i class="fas fa-fw fa-gamepad iconR"></i></a>
					<div class="line"></div>
					<div id="shop">
						<a href="{{ route('shop') }}" class="mapA"><i class="fa fa-fw fa-chess-queen iconL"></i> {{ __('main.shop') }} <i class="fas fa-fw fa-chess-queen iconR"></i></a>
					<div class="line shopHover"></div>
					<a href="{{ route('digital shop') }}" class="shopHover"><i class="fa fa-fw fa-chess-pawn iconL"></i>{{ __('main.Eshop') }}<i class="fa fa-fw fa-chess-pawn iconR"></i></a>
					<div class="line shopHover"></div>
					<a href="{{ route('boards shop') }}" class="shopHover"><i class="fa fa-fw fa-dice iconL"></i>{{ __('main.plateau') }}<i class="fa fa-fw fa-dice iconR"></i></a>
              		</div>
        		</div>
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
</script>
		</body>
@endsection
