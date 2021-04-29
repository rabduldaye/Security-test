<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopPerformance;

class TopPerformanceController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $topperformance = TopPerformance::all();
      return view('topperformance.index', compact('topperformance'));
    }

   
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topperformance.create');
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
          'season' => 'required|max:255',
          'performance' => 'numeric', 
          
        ]);
        $topperformance = TopPerformance::create($storeData);

        return redirect('/topperformance')->with('completed', 'New lis of has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $topperformance = TopPerformance::findOrFail($id);
      return view('topperformance.show', compact('topperformance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $topperformance = TopPerformance::findOrFail($id);
      return view('topperformance.edit', compact('topperformance'));
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
        'season' => 'required|max:255',
        'performance' => 'numeric',
      ]);

      TopPerformance::whereId($id)->update($updateData);
      return redirect('/topperformance')->with('completed', 'Topperformance has been updated');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $topperformance = TopPerformance::findOrFail($id);
      $topperformance->delete();

      return redirect('/topperformance')->with('completed', 'topperformance has been deleted');
  }
}
