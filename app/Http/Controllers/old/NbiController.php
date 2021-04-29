<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nbi;
class NbiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nbi = Nbi::all();
        return view('nbi.index',compact('nbi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('nbi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $storeData = $request->validate([
            'nickname' => 'required|max:255',
            
            'nbiraw' => 'required|numeric',
            

        ]);
        $nbi = Nbi::create($storeData);

        return redirect('/nbi')->with('completed', 'Nbi has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $nbi = Nbi::findOrFail($id);
        return view('nbi.edit', compact('nbi'));
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
        //
        $updateData = $request->validate([
            'nickname' => 'required|max:255',
            
            'nbiraw' => 'required|numeric',
            

          ]);
          Nbi::whereId($id)->update($updateData);
          return redirect('/nbi')->with('completed', 'Nbi has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $nbi = Nbi::findOrFail($id);
        $nbi->delete();
  
        return redirect('/nbi')->with('completed', 'Nbi has been deleted');

    }
}
