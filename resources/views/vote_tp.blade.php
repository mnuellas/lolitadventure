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
    form {
      margin-top: 5vh;
      margin-bottom: 5vh;
      margin-left: 10vw
    }
    div {
      text-align: center;
    }
    #aa {
      width: 100vw;
      text-align: center;
    }
    </style>
  </head>
  <header>
    <h2>Les noms proposés :</h2>
  </header>
    <form method="POST" action="{{ url('/voted') }}">
      <h5>Vous pouvez voter pour plusieurs noms et/ou en proposer un nouveau</h5>
      {{ csrf_field() }}
      @foreach ($proposed_titles as $title)
        <input type="checkbox" name="{{ $title->id }}">{{ $title->name }}<br>
      @endforeach
      <label>Proposer son nom (vote automatiquement pour celui ci):<br>il doit être en français, et comporter "Paris" </label><input style="margin-left:10px" type="text" placeholder="nom" name="new_name">
      <br><input type="submit" value="Voter" class="btn btn-success">
    </form>
    <div id="aa">
      <a href="{{ url('/see_vote') }}" class="btn btn-danger">Revenir à l'accueil</a>
    <div>
</body>
</html>
