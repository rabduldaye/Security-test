<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class StatsController extends Controller
{

    public function batchUpdateNBI() {


        return view('stats.editnbi');

    }


    public function updateNBI(Request $request) {
        
        //
       
        $storeData = $request->validate([
            'nbidata' => 'required',
            
        ]);
        
        $nbidata = $storeData["nbidata"];
        //first seperate new lines
        $nbidata = preg_split('/[\r\n]/', $nbidata, null, PREG_SPLIT_NO_EMPTY);
        
        foreach ($nbidata as $nbidatum) {
            $nbidatum = preg_split('/[ \t]/', $nbidatum, null, PREG_SPLIT_NO_EMPTY);
            $email = $nbidatum[0];
            $nbi = $nbidatum[1];

            $user = User::where('email','=',$email)->first();
            if ($user != null) {
                $user->nbi = $nbi;
                $user->save();
            }
            
        }





        //now redirect to rules
        return redirect('/stats/nbi')->with('completed', 'nbi scores have been updated');


    }
    public function downloadNBIData() {

        $table = User::all();
        $filename = "users.csv";
        $handle = fopen($filename, 'w+');
        //get ready to download
        fputcsv($handle, array('ID', 'First', 'Last', 'Nickname','Email','NBI'));

        foreach($table as $row) {
            fputcsv($handle, array($row['id'], $row['firstname'],$row['lastname'],$row['nickname'], $row['email'], $row['nbi']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

    return response()->download($filename, 'myusers.csv', $headers);
    //Response::download($filename, 'myusers.csv', $headers);



    }

    //show main page!
    public function  showStatsPage() {
       
        //now get the standings
        $standings = DB::table('users')
            ->orderBy('allscores', 'desc')
            ->select(DB::raw('*, RANK() OVER(ORDER BY allscores DESC) as playerrank'))
            ->get(
                ['id',
                 'firstname',
                 'nickname',
                 'lastname',
                 'allscores',
                 'playerrank',
                 
            ]);
        //fix the ranks
        $this->fixRanks($standings);
    
        return view('stats.index', compact('standings'));
    }

    public function showMostDivisionWins() {
        //now get the standings
        $standings = DB::table('users')
        ->orderBy('divisionWins', 'desc')
        ->select(DB::raw('*, RANK() OVER(ORDER BY divisionWins DESC) as playerrank'))
        ->get(
            ['id',
                'firstname',
                'nickname',
                'lastname',
                'divisionWins',
                'playerrank',
                
        ]);
        //fix the ranks
        $this->fixRanks($standings);

        return view('stats.divwins', compact('standings'));

    }

    public function showNBI() {
        
        //now get the standings
        $standings = DB::table('users')
            ->orderBy('nbi', 'desc')
            ->select(DB::raw('*, RANK() OVER(ORDER BY nbi DESC) as playerrank'))
            ->get(
                ['id',
                 'firstname',
                 'nickname',
                 'lastname',
                 'nbi',
                 'playerrank',
                 
            ]);
        //fix the ranks
        $this->fixRanks($standings);

        return view('stats.nbi', compact('standings'));

    }



    public function fixRanks($standings) {
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


        
    }

}
