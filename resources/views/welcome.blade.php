<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="/css/test.css" rel="stylesheet">
</head>
<body>
<!--
    <navbar>
        <div class="nav-links-container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('register')}}" class="nav-link">Register</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('login')}}" class="nav-link">Login</a>
                </li>
            </ul>
        </div>
    </navbar> -->
    <contentBox>

@section('content')
        <div class="container-md">
        <br>
            <div class="row" >
                <div class="card">
                    <div class="card-header">NOLAN BOWL RULES</div>
                    <div class="card-body">
                        <div class="card-content">
                            1. Each bowl game is assigned a point value that corresponds roughly to its relative payout (so "how good" the bowl is), selected by 'The Admin'. Better bowls are worth more points, and the highest point total wins.
                            <br><br>
                            2. TIEBREAKERS: (a) The 1st tiebreaker is "did you pick Michigan?" with those who did not being eliminated in favor of those who did [Go Blue!]; (b) The 2nd tiebreaker is "did you pick Notre Dame?" with those who did being eliminated in favor of those who did not [the "Returning to Glory since 1993" provision]; (c) If there is still a tie, cumulative overall number of games picked correctly will determine the champion; (d) In the event a tie is STILL in effect, we will begin with the final bowl and work backward through the games, eliminating those that picked incorrectly closest to the end of the bowl season until a winner emerges; (e) If there is still a tie (identical submissions), a coin will be flipped to determine the champion.
                            <br><br>
                            3. Divisions and Conferences will be created and named arbitrarily by 'The Admin', and mean nothing in terms of winning the pool. They're just fun.
                            <br><br>
                            4. Entry for Nolan Bowl XX is 免费 (free, as always), and the grand prize is status as Nolan Bowl XX Champion, which gains you admission to the Nolan Bowl Hall of Champions.
                            <br><br>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </contentBox>
</body>
</html>
