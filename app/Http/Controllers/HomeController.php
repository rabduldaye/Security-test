<?php

namespace App\Http\Controllers;
use Auth;
use NumberFormatter;
use App\Models\Config;
use App\Models\User;
use App\Models\GamePick;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {

      //this will actually do quite a few things
      $gamesplayed = DB::table('games')->where('scoredflag','=','yes')->count();
      $gamestotal = DB::table('games')->count();
      $gamespercent = (double)$gamesplayed/$gamestotal;

      $pointsleft = DB::table('games')->where('scoredflag','=','no')->sum('points');

      $yourpoints = Auth::user()->score;
      
      $rando = User::inRandomOrder()->first();
      $smack = $rando->smack;
      $smackuser = $rando->fullname;
      
      $config = Config::firstOrNew();
     
      
        //rank in league
        $sqlstring = '';
        $sqlstring = $sqlstring . 'select id, nickname, score, myrank, equalscores FROM (select id, nickname, score, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) AS myrank ';
        $sqlstring = $sqlstring . 'from users) as temp LEFT JOIN (select scrank, count(scrank) as equalscores from (select id, nickname, score, RANK() OVER(ORDER ';
        $sqlstring = $sqlstring . 'BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as scrank from users) as results group by scrank) as temp2 ON myrank = temp2.scrank ';
        $sqlstring = $sqlstring . 'where id = ' . Auth::user()->id;
        $standings = DB::select(DB::raw($sqlstring));
        
        $leagueRank = $standings[0]->myrank;
        $leagueTie = ($standings[0]->equalscores > 1) ? true : false;
        
        //rank in conference
        

        $sql = "select id score, myrank, equalscores FROM (select id, nickname, score, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as myrank from users where conference = \n"

        . "'". Auth::user()->conference ."'\n"

        . ") as temp LEFT JOIN (select scrank, count(scrank) as equalscores from (select id, nickname, score, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as scrank from users where conference = \n"

        . "'". Auth::user()->conference ."'\n"

        . ") as results group by scrank) as temp2 ON myrank = temp2.scrank where id = \n"

        . Auth::user()->id;
        $standings = DB::select(DB::raw($sql));
        
        $confRank = $standings[0]->myrank;
        $confTie = ($standings[0]->equalscores > 1) ? true : false;
        

        //rank in division
        $sql = "select id score, myrank, equalscores FROM (select id, nickname, score, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as myrank from users where division = \n"

        . "'". Auth::user()->division ."'\n"

        . ") as temp LEFT JOIN (select scrank, count(scrank) as equalscores from (select id, nickname, score, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as scrank from users where division = \n"

        . "'". Auth::user()->division ."'\n"

        . ") as results group by scrank) as temp2 ON myrank = temp2.scrank where id = \n"

        . Auth::user()->id;

        $standings = DB::select(DB::raw($sql));
        
        $divRank = $standings[0]->myrank;
        $divTie = ($standings[0]->equalscores > 1) ? true : false;

        //top three in division, conference, league

        $leagueTopThree = DB::table('users')
        ->where('status', '=', 'current')
        ->where('division', "<>", '')
        ->orderBy('score', 'desc')
        ->orderBy('selMichigan', 'desc')
        ->orderBy('selNotredame', 'desc')
        ->orderBy('wins', 'desc')
        ->orderBy('streakWL', 'desc')
        ->orderBy('streak', 'desc')
        ->select(DB::raw('*, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
        ->take(3)
        ->get(
            ['id',
             'firstname',
             'nickname',
             'lastname',
             'score',
             'division',
             'wins',
             'streak',
             'streakWL',
             'conference',
             'playerrank',
             
        ]);
        //handle ties
        $this->handleTies($leagueTopThree);
        //now the conference
        $conferenceTopThree = DB::table('users')
            ->where('status', '=', 'current')
            ->where('division', "<>", '')
            ->where('conference', '=', Auth::user()->conference)
            ->orderBy('score', 'desc')
            ->orderBy('selMichigan', 'desc')
            ->orderBy('selNotredame', 'desc')
            ->orderBy('wins', 'desc')
            ->orderBy('streakWL', 'desc')
            ->orderBy('streak', 'desc')
            ->select(DB::raw('*, RANK() OVER(PARTITION BY conference ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
            ->take(3)
            ->get(
                ['id',
                 'firstname',
                 'nickname',
                 'lastname',
                 'score',
                 'division',
                 'wins',
                 'streak',
                 'streakWL',
                 'conference',
                 'playerrank',
                 
            ]);    
        
        //handle ties
        $this->handleTies($conferenceTopThree);
        //now the division      
        $divisionTopThree = DB::table('users')
            ->where('status', '=', 'current')
            ->where('division', '=', Auth::user()->division)
            ->orderBy('score', 'desc')
            ->orderBy('selMichigan', 'desc')
            ->orderBy('selNotredame', 'desc')
            ->orderBy('wins', 'desc')
            ->orderBy('streakWL', 'desc')
            ->orderBy('streak', 'desc')
            ->select(DB::raw('*, RANK() OVER(PARTITION BY conference ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
            ->take(3)
            ->get(
                ['id',
                 'firstname',
                 'nickname',
                 'lastname',
                 'score',
                 'division',
                 'wins',
                 'streak',
                 'streakWL',
                 'conference',
                 'playerrank',
                 
            ]); 
        //handle ties
        $this->handleTies($divisionTopThree);

        //get my picks
        //$mypicks = GamePick::where('userid','=',Auth::user()->id)->get();
        //$countMyPicks = count($mypicks);
        $mypicks = DB::table('game_picks')
          ->join('games', 'game_picks.gameid', '=', 'games.espnID')
          ->where('userid','=',Auth::user()->id)
          ->orderby('date')
          ->get();
       // dd($mypicks);
        $countMyPicks = count($mypicks);
        //loop through
        


        //we need the number of games
        $numGames = count(Game::all());  
        
        //upcoming games
        $upcomingGames = Game::where('scoredflag','=','no')->orderBy('date')->take(3)->get();
        
        $nogames = true;
        if (count($upcomingGames) > 0) {
            $nogames = false;
        }

        $locale = 'en_US';
        $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);
        $divRank = $nf->format($divRank);
        $confRank = $nf->format($confRank);
        $leagueRank = $nf->format($leagueRank);

        //dd($divRank);
        //dd($mypicks);
        
        return view('home.index', compact('upcomingGames','numGames','mypicks','countMyPicks','divisionTopThree','leagueTopThree','conferenceTopThree',
                    'divRank','divTie','confRank','confTie','leagueRank','leagueTie','smack','yourpoints','gamespercent','gamestotal','gamesplayed', 'smackuser',
                  'nogames'));
                    
      


      //only if locked
      //we need ranks for player      
      //we need top three for league, division, conferenceUser::inRandomOrder()->first();
      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {

        $usercount = count(DB::table('users')->get());

        $gamecount = count(DB::table('games')->get());

        $scoredGames = count(DB::table('games')->where('scoredflag','<>','no')->get());
    
        $pickCount = count(DB::table('game_picks')->get());

        $numPlayers = count(DB::table('users')->where('status','=','current')->get());

        $sql = "select * from (select count(*) as num from game_picks group by userid) as temp where temp.num > 0 AND temp.num < " . $gamecount;
        $numPlayersWithPicksShort = count(DB::select(DB::raw($sql)));
        //dd($numPlayersWithPicksShort);

        //recent picks
        //recent profile changes
        $last3profileUpdates = DB::table('users')->orderby('updated_at','desc')->take(3)->get();
        //last 3 picks made 
        $last3picksMade = DB::table('game_picks')->leftJoin('users', 'users.id', '=', 'game_picks.userid')->leftJoin('games', 'games.espnID', '=', 'game_picks.gameid')->orderby('game_picks.created_at')->take(3)->get();
        //dd($last3picksMade);
        //upcoming games
        $upcomingGames = Game::where('scoredflag','=','no')->orderBy('date')->take(3)->get();
        
        $nogames = true;
        if (count($upcomingGames) > 0) {
            $nogames = false;
        }

        //we need to do something special for this
        $config = Config::firstOrNew();
        $sortedUsers =  $config->userssortedflag;
        if ($config->seasonlock == "no") {
          $locked = false;
        } else {
          $locked = true;
        }


        return view('admin.index', compact('upcomingGames','usercount','gamecount','scoredGames','pickCount','numPlayers','numPlayersWithPicksShort',
                    'last3profileUpdates','last3picksMade','nogames','sortedUsers','locked'));
        
    }


    public function handleTies($standings) {
      //dd($standings);
      $num = count($standings);

      if ($num > 1) {

      

      //before we return it, let's massage it
      foreach ($standings as $key=>$var){
          //is it the last one? if so only check the one before
          if ($key == ($num - 1)) {
              //for the last one, we need to check the one before
              if($var->playerrank == $standings[$key-1]->playerrank){
                  //they have the same player rank so add T
                  $var->rank = 'T' . $var->playerrank;
              } else {
                  $var->rank = $var->playerrank;
              }

          //is it the first one? if so only check after
          } else if ($key == 0) {
              //for every one but the last one
              if($var->playerrank == $standings[$key+1]->playerrank){
                  //they have the same player rank so add T
                  $var->rank  = 'T' . $var->playerrank;
              } else {
                  $var->rank = $var->playerrank;
              }
          //for all others (check before AND after)
          } else {
              if (($var->playerrank == $standings[$key+1]->playerrank) or ($var->playerrank == $standings[$key-1]->playerrank)) {
                  //they have the same player rank so add T
                  $var->rank  = 'T' . $var->playerrank;
              } else {
                  $var->rank = $var->playerrank;
              }
          }
          
      }

    } else {
        //only one so 1
        $standings[0]->rank = 1;
    }

    } //end function

}
