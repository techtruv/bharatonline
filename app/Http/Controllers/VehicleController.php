<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\TruckType;
use App\Models\Driver;
use App\Models\Supplier;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Vehicle::orderBy('id','desc')->get();
        return view('admin.vehicleView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicleType= TruckType::orderBy('truckName','ASC')->get();
        $drivers= Driver::orderBy('driverName','ASC')->get();
        $suppliers= Supplier::orderBy('supplierName','ASC')->get();
        return view('admin.vehicle',compact('vehicleType','drivers','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $input =  $request->all();
    
         $request->validate([
            'vehicleNumber'=>'required|max:255|unique:vehicles',
            'vehicleType'=>'required',
            'ownership'=>'required']);
         
         $input['supplier_id']=$request->supplierName;
         unset($input['supplierName']);
         $input['driver_id']=$request->driverName;
         unset($input['driverName']);



         $res = Vehicle::create($input);
        return redirect()->back()->with('success','Vehicle added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicleType= TruckType::orderBy('truckName','ASC')->get();
        $drivers= Driver::orderBy('driverName','ASC')->get();
        $suppliers= Supplier::orderBy('supplierName','ASC')->get();
        $data = Vehicle::find($id);
        return view('admin.vehicle',compact('vehicleType','drivers','suppliers','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input =  $request->all();
    
         $request->validate([
            'vehicleNumber'=>'required|max:255|unique:vehicles,id,'.$id,
            'vehicleType'=>'required',
            'ownership'=>'required']);
         
         $input['supplier_id']=$request->supplierName;
         unset($input['supplierName']);
         $input['driver_id']=$request->driverName;
         unset($input['driverName']);
         unset($input['_method']);
         unset($input['_token']);

         $res = Vehicle::where('id',$id)->update($input);
        return redirect(route('vehicle.index'))->with('success','Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $res = Vehicle::where('id',$id)->delete();
        return redirect()->back()->with('success','Vehicle Deleted successfully');
    }
}
