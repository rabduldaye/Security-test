<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Config;
use App\Models\InSeason;



class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division = Division::all();

        

        return view('division.index', compact('division'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = "NB: Conferences";
        $conferences = DB::table('conferences')->get();

        return view('division.create', compact('conferences','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $num = count($request->all());

        //dd($request->all());
        $num = ($num-1)/2;

        //dd($request->all());
        $counter = 1;

        //get the first one
        $divName = $request->input('division');
        $divConf = $request->input('conference');
        //dd($divConf);

        Division::create(array('name'=>$divName,'conference'=>$divConf));


        for ($i = 2; $i <= $num; $i++) {
            $divName = $request->input('division' . $i);
            $divConf = $request->input('conference'  . $i);
            Division::create(array("name"=>$divName,"conference"=>$divConf));

        }

        

        return redirect('/division')->with('completed', 'Division has been saved!');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $division = Division::findOrFail($id);
        $conferences = DB::table('conferences')->get();
        
        return view('division.edit', compact('division', 'conferences'));

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
            'conference' => 'required|max:255'
        ]);
        Division::whereId($id)->update($updateData);
        return redirect('/division')->with('completed', 'Division has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division = Division::findOrFail($id);
        $division->delete();

        return redirect('/division')->with('completed', 'Division has been deleted');
    }

    
    public function addUser2Div(Request $request) 
    {
  
        //dd($request->all());

        $num = count($request->all());

        //dd($request->all());
        $num = ($num-4);

        $division = $request->input('division');

        $divs = Division::where('name','=',$division)->first();
        $conference = $divs->conference;


       //$conference = $request->input('conference');
        //get conference from division
        //dd($conference);

        //dd($request);
        //loop through the request (keys/values)
      foreach($request->all() as $key => $value) {
        //skip csrf token
        if ($key != "_token" and $key != "whatever" and $key != "whatever1" and $key != "division") {
            $id = $value;
            //get the user by id
            $user = User::where('id','=', $id)->first();
            //InSeason::where('userid', '=', $id)->first();
            $user->division = $division;
            $user->conference = $conference;
            



            $user->save();

                          
        }
          
    }


        return redirect('/user/usersorter')->with('completed', 'Division has been saved!');
    }

    public function divisionSorter() {

        //get all users where division is not set
        $users = DB::table('users')
            ->where('division',"=",'')
            ->select("*", DB::raw("CONCAT(users.firstname,' \"',users.nickname, '\" ',users.lastname) AS full_name"), DB::raw("CONCAT(users.city,', ',users.state) AS location"))
            ->get(
                ['users.id',
                 'users.full_name',
                 'users.location',
                
            ]);
        
        

        if (count($users) == 0) {
            //set the flag
            $config = Config::all()->first();
            $config->userssortedflag = "yes";
            $config->save();
            //no request 
            //dd(redirect()->back()->getTargetUrl());
            if (str_ends_with(redirect()->back()->getTargetUrl(), '/user/usersorter')) {
                
                return redirect('/admin')->with('completed', 'All Users have been sorted into divisions!');
            } else {
                //no users are left unsorted
                return redirect()->back()->with('completed', 'All Users have been sorted into divisions!');
            }

            
        } else {
                //also need a division list...
            $divs = Division::all();
            
            //dd($divisions);

            return view('division.usersorter', compact('users', 'divs'));
        }
        
    }
}
