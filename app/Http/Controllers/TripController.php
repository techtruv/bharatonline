<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\LRList;
use App\Models\Company;
use App\Models\TruckType;
use App\Models\Driver;
use App\Models\PartyAdvance;
use App\Models\SupplierAdvance;
use App\Models\SupplierCharges;
use App\Models\PartyCharges;
use App\Models\SupplierPayment;
use App\Models\PartyPayment;
use App;
use PDF;

class TripController extends Controller
{
    
     
    public function index(Request $request)
    {
        $id=1;
        $records = Trip::orderBy('startDate','Desc')->get();
        
        if(isset($request->from_date) && isset($request->to_date)){
            $records = $records->WhereBetween('startDate',[$request->from_date,$request->to_date]);
        }
        
        if(isset($request->partyName)){
            $records = $records->Where('partyName',$request->partyName);
        }
        
        if(isset($request->origin) AND isset($request->destination)){
            $records = $records->Where('origin',$request->origin)->Where('destination',$request->destination);
        }
        
        
        
         if(isset($request->status)){
            $records = $records->Where('status',$request->status);
        }
        
        return view('admin.tripshow',compact('records','id'));
    }


    public function indexAll($id)
    {
        $records = Trip::where('status',$id)->orderBy('startDate','Desc')->get();
        return view('admin.tripshow',compact('records','id'));
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
        
        return view('admin.trip',compact('vehicleType','drivers','suppliers'));

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
            'partyName'=>'required',
            'vehicleNumber'=>'required',
            'origin'=>'required',
            'destination'=>'required',
            'billingType'=>'required',
            'partyFreightAmount'=>'required',
            'startDate'=>'required|date',
        ]);
        
        $input['supplierName'] = $request->supplier_name;
        $input['status']=1;
        unset($input['_token']);
        unset($input['lrNo']);
        unset($input['lr_table_id']);
        unset($input['materialName']);
        unset($input['note']);
         unset($input['supplier_name']);
        $res = Trip::create($input);
        
        LRList::where('trip_id',0)->update(['trip_id'=>$res->id]);

        return redirect(route('trips.index'))->with('success','Trip added successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data = Trip::find($id);
        return view('admin.tripView',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = Trip::find($id);
        $vehicleType= TruckType::orderBy('truckName','ASC')->get();
        $drivers= Driver::orderBy('driverName','ASC')->get();
        $suppliers= Supplier::orderBy('supplierName','ASC')->get();
        
        return view('admin.trip',compact('vehicleType','drivers','suppliers','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate([
            'partyName'=>'required',
            'vehicleNumber'=>'required',
            'origin'=>'required',
            'destination'=>'required',
            'billingType'=>'required',
            'partyFreightAmount'=>'required',
            'startDate'=>'required|date',
        ]);
        
        $input['supplierName'] = $request->supplier_name;
        $input['status']=1;
        unset($input['_token']);
        unset($input['lrNo']);
        unset($input['lr_table_id']);
        unset($input['materialName']);
        unset($input['note']);
        unset($input['supplier_name']);
        unset($input['_method']);
        $res = Trip::where('id',$id)->update($input);
        
       
        return redirect(route('trips.index'))->with('success','Trip Update successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PartyAdvance::where('trip_id',$id)->delete();
        SupplierAdvance::where('trip_id',$id)->delete();
        SupplierCharges::where('trip_id',$id)->delete();
        PartyCharges::where('trip_id',$id)->delete();
        SupplierPayment::where('trip_id',$id)->delete();
        PartyPayment::where('trip_id',$id)->delete();
        Trip::find($id)->delete();
        return redirect()->back();
    }


    public function save_material(Request $request){
        
       $input =  $request->all();
       $input['trip_id'] =isset($request->id) ? $request->id : 0;
       LRList::create($input);
       return "Added Material successfully";

    }


    public function fetch_material(Request $request){
        
        $records = LRList::where('trip_id',isset($request->id) ? $request->id : 0)->get();
       
        $html = '';
        $i=1;
        foreach($records as $tc){
            $html .= '<tr>
                        <td>'.$i++.'</td>
                        <td>'.$tc->lr_no.'</td>
                        <td>'.$tc->material.'</td>
                        <td>'.$tc->details.'</td>
                        <td> <i class="mdi mdi-window-close" onclick="delMaterial('.$tc->id.')"></i></td>
                    </tr>';
        }
     return $html;
     }

    public function partyPdf(Request $request,$id){
       
        $pdf=App::make('dompdf.wrapper');
        $data =Trip::find($id);
        $com = Company::first();
        view()->share(compact('com','data'),$com,$data);
        $pdf = PDF::loadView('admin.trip_party_pdf');
        $pdf->setPaper('A4');
        return $pdf->stream();
    }

    
}
