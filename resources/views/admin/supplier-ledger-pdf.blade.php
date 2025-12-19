@php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddShortController;
@endphp

<style>
 table,td {

  border-spacing: -1px;
  font-size: 14px;
  border: 0.5px solid black;

}

th{
	padding-left: 26px;
	padding-bottom: 6px;
	padding-top: 6px;
	padding-right:  6px;
    border: 0.5px solid black;

	text-align: left;

}
/*td {

padding-left: 4px;
}*/


#background{
    position:absolute;
    z-index:0;
    background:white;
    display:block;
    min-height:50%; 
    min-width:50%;
    color:yellow;
}

#content{
    position:absolute;
    z-index:1;
}

#bg-text
{
    color:lightgrey;
    font-size:120px;
    transform:rotate(300deg);
    -webkit-transform:rotate(300deg);
}
</style>
  <div class="container-fluid">
         <div class="row">
                         
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                 
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            
                                        </ul> <!-- end nav-->
                                        <div class="tab-content">
                                         <div class="tab-pane show active" id="buttons-table-preview">
                                            
                                            <div class="table-responsive">
                                                <table class="table" style="width:100%;">
                                                    <thead>
                                                    <tr>
                                                        
                                                        <th colspan="12" style="text-align:center;"> <h1 style="margin-bottom:-20px;">{{ $com->name }}</h1>
                                                            <br><p style="margin-bottom:-20px;">{{ $com->mobile }},{{ $com->phone }}</p>
                                                            <br><p>{{ $com->address }}</p>
                                                        </th>
                                                        
                                                       
                                                    </tr>
                                                    <tr>
                                                        
                                                        <th>Date</th>
                                                        <th>Truck No.</th>
                                                        <th>Supplier / Owner</th>
                                                        <th>Destionation</th>
                                                        <th>Party</th>
                                                        <th>Qyt(MT)</th>
                                                        <th>Rate</th>
                                                        <th>Fright</th>
                                                        <th>Total Advance</th>
                                                        <th>Total Charges</th>
                                                        <th>Total Payment</th>
                                                        <th>Balance</th>
                                                       
                                                    </tr>
                                                    </thead>
                                                
                                                
                                                   <tbody>

                                                   @php
                                                    $total_supplierBalance=0;
                                                    $total_freight=0;
                                                    $total_adv=0;
                                                    $total_charges=0;
                                                    $total_payment=0;
                                                    
                                                   @endphp

                                                   @foreach($records as $row)
                                                   @php
                                                    $partyName = AdminController::getValueStatic2('parties','partyName','id',$row->partyName);
                                                 
                                                   $supplierName = AdminController::getValueStatic2('suppliers','supplierName','id',$row->supplierName);
                                                  
                                                   $vehicleNumber = AdminController::getValueStatic2('vehicles','vehicleNumber','id',$row->vehicleNumber);
                                                   
                                                   $ownership = AdminController::getValueStatic2('vehicles','ownership','id',$row->vehicleNumber);
                                                   
                                                   $origin = AdminController::getValueStatic2('routes','name','id',$row->origin);
                                                   
                                                   $destination = AdminController::getValueStatic2('routes','name','id',$row->destination);
                                                   $partyBalance= AddShortController::partyBalance($row->id);
                                                   
                                                    //$supplierBalance= AddShortController::supplierBalance($row->id);

                                                    $suptotalChargesDection =AddShortController::sumfucntion('supplier_charges','trip_id','chargesAmount',$row->id,'billtype',2);
                                                    $suptotalChargesAdd =AddShortController::sumfucntion('supplier_charges','trip_id','chargesAmount',$row->id,'billtype',1);
                                                    $totalSupplierPayment = AddShortController::sumfucntion2('supplier_payments','trip_id','amount',$row->id);
                                                    $suptotalPartyAdvance = AddShortController::sumfucntion2('supplier_advances','trip_id','amount',$row->id);
                                                    $supplierBalance = $row->truckHireAmount - $suptotalPartyAdvance-$totalSupplierPayment + $suptotalChargesAdd - $suptotalChargesDection ;
                                                    
                                                @endphp
                                                        
                                                        @if($supplierBalance==0)

                                                        @php
                                                            $total_freight+=$row->truckHireAmount;
                                                            $total_adv+=$suptotalPartyAdvance;
                                                            $total_payment+=$totalSupplierPayment;
                                                            $total_charges+=$suptotalChargesAdd - $suptotalChargesDection;
                                                            $total_supplierBalance+=$supplierBalance;

                                                            $vehNum=  isset($vehicleNumber) ? $vehicleNumber : '';
                                                            $onwer = isset($ownership) ? $ownership : ''  ;
                                                            $org = isset($origin) ? $origin : '';
                                                            $desti = isset($destination) ? $destination : '';
                                                            $supp = isset($supplierBalance) ? round($supplierBalance) : '0';
             
                                                        @endphp

                                                        <tr>
                                                            <td>{{ date('d-m-Y',strtotime($row->startDate)) }}</td>
                                                            <td>{{ $vehNum  }}</span></td>
                                                         
                                                            <td>{{ $supplierName }}</td>
                                                         
                                                            <td>{{ $desti }}  </td>
                                                            <td>{{ $partyName }}</td>
                                                            <td style="text-align:center;">{{ $row->truck_rate_per }}</td>
                                                            <td style="text-align:center;">{{ $row->truck_unit_per }}</td>
                                                            <td style="text-align:center;"> {{ $row->truckHireAmount }}</td>
                                                            <td style="text-align:center;">{{ $suptotalPartyAdvance }}</td>
                                                            <td style="text-align:center;">{{ $suptotalChargesAdd - $suptotalChargesDection  }}</td>
                                                            <td style="text-align:center;">{{ $totalSupplierPayment }}</td>
                                                            <td style="text-align:center;">{{  $supp }}</td>
                                                            </tr>
                                                            
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <th colspan="7" style="text-align:right; ">Total</th>
                                                    <th style="text-align:center;"> {{ round($total_freight) }}</th>
                                                    <th style="text-align:center;">{{ round($total_adv) }}</th>
                                                    <th style="text-align:center;">{{ round($total_charges) }}</th>
                                                    <th style="text-align:center;">{{ round($total_payment) }}</th>
                                                    <th style="text-align:center;">{{ round($total_supplierBalance) }}</th>
                                                    
                                                    </tfoot>
                                                  
                                                </table>    
                                                </div> <!-- end preview-->  
                                                                      
                                            </div> <!-- end preview-->
                                       
                                          
                                        </div> <!-- end tab-content-->
                                        
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

  </div>   

            
