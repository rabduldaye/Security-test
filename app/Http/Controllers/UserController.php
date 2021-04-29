<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\InSeason;
use App\Models\Config;
use App\Models\Games;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $numGames = count(Games::all());
      if (Auth::user()->is_admin != 0) {
        //get the number of picks per user
        $sql = "select * from users join (select userid, count(userid) as picks from game_picks group by userid) as gp on gp.userid = users.id";
        $user = DB::select(DB::raw($sql));
        //dd($user);
      } else {
        $user = User::all();
      }



      
      //dd($user);
      return view('user.index', compact('user','numGames'));
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/user')->with('no create', 'there is no create functionality!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
          'nickname' => 'required|max:255',
          'firstname' => 'required|max:255',
          'lastname' => 'required|max:255',
          'email' => 'required|max:255',
          'phone' => 'numeric',
          'password' => 'required|max:255',
          'city' => 'required|max:255',
          'state' => 'required|max:255',
          'bowling' => 'required|numeric',
          'cq1' => 'required|max:255',
          'cq2' => 'required|max:255',
          'favsport' => 'max:255',
          'knowme' => 'required|max:255',
          'news' => 'max:255',
          'smack' => 'required|max:255',
        ]);
        $user = user::create($storeData);

        return redirect('/user')->with('completed', 'user has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      
      $canedit = ((Auth::user()->is_admin != 0) or (Auth::user()->id == $id));

      //dd($canedit);

      $config = Config::firstOrNew();
        
        $title = $config->welcome;
        $cq1 = $config->cq1;
        $cq2 = $config->cq2;
        
      $user = user::findOrFail($id);
      return view('user.show', compact('user', 'cq1','cq2', 'canedit'));
      
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {

      $updateData = $request->validate([
        
        'status' => 'max:255'
        
      ]);

      User::whereId($id)->update($updateData);
      return redirect('/user')->with('completed', 'user has been updated');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      //can the user edit?
      $canedit = ((Auth::user()->is_admin != 0) or (Auth::user()->id == $id));
      //if so do the normal thing
      if ($canedit) {
        //get the config
        $config = Config::firstOrNew();
        //get the important stuff
        $title = $config->welcome;
        $cq1 = $config->cq1;
        $cq2 = $config->cq2;
        
        $user = user::findOrFail($id);
        return view('user.edit', compact('user', 'cq1','cq2'));
      } else {
        //else they shouldn't be here so redirect
        return redirect('/')->with('huh', 'user can not edit this user');
      }
      
    }

    public function editpwd($id)
    {

      //can the user edit?
      $canedit = ((Auth::user()->is_admin != 0) or (Auth::user()->id == $id));
      //get the user
      $user = user::find($id);
      //if so do the normal thing
      if ($canedit and ($user != null)) {
        
        
        return view('user.editpwd', compact('user'));
      } else {
        //else they shouldn't be here so redirect
        return redirect('/')->with('huh', 'user can not edit the password of this user');
      }
      
    }

    public function updatepwd(Request $request, $id)
    {

      
      //can the user edit?
      $canedit = ((Auth::user()->is_admin != 0) or (Auth::user()->id == $id));
     
      $user = User::find($id);

      if ($user == null) {
        //else they shouldn't be here so redirect
        return redirect('/')->with('huh', 'user can not edit this user');
      }

      //if user is NOT admin
      if (Auth::user()->is_admin == 0) {
        //validate the input
        $updateData = $request->validate([
          'password' => 'required|max:255',
          'newpassword' => 'required|max:255',
          'password_confirmation' => 'required|max:255|same:newpassword',
          
        ]);

        $passwordentered = $updateData["password"];


        if (!Hash::check($passwordentered, $user->password)) {
            return Redirect::back()->withErrors(['password', 'The password you entered was incorrect']);
        }


      } else {
        //validate the input
        $updateData = $request->validate([
          'newpassword' => 'required|max:255',
          'password_confirmation' => 'required|max:255|same:newpassword',
          
        ]);
      }

      $newpassword = $updateData["newpassword"];

      $user->password = bcrypt($newpassword);
      $user->save();
      

      return redirect('/home')->with('password updated', 'you successfully updated your password');


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
      
      
      //can the user edit?
      $canedit = ((Auth::user()->is_admin != 0) or (Auth::user()->id == $id));
      //if so do the normal thing
      if ($canedit) {
        //if user is NOT admin
        if (Auth::user()->is_admin == 0) {

        
          //dd($request);
        //validate the input
        $updateData = $request->validate([
          'nickname' => 'required|max:255',
          'firstname' => 'required|max:255',
          'lastname' => 'required|max:255',
          'email' => 'required|max:255',
          
          
          'city' => 'required|max:255',
          'state' => 'required|max:255',
          'bowling' => 'required|numeric',
          'cq1' => 'required|max:255',
          'cq2' => 'required|max:255',
          'favsport' => 'max:255',
          'knowme' => 'required|max:255',
          'news' => 'max:255',
          'smack' => 'required|max:255',
          
        ]);

      } else {

        //dd($request);
        //validate the input
        $updateData = $request->validate([
          'nickname' => 'required|max:255',
          'firstname' => 'required|max:255',
          'lastname' => 'required|max:255',
          'email' => 'required|max:255',
          'division' => 'string|min:0|max:255',
          'conference' => 'string|min:0|max:255',
          'allscores' => 'required|integer|min:0',
          'nbi' => 'required|numeric',
          'divisionwins' => 'required|integer|min:0',
          'coinflip' => 'required|integer|max:1|min:0',
          'tags' => 'string|min:0|max:255',
          'status' => 'required|max:255',
          'city' => 'required|max:255',
          'state' => 'required|max:255',
          'bowling' => 'required|numeric',
          'cq1' => 'required|max:255',
          'cq2' => 'required|max:255',
          'favsport' => 'max:255',
          'knowme' => 'required|max:255',
          'news' => 'max:255',
          'smack' => 'required|max:255',
          
        ]);
      }
        //update the record
        User::whereId($id)->update($updateData);
        return redirect('/user')->with('completed', 'user has been updated');

      } else {
        //else they shouldn't be here so redirect
        return redirect('/')->with('huh', 'user can not edit this user');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      
      //can the user edit?
      $candelete = (Auth::user()->is_admin != 0);
      //if so do the normal thing
      if ($candelete) {

        //get the user
        $user = user::findOrFail($id);
        //delete the user
        $user->delete();
        //redirect afterwards
        return redirect('/user')->with('completed', 'user has been deleted');
      } else {
        //else they shouldn't be here so redirect
        return redirect('/')->with('permission error', 'user can not delete this user');
      }
    }

}
