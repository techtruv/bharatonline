<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Party::orderBy('id','DESC')->get();
        return view('admin.partyshow',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.party');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'partyName'=>'required|max:255',
            'mobile'=>'required|max:10|min:10|unique:parties'
            ]);

        $res = Party::create($input);
        return redirect()->back()->with('success','Party added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function show(Party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Party::find($id);
        return view('admin.party',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $request->validate([
            'partyName'=>'required|max:255',
            'mobile'=>'required|max:10|min:10|unique:parties,id'.$id,
            ]);

        unset($input['_method']);
        unset($input['_token']);
        $res = Party::where('id',$id)->update($input);
        return redirect(route('party.index'))->with('success','Party Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $records = Party::find($id)->delete();
       return redirect()->back()->with('success','Party Deleted successfully');
    }
}
