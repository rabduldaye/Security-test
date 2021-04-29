<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllTimeRank;

class AllTimeRankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alltimerank = alltimerank::all();
        return view('alltimerank.index', compact('alltimerank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alltimerank.create');
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
            'name' => 'required|max:255',
            'points' => 'required|numeric',
            'rank' => 'required|numeric',
        ]);
        alltimerank::create($storeData);

        return redirect('/alltimerank')->with('completed', 'All time rankings have been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $alltimerank = alltimerank::findOrFail($id);
        return view('alltimerank.edit', compact('alltimerank'));
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
            'points' => 'required|numeric',
            'rank' => 'required|numeric',
        ]);
        alltimerank::whereID($id)->update($updateData);

        return redirect('/alltimerank')->with('completed', 'All time rankings have been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alltimerank = alltimerank::findOrFail($id);
        $alltimerank->delete();

        return redirect('/alltimerank')->with('completed', 'All time rankings have been deleted');
    }
}
