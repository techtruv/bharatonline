<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Driver::orderBy('id','DESC')->get();
        return view('admin.driverView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.driver');
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
            'driverName'=>'required|max:255',
            'mobile'=>'required|max:10|min:10|unique:drivers',
        ]);
        
        $res = Driver::create($input);
        return redirect()->back()->with('success','Driver Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Driver::find($id);
        return view('admin.driver',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      $input = $request->all();

        $request->validate([
            'driverName'=>'required|max:255',
            'mobile'=>'required|max:10|min:10|unique:drivers,id,'.$id,
        ]);
        
        unset($input['_method']);
        unset($input['_token']);
        $res = Driver::where('id',$id)->update($input);
        return redirect(route('driver.index'))->with('success','Driver Upated successfully');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Driver::where('id',$id)->delete();
        return redirect(route('driver.index'))->with('success','Driver Deleted successfully');
   
    }
}
