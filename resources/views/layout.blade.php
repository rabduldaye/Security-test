<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>GenericBowl</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   @yield('css')
</head>

<body>
  <div class="container">
  @if (auth('admin'))
    <tr><a href="{{ route('user.index')}}" class="btn btn-primary btn-sm">Profiles</a></tr>
    <tr><a href="{{ route('games.index')}}" class="btn btn-primary btn-sm">Games</a></tr>
    <tr><a href="{{ route('conference.index')}}" class="btn btn-primary btn-sm">Conferences</a></tr>
    <tr><a href="{{ route('division.index')}}" class="btn btn-primary btn-sm">Divisions</a></tr>
    <tr><a href="{{ route('topperformance.index')}}" class="btn btn-primary btn-sm">TopPerformance</a></tr>
    <tr><a href="{{route('map.index')}}" class="btn btn-primary btn-sm">Location</a></tr>
@endif
    <tr><a href="{{ route('nbi.index')}}" class="btn btn-primary btn-sm">NBI</a></tr>
  </div>
   <div class="container">
      @yield('content')
   </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
   integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
   integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
   integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
