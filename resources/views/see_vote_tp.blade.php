<html>
<body>
  <head>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
    body {
      background-color: #ffb5d1;
    }
    header {
      text-align: center;
      width: 50vw;
      margin: auto;
      margin-top: 5vh;
    }
    ul {
      margin-top: 5vh;
      margin-bottom: 5vh;
      margin-left: 10vw
    }
    div {
      text-align: center;
    }
    </style>
  </head>
  <header>
    Mes chères petites fleurs, première étape pour notre association : un nom. Juste deux contraintes à votre imagination : il doit être en français, et comporter "Paris". A vos stylos !! 🎀
    <br>Les noms proposés :
  </header>
  <ul>
    @foreach ($proposed_titles as $title)
      <li>Nom : {{ $title->name }}, votes : {{ $title->vote }}</li>
    @endforeach
  </ul>
  <div>
    <a class="btn btn-success" href="{{ url('vote') }}">Aller voter</a>
  </div>
</body>
<footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</footer>
</html>
