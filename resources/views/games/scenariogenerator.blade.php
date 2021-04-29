@extends('sitelayout')
@section('pagetitle', ': Picks')
@section('content')

<div ng-app="myApp" ng-controller="myCtrl as ctrl">

    <table class="conference">
        <tr>
            <th colspan="2">Game Picks</th>
        </tr>
        <!-- the user can edit and the picks are ready to be picked -->
        @foreach($games as $game)


        @if ($game->scoredflag == 'yes')
        <tr class="table-warning">
            <td class="top"><a class="center"
                    href="https://www.espn.com/mens-college-basketball/game?gameId={{$game->id}}">{{ $game->name }}
                    ({{$game->points }} Points)</a></td>
        </tr>

        <tr>
            <td style="text-align:center; ">

                <div class="switch-field">
                    <label class="left scored">
                        <table style="background-color: inherit; color: inherit">
                            <tr>
                                <td style="padding: 0px; padding-right: 10px"><img
                                        src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30">
                                </td>
                                <td style="padding: 0px">{{ $game->team1Name }}</td>

                            </tr>
                        </table>
                    </label>
                    <label class="score scored"><span>{{ $game->team1_score }}</span></label>
                    <label class="score scored"><span>{{ $game->team2_score }}</span></label>
                    <label class="right scored">
                        <table style="background-color: inherit; color: inherit">
                            <tr>


                                <td style="padding: 0px">{{ $game->team2Name }}</td>
                                <td style="padding: 0px; padding-left: 10px"><img
                                        src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30">
                                </td>

                            </tr>
                        </table>
                    </label>


                </div>



            </td>
        </tr>
        <tr class="table-warning">
            <td class="center bot mbold">Date: {{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}<p>
            </td>
        </tr>
        @else
        <tr class="table-warning">
            <td class="top"><a class="center"
                    href="https://www.espn.com/mens-college-basketball/game?gameId={{$game->id}}">{{ $game->name }}
                    ({{$game->points }} Points)</a></td>
        </tr>

        <tr>
            <td>
                <div class="switch-field">
                    <input ng-click="ctrl.selectWinner({{$game->espnID}},{{$game->team1}},{{$game->points}})"
                        id="{{$game->team1}}" type="radio" name="{{$game->espnID}}" value="{{ $game->team1 }}">
                    <label for="{{$game->team1}}"><img class="left"
                            src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"><span>{{ $game->team1Name }}</span></label>
                    <input ng-click="ctrl.selectWinner({{$game->espnID}},{{$game->team2}},{{$game->points}})"
                        id="{{$game->team2}}" type="radio" name="{{$game->espnID}}" value="{{ $game->team2 }}"><label
                        for="{{$game->team2}}">{{ $game->team2Name }}<img class="right"
                            src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></label>
                </div>
            </td>
        </tr>

        <tr class="table-warning">
            <td class="center bot mbold">Date: {{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}<p>
            </td>
        </tr>
        @endif


        @endforeach








    </table>


    <table class="conference">
        <tr>
            <th colspan="7">Division: {{ $division }}</a></th>
        </tr>
        <tr>
            <td><label class="label">Rank</label></td>

            <td><label class="label">Name</label></td>
            <td><label class="label">Score</label></td>
            <td><label class="label">W</label></td>
            <td><label class="label">L</label></td>
            <td><label class="label">Streak</label></td>
        </tr>
        <tr ng-repeat="user in ctrl.users | orderBy:'rank'">
            <td style="align-text: center">[[ user.tie ]][[ user.rank ]]</td>
            <td>[[ user.firstname ]] "[[ user.nickname ]]" [[ user.lastname ]]</td>
            <td style="align-text: center">[[ user.score ]]</td>
            <td style="align-text: center">[[ user.wins ]]</td>
            <td style="align-text: center">[[ numGames - user.wins ]]</td>
            <td style="align-text: center">[[ user.streak ]][[ user.streakWL ]]</td>
            </td>




        </tr>



    </table>



</div>

<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
    //set js array to json array of blade profile
    $scope.numGames = {{ $numGames }};
        
    //alert(numGames);
    this.users = @json($users);

    //we're going to convert users to an


    this.users = this.users = this.users.sort((a, b) => {
        if (a.score > b.score) return -1;
        if (a.score < b.score) return 1;
        //ok got here so now sort on remainer...

        //michigan
        if (a.selMichigan > b.selMichigan) return -1;
        if (a.selMichigan < b.selMichigan) return 1;

        //notredame
        if (a.selNotredame > b.selNotredame) return -1;
        if (a.selNotredame < b.selNotredame) return 1;
        //wins
        if (a.wins > b.wins) return -1;
        if (a.wins < b.wins) return 1;
        //streakWL
        if (a.streakWL > a.streakWL) return -1;
        if (a.streakWL < a.streakWL) return 1;
        //streak
        if (a.streak > b.streak) return -1;
        if (a.streak < b.streak) return 1;



        return 0;
    });


    for (var j = 0; j < this.users.length; j++) {
        //console.log(this.users[j].nickname + " -> " + this.users[j].score);
        if (j == 0) {
            this.users[j].rank = 1;
        } else {
            var curr = this.users[j];
            var prev = this.users[j - 1];
            if ((curr.score == prev.score) && (curr.selMichigan == prev.selMichigan) &&
                (curr.streakWL == prev.streakWL) && (curr.streak == prev.streak)) {
                curr.rank = prev.rank;

            } else {
                curr.rank = prev.rank + 1;
            }


        }
        //console.log(this.users[j].score);
    }
    //tie
    for (var j = 0; j < this.users.length; j++) {
        //console.log(this.users[j].nickname + " -> " + this.users[j].score);
        if (j == 0) {
            //first one
            if (this.users[j].rank == this.users[j + 1].rank) {
                this.users[j].tie = "T";
            } else {
                this.users[j].tie = "";
            }
        } else if (j == (this.users.length - 1)) {
            //last one
            if (this.users[j].rank == this.users[j - 1].rank) {
                this.users[j].tie = "T";
            } else {
                this.users[j].tie = "";
            }
        } else {
            //middle
            if (this.users[j].rank == this.users[j - 1].rank || this.users[j].rank == this.users[j + 1].rank) {
                this.users[j].tie = "T";
            } else {
                this.users[j].tie = "";
            }
        }

    }


    this.picks = @json($results);


    //select winner method -> runs after selection is made
    this.selectWinner = function(game, selection, points) {
        //show params
        //alert("Game: " + game + " :sel: " + selection + " :pts: " + points);
        //loop through picks
        for (var i = 0; i < this.picks.length; i++) {
            //get the game
            if (this.picks[i].gameid == game) {
                //in either case, this game is scored (important in streaks)
                this.picks[i].scored = true;

                //game is correct
                if (this.picks[i].selection == selection) {
                    //pick is correct
                    //alert(this.picks[i].userid + " got the pick correct");
                    //was the score already there?
                    if (this.picks[i].score == 0) {
                        //add score
                        this.picks[i].score = 3;
                        //now try to add score to the user
                        for (var j = 0; j < this.users.length; j++) {
                            if (this.users[j].id == this.picks[i].userid) {
                                //add to score
                                this.users[j].score = this.users[j].score + points;
                                //alert(this.users[j].id);
                                //add to wins
                                this.users[j].wins = this.users[j].wins + 1;

                            }

                        }
                    }
                } else {

                    //pick is incorrect
                    //was the score already there?
                    if (this.picks[i].score != 0) {
                        //it wasn't so, we need to remove points
                        this.picks[i].score = 0;
                        for (var j = 0; j < this.users.length; j++) {
                            if (this.users[j].id == this.picks[i].userid) {
                                //add to score
                                this.users[j].score = this.users[j].score - points;
                                //alert(this.users[j].id);
                                //add to wins
                                this.users[j].wins = this.users[j].wins - 1;

                            }

                        }

                    }






                } //end bad selection

            } //end game check


        } //end for loop


        
        //we actually have to work our way back through the picks to see how many correct...
        for (var j = 0; j < this.users.length; j++) {

            var id = this.users[j].id;
            //loop backwards through the picks
            var wl = '';
            var streak = 0;
            for (var i = (this.picks.length - 1); i >= 0; i--) {
                

                /** this is NOT compiling */

                if (id == this.picks[i].userid) {
                    //alert();
                    if (this.picks[i].scored || this.picks[i].scoredflag === "yes") {
                        //if (id == this.picks[i].userid && this.picks[i].scored) {
                        if (this.picks[i].score != 0) {
                            //user got it correct
                            if (wl == '' || wl == 'W') {
                                wl = 'W';
                                streak = streak + 1;
                            } else {
                                //found one that is incorrect
                                break;
                            }
                        } else {
                            if (wl == '' || wl == 'L') {
                                wl = 'L';
                                streak = streak + 1;
                            } else {
                                //found a correct pick
                                break;
                            }
                        }

                    }
                } ///end if id
            }

            this.users[j].streak = streak;
            this.users[j].streakWL = wl;

        }
       
        //ok, one more thing to do... we are going to sort and create a rank...
        this.users = this.users = this.users.sort((a, b) => {
            if (a.score > b.score) return -1;
            if (a.score < b.score) return 1;
            //ok got here so now sort on remainer...

            //michigan
            if (a.selMichigan > b.selMichigan) return -1;
            if (a.selMichigan < b.selMichigan) return 1;

            //notredame
            if (a.selNotredame > b.selNotredame) return -1;
            if (a.selNotredame < b.selNotredame) return 1;
            //wins
            if (a.wins > b.wins) return -1;
            if (a.wins < b.wins) return 1;
            //streakWL
            if (a.streakWL > a.streakWL) return -1;
            if (a.streakWL < a.streakWL) return 1;
            //streak
            if (a.streak > b.streak) return -1;
            if (a.streak < b.streak) return 1;



            return 0;
        });


        for (var j = 0; j < this.users.length; j++) {
            console.log(this.users[j].nickname + " -> " + this.users[j].score);
            if (j == 0) {
                this.users[j].rank = 1;
            } else {
                var curr = this.users[j];
                var prev = this.users[j - 1];
                if ((curr.score == prev.score) && (curr.selMichigan == prev.selMichigan) &&
                    (curr.streakWL == prev.streakWL) && (curr.streak == prev.streak)) {
                    curr.rank = prev.rank;

                } else {
                    curr.rank = prev.rank + 1;
                }


            }
            //console.log(this.users[j].score);



        }

        //tie
        for (var j = 0; j < this.users.length; j++) {
            //console.log(this.users[j].nickname + " -> " + this.users[j].score);
            if (j == 0) {
                //first one
                if (this.users[j].rank == this.users[j + 1].rank) {
                    this.users[j].tie = "T";
                } else {
                    this.users[j].tie = "";
                }
            } else if (j == (this.users.length - 1)) {
                //last one
                if (this.users[j].rank == this.users[j - 1].rank) {
                    this.users[j].tie = "T";
                } else {
                    this.users[j].tie = "";
                }
            } else {
                //middle
                if (this.users[j].rank == this.users[j - 1].rank || this.users[j].rank == this.users[j + 1]
                    .rank) {
                    this.users[j].tie = "T";
                } else {
                    this.users[j].tie = "";
                }
            }

        }





    };


}).config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});;
</script>

@endsection