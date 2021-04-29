
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title> @title() @yield('pagetitle', '')</title>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link href="/css/test.css" rel="stylesheet">
   
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>


</head>

<body>
<titlebar>
    <div class="nav-links-container">
        <img src="http://nolanbowl.com/images/Nolan%20Bowl%20final.png" width="95" height="75" padding="0">
        <h1>@title() @yield('pagetitle', '')</h1>
        <a href="/" onclick="menuappear()"><i class="material-icons menu">menu</i></a>

    </div>
    </titlebar>
    <navbar class="collapsable">
        <div class="nav-links-container">
            
            <ul class="navbar-nav mr-auto">
                
                <li class="nav-item active">
                    <a href="/home" class="nav-link">Home</a>
                </li>
                <li class="nav-item active">
                    <a href="/picks" class="nav-link">Picks</a>
                </li>
                @userssorted
                <li class="nav-item active">
                    <a href="/standings" class="nav-link">Standings</a>
                </li>
                @enduserssorted
                <li class="nav-item active">
                    <a href="/stats" class="nav-link">Stats</a>
                </li>
                <li class="nav-item active">
                    <a href="/rules" class="nav-link">Rules</a>
                </li>
                @isadmin
                    <li class="nav-item active">
                    <a href="/admin" class="nav-link">Admin</a>
                </li>
                @endisadmin
                <li class="nav-item active">
                    <a href="/logout" class="nav-link">Logout</a>
                </li>
                
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
