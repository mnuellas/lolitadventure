<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lolitadventure') }}</title>
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
<header>
  <div class="topnav">
    <a href="{{ url('/') }}" style="font-size:25px">Lolitadventure</a>
    <a href="{{ route('profil') }}">Compte</a>
  </div>
</header>
<main id="lexicon_body">
  <section class="lexicon_section">
    <div>
    @if (App::isLocale('fr'))
    <h3>Comment utiliser le lexique ?</h3>
    <p>Il est divisé en 5 sections dont une pour chaque type de carte, une sur qu'est ce que le lolita et la dernière sur qui je suis et Lolitadventure. Si vous cherchez par exemple qu'est ce que la danse du raptor, allez dans la section "Action".
      Sinon vous pouvez taper les mots clef dans la barre de recherche, ça marche presque la moitié du temps.
    </p>
    <ul class="fa-ul">
      <li><i class="fa-li fa fa-running"></i>Action</li>
      <li><i class="fa-li fa fa-award"></i>Quizz</li>
      <li><i class="fa-li fa fa-dice"></i>Evénement</li>
      <li><i class="fa-li fa fa-heart"></i>Mais qu'est ce que le fuck c'est l'EGL</li>
      <li><i class="fa-li fa fa-chess"></i>Lolitadventure et sa propre aventure</li>
    </ul>
    @endif
    @if (App::isLocale('en'))
    <h3>How to use the lexicon ?</h3>
    <p>The lexicon is divided in 5 parts: one for each types of cards, one about Lolita and EGL and one about me and this game</p>
    <p>You will mainly use it to search what the raptor dance is.</p>
    <ul class="fa-ul">
      <li><i class="fa-li fa fa-running"></i>Action</li>
      <li><i class="fa-li fa fa-award"></i>Quizz</li>
      <li><i class="fa-li fa fa-dice"></i>Event</li>
      <li><i class="fa-li fa fa-heart"></i>Okay but wtf is EGL ?</li>
      <li><i class="fa-li fa fa-chess"></i>Lolitadventure and its own adventure</li>
    </ul>
    @endif
    </div>
  </section>
  <section class="lexicon_section">
    @if (App::isLocale('en'))
    <h3>Action cards</h3>
    <div>
      This section will link to explicative exemples of the forfeits, it's ordered by key words.<br />
      for exemple, if you really don't see what a squat is, it'll take you the the squat's wikihow page
    </div>
    @endif
    @if (App::isLocale('fr'))
    <h3>Cartes Action</h3>
    <div>Cette section vous enverra vers des exemples explicatifs des gages. C'est ordonné par mot clés.<br />
      Par exemple, si vous ne savez pas c'est quoi un squat, ça vous emmenera sur la page wikihow du squat
    </div>
    @endif
    <div>
      <ul class="fa-ul">
        <li><i class="fa-li fa fa-running"></i><a href="https://www.wikihow.life/Do-a-Squat">squats</a></li>
        @if (App::isLocale('fr'))
        <li><i class="fa-li fa fa-gamepad"></i><a href="https://www.youtube.com/watch?v=jVm1NbrXaXc">Pokemon</a></li>
        <li><i class="fa-li fa fa-music"></i><a href="https://www.youtube.com/watch?v=2rt2g_afiAg">Une souris verte (quand même)</a></li>
        <li><i class="fa-li fa fa-fist-raised"></i><a href="https://www.youtube.com/watch?v=4c5fIeVHVXw">Allumer le feu de Johnny Hallyday</li>
        @endif
        @if (App::isLocale('en'))
        <li><i class="fa-li fa fa-gamepad"></i><a href="https://www.youtube.com/watch?v=dCVTpeceIew">Pokemon</a></li>
        <li><i class="fa-li fa fa-music"></i><a href="https://www.youtube.com/watch?v=yCjJyiqpAuU">Twinkle twinkle little star (have you been raised under a rock ?!)</a></li>
        <li><i class="fa-li fa fa-fist-raised"></i><a href="https://www.youtube.com/watch?v=EPhWR4d3FJQ">Born in the USA by Bruce Sprinsteen</a></li>
        @endif
        <li><i class="fa-li fa fa-heart"></i><a href="https://www.youtube.com/watch?v=2IzR_ClTE8Y">BabyMetal</a></li>
        <li><i class="fa-li fa fa-robot"></i><a href="https://www.youtube.com/watch?v=JO7PfNk2OMw">PonPonPon</a></li>
        <li><i class="fa-li fa fa-cookie"></i><a href="https://youtu.be/9wFVg4j1ZpU?t=71">Raptor</a></li>
        
      </ul>
    </div>
  </section>
  <section class="lexicon_section">
    @if (App::isLocale('fr'))
    <h3>Cartes Quizz</h3>
    <div>
      Cette section sert à vous expliquer pourquoi certaines questions des cartes quizz ont telles réponses<br />
      Pour l'instant, elle ne contient que les questions qui ont suscité un débat entre mes béta-testeuses/testeurs donc <br />
      si vous ne trouvez pas la question, contactez moi et je le rajouterais
    </div>
    @endif
    @if (App::isLocale('en'))
    <h3>Quizz cards</h3>
    <div>
      This section will explain why some questions have this answers<br />
      For the moment, it contain only the cards that had created some debate within my beta-testers so if you<br />
      don't find your question here please contact me and I'll add it here.
    </div>
    @endif
  </section>
  <section class="lexicon_section">
    @if (App::isLocale('fr'))
    <h3>Cartes Event</h3>
    <div>Okay ! Là c'est ma session préférrée parce que 99% des cartes events sont inspirés de la vie réelle !</br >
      Elle est ici pour dire coucou aux filles qui m'ont confié leur malheurs et leur bonheur. Gros calins aux coupines qui n'ont pas
      des proches encourageants voir menaçant. High-Five à toutes les lolitas qui gagné des lots, des prix et des encouragements !
      Bises aux malheureuses qui ont des chats (et qui doivent se battre pour qu'ils n'entrent pas dans l'armoire)<br />
      Merci à toutes pour vos témoigagnes !!!
    </div>
    @endif
  </section>
  <section class="lexicon_section" style="margin-bottom: 2vh">
    @if (App::isLocale('fr'))
    <h3>Lolitadventure, quelle aventure !</h3>
    <div>
      <p>Owi ! On va parler de moi !! Moi c'est Marie, j'ai une petite soeur trop choupie du nom de Pauline (rien à voir lol).
      A son lancement en 2020, ça fait deux ans que je travaille sur ce jeu ! D'abord un simple jeu crée pour une mini tea-party 
      où l'on tirait juste des cartes "discussion" comme "quel est ta boisson préférée" ou "ta dream dress" puis un jeu de plateau avec
      un design tout à fait différent :</p>
      <img style="height:60vh"src="img/background.png">
      <p>(Ouaip, comme quoi il n'est jamais trop tard pour changer de design)</p>
      <p>J'étais à l'époque dans une association de geek, on jouaient aux jeux vidéo, on regardait des animes, on jugeait les cosplays mais
      ce qui m'avait plu le plus, c'était la branche jeu de société. J'adorais ça et je voulais y jouer en Tea-Party. Alors pourquoi ne pas créer un
      vrai jeu de société lolita ? Le premier avait bien marché ! C'est là qu'a commencé ma galère. J'ai pris la tête à tout le monde dessus :
      l'asso de geek, mon petit ami de l'époque, mes amies, mes potes, des gens qui n'avaient rien demandé, des lolitas qui voulaient prendre le thé...
      La version papier a même eu son Ulule ! Et maintenant un site ! Ce bébé, je l'ai fait moi même, je ne suis qu'une débutante et les tecnho utilisés
      sont pas... les plus jeunes (bon il y a Laravel au niveau serveur, donc ça va). Le code est un peu <a href="https://fr.wikipedia.org/wiki/Programmation_spaghetti">spaghetti</a>
      Mais c'est mieux que rien ! Vous pouvez jouer avec des lolitas du monde entier gratuitement (d'ailleurs ça se paie pas tout seul un site, voici mon <a href="https://fr.tipeee.com/lolitadventure">tipeee</a> si tu veux contribuer)
      Voilà voilà ! Merci de jouer ! Si tu aimes mon jeu, n'hésite pas à me le faire savoir !!
    </div>
    @endif
    @if (App::isLocale('en'))
    <h3>Lolitadventure, what an adventure !</h3>
    <div>
      <p>Oh yeah ! Time to talk about me !! I'm Marie, I have a little sister named Pauline (off-topic but she's so cute !!!).
      In 2020, it would be 2 years that I work on lolitadventure ! Firstly a simple game created for a tiny tea-party 
      where you picked some "discussion cards" like "what's your favorite dress ?" our "are more bows or flowers ?" then a board game with
      a completly different design :</p>
      <img style="height:60vh"src="img/background.png">
      <p>(Yep, that was really ugly, I'm really not a good designer lol)</p>
      <p>At that time, I was in a "geek" association, we played video games, juged cosplays, watched animes but
      what I loved the moset was the boardgames branch. I really love boardgames : there are fun and make you sociable, so why not take on at Tea-Party ?. Then why not
      create a lolita boardgame ? The first one was a total fun ! And then began my troubles. I began to annoy everyone with this game :
      the geek association, my boyfriend at this time, my friends, buddys, innoncent people that never asked anything, lolitas that just wanted some tea...
      The paper version had even an Ulule (a french kickstarter) ! And now a site ! That baby, I did myself, I'm only a beginner and used technoligies are not...
      the younger ones (well I used Laravel for server side so I guess it's okay (F*ck you Symphony users, I love Laravel more !)). The code is a little <a href="https://fr.wikipedia.org/wiki/Programmation_spaghetti">spaghetti</a>
      But it's better than anything (And, if you ask me, I really did a good job) ! You can play with every lolitas around the globe with this site!! (By the way a site does'nt pay by itself, here my <a href="https://fr.tipeee.com/lolitadventure">tipeee</a> if want to help me maintain it)
      I really want to thank you to play ! I hope that you like it ! If you do, let me know !!
    </div>
    @endif
  </section>
</main>
<footer class="footer_lexicon">
  <a href="https://www.facebook.com/lolitadventure/"><i class="fab fa-facebook"></i></a>
  <a href="https://www.instagram.com/lolitadventure/"><i class="fab fa-instagram"></i></a>
  <a href="https://fr.tipeee.com/lolitadventure">Tipeee</a>
  <p>all rights reserved Lolitadventure</p>
</footer>
</body>
</html>
