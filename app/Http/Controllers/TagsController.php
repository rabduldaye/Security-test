<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tags;
use App\Models\User;
use App\Models\InSeason;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tags::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request-all());

        $num = count($request->all());
        //SKIP TOKEN
        $num = ($num-1);
        //dd($request->all());
  
         //get the first one
         $confName = $request->input('name');
  
         Tags::create(array("name"=>$confName));
        
          
        for ($i = 2; $i <= $num; $i++) {
          
          $tagName = $request->input('name'  . $i);
          Tags::create(array("name"=>$tagName));
  
      }
  
        
        return redirect('/tags')->with('success', 'tags have been saved!');
    }

    public function userSorter() {
        
        $users = DB::table('users')
            ->select("*", DB::raw("CONCAT(users.firstname,' \"',users.nickname, '\" ',users.lastname) AS full_name"), DB::raw("CONCAT(users.city,', ',users.state) AS location"))
            ->get(['users.id',
                'users.full_name',
                'users.location',
            ]);
        //dd($users);

        $tags = Tags::all();

        return view('tags.usersorter', compact('users', 'tags'));
    }


     
    public function addUser2Tag(Request $request) 
    {
  
        //dd($request->all());

        $num = count($request->all());

        //dd($request->all());
        $num = ($num-4);
        //get the tag
        $tag = $request->input('tag');

        
        //loop through the request (keys/values)
        foreach($request->all() as $key => $value) {
        //skip csrf token
            if ($key != "_token" and $key != "whatever" and $key != "whatever1" and $key != "tag") {
                $id = $value;

                //we need to do this in user table & inseason table
            
                //get the user by id
                $user = User::findOrFail($id);
                //dd($user);
                $user->tags = $user->tags . " " . $tag;
                //save the user
                $user->save();
            

                          
        }
          
    }


        return redirect('/tags/usersorter')->with('completed', 'User sorted into tags!');
    }



    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tags::findOrFail($id);
        
        return view('tags.edit', compact('tag'));
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
        $storeData = $request->validate([
            'name' => 'required|max:255',            
          ]);
          //dd($storeData);
    
          Tags::whereId($id)->update($storeData);
          return redirect('/tags')->with('success', 'tag has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tags::findOrFail($id);
        $tag->delete();
  
        return redirect('/tags')->with('completed', 'tag has been deleted');
    }
}
