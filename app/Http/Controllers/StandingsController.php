<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Conference;
use Illuminate\Support\Arr;

class StandingsController extends Controller
{

    public function showStandingsByGivenDivision($division) {
        //we need the number of scored games
        $scoredgames = DB::table('games')->where('scoredflag','<>', 'no')->count();
        




                
        //now get the standings
        $standings = DB::table('users')
        ->where('status', '=', 'current')
        ->where('division', "<>", '')
        ->where('division', "=", $division)   
        ->orderBy('score', 'desc')
        ->orderBy('selMichigan', 'desc')
        ->orderBy('selNotredame', 'desc')
        ->orderBy('wins', 'desc')
        ->orderBy('streakWL', 'desc')
        ->orderBy('streak', 'desc')
        ->select(DB::raw('*, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
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
    

        //dd($standings);
        $num = count($standings);
        //before we return it, let's massage it
        foreach ($standings as $key=>$var){
            //is it the last one? if so only check the one before
            if ($key == ($num - 1)) {
                //for the last one, we need to check the one before
                if($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division){
                    //they have the same player rank so add T
                    $var->rank = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }

            //is it the first one? if so only check after
            } else if ($key == 0) {
                //for every one but the last one
                if($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division){
                    //they have the same player rank so add T
                    $var->rank  = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }
            //for all others (check before AND after)
            } else {
                if (($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division) or
                    ($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division))   {
                
                    //they have the same player rank so add T
                    $var->rank  = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }
            }
            
        }




            if (count($standings) <= 0) {
                //we need to redirect, no one is in that division
                if (str_ends_with(redirect()->back()->getTargetUrl(), '/standings/division/' . $division)) {
                
                    return redirect('/standings/conference');
                } else {
                    //no users are left unsorted
                    return redirect()->back();
                }
            } else {
                //get conferences and be done
                $conferences = DB::table('conferences')
                    ->join('divisions', 'divisions.conference', '=', 'conferences.name')
                    ->where('divisions.name', "=", $division)
                    ->get([
                        'conferences.name',
                    ]);
                $divisions = DB::table('divisions') 
                    ->where('name', "=", $division)
                    ->get();
                return view('user.standings', compact('standings', 'divisions', 'conferences', 'scoredgames'));


            }
    }

    public function showStandings() {
        
        $scoredgames = DB::table('games')->where('scoredflag','<>', 'no')->count();
        

        
        //now get the standings
        $standings = DB::table('users')
            ->where('status', '=', 'current')
            ->where('division', "<>", '')
            ->orderBy('division', 'desc')
            ->orderBy('score', 'desc')
            ->orderBy('selMichigan', 'desc')
            ->orderBy('selNotredame', 'desc')
            ->orderBy('wins', 'desc')
            ->orderBy('streakWL', 'desc')
            ->orderBy('streak', 'desc')
            ->select(DB::raw('*, RANK() OVER(PARTITION BY division ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
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
        

        //dd($standings);
        $num = count($standings);
        //before we return it, let's massage it
        foreach ($standings as $key=>$var){
            //is it the last one? if so only check the one before
            if ($key == ($num - 1)) {
                //for the last one, we need to check the one before
                if($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division){
                    //they have the same player rank so add T
                    $var->rank = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }

            //is it the first one? if so only check after
            } else if ($key == 0) {
                //for every one but the last one
                if($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division){
                    //they have the same player rank so add T
                    $var->rank  = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }
            //for all others (check before AND after)
            } else {
                if (($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division) or
                    ($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division))   {
                
                    //they have the same player rank so add T
                    $var->rank  = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }
            }
            
        }









        
        
        
        //only return conferences with people in them
        $conferences = DB::table('conferences') 
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                  ->from('users')
                  ->whereColumn('users.conference', 'conferences.name');
            })
            ->get();
        //only select divisions where in which there are users
        //$divisions = DB::table('divisions')->get();
        //only return divisions with people in them
        $divisions = DB::table('divisions') 
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                  ->from('users')
                  ->whereColumn('users.division', 'divisions.name');
            })
            ->get();
                
        //all done ->go view!    
        return view('user.standings', compact('standings', 'divisions', 'conferences', 'scoredgames'));

    }

    public function showStandingsbyConf() {
        //we need conference table
        
        $scoredgames = DB::table('games')->where('scoredflag','<>', 'no')->count();
        
        //only return conferences with people in them
        $conferences = DB::table('conferences') 
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                  ->from('users')
                  ->whereColumn('users.conference', 'conferences.name');
            })
            ->get();
        

        //now get the standings
        $standings = DB::table('users')
            ->where('status', '=', 'current')
            ->where('division', "<>", '')
            ->orderBy('conference', 'desc')
            ->orderBy('score', 'desc')
            ->orderBy('selMichigan', 'desc')
            ->orderBy('selNotredame', 'desc')
            ->orderBy('wins', 'desc')
            ->orderBy('streakWL', 'desc')
            ->orderBy('streak', 'desc')
            ->select(DB::raw('*, RANK() OVER(PARTITION BY conference ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
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


        //dd($standings);
        $num = count($standings);
        //before we return it, let's massage it
        foreach ($standings as $key=>$var){
            //is it the last one? if so only check the one before
            if ($key == ($num - 1)) {
                //for the last one, we need to check the one before
                if($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division){
                    //they have the same player rank so add T
                    $var->rank = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }

            //is it the first one? if so only check after
            } else if ($key == 0) {
                //for every one but the last one
                if($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division){
                    //they have the same player rank so add T
                    $var->rank  = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }
            //for all others (check before AND after)
            } else {
                if (($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division) or
                    ($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division))   {
                
                    //they have the same player rank so add T
                    $var->rank  = 'T' . $var->playerrank;
                } else {
                    $var->rank = $var->playerrank;
                }
            }
            
        }








        //view them
        return view('user.cstandings', compact('standings', 'conferences', 'scoredgames'));

    }

    
    public function showStandingsbyConfByGivenConference($conference) {
        //we need conference table
        
        $scoredgames = DB::table('games')->where('scoredflag','<>', 'no')->count();
        
        //only return conferences with people in them
        $conferences = DB::table('conferences')
            ->where('name','=',$conference) 
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                  ->from('users')
                  ->whereColumn('users.conference', 'conferences.name');
            })
            ->get();
        //check for results?
        if (count($conferences) <= 0) {
            if (str_ends_with(redirect()->back()->getTargetUrl(), '/standings/conference/' . $conference)) {
                
                return redirect('/standings/conference');
            } else {
                //no users are left unsorted
                return redirect()->back();
            }
        }
       
            
        //now get the standings
        $standings = DB::table('users')
        ->where('status', '=', 'current')
        ->where('division', "<>", '')
        ->where('conference', '=', $conference)
        ->orderBy('score', 'desc')
        ->orderBy('selMichigan', 'desc')
        ->orderBy('selNotredame', 'desc')
        ->orderBy('wins', 'desc')
        ->orderBy('streakWL', 'desc')
        ->orderBy('streak', 'desc')
        ->select(DB::raw('*, RANK() OVER(PARTITION BY conference ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
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


    //dd($standings);
    $num = count($standings);
    //before we return it, let's massage it
    foreach ($standings as $key=>$var){
        //is it the last one? if so only check the one before
        if ($key == ($num - 1)) {
            //for the last one, we need to check the one before
            if($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division){
                //they have the same player rank so add T
                $var->rank = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }

        //is it the first one? if so only check after
        } else if ($key == 0) {
            //for every one but the last one
            if($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division){
                //they have the same player rank so add T
                $var->rank  = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }
        //for all others (check before AND after)
        } else {
            if (($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division) or
                ($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division))   {
            
                //they have the same player rank so add T
                $var->rank  = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }
        }
        
    }


        //view them
        return view('user.cstandings', compact('standings', 'conferences', 'scoredgames'));

    }

    public function showStandingsbyLeague() {
        
        //Nwe need the scored games
        $scoredgames = DB::table('games')->where('scoredflag','<>', 'no')->count();
       

        //select id, nickname, score, RANK() OVER(ORDER BY score DESC) score_rank from users;

        //now get the standings
        $standings = DB::table('users')
            ->where('status', '=', 'current')
            ->where('division', "<>", '')
            ->orderBy('score', 'desc')
            ->orderBy('selMichigan', 'desc')
            ->orderBy('selNotredame', 'desc')
            ->orderBy('wins', 'desc')
            ->orderBy('streakWL', 'desc')
            ->orderBy('streak', 'desc')
            ->select(DB::raw('*, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
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
        
        //dd($standings);
        $num = count($standings);
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
        //dd($standings);
            //dd($divisions);
            return view('user.lstandings', compact('standings', 'scoredgames'));

    }

    public function showStandingsbyTag() {
        
        //Nwe need the scored games
        $scoredgames = DB::table('games')->where('scoredflag','<>', 'no')->count();
        
        
        //we first need tags
        $tags = DB::table('tags')->get();
        //if there are no tags?
        if (!(count($tags) > 0 )) {
            //tags are NOT setup so bug out
            return redirect()->back();
        } else {
            
            //create an empty array
            $results = collect([]);
            //loop through the tags
            foreach ($tags as $tag) {

                //dd($tag->name);
                //now get the standings
                $standings = DB::table('users')
                    ->where('status', '=', 'current')
                    ->where('division', "<>", '')
                    ->where('users.tags', 'LIKE', '%'. $tag->name .'%')
                    ->orderBy('score', 'desc')
                    ->orderBy('selMichigan', 'desc')
                    ->orderBy('selNotredame', 'desc')
                    ->orderBy('wins', 'desc')
                    ->orderBy('streakWL', 'desc')
                    ->orderBy('streak', 'desc')
                    ->select(DB::raw('*, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
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
                        
                        ]);





                    //only add tag if there are users in tag
                    if (count($standings) > 0) {
    //dd($standings);
    $num = count($standings);
    //before we return it, let's massage it
    foreach ($standings as $key=>$var){
        //is it the last one? if so only check the one before
        if ($key == ($num - 1)) {
            //for the last one, we need to check the one before
            if($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division){
                //they have the same player rank so add T
                $var->rank = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }

        //is it the first one? if so only check after
        } else if ($key == 0) {
            //for every one but the last one
            if($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division){
                //they have the same player rank so add T
                $var->rank  = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }
        //for all others (check before AND after)
        } else {
            if (($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division) or
                ($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division))   {
            
                //they have the same player rank so add T
                $var->rank  = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }
        }
        
    }








                        $results = Arr::add($results, $tag->name, $standings);
                    }
                
                

            }

            

            if (count($results) > 0) {
                return view('user.tstandings', compact('results', 'tags', 'scoredgames'));
            } else {

                if (str_ends_with(redirect()->back()->getTargetUrl(), '/standings/category')) {
                
                    return redirect('/standings');
                } else {
                    //no users are left unsorted
                    return redirect()->back();
                }




                
            }

            




        }



    }

    public function showStandingsbyGivenTag($tag) {
        
        //we need the scored games
        $scoredgames = DB::table('games')->where('scoredflag','<>', 'no')->count();
        //create an empty array
        $results = collect([]);
        
        //we first need tags
        $tags = DB::table('tags')->where('name','=',$tag)->get();
        //if for some reason tag doesn't exist
        if (!(count($tags) > 0 )) {
            if (str_ends_with(redirect()->back()->getTargetUrl(), '/standings/category')) {
                
                return redirect('/standings');
            } else {
                //no users are left unsorted
                return redirect()->back();
            }
        } else {
            
            //create an empty array
            $results = collect([]);
            //loop through the tags
            foreach ($tags as $tag) {

                //dd($tag->name);
                //now get the standings
                


                        $standings = DB::table('users')
                        ->where('status', '=', 'current')
                        ->where('division', "<>", '')
                        ->where('users.tags', 'LIKE', '%'. $tag->name .'%')
                        ->orderBy('score', 'desc')
                        ->orderBy('selMichigan', 'desc')
                        ->orderBy('selNotredame', 'desc')
                        ->orderBy('wins', 'desc')
                        ->orderBy('streakWL', 'desc')
                        ->orderBy('streak', 'desc')
                        ->select(DB::raw('*, RANK() OVER(ORDER BY score DESC, selMichigan DESC, selNotredame DESC, wins DESC, streakWL DESC, streak DESC) as playerrank'))
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
                            
                            ]);
        





                    //only add tag if there are users in tag
                    if (count($standings) > 0) {
                            //dd($standings);
    $num = count($standings);
    //before we return it, let's massage it
    foreach ($standings as $key=>$var){
        //is it the last one? if so only check the one before
        if ($key == ($num - 1)) {
            //for the last one, we need to check the one before
            if($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division){
                //they have the same player rank so add T
                $var->rank = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }

        //is it the first one? if so only check after
        } else if ($key == 0) {
            //for every one but the last one
            if($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division){
                //they have the same player rank so add T
                $var->rank  = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }
        //for all others (check before AND after)
        } else {
            if (($var->playerrank == $standings[$key+1]->playerrank and $var->division == $standings[$key+1]->division) or
                ($var->playerrank == $standings[$key-1]->playerrank and $var->division == $standings[$key-1]->division))   {
            
                //they have the same player rank so add T
                $var->rank  = 'T' . $var->playerrank;
            } else {
                $var->rank = $var->playerrank;
            }
        }
        
    }

                        $results = Arr::add($results, $tag->name, $standings);
                    }
                
                

            }
                    //only add tag if there are users in tag
            if (count($standings) > 0) {
                
                return view('user.tstandings', compact('results', 'tags', 'scoredgames'));
            } else {
                if (str_ends_with(redirect()->back()->getTargetUrl(), '/standings/category')) {
                
                    return redirect('/standings');
                } else {
                    //no users are left unsorted
                    return redirect()->back();
                }
            }


        }


    }


}
