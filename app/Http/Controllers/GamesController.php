<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Games;
use App\Models\User;
use App\Models\GamePick;
use App\Models\InSeason;
use App\Models\Config;
use App\Models\SetSeason;
use Illuminate\Support\Arr;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource. (shows a list of games)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $games = games::all();


        //we need to do something special for this
        $config = Config::firstOrNew();
        if ($config->seasonlock == "no") {
          $locked = false;
        } else {
          $locked = true;
        }

        


      return view('games.index', compact('games', 'locked'));
    }

    /**
     * Display the make your picks page
     *
     * @return \Illuminate\Http\Response
     */



    public function pickDistro() {

      $sql = "select *, (select count(selection) from game_picks where games.team1 = selection) as selt1,  (select count(selection) from game_picks where games.team2 = selection) as selt2 from games";
      $games = DB::select(DB::raw($sql));

      //dd($games);

      
      return view('games.gamepickdistro', compact('games'));


    }


    public function showPicks($id) {
        
        
      //can the user edit?
      $canedit = ((Auth::user()->is_admin != 0) or (Auth::user()->id == $id));

      //we need to make sure user exists...
      $user = User::find($id);
      //user doesn't exist... bug out
      if ($user == null) {
        return redirect('/')->with('Error Showing Picks', 'user does not exist!');
      }

      //we need the number of games
     //we need the number of games
     $numGames = count(DB::table('games')->where('scoredflag','<>','yes')->get());
      //need the user ID
        

      //we need to set up the game picks table
      $gamepicks = DB::table('game_picks')->where('userid', '=', $id);

      $games = DB::table('games')
        ->leftJoinSub($gamepicks, 'picks', function ($join) {
                $join->on('games.espnID', '=', 'picks.gameid');
            })->orderby('games.date')
              ->get(
              ['games.id',
              'games.espnID',
              'games.name',
              'games.date',
              'games.team1',
              'games.team2',
              'games.scoredflag',
              'games.team1Name',
              'games.team1_score',
              'games.team2_score',
              'games.team2Name',
              'games.points',
              'picks.score',
              'picks.selection'

            ]);



        //we need to do something special for this
        $config = Config::firstOrNew();
        if ($config->seasonlock == "no") {
          $locked = false;
        } else {
          $locked = true;
        }

        return view('games.gamepicks2', compact('games', 'numGames', 'locked', 'canedit','id'));
    }




    public function picks() {
       
        
      //can the user edit?
      $canedit = true;

        //we need the number of games
        $numGames = count(DB::table('games')->where('scoredflag','<>','yes')->get());
        //need the user ID
        $id = Auth::user()->id;

        //we need to set up the game picks table
        $gamepicks = DB::table('game_picks')->where('userid', '=', $id);

        $games = DB::table('games')
            ->leftJoinSub($gamepicks, 'picks', function ($join) {
                $join->on('games.espnID', '=', 'picks.gameid');
            })->orderby('games.date')->get(
              ['games.id',
              'games.espnID',
              'games.name',
              'games.date',
              'games.team1',
              'games.team2',
              'games.scoredflag',
              'games.team1Name',
              'games.team1_score',
              'games.team2_score',
              'games.team2Name',
              'games.points',
              'picks.score',
              'picks.selection'

            ]);



        //we need to do something special for this
        $config = Config::firstOrNew();
        if ($config->seasonlock == "no") {
          $locked = false;
        } else {
          $locked = true;
        }

        return view('games.gamepicks2', compact('games', 'numGames', 'locked', 'canedit','id'));
    }


    public function scenarioGenerator() {

      //we need to do something special for this
      $config = Config::firstOrNew();
      //now check for at least the following
      if ($config->seasonlock != "yes" || $config->userssortedflag != "yes") {
        //get back!
        return redirect('/')->with('permission denied', 'scenario generator is not ready!');
      }



      //get your ID
      $id = Auth::user()->id;
      //get your division
      $division = Auth::user()->division;
      //sub query for IN
      //$results = collect([]);
      //select id, firstname,nickname, lastname,score, wins, streak, streakWL  from users;
      $users = DB::table('users')->where('division','=',$division)->select(['id','firstname','nickname','lastname','score','wins', 'streak','streakWL'])->get();
      $users = $users->toArray();
      $ids = DB::table('users')->where('division','=',$division)->select('id');


      
      //->join('contacts', 'users.id', '=', 'contacts.user_id')->select('users.*', 'contacts.phone', 'orders.price')
      $results = DB::table('game_picks')
        ->whereIn('userid',$ids)
        ->join('games', 'games.espnID', '=', 'game_picks.gameid')
        ->select('game_picks.userid','game_picks.gameid', 'game_picks.selection','game_picks.score','games.date', 'games.points', 'games.scoredflag')
        ->orderBy('games.date')->get();
        //$results = Arr::add($results, $id, $picks);
      //dd($results);
      
      //we need games too
      $games = DB::table('games')->orderby('date')->get();

      $numGames = count($games);
      //dd($numGames);
      return view('games.scenariogenerator', compact('games', 'division', 'users', 'results', 'numGames'));
     

    }

    /**
     * store the picks you saved
     *
     * @return \Illuminate\Http\Response
     */

    public function storepicks(Request $request)
    {
      
      //we need the number of picks in the request
      $numPicks = count($request->all());
      //actual number is one less (CSRF token)
      $numPicks = $numPicks - 1;
      //we need the number of games
      $numGames = count(Games::all());
      //need the user ID
      $id = $request->input('id');
      
      
      //can the user edit?
      $canedit = ((Auth::user()->is_admin != 0) or (Auth::user()->id == $id));
      //bug out if not
      if (!$canedit) {
        return redirect('/')->with('permission denied', 'you do not have permissiont to do that!');
      }


      //loop through the request (keys/values)
      foreach($request->all() as $key => $value) {
          //skip csrf token
          if ($key != "_token" and $key != 'id') {
              //for each pick put in DB
              $pick = GamePick::updateOrCreate(
                  ['userid' => $id, 'gameid' => $key ],
                  ['selection' => $value]

              );
          }

      }


      if ($numPicks == $numGames) {
        //all the picks are in
        //enter the user into the inseason db
        //everything is default except the userid
        $user = User::findorfail($id);
        $user->status = "current";
        $user->save();
        

        return redirect('/')->with('completed', 'all picks have been saved!');

      } else {
        //all the picks are not in
        return redirect('/picks')->with('completed', 'some picks have been saved!');
      }


  }

    
    /**
     * Show the form for creating a game.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('games.create');
    }

    /**
     * Store a newly created game in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        $storeData = $request->validate([
            'name' => 'required|max:255',
            'date' => 'max:255',
            'espnID' => 'required|max:255',
            'team1' => 'required|max:255',
            'team1Name' => 'required|max:255',
            'team2' => 'required|max:255',
            'team2Name' => 'required|max:255',
            'points' => 'required|numeric',
            
        ]);
          
        Games::create($storeData);
        return redirect('/games')->with('success', 'Games has been saved!');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $games = games::findOrFail($id);
      return view('games.edit', compact('games'));
    }


    /**
     * Show the form for editing the specified game score.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function setScore($id) {
        

      $games = games::findOrFail($id);
      return view('games.setscore', compact('games')); 
    }

   /**
     * update the score for the given game.
     * @param gameID
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function updateScore(Request $request, $id)
    {
      //two flags
      $alreadyscored = false;
      $scoreflipped = false;

      //first make sure we have scores for both teams
      $updateData = $request->validate([
        'team1_score' => 'required|numeric|min:0',
        'team2_score' => 'required|numeric|min:0',
            
      ]);
      //get the game
      $game = games::findOrFail($id);
      //save the data to the game
      if ($game->scoredflag != "no") {
        $alreadyscored = true;
        //check the winner situation
        if ($game->team1_score > $game->team2_score) {
          //result flipped...
          if (intval($updateData["team1_score"]) <= intval($updateData["team2_score"])) {
            $scoreflipped = true;  
          }
          
        } else {
          //result flipped...
          if (intval($updateData["team1_score"]) > intval($updateData["team2_score"])) {
            $scoreflipped = true;  
          }
        }
        

      }
      //we still need to update the score...
      $game->team1_score = intval($updateData["team1_score"]);
      $game->team2_score = intval($updateData["team2_score"]);
      $game->scoredflag = "yes";
      //save the updates
      $game->save();
      
      //who won? set a sentinel (for ties/unsetting the score)
      //we'll use this value to reset the scores
      $winner = -1;
      
      //is team1 the winner
      if ($game->team1_score > $game->team2_score) {
        $winner = $game->team1; 
      } else {
        //or is team2?
        $winner = $game->team2;
      }
 
      //query for Users (we need to update season stats)
      $gamepicks = User::join('game_picks', 'users.id', "=", 'game_picks.userid')
      ->where('gameid',"=", $game->espnID)
      ->get(
        ['users.id as id',
        'users.score',
        'users.wins',
        'users.streak',
        'users.streakWL',
        'game_picks.selection',
      ]);
    
      $fixstreaks = false;
      //now loop through game picks
      foreach($gamepicks as $gamepick) {
        //now we can see if the pick is a winner/loser
        //is the pick a winner?
        if ($gamepick->selection == $winner)  {
          //award the points
          //we have a couple of issues
          //if already scored but no flip -> do nothing  (the points have already been added)
          //if not already scored, add the points
          //if already scored and a flip occurred, add the points (the points haven't been added)
          if ((!$alreadyscored) or ($alreadyscored and $scoreflipped)) {
            //add to the score
            $gamepick->score = $gamepick->score + $game->points;
            //add to wins
            $gamepick->wins = $gamepick->wins + 1; 
            //modify streak next
            if ($alreadyscored) {
              //need to call fixstreaks method
              $fixstreaks = true;
            } else {
              //dd($gamepick->streakWL);
              //do normal streak
              if ($gamepick->streakWL != 'W') {
                $gamepick->streakWL = 'W';
                $gamepick->streak = 1;
              } else {
                $gamepick->streak = $gamepick->streak + 1; 

              }
            }
            //we need to actually save these
            $gamepick->update([
              'score' => $gamepick->score,
              'wins' => $gamepick->wins,
              'streak' => $gamepick->streak,
              'streakWL' => $gamepick->streakWL,
            ]);




          }
          //finally set up gamepicks correctly
          DB::table('game_picks')
              ->where('gameid', '=', $game->espnID)
              ->where('userid', '=', $gamepick->id)
              ->update(['score' => $game->points]);
          
        } else {
          //remove the points
          //fix streak
          //we have a couple of issues
          //if already scored but no flip -> do nothing  (the points haven't been added)
          //if not already scored, do nothing... you get no points
          //if already scored and a flip occurred, remove the points
          if ((!$alreadyscored) or ($alreadyscored and !$scoreflipped)) {
            //fix streak
            //do normal streak
            if ($gamepick->streakWL != 'L') {
              $gamepick->streakWL = 'L';
              $gamepick->streak = 1;
            } else {
              $gamepick->streak = $gamepick->streak + 1; 
            }



          } else {
            //remove the points from user
            $gamepick->score = $gamepick->score - $game->points;
            //remove a win from the user
            $gamepick->wins = $gamepick->wins - 1; 
            //call fix streak method
            $fixstreaks = true;
          }
          
          //we need to actually save these
          $gamepick->update([
            'score' => $gamepick->score,
            'streak' => $gamepick->streak,
            'streakWL' => $gamepick->streakWL,
          ]);

          //no matter what, fix the picks table
          DB::table('game_picks')
              ->where('gameid', '=', $game->espnID)
              ->where('userid', '=', $gamepick->id)
              ->update(['score' => 0]);


        }

      } //end game pick loop

      //if we have to fix streaks fix 'em
      if ($fixstreaks) {
        //does all users
        $this->fixStreaks();
      }
    
      //go back to games when you're done!
      return redirect('/games')->with('completed', 'games has been updated');
  }

  
  public function fixStreaks() {
    //all hell has broken loose! Now, we have to handle streaks on our own!
    //a couple of assumptions -> games are played in order of their dates rather than their
    //selection (which is pretty normal)... however, if the admin updates scores out of order,
    //this will be available for the admin (use as a last resort)... it'll be slow.

    //need to handle streaks with out of order updating of scores
    //IE, admin sets winner, winner changes down the line... streaks is fucked

    //ok the first thing we need are the users
    //just get them all
    $users = User::all();
    //now loop through them
    foreach ($users as $user) {
      //now we need each pick in reverse order of the play
      //IE, we need the most recent first
      //no matter what, fix the picks table
      $picks = DB::table('game_picks')
      ->where('userid', '=', $user->id)
      ->join('games', 'game_picks.gameid', '=', 'games.espnID')
      ->where('games.scoredflag', '=', "yes")
      ->orderBy('games.date', 'desc')
      ->get([
        'game_picks.score',
        'games.date'
      ]);
      //init
      $streak = 0;
      if ($picks[0]->score != 0) {
        $streakWL = 'W';          
      } else {
        $streakWL = 'L';
      }

      //$streakWL = $picks;
      //dd($picks);
      foreach ($picks as $pick) {
        if ($pick->score != 0) {
          if ($streakWL == 'W') {
            $streak = $streak + 1;
          } else {
            //break -> the streak is over
            break;
          }          
        } else {
          if ($streakWL == 'L') {
            $streak = $streak + 1;
          } else {
            //break -> the streak is over
            break;
          }      
        }
      }

      //now update $user
      $user->streak = $streak;
      $user->streakWL = $streakWL;
      $user->update();
      


    }

    


  }

  public function updateScoreOLD(Request $request, $id)
  {

    //we need to do more than this... (update scores!)

    $updateData = $request->validate([
      'team1_score' => 'required|numeric|min:0',
      'team2_score' => 'required|numeric|min:0',
          
    ]);
    //get the game
    $game = games::findOrFail($id);
    //save the data to the game
    $game->team1_score = intval($updateData["team1_score"]);
    $game->team2_score = intval($updateData["team2_score"]);
    $game->save();
    
    //who won? set a sentinel (for ties/unsetting the score)
    //we'll use this value to reset the scores
    $winner = -1;
    
    //is team1 the winner
    if ($game->team1_score > $game->team2_score) {
      $winner = $game->team1; 
    } else {
      //or is team2?
      $winner = $game->team2;
    }
    
    //now let's get all gamepicks relative to this game
    $gamepicks = GamePick::where('gameid',"=", $game->espnID)->get();
    //now loop through game picks
    foreach($gamepicks as $gamepick) {
      //can't be winner if -1 so this is all we
      //need... not too shabby
      if ($gamepick->selection == $winner)  {
        //award the points
        $gamepick->score = $game->points;
      } else {
        //what the matt giveth, the matt taketh away
        $gamepick->score = 0;
      }

      //save the game pick
      $gamepick->save();
      
    }
    //go back to games when you're done!
    return redirect('/games')->with('completed', 'games has been updated');
}
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $updateData = $request->validate([
        'name' => 'required|max:255',
            'date' => 'max:255',
            'espnID' => 'required|max:255',
            'team1' => 'required|max:255',
            'team1Name' => 'required|max:255',
            'team2' => 'required|max:255',
            'team2Name' => 'required|max:255',
            'points' => 'required|numeric',
    ]);
      games::whereId($id)->update($updateData);
      return redirect('/games')->with('completed', 'games has been updated');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $games = games::findOrFail($id);
      $games->delete();

      return redirect('/games')->with('completed', 'games has been deleted');
  }
}
