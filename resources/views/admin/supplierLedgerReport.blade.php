@php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddShortController;
@endphp
@extends('layouts.app')
@section('body')
<script type="text/javascript">
   $(function() {
     
    $('#from_date').datepicker({ dateFormat: 'dd-mm-yy' }).val();
     $('#to_date').datepicker({ dateFormat: 'dd-mm-yy' }).val();
    });
   
   
</script>
   <!-- Start Content-->
  <div class="container-fluid">

  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Supplier Report</h4>
                                    
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 



         <div class="row">
                            <form>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="mb-2 col-md-2">
                                                <input class="form-control" type="date" name="from_date" id="from_date" value="<?php echo isset($_GET['from_date']) ? date('m/d/Y',strtotime($_GET['from_date'])) : ''  ?>" />
                                            </div>

                                            <div class="mb-2 col-md-2">
                                                <input  class="form-control" type="date" name="to_date" id="to_date" value="<?php echo isset($_GET['to_date']) ? date('m/d/Y',strtotime($_GET['to_date'])) : ''  ?>"/>
                                            </div>

                                            <div class="mb-2 col-md-2">
                                                <select class="form-select js-example-basic-single advanceType" name="id" id="id" >
                                                <option value="" selected>Select</option>

                                                </select>
                                            </div>


                                            <!--<div class="mb-2 col-md-2">-->
                                            <!--    <select class="form-select js-example-basic-single" name="status" id="status" >-->
                                            <!--        <option value="" selected>Selected Status</option>-->
                                            <!--        <option value="1" >Start</option>-->
                                            <!--        <option value="2" >Complete Trip</option>-->
                                            <!--        <option value="3" >POD Received</option>-->
                                            <!--        <option value="4" >POD Submited</option>-->
                                            <!--        <option value="5" >Settlement</option>-->
                                            <!--    </select>-->
                                            <!--</div>-->
                                            <!--<script> $("#status").val(<?php echo isset($_GET['status']) ? $_GET['status'] : ''  ?>);-->
                                            <!--</script>-->
                                            <div class="mb-2 col-md-2">
                                                <button class="btn btn-primary pull-right">Search</button>  
                                                <a href="{{ Route('supplierledgerReport') }}" class="btn btn-success pull-right">Reset</a>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      <a target="_blank" class="btn btn-primary" href="{{ route('supplierledgerPdf') }}?id=<?php echo isset($_GET['id']) ? $_GET['id'] : '';  ?>&from_date=<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''  ?>&to_date=<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''  ?>&status=<?php echo isset($_GET['status']) ? $_GET['status'] : ''  ?>" >PDF</a>
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            
                                        </ul> <!-- end nav-->
                                        <div class="tab-content">
                                         <div class="tab-pane show active" id="buttons-table-preview">
                                            
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
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
                                                        <th>Trips Status</th>
                                                        <th>View</th>
                                                            
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
                                                    if(isset($row->supplierName)){
                                                        $supplierName = AdminController::getValueStatic2('suppliers','supplierName','id',$row->supplierName);
                                                        }
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
                                                        @endphp

                                                        <tr>
                                                            <td>{{ date('d-m-Y',strtotime($row->startDate)) }}</td>
                                                            <td>{{ isset($vehicleNumber) ? $vehicleNumber : ''  }} <span style="color:blue;">( {{ isset($ownership) ? $ownership : ''  }} )</span></td>
                                                         
                                                            <td>{{ isset($supplierName) ? $supplierName : ''  }}</td>
                                                         
                                                            <td>{{ isset($origin) ? $origin : '' }} => {{ isset($destination) ? $destination : '' }}  </td>
                                                            <td>{{ $partyName }}</td>
                                                            <td>{{ $row->truck_rate_per }}</td>
                                                            <td>{{ $row->truck_unit_per }}</td>
                                                            <td>₹ {{ $row->truckHireAmount }}</td>
                                                            <td>₹ {{ $suptotalPartyAdvance }}</td>
                                                            <td>₹ {{ $suptotalChargesAdd - $suptotalChargesDection  }}</td>
                                                            <td>₹ {{ $totalSupplierPayment }}</td>
                                                            <td> ₹ {{ isset($supplierBalance) ? round($supplierBalance) : '0' }}</td>
                                                            <td> <span class="btn btn-success" > 
                                                                    Settlement
                                                                </span></td>
                                                          

                                                             <td><a href="{{ route('trips.show',$row->id) }}"><span class="btn btn-primary" > View </span></a></td>
                                                        </tr>
                                                            
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <th colspan="7" style="text-align:right">Total</th>
                                                    <th>₹ {{ round($total_freight) }}</th>
                                                    <th>₹ {{ round($total_adv) }}</th>
                                                    <th>₹ {{ round($total_charges) }}</th>
                                                    <th>₹ {{ round($total_payment) }}</th>
                                                    <th>₹ {{ round($total_supplierBalance) }}</th>
                                                    <th id="payamount"></th>
                                                    <th>
                                                   </th>
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

  <script>
  
  function totalSum(value){

    var payamount = $("#payamountHiden").val();
   if(payamount==''){
    payamount=0;  
   }

    var total = parseInt(payamount)+parseInt(value);

    $("#payamountHiden").val(total);
    $("#payamount").html(total);

  }
  function fetchAType($id=0){
     $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=suppliers&id=id&column=supplierName',
            success:function(response){
                console.log(response);
                $(".advanceType").html(response);
                $(".advanceType").val(<?php echo isset($_GET['id']) ? $_GET['id'] : '';  ?>);
                $('.advanceType').trigger('change'); 
            }
            });
    };

    fetchAType();
  </script>               
@endsection