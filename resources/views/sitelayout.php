
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>@yield('title')</title>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link href="/css/test.css" rel="stylesheet">
   
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>



    

</head>

<body>
<navbar>
        <div class="nav-links-container">
            <img src="logo.png" width="95" height="75" padding="0">
            <h1>{{ $title }}</h1><br>
            
            
        </div>
    
    <navbar>
        <div class="nav-links-container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="/home" class="nav-link">Home</a>
                </li>
                <li class="nav-item active">
                    <a href="/picks" class="nav-link">Picks</a>
                </li>
                <li class="nav-item active">
                    <a href="/stats" class="nav-link">Stats</a>
                </li>
                <li class="nav-item active">
                    <a href="/rules" class="nav-link">Rules</a>
                </li>
                @isadmin
                    <li class="nav-item active">
                    <a href="/admin" class="nav-link">Home</a>
                </li>
                @endisadmin
                <!--
                <li class="nav-item active">
                    <a href="/games" class="nav-link">Games</a>
                </li>
                @isadmin
                <li class="nav-item active">
                    <a href="{{ route('user.index')}}" class="nav-link">Profiles</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('games.index')}}" class="nav-link">Games</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('conference.index')}}" class="nav-link">Conferences</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('division.index')}}" class="nav-link">Divisions</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('divisiontitles.index')}}" class="nav-link">Division Titles</a>
                </li>
                @endisadmin
                <li class="nav-item active">
                    <a href="{{ route('nbi.index')}}" class="nav-link">NBI</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('alltimerank.index')}}" class="nav-link">Rank</a>
                </li>
-->
            </ul>
            
        </div>
    </navbar>
    <contentBox><content>
      @yield('content')
    </content></contentBox>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
   integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
   integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>

</html>
