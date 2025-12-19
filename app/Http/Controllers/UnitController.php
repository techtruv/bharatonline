<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Unit::orderBy('id','DESC')->get();
        return view('admin.unit',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|max:255|unique:units',
            'description' => 'nullable|max:1000'
        ]);

        $res = Unit::create($input);

        return redirect(route('unit.index'))->with('success','Unit Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = Unit::orderBy('id','DESC')->get();
        $data = Unit::find($id);
        return view('admin.unit',compact('records','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required|max:255|unique:units,name,'.$id,
            'description' => 'nullable|max:1000'
        ]);
        unset($input['_token']);
        unset($input['_method']);

        $res = Unit::where('id',$id)->update($input);

        return redirect(route('unit.index'))->with('success','Unit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Unit::find($id)->delete();
        return redirect(route('unit.index'))->with('success','Unit Deleted Successfully');
    }
}
