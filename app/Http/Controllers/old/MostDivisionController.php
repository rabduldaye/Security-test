<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\MostDivisions;



class MostDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mostdivision = MostDivisions::all();

        return view('divisiontitles.index', compact('mostdivision'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('divisiontitles.create');
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
            'wins' => 'numeric'
        ]);
        $mostdivision = MostDivisions::create($storeData);

        return redirect('/divisiontitles')->with('completed', 'Division titles has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $mostdivision = MostDivisions::findOrFail($id);
      return view('divisiontitles.show', compact('mostdivision'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mostdivision = MostDivisions::findOrFail($id);

        return view('divisiontitles.edit', compact('mostdivision'));

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
            'wins' => 'numeric'
        ]);
        MostDivisions::whereId($id)->update($updateData);
        return redirect('/divisiontitles')->with('completed', 'Division title has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mostdivision = MostDivisions::findOrFail($id);
        $mostdivision->delete();

        return redirect('/divisiontitles')->with('completed', 'Division title  has been deleted');
    }
}
