<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\viewprofile;
use App\Models\User;

class ViewProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewprofile = Viewprofile::all();
        return view('viewprofile.index', compact('viewprofile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('viewprofile.create');
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
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'numeric',
            'password' => 'max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'bowling' => 'required|numeric',
            'cq1' => 'required|max:255',
            'cq2' => 'required|max:255',
            'favsport' => 'max:255',
            'knowme' => 'required|max:255',
            'news' => 'max:255',
            'smack' => 'required|max:255',
            'startpage' => 'max:255',
            'status' => 'max:255',
            'division' => 'max:255',
            'tags' => 'max:255'
            ]);
        viewprofile::create($storeData);
        return redirect('/viewprofile')->with('completed', 'profile has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viewprofile = viewprofile::findOrFail($id);
        return view('viewprofile.show', compact('viewprofile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $viewprofile = viewprofile::findOrFail($id);
        return view('viewprofile.edit', compact('viewprofile'));
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
            'nickname' => 'required|max:255',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'numeric',
            'password' => 'max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'bowling' => 'required|numeric',
            'cq1' => 'required|max:255',
            'cq2' => 'required|max:255',
            'favsport' => 'max:255',
            'knowme' => 'required|max:255',
            'news' => 'max:255',
            'smack' => 'required|max:255',
            'startpage' => 'max:255',
            'status' => 'max:255',
            'division' => 'max:255',
            'tags' => 'max:255'
        ]);

        Viewprofile::whereId($id)->update($updateData);
        return redirect('/viewprofile')->with('completed', 'profile has been updated');
    }
}
