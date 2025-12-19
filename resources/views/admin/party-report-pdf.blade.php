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
   <!-- Start Content-->
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
                                                        
                                                        <th colspan="9" style="text-align:center;"> <h1 style="margin-bottom:-20px;">{{ $com->name }}</h1>
                                                            <br><p style="margin-bottom:-20px;">{{ $com->mobile }},{{ $com->phone }}</p>
                                                            <br><p>{{ $com->address }}</p>
                                                        </th>
                                                        
                                                       
                                                    </tr>
                                                        <tr>
                                                        
                                                         <th>Date</th>
                                                            <th>Party Name</th>
                                                            <th>Truck No.</th>
                                                            <th>Destionation</th>
                                                            <th>Fright</th>
                                                            <th>Total Advance</th>
                                                            <th>Total Charges</th>
                                                            <th>Total Payment</th>
                                                            <th>Balance</th>
                                                            
                                                           
                                                        </tr>
                                                    </thead>
                                                
                                                
                                                   <tbody>
                                                   @php
                                                    $total_partyBalance=0;
                                                    $total_freight=0;
                                                    $total_adv=0;
                                                    $total_charges=0;
                                                    $total_payment=0;
                                                    $total_supplierBalance=0;
                                                   @endphp
                                            @foreach($records as $row)
                                                   @php
                                                   $partyName = AdminController::getValueStatic2('parties','partyName','id',$row->partyName);
                                                   $vehicleNumber = AdminController::getValueStatic2('vehicles','vehicleNumber','id',$row->vehicleNumber);
                                                   $ownership = AdminController::getValueStatic2('vehicles','ownership','id',$row->vehicleNumber);
                                                   $origin = AdminController::getValueStatic2('routes','name','id',$row->origin);
                                                   $destination = AdminController::getValueStatic2('routes','name','id',$row->destination);
                                                   //$partyBalance= AddShortController::partyBalance($row->id);
                                                   $supplierBalance= AddShortController::supplierBalance($row->id);
                                                    $partyFreightAmount = $row->partyFreightAmount;
                                                    $totalChargesAdd =AddShortController::sumfucntion('party_charges','trip_id','chargesAmount',$row->id,'billtype',1);
                                                    $totalChargesDection =AddShortController::sumfucntion('party_charges','trip_id','chargesAmount',$row->id,'billtype',2);
                                                    $totalPartyAdvance = AddShortController::sumfucntion2('party_advances','trip_id','amount',$row->id);
                                                    $totalPartypayment = AddShortController::sumfucntion2('party_payments','trip_id','amount',$row->id);
                                                    $partyBalance = $partyFreightAmount + $totalChargesAdd - $totalChargesDection - $totalPartyAdvance - $totalPartypayment ;
                                                    

                                                @endphp
                                                    @if($partyBalance!=0)
                                                        @php
                                                            $total_partyBalance += $partyBalance;
                                                            $total_freight+=$partyFreightAmount;
                                                            $total_adv+=$totalPartyAdvance;
                                                            $total_payment+=$totalPartypayment;
                                                            $total_charges+=$totalChargesAdd - $totalChargesDection;
                                                            $total_supplierBalance+=$supplierBalance;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ date('d-m-Y',strtotime($row->startDate)) }}</td>
                                                            <td>{{ $partyName }}</td>
                                                         
                                                            <td>{{ isset($vehicleNumber) ? $vehicleNumber : ''  }} <span style="color:blue;">( {{ isset($ownership) ? $ownership : ''  }} )</span></td>
                                                            <td>{{ isset($origin) ? $origin : '' }} => {{ isset($destination) ? $destination : '' }}  </td>
                                                            <td> {{ $partyFreightAmount }}</td>
                                                            <td> {{ $totalPartyAdvance }}</td>
                                                            <td> {{ $totalChargesAdd - $totalChargesDection  }}</td>
                                                            <td> {{ $totalPartypayment }}</td>
                                                            
                                                            <td>  {{ isset($partyBalance) ? round($partyBalance) : '0' }}</td>
                                                        
                                                          </tr>
                                                            
                                                    @endif
                                                @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <th colspan="4" style="text-align:right">Total</th>
                                                    <th> {{ round($total_freight) }}</th>
                                                    <th> {{ round($total_adv) }}</th>
                                                    <th> {{ round($total_charges) }}</th>
                                                    <th> {{ round($total_payment) }}</th>
                                                    <th>{{ round($total_partyBalance) }}</th>
                                                    
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
  
  
