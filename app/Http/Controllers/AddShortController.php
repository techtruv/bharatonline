<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\Models\Expenses;
use PDF;
use App;
use Dompdf\Canvas;
use Dompdf\Dompdf; 
use Dompdf\Options; 
use PhpParser\Node\Expr\FuncCall;
use Dompdf\FontMetrics; 
use App\Models\Supplier;
use App\Models\Trip;
use App\Models\Party;
use App\Models\Route;
use App\Models\PartyAdvance;
use App\Models\SupplierAdvance;
use App\Models\SupplierCharges;
use App\Models\PartyCharges;
use App\Models\SupplierPayment;
use App\Models\PartyPayment;
use App\Models\Vehicle;
use App\Models\Company;
use App\Models\Head;
use Maatwebsite\Excel\Facades\Excel;

use DB;

class AddShortController extends Controller
{
    public function AddShort(Request $request){
        
      $input =  $request->all();

        if($request->page=='AddExpenses'){

            unset($input['page']);
            ExpenseType::create($input);
            return "1";
        }


        if($request->page=='addParty'){

            unset($input['page']);
            Party::create($input);
            return "1";
        }

        if($request->page=='addVehicle'){

            unset($input['page']);
        
            $input['supplier_id']=$request->supplierName;
            unset($input['supplierName']);
            $input['driver_id']=$request->driverName;
            unset($input['driverName']);
            $input['vehicleNumber'] = \Str::upper($request->vehicleNumber);
            Vehicle::create($input);
            return "1";
        }



        if($request->page=='addHead'){

            unset($input['page']);
            Head::create($input);
            return "1";
        }


        if($request->page=='addState'){

            unset($input['page']);
            Route::create($input);
            return "1";
        }


        if($request->page=='AddExpenses'){

            unset($input['page']);
            ExpenseType::create($input);
            return "1";
        }


        if($request->page=='xAddAdvanceType'){

            unset($input['page']);
            \App\Models\AdvanceType::create($input);
            return "1";
        }

        if($request->page=='SaveExpenses'){

            unset($input['page']);
            $input['expensesDate'] = date('Y-m-d',strtotime($request->expensesDate));
            $input['user_id'] =auth()->user()->id;
            Expenses::create($input);
            return "1";
        }

        //Add Charge Type 

        if($request->page=='xAddChargeType'){

            unset($input['page']);
            \App\Models\ChargesType::create($input);
            return "1";
        }

        // Save Party Charge 

        if($request->page=='saveCharge'){

            unset($input['page']);
            $input['chargesDate'] = date('Y-m-d',strtotime($request->chargesDate));
            $input['user_id'] =auth()->user()->id;
            \App\Models\PartyCharges::create($input);
            return "1";
        }


         // Save Party Charge 

         if($request->page=='SaveComplete'){
          
            
            Trip::where('id',$request->trip_id)->update([
                'endDate'=>date('Y-m-d',strtotime($request->endDate)),
                'endKmsReading' => $request->endKmsReading,
                'status' => '2',
            ]);
            return "1";
         }

        


           // Save SaveComplete

           if($request->page=='SavePODSubmit'){
          
           
            Trip::where('id',$request->trip_id)->update([
                'pod_submitted_date'=>date('Y-m-d',strtotime($request->pod_submitted_date)),
                'status' => '4',
            ]);
            return "1";
         }

    }
    
    public static function Settlement($id){
        $row = Trip::find($id);
        $suptotalChargesDection =AddShortController::sumfucntion('supplier_charges','trip_id','chargesAmount',$row->id,'billtype',2);
        $suptotalChargesAdd = AddShortController::sumfucntion('supplier_charges','trip_id','chargesAmount',$row->id,'billtype',1);
        $totalSupplierPayment = AddShortController::sumfucntion2('supplier_payments','trip_id','amount',$row->id);
        $suptotalPartyAdvance = AddShortController::sumfucntion2('supplier_advances','trip_id','amount',$row->id);
       
       $supplierBalance = $row->truckHireAmount - $suptotalPartyAdvance-$totalSupplierPayment + $suptotalChargesAdd - $suptotalChargesDection ;
        if($supplierBalance==0){
            $row->status = 5;
            $row->save();
        }
                                               
    }

    public function supplierMultiPayment(Request $request){
        $request->all();
        $sizeof = sizeof($request->ids);
        $request->validate([
            'spayType'=>'required',
            'paymentDate'=>'required',
        ]);
        $ids = $request->ids;
        $p = $request->payment;
       
        for($i=0; $i<$sizeof; $i++){
            if($p[$i]!=0){
            
            
            DB::table('supplier_payments')
                        ->insert([
                            'trip_id'=>$ids[$i],
                            'advanceType'=>$request->spayType,
                            'bulk_type'=>1,
                            'ledger_amount'=>$request->totalamount,
                            'text'=>$request->text.'  @'.$request->totalamount,
                            'paymentDate'=>date('Y-m-d',strtotime($request->paymentDate)),
                            'amount'=>$p[$i],
                            'user_id'=>auth()->user()->id,
                            'page'=>7
                            ]);
                            
                AddShortController::Settlement($ids[$i]);

            } 
        }
        
        return redirect(route('supplierReport'));
    }


    public function partyMultiPayment(Request $request){
        $sizeof = sizeof($request->ids);
        $request->validate([
            'spayType'=>'required',
            'paymentDate'=>'required',
        ]);
        $ids = $request->ids;
        $p = $request->payment;
       
        for($i=0; $i<$sizeof; $i++){
            if($p[$i]!=0){
            DB::table('party_payments')
                        ->insert([
                            'trip_id'=>$ids[$i],
                            'advanceType'=>$request->spayType,
                            'paymentDate'=>date('Y-m-d',strtotime($request->paymentDate)),
                            'amount'=>$p[$i],
                            'user_id'=>auth()->user()->id,
                            'page'=>6
                            ]);
            } 
        }
        return redirect(route('partyReport'));

    }

    public function addPODReceive(Request $request){
      
        $fileName ='';
        if ($request->hasFile('pod_receuve_doc')) {
            $rand_val = date('YMDHIS') . rand(11111, 99999);
            $image_file_name = md5($rand_val);
            $file = $request->file('pod_receuve_doc');
            $fileName = $image_file_name . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploadFiles';
            $file->move($destinationPath, $fileName);
           
        }

        Trip::where('id',$request->trip_id)->update([
            'pod_receuve_date'=>date('Y-m-d',strtotime($request->pod_receuve_date)),
            'pod_receuve_doc' => $fileName,
            'status' => '3',
        ]);
        return "1";
    }
    public function masterDelete(Request $request){
        $table=$request->table;
         $id=$request->id;

        return  DB::table($table)->where('id',$id)->delete();
    }

    public static function sumfucntion($table,$key,$sum,$value,$key2,$value2){

      return  DB::table($table)->where($key,$value)->where($key2,$value2)->sum($sum);
    }
    public static function sumfucntion2($table,$key,$sum,$value){
        return  DB::table($table)->where($key,$value)->sum($sum);
      }

      public static function totalSupplierBalance($id){
        $records = Trip::where('supplierName',$id)->get();
        $suptotalChargesDection =0;
        $suptotalChargesAdd =0;
        $totalSupplierPayment = 0;
        $suptotalPartyAdvance = 0;
        $truckHireAmount=0;
        foreach($records as $data){
        $suptotalChargesDection += DB::table('supplier_charges')->where('trip_id',$data->id)->where('billtype',2)->sum('chargesAmount');
        $suptotalChargesAdd += DB::table('supplier_charges')->where('trip_id',$data->id)->where('billtype',1)->sum('chargesAmount');
        $totalSupplierPayment += DB::table('supplier_payments')->where('trip_id',$data->id)->sum('amount');
        $suptotalPartyAdvance += DB::table('supplier_advances')->where('trip_id',$data->id)->sum('amount');
        $truckHireAmount +=$data->truckHireAmount;
        }
      return  $truckHireAmount - $suptotalPartyAdvance - $totalSupplierPayment + $suptotalChargesAdd - $suptotalChargesDection ;
      
    }

    public static function totalPartyBalance($id){
        $records = Trip::where('partyName',$id)->get();
        $partyFreightAmount = 0;
        $totalChargesAdd =0;
        $totalChargesDection =0;
        $totalPartyAdvance = 0;
        $totalPartypayment = 0;
        
        foreach($records as $data){
        $partyFreightAmount += $data->partyFreightAmount;
        $totalChargesAdd +=AddShortController::sumfucntion('party_charges','trip_id','chargesAmount',$data->id,'billtype',1);
        $totalChargesDection +=AddShortController::sumfucntion('party_charges','trip_id','chargesAmount',$data->id,'billtype',2);
        $totalPartyAdvance += AddShortController::sumfucntion2('party_advances','trip_id','amount',$data->id);
        $totalPartypayment += AddShortController::sumfucntion2('party_payments','trip_id','amount',$data->id);
        }
        return $partyBalance = $partyFreightAmount + $totalChargesAdd - $totalChargesDection - $totalPartyAdvance - $totalPartypayment ;
   }

    function supplierReport(Request $request){
         $suppliers= Supplier::orderBy('supplierName','ASC')->get();
        $records = Supplier::orderBy('supplierName','asc')->get();
        
        $request->supplierName;
        if(isset($request->supplierName)){
            $records =$records->where('id',$request->supplierName);
        }
        return view('admin.supplierReport',compact('records','suppliers'));
      }


      function supplierledgerReport(Request $request){
         $records = Trip::get();
        
        if(isset($request->id)){
            $records =$records->where('supplierName',$request->id);
        }

        if(isset($request->from_date) && isset($request->to_date) ){
            $fromDate = date('Y-m-d',strtotime($request->from_date));
            $toDate = date('Y-m-d',strtotime($request->to_date));
            $records =$records->whereBetween('startDate',[$fromDate,$toDate]);
        }

        if(isset($request->status)){
            $records =$records->where('status',$request->status);
        }
        return view('admin.supplierLedgerReport',compact('records'));
      }

      function supplierledgerPdf(Request $request){
        $com = Company::first();
        $records = Trip::get();
        if(isset($request->id)){
            $records =$records->where('supplierName',$request->id);
        }
        if(isset($request->status)){
            $records =$records->where('status',$request->status);
        }
        
       if(isset($request->from_date) && isset($request->to_date) ){
            $fromDate = date('Y-m-d',strtotime($request->from_date));
            $toDate = date('Y-m-d',strtotime($request->to_date));
            $records =$records->whereBetween('startDate',[$fromDate,$toDate]);
        }

        $pdf=App::make('dompdf.wrapper');
        
        view()->share(compact('records','com'),$records,$com);
        $pdf = PDF::loadView('admin.supplier-ledger-pdf', $records);
        $pdf->setPaper('A4', 'landscape');
       return $pdf->stream();

      
      }
  
      function partyReport(){
        $records = Party::orderBy('partyName','asc')->get();
        return view('admin.partyReport',compact('records'));
      }

     

    public function supplierBalanceList($id){
       
         $records = Trip::where('supplierName',$id)->get();
        return view('admin.supplierBalanceList',compact('records'));
    }

    public function partyLedgerReport(Request $request){
       
        $records = Trip::get();
        if(isset($request->id)){
            $records =$records->where('partyName',$request->id);
        }
        
        if(isset($request->from_date) && isset($request->to_date) ){
            $fromDate = date('Y-m-d',strtotime($request->from_date));
            $toDate = date('Y-m-d',strtotime($request->to_date));
            $records =$records->whereBetween('startDate',[$fromDate,$toDate]);
        }

        return view('admin.partyLedgerReport',compact('records'));
   }


   public function partyledgerPdf(Request $request){
    $com = Company::first();
    $records = Trip::where('status',5)->get();
    
    if(isset($request->id)){
        $records =$records->where('partyName',$request->id);
    }
    
    if(isset($request->from_date) && isset($request->to_date) ){
            $fromDate = date('Y-m-d',strtotime($request->from_date));
            $toDate = date('Y-m-d',strtotime($request->to_date));
            $records =$records->whereBetween('startDate',[$fromDate,$toDate]);
        }
        
    $pdf=App::make('dompdf.wrapper');
        
    view()->share(compact('records','com'),$records,$com);
    $pdf = PDF::loadView('admin.party-report-pdf', $records);
    $pdf->setPaper('A4', 'landscape');
   return $pdf->stream();
  
}

   
    public function partyBalanceList($id){
        $records = Trip::where('partyName',$id)->get();
        return view('admin.partyBalanceList',compact('records'));
    }

    public static function partyBalance($id){
         $data = Trip::find($id);
         $partyFreightAmount = $data->partyFreightAmount;
         $totalChargesAdd =AddShortController::sumfucntion('party_charges','trip_id','chargesAmount',$data->id,'billtype',1);
         $totalChargesDection =AddShortController::sumfucntion('party_charges','trip_id','chargesAmount',$data->id,'billtype',2);
         $totalPartyAdvance = AddShortController::sumfucntion2('party_advances','trip_id','amount',$data->id);
         $totalPartypayment = AddShortController::sumfucntion2('party_payments','trip_id','amount',$data->id);
       return $partyBalance = $partyFreightAmount + $totalChargesAdd - $totalChargesDection - $totalPartyAdvance - $totalPartypayment ;
    }

    public static function supplierBalance($id){
        $data = Trip::find($id);
        $suptotalChargesDection =AddShortController::sumfucntion('supplier_charges','trip_id','chargesAmount',$data->id,'billtype',2);
        $suptotalChargesAdd =AddShortController::sumfucntion('supplier_charges','trip_id','chargesAmount',$data->id,'billtype',1);
        $totalSupplierPayment = AddShortController::sumfucntion2('supplier_payments','trip_id','amount',$data->id);
        $suptotalPartyAdvance = AddShortController::sumfucntion2('supplier_advances','trip_id','amount',$data->id);
        $truckHireAmount=$data->truckHireAmount;
       return $supBalance = $truckHireAmount - $suptotalPartyAdvance-$totalSupplierPayment + $suptotalChargesAdd - $suptotalChargesDection ;
      
    }


    public function companyLedger(Request $request){
        return view('admin.company-ledger');
    }


    
    
    public function tripsreports(Request $request){
        $data = Trip::find($request->trip_id);
        $status = $data->status; 
        $expenses = Expenses::where('trip_id',$request->trip_id)->get();
        
        $chargeAdds = PartyCharges::where('trip_id',$request->trip_id)->where('billtype',1)->get();
        $chargesdections = PartyCharges::where('trip_id',$request->trip_id)->where('billtype',2)->get();
        $partyAdvances = PartyAdvance::where('trip_id',$request->trip_id)->get();

        $partyFreightAmount = $data->partyFreightAmount;
        $totalChargesAdd =$this->sumfucntion('party_charges','trip_id','chargesAmount',$data->id,'billtype',1);
        $totalChargesDection =$this->sumfucntion('party_charges','trip_id','chargesAmount',$data->id,'billtype',2);
        $totalExpenses = $this->sumfucntion2('expenses','trip_id','expensesAmount',$data->id);
        $totalPartyAdvance = $this->sumfucntion2('party_advances','trip_id','amount',$data->id);
        $totalPartypayment = $this->sumfucntion2('party_payments','trip_id','amount',$data->id);
        $totalSupplierPayment = $this->sumfucntion2('supplier_payments','trip_id','amount',$data->id);
        
        $partyBalance = $partyFreightAmount + $totalChargesAdd - $totalChargesDection - $totalPartyAdvance - $totalPartypayment ;

         $truckHireAmount=$data->truckHireAmount;
         $supchargeAdds = SupplierCharges::where('trip_id',$request->trip_id)->where('billType',1)->get();
        $supchargesdections = SupplierCharges::where('trip_id',$request->trip_id)->where('billType',2)->get();
        $suppartyAdvances = SupplierAdvance::where('trip_id',$request->trip_id)->get();

        $suptotalChargesAdd =$this->sumfucntion('supplier_charges','trip_id','chargesAmount',$data->id,'billtype',1);
        $suptotalChargesDection =$this->sumfucntion('supplier_charges','trip_id','chargesAmount',$data->id,'billtype',2);
        $suptotalExpenses = $this->sumfucntion2('expenses','trip_id','expensesAmount',$data->id);
        $suptotalPartyAdvance = $this->sumfucntion2('supplier_advances','trip_id','amount',$data->id);
        $total_revenue=0;
        $total_revenue= $partyFreightAmount + $totalChargesAdd - $totalChargesDection ;
        $supBalance = $truckHireAmount - $suptotalPartyAdvance-$totalSupplierPayment + $suptotalChargesAdd - $suptotalChargesDection ;
      
        $profit='';
        $profit = $total_revenue - $truckHireAmount - $totalExpenses- $suptotalChargesAdd + $suptotalChargesDection;
        $total_expenses = $truckHireAmount + $totalExpenses + $suptotalChargesAdd - $suptotalChargesDection;

        $partyPayment = PartyPayment::where('trip_id',$request->trip_id)->get();

        $supplierPayment = SupplierPayment::where('trip_id',$request->trip_id)->get();

        $ownership = AdminController::getValueStatic2('vehicles','ownership','id',$data->vehicleNumber);

        $expTable='expenses';
        $supChareTable='supplier_charges';
        $supAdvTable='supplier_advances';
        $partyChareTabel="party_charges";
        $partyAdvTabel="party_advances";
        $partyPayTabel="party_payments";
        $supPayTable="supplier_payments";
        $html='';
            $html.='<div class="card">
                <div class="card-body">
                 <div class="row">
                 
                    <div class="col-md-6"> <h4 class="header-title mb-3">Revenue</h4> </div>
                    <div class="col-md-6"><h4 class="header-title mb-3">₹ '.$total_revenue.'</h4> </div>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Freight Amount : </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">₹  '.$partyFreightAmount.'</span> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Total Charges : </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">₹ '.$totalChargesAdd.'</span> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Total Deductions (-): </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">-₹ '.$totalChargesDection.'</span> </div>
                        </div>
                    
                    </ul>

                </div>
                <div class="card-body">
                   
                    <div class="card-body">
                    <div class="row">
                                <div class="col-md-6"> <h4 class="header-title mb-3">Expenses</h4> </div>
                                <div class="col-md-6"><h4 class="header-title mb-3">₹ '.$total_expenses.'</h4> </div>
                            </div>
                    </div>
                    <ul class="list-unstyled mb-0">';
                    if($ownership == 'Market Truck'){
                 $html.= '<div class="row">
                        <div class="col-md-6"> <span class="fw-bold me-2">Truck Hire Cost : </span> </div>
                        <div class="col-md-6"><span class="fw-bold me-2">₹ '.$truckHireAmount.'</span> </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6"> <span class="fw-bold me-2">Supplier Charges : </span> </div>
                        <div class="col-md-6"><span class="fw-bold me-2">₹ '.$suptotalChargesAdd.'</span> </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6"> <span class="fw-bold me-2">Supplier Deductions (-): </span> </div>
                        <div class="col-md-6"><span class="fw-bold me-2">₹ '.$suptotalChargesDection.'</span> </div>
                     </div>
                    ';
                    }
                 foreach($expenses as $exp){
                    $html.='<div class="row">
                    <div class="col-md-6"> <span class="fw-bold me-2">'. AdminController::getValueStatic2('expense_types','name','id',$exp->expensesType) .' </span> </div>
                    <div class="col-md-6 "><span class="fw-bold me-2">₹ '.$exp->expensesAmount.'</span>';
                    if($status!=5){ 
                        $html.='<button type="button" class="btn" onclick="masterdelete('."'$expTable'".','.$exp->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                    </button></div>';
                    }
                    $html.='
                    </div>';
                }
                    $html.='</ul>

                </div>
                <div class="card-body">
                <div class="row">
                            <div class="col-md-6"> <h4 class="header-title mb-3">Profit</h4> </div>
                            <div class="col-md-6"><h4 class="header-title mb-3">₹ '.$profit.'</h4> </div>
                        </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                <div class="row">
                <div class="col-md-6"> <span class="fw-bold me-2">
                    <h4 class="header-title mb-3">'.AdminController::getValueStatic2('parties','partyName','id',$data->partyName).'</h4>
                    </div>
                    <div class="col-md-6"><a href='.route("partyPdf",$request->trip_id).' class="btn btn-primary" target="_blank">View </a></div>
                </div>

                    <ul class="list-unstyled mb-0">
                        <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Freight Amount : </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">₹ '.number_format($partyFreightAmount,2) .'</span> </div>
                        </div>';
                        
                        foreach ($partyAdvances as $advx) {
                            $html.= ' <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Advance </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">-₹ '.$advx->amount.'</span>';
                            if($status!=5){ 
                                $html.= '<button type="button" class="btn" onclick="masterdelete('."'$partyAdvTabel'".','.$advx->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                            </button>';
                            }
                            $html.= '</div>
                        </div>';
                        }
                        

                        foreach ($chargeAdds as $chags) {
                            $html.= ' <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">'. AdminController::getValueStatic2('charges_types','name','id',$chags->chargesType) .' </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">₹ '.$chags->chargesAmount.'</span>'; 
                            if($status!=5){ 
                                $html.= '<button type="button" class="btn" onclick="masterdelete('."'$partyChareTabel'".','.$chags->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                            </button>';
                            }
                            $html.= '</div>
                        </div>';
                        }

                        foreach ($chargesdections as $chags) {
                            $html.= ' <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">'. AdminController::getValueStatic2('charges_types','name','id',$chags->chargesType) .' </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2"> - ₹ '. $chags->chargesAmount.'</span>';
                            
                            if($status!=5){ 
                                $html.= '<button type="button" class="btn" onclick="masterdelete('."'$partyChareTabel'".','.$chags->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                            </button>';
                            }
                            $html.= '</div>
                        </div>';
                        }
                        

                        foreach ($partyPayment as $partypay) {
                            $html.= ' <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Payment </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">  ₹ '. $partypay->amount.'</span>';
                            if($status!=5){  
                                $html.= '<button type="button" class="btn" onclick="masterdelete('."'$partyPayTabel'".','.$partypay->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                            </button>';
                            }
                             $html.= '</div>
                        </div>';
                        }
                        
                    $html.='<div class="row" style="border-top:1px solid #e8e6e6; padding-top: 10px;">
                    <div class="col-md-6"><h4 class="header-title mb-3"> Party Balance </h4> </div>
                    <div class="col-md-6"><span class="fw-bold me-2">  ₹ '.number_format($partyBalance,2).'</span> </div>
                        </div>
                    </ul>

                </div>';
                
                if($ownership == 'Market Truck'){
                $html.='<div class="card-body">
                    <h4 class="header-title mb-3">'.AdminController::getValueStatic2('suppliers','supplierName','id',$data->supplierName).'</h4>

                    <ul class="list-unstyled mb-0">
                        <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Truck Hire Cost : </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">₹ '.$truckHireAmount.'</span> </div>
                        </div>';

                        foreach ($suppartyAdvances as $adds) {
                            $sspaydt = date('d-m-Y',strtotime($adds->paymentDate));
                            $ssrmk = isset($adds->text) ? $adds->text : '';
                            
                            
                            $html.= ' <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Advance('.$sspaydt.') </span>
                            <br>
                            '.$ssrmk.'</div>
                            <div class="col-md-6"><span class="fw-bold me-2">-₹ '.$adds->amount.'</span>';
                            if($status!=5){ 
                                $html.= '<button type="button" class="btn" onclick="masterdelete('."'$supAdvTable'".','.$adds->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                            </button>';
                            }
                            $html.= '</div>
                        </div>';
                        }
                        

                        foreach ($supchargeAdds as $chagsa) {
                            $html.= ' <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">'. AdminController::getValueStatic2('charges_types','name','id',$chagsa->chargesType) .' </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2">₹ '.$chagsa->chargesAmount.'</span>'; 
                            if($status!=5){ 
                                $html.= '<button type="button" class="btn" onclick="masterdelete('."'$supChareTable'".','.$chagsa->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                            </button>';
                            }
                                $html.= '</div>
                                    </div>';
                        }

                        foreach ($supchargesdections as $chagss) {
                            $html.= ' <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">'. AdminController::getValueStatic2('charges_types','name','id',$chagss->chargesType) .' </span> </div>
                            <div class="col-md-6"><span class="fw-bold me-2"> - ₹ '. $chagss->chargesAmount.'</span>';
                            if($status!=5){ 
                                $html.='
                            <button type="button" class="btn" onclick="masterdelete('."'$supChareTable'".','.$chagss->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                            </button>';
                            }
                                $html.= '
                                </div>
                            </div>';
                        }

                        foreach ($supplierPayment as $spartypay) {
                            $paydt = date('d-m-Y',strtotime($spartypay->paymentDate));
                            $rmk = isset($spartypay->text) ? $spartypay->text : '';
                            
                            $html.= ' <div class="row">
                            <div class="col-md-6"> <span class="fw-bold me-2">Payment ('.$paydt.') </span>
                            <br>
                            '.$rmk.'
                            </div>
                            <div class="col-md-6"><span class="fw-bold me-2">  ₹ '. $spartypay->amount.'</span> '; 
                            if($status!=5){ 
                                $html.='<button type="button" class="btn" onclick="masterdelete('."'$supPayTable'".','.$spartypay->id.')"><i class="mdi mdi-trash-can-outline" style="color:blue;"></i>
                            </button>';
                            }
                            $html.= '
                            </div>
                          </div>';
                        }
                        
                    $html.='<div class="row" style="border-top:1px solid #e8e6e6; padding-top: 10px;">
                    <div class="col-md-6"> <h4 class="header-title mb-3"> Supplier Balance </h4> </div>
                    <div class="col-md-6"><span class="fw-bold me-2">  ₹ '.number_format($supBalance,2).'</span> </div>
                        </div>';
                    }
                    
                   $html.='</ul>

                </div>
               
            </div>';
        
        $data = array('partyBal'=>$partyBalance,'supBal'=>$supBalance,'html'=>$html);

    return json_encode($data,true);
    }


   
}
