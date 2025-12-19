@php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddShortController;
@endphp
@extends('layouts.app')
@section('body')
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
         <x-alert />
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            
                                        </ul> <!-- end nav-->
                                        <div class="tab-content">
                                        <form action="{{ route('supplierMultiPayment') }}" method="post">
                                           @csrf
                                           
                                            <div class="tab-pane show active" id="buttons-table-preview">
                                            
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                        
                                                        <th>Date</th>
                                                        <th>supplierName</th>
                                                            <th>Truck No.</th>
                                                            <th>Route</th>
                                                            <th>Trips Status</th>
                                                            <th>Supplier Balance</th>
                                                            <th>Payment Amount</th>
                                                            <th>View</th
                                                            
                                                        </tr>
                                                    </thead>
                                                
                                                
                                                   <tbody>
                                                   @php
                                                    $total_supplierBalance=0;
                                                   @endphp
                                                   @foreach($records as $row)
                                                   @php
                                                   $supplierName = AdminController::getValueStatic2('suppliers','supplierName','id',$row->supplierName);
                                                  
                                                   $vehicleNumber = AdminController::getValueStatic2('vehicles','vehicleNumber','id',$row->vehicleNumber);
                                                   
                                                   $ownership = AdminController::getValueStatic2('vehicles','ownership','id',$row->vehicleNumber);
                                                   
                                                   $origin = AdminController::getValueStatic2('routes','name','id',$row->origin);
                                                   
                                                   $destination = AdminController::getValueStatic2('routes','name','id',$row->destination);
                                                   $partyBalance= AddShortController::partyBalance($row->id);
                                                   $supplierBalance= AddShortController::supplierBalance($row->id);
                                                   $total_supplierBalance+=$supplierBalance;
                                                @endphp
                                                        
                                                        @if($supplierBalance!=0)
                                                        <tr>
                                                            <td>{{ date('d-m-Y',strtotime($row->startDate)) }}</td>
                                                            <td>{{ $supplierName }}</td>
                                                         
                                                            <td>{{ isset($vehicleNumber) ? $vehicleNumber : ''  }} <span style="color:blue;">( {{ isset($ownership) ? $ownership : ''  }} )</span></td>
                                                            <td>{{ isset($origin) ? $origin : '' }} => {{ isset($destination) ? $destination : '' }}  </td>
                                                            <td> <span class="btn btn-success" > 
                                                                @if($row->status==1) 
                                                                    Start    
                                                                @elseif($row->status==2)
                                                                    Complete Trip
                                                                @elseif($row->status==3)
                                                                    POD Received
                                                                @elseif($row->status==4)
                                                                    POD Submited
                                                                @elseif($row->status==5)
                                                                    Settlement
                                                                @endif 
                                                                </span></td>
                                                            <td> ₹ {{ isset($supplierBalance) ? round($supplierBalance) : '0' }}</td>

                                                            <td>  <input type="hidden" name="ids[]" value="{{ $row->id }}"/> 
                                                            <input type="number" name="payment[]" value="0" onchange="totalSum(this.value)" /></td>
                                                            <td><a href="{{ route('trips.show',$row->id) }}"><span class="btn btn-primary" > View </span></a></td>
                                                        </tr>
                                                            
                                                        @endif
                                                    @endforeach
                                                    </tbody>

                                                    <tfoot>
                                                    <th colspan="5" style="text-align:right">Total</th>
                                                    <th>{{ round($total_supplierBalance) }}</th>
                                                    <th id="payamount"></th>
                                                    <th><input type="hidden" id="payamountHiden" name="totalamount" />
                                                   </th>
                                                    </tfoot>
                                                </table>    
                                                </div> <!-- end preview-->  
                                                <div class="mb-3 col-md-3">
                                                     <input  type="date" class="form-control" name="paymentDate">
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                             <select class="form-select advanceType" name="spayType" id="spayType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                            </select>
                                                </div>
                                                
                                                <div class="mb-3 col-md-3">
                                                             <textarea   class="form-control" placeholder="Notes" name="text"></textarea>
                                                </div>
                                                
                                                <button class="btn btn-primary pull-right">Save</button>                                
                                            </div> <!-- end preview-->
                                       
                                           </form>
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
            url:'{{ url("common-get-select2") }}?table=advance_types&id=id&column=name',
            success:function(response){
                console.log(response);
                $(".advanceType").html(response);
                $(".advanceType").val(id);
                $('.advanceType').trigger('change'); 
            }
            });
    };

    fetchAType();
  </script>               
@endsection