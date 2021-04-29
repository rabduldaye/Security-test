<?php

namespace App\Http\Controllers;
use App\Models\Config;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{


    public function showMap() {
      $config = Config::all()->first();
      return view('config.map', compact('config'));
    }


    
    public function updateMap(Request $request) {
      
      $storeData = $request->validate([
          'mapembed' => 'required',
          
      ]);
      //get the config, rules
      $config = Config::all()->first();
      $config->mapembed = $storeData["mapembed"];
      //then save it
      $config->save();
      //now redirect to rules
      return redirect('/map')->with('success', 'map has been updated!');


  }

  public function editMap()
  {
    //get config 
    $config = Config::all()->first();
    //get the view
    return view('config.editmap', compact('config'));

  }

    public function toggleSeason() {

      $config = Config::all()->first();
      //flip the switch
      if ($config->seasonlock == "no") {
        //set flag
        $config->seasonlock = "yes";
        
        //get all picks where michigan involved
        $gamepicks = DB::table('game_picks')
          ->leftJoin('games', 'games.espnID', '=', 'game_picks.gameid')
          ->where('games.team1','=',$config->michiganID)
          ->orWhere('games.team2','=',$config->michiganID)
          ->select(['game_picks.userid',
                    'game_picks.selection']);
        //dd($gamepicks);

        //now do the update
        $users = DB::table('users')
          ->joinSub($gamepicks, 'gp', function ($join) {
            $join->on('users.id', '=', 'gp.userid');
          })
          ->update(['users.selMichigan' => DB::raw('case when `selection` = ' . $config->michiganID . ' THEN 1 ELSE 0 END')]);
        
        //get all picks where ND involved
        $gamepicks = DB::table('game_picks')
          ->leftJoin('games', 'games.espnID', '=', 'game_picks.gameid')
          ->where('games.team1','=',$config->notredameID)
          ->orWhere('games.team2','=',$config->notredameID)
          ->select(['game_picks.userid',
                    'game_picks.selection']);
        //dd($gamepicks);

        //finally set up gamepicks correctly
        $users = DB::table('users')
          ->joinSub($gamepicks, 'gp', function ($join) {
            $join->on('users.id', '=', 'gp.userid');
          })
          ->update(['users.selNotredame' => DB::raw('case when `selection` = ' . $config->notredameID . ' THEN 1 ELSE 0 END')]);
          

      } else {
        $config->seasonlock = "no";
      }
      //save the config
      $config->save();
      //go back to where we were
      return redirect()->back()->with('success', 'Season Lock toggled');  ;

    }


    public function showConfig() {
      $config = Config::all()->first();
      return view('config.show', compact('config'));
    }

    public function editConfig() {
      $config = Config::all()->first();
      return view('config.edit', compact('config'));
    }

    public function updateConfig(Request $request) {
      
      $storeData = $request->validate([
          'welcome' => 'required|max:255',
          'cq1' => 'required|max:255',
          'cq2' => 'required|max:255',
          'title' => 'required|max:255',
          'michiganID' => 'required|max:255',
          'notredameID' => 'required|max:255',
      ]);
      //get the config
      $config = Config::all()->first();
      //edit the config
      $config->welcome = $storeData["welcome"];
      $config->cq1 = $storeData["cq1"];
      $config->cq2 = $storeData["cq2"];
      $config->title = $storeData["title"];
      $config->michiganID = $storeData["michiganID"];
      $config->notredameID = $storeData["notredameID"];


      //dd($config);
      //now save
      $config->save();

      //dd($config);
      //now redirect to rules
      return redirect('/config')->with('success', 'config has been  updated');
    }


    public function updateRules(Request $request) {
        
        
       
        $storeData = $request->validate([
            'rules' => 'required',
            
        ]);
        //get the config, rules
        $config = Config::all()->first();
        $config->rules = $storeData["rules"];
        //then save it
        $config->save();
        //now redirect to rules
        return redirect('/rules')->with('completed', 'rules have been updated');


    }

    public function editRules()
    {
       
      $config = Config::all()->first();
      $rules = $config->rules;
      return view('config.editrules', compact('rules'));

    }

    public function showRules() {
      $config = Config::all()->first();
      $rules = $config->rules;
      return view('rules', compact('rules'));
    }
}
