<?php

namespace App\Http\Controllers;

use App\Models\TruckType;
use Illuminate\Http\Request;

class TruckTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = TruckType::orderBy('id','DESC')->get();
        return view('admin.trucktype',compact('records'));
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

        $request->validate(['truckName'=>'required|max:255']);

        unset($input['_token']);
        $res = TruckType::create($input);
        
        return redirect()->back()->with('success','Vehicle Type Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckType  $truckType
     * @return \Illuminate\Http\Response
     */
    public function show(TruckType $truckType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckType  $truckType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = TruckType::orderBy('id','DESC')->get();
        $data = TruckType::find($id);
        return view('admin.trucktype',compact('records','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckType  $truckType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate(['truckName'=>'required|max:255']);

        unset($input['_token']);
        unset($input['_method']);
        $res = TruckType::where('id',$id)->update($input);
        
        return redirect(route('vehicleType.index'))->with('success','Vehicle Type Updated successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckType  $truckType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $res = TruckType::find($id)->delete();
        
        return redirect(route('vehicleType.index'))->with('success','Vehicle Type Deleted successfully');
  
    }
}
