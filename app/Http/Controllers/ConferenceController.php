<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;


class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conference = Conference::all();
        return view('conference.index', compact('conference'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('conference.create');
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
      //SKIP TOKEN
      $num = ($num-1);
      //dd($request->all());

       //get the first one
       $confName = $request->input('conference');

       Conference::create(array("name"=>$confName));
      
        
      for ($i = 2; $i <= $num; $i++) {
        
        $confName = $request->input('conference'  . $i);
        Conference::create(array("name"=>$confName));

    }

      
      return redirect('/conference')->with('success', 'conference has been saved!');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $conference = Conference::findOrFail($id);
      return view('conference.edit', compact('conference'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $storeData = $request->validate([
        'name' => 'required|max:255',
        
      ]);
      //dd($storeData);

      Conference::whereId($id)->update($storeData);
      return redirect('/conference')->with('success', 'conference has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $conference = Conference::findOrFail($id);
      $conference->delete();

      return redirect('/conference')->with('completed', 'conference has been deleted');
    }
}
