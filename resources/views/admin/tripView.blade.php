@php
use App\Http\Controllers\AdminController;
use App\Models\Driver;
@endphp
@extends('layouts.app')
@section('body')
   <!-- Start Content-->

<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
   <div class="container-fluid" >
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Trips Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row justify-content-center">
                        <div class="col-lg-7 col-md-10 col-sm-11">
                             @if($data->status==1)
                                <button class="btn btn-primary" onclick="onComplete()">Complete Trip</button>
                            @elseif($data->status==2)
                                 <button class="btn btn-primary" onclick="onPODReceive()">POD Received</button>
                            @elseif($data->status==3)
                                 <button class="btn btn-primary" onclick="onPODSubmit()">POD Submited</button>
                            @elseif($data->status==4)
                                 <button class="btn btn-primary"  onclick="partyPaymentModel()">Settlement</button>
                            @endif
                                </div>



 
                            <div class="col-lg-7 col-md-10 col-sm-11">
        
                                <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                                    <div class="horizontal-steps-content">
                                        <div class="step-item ">
                                            
                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom">Started {{ isset($data->startDate) ? date('d-m-Y',strtotime($data->startDate)) : '' }}</span>
                                           
                                        </div>
                                        <div class="step-item current">
                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" >Completed</span>
                                        </div>
                                        <div class="step-item current">
                                            <span>POD Received</span>
                                        </div>

                                        <div class="step-item current">
                                            <span>POD Submited</span>
                                        </div>
                                        <div class="step-item current">
                                            <span>Delivered {{ isset($data->endDate) ? date('d-m-Y',strtotime($data->endDate)) : '' }}</span>
                                        </div>
                                    </div>
                                    
                                    @if($data->status==1)
                                    <div class="process-line" style="width: 0%;"></div>
                                    @elseif($data->status==2)
                                    <div class="process-line" style="width: 25%;"></div>
                                    @elseif($data->status==3)
                                    <div class="process-line" style="width: 50%;"></div>
                                    @elseif($data->status==4)
                                    <div class="process-line" style="width: 75%;"></div>
                                    @else
                                    <div class="process-line" style="width: 100%;"></div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        <!-- end row -->    
                        
                        
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">{{ AdminController::getValueStatic2('routes','name','id',$data->origin) }} -> {{ AdminController::getValueStatic2('routes','name','id',$data->destination) }}</h4>
            
            
                                    </div>
                                </div>
                               <div class="card">
                                    <div class="card-body">
                                    <table class="table mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>SN</th>
                                                    <th>LR NO</th>
                                                    <th>Material</th>
                                                    <th>Details</th>
                                                </tr>
                                                </thead>
                                                <?php
                                              $material_records =  AdminController::getRecords('l_r_lists','trip_id',$data->id);
                                                
                                                ?>
                                                
                                                <tbody >
                                                @foreach($material_records as $tc)
                                                    <tr>
                                                        <td>{{ $loop->index+1 }}</td>
                                                        <td>{{ $tc->lr_no }}</td>
                                                        <td>{{ $tc->material }}</td>
                                                        <td>{{ $tc->details }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                               
                                                
                                                </tbody>
                                            </table>
                                      
                                    </div>
                                
                            </div> <!-- end col -->

        
                            </div> <!-- end col -->
        
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>{{ AdminController::getValueStatic2('parties','partyName','id',$data->partyName) }}</br> ₹ {{  number_format($data->partyFreightAmount,2) }} </th>
                                                    <?php
                                                            $ownership = AdminController::getValueStatic2('vehicles','ownership','id',$data->vehicleNumber);
                                                    ?>
                                                    @if($ownership == 'Market Truck')
                                                    <th>{{ AdminController::getValueStatic2('vehicles','vehicleNumber','id',$data->vehicleNumber) }}</br> N/A</th>
                                                    
                                                    <th>
                                                        @if($data->supplierName)
                                                        {{ AdminController::getValueStatic2('suppliers','supplierName','id',$data->supplierName) }} 
                                                        @endif </br> ₹ {{ number_format($data->truckHireAmount,2) }}</th>
                                                    @endif
                                                    @if($ownership == 'My Truck')
                                                    <th></th>
                                                    <?php
                                                    $vehicleNumber=AdminController::getRecordFirst('vehicles','id',$data->vehicleNumber);
                                                    //$vehicleNumber = AdminController::getValueStatic2('vehicles','vehicleNumber','id',$data->vehicleNumber);
                                                    
                                                        $drivers = Driver::find($vehicleNumber->driver_id);
                                                        $driverName = $drivers->driverName;
                                                    
                                                    ?>
                                                    <th>{{ $vehicleNumber->vehicleNumber }} 
                                                    </br>{{ $driverName }} </th>
                                                    @endif
                                                </tr>
                                                </thead>
                                               
                                            </table>
                                        </div>

                                        
                                        <!-- end table-responsive -->
            
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div class="table-responsive">
                                        <div class="">
                                         <button  type="button" class="btn btn-primary" onclick="expensesModel()"><i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b> </br> Expenses </br></b></h5></button>
                                        &nbsp &nbsp
                                         <button  type="button" class="btn btn-primary" onclick="partyChargeModel()"><i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b>Party </br> Charges</b></h5></button>
                                            @if($ownership == 'Market Truck')
                                             &nbsp
                                            <button  type="button" class="btn btn-primary" onclick="supplierChargeModel()"><i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b>Supplier </br> Charges</b></h5></button>
                                            @endif
                                             &nbsp
                                            <button  type="button" class="btn btn-primary" onclick="partyAdvanceModel()"><i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b> Party </br> Advance</b></h5></button>
                                            
                                            @if($ownership == 'Market Truck')
                                            &nbsp
                                            <button  type="button" class="btn btn-primary" onclick="supplierAdvanceModel()"><i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b> Supplier </br> Advance</b></h5></button>
                                            @endif

                                             &nbsp
                                            <button  type="button" class="btn btn-primary" onclick="partyPaymentModel()"><i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b> Party </br> Payment</b></h5></button>
                                            @if($ownership == 'Market Truck')
                                            &nbsp
                                            <button  type="button" class="btn btn-primary" onclick="supplierPaymentModel()"><i class="mdi mdi-truck-fast h2 text-muted"></i>
                                            <h5><b> Supplier </br> Payment</b></h5></button>
                                            @endif
                                          
                                        </div>
                                        </div>

                                    </div>
                                </div>
                                                <div  id="reports">
                                                <div>
                                

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
        
        
                     
                    </div> <!-- container -->
                  
@include('admin.tripViewStatusModel');
@include('admin.tripViewjs');
@include('admin.tripViewajax');
@endsection







<!--Add Party Payment Modal -->
<div class="modal fade" id="partyPaymentModel" tabindex="-1" role="dialog" aria-labelledby="partyPaymentModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="partyPaymentModel">Add Party Payment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Payment Amount</label>
                                                            <input class="form-control" placeholder="Payment Amount" type="number" name="payAmount" id="payAmount"  />

                                                            <input class="form-control" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />
                                                           </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Payment Type <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="addAdvanceTypeModel()"></i></a></label>
                                                            <select class="form-select advanceType" name="payType" id="payType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                            </select>
                                                          </div>
                                                    </div>
                                                

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Payment Date</label>
                                                            <input type="date" class="form-control" name="payDate" id="payDate" required />
                                                         </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Note</label>
                                                            <textarea class="form-control" placeholder="Notes"  name="paymentNote" id="paymentNote" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SavePartyPayment()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>

<script>
    function SavePartyPayment(){
       
        var amount = $("#payAmount").val();
        var trip_id = $("#trip_id").val();
        var advanceType = $("#payType").val();
        var paymentDate = $("#payDate").val();
        var notes = $("#paymentNote").val();

        if(amount==''){
            alert('Please Select Payment Amount');
        }
        if(advanceType==''){
            alert('Please Select Payment Type');
        }
        
        if(paymentDate==''){
            alert('Please Fill Payment Date');
        }

        $.ajax({
            type:'GET',
            url:'{{ route("partyPayment.create") }}?page=6&amount='+amount+'&advanceType='+advanceType+'&trip_id='+trip_id+'&paymentDate='+paymentDate+'&text='+notes,
            success:function(response){
            //console.log(response);
            $("#payAmount").val('');
            $("#payType").val('');
            $("#payDate").val('');
            $("#paymentNote").val('');
            $("#partyPaymentModel").modal('hide');
            location.reload();
            fetchReports();
             }
            });
    }
</script>

<!--Add Supplier Advance Modal -->
<div class="modal fade" id="supplierAdvanceModel" tabindex="-1" role="dialog" aria-labelledby="supplierAdvanceModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supplierAdvanceModel">Add Supplier Advance</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Advance Amount</label>
                                                            <input class="form-control" placeholder="Advance Amount" type="number" name="sAdvanceAmount" id="sAdvanceAmount"  />

                                                            <input class="form-control" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />
                                                           </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Advance Type <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="addAdvanceTypeModel()"></i></a></label>
                                                            <select class="form-select advanceType" name="sadvanceType" id="sadvanceType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                            </select>
                                                          </div>
                                                    </div>
                                                

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Advnace Date</label>
                                                            <input type="date" class="form-control" name="sadvanceDate" id="sadvanceDate" required />
                                                         </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Note</label>
                                                            <textarea class="form-control" placeholder="Notes"  name="sNote" id="sNote" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SaveSupplierAdvanceCharge()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>

<script>
    function SaveSupplierAdvanceCharge(){
       
        var amount = $("#sAdvanceAmount").val();
        var trip_id = $("#trip_id").val();
        var advanceType = $("#sadvanceType").val();
        var paymentDate = $("#sadvanceDate").val();
        var notes = $("#sNote").val();

        if(amount==''){
            alert('Please Select Bill Type');
        }
        if(advanceType==''){
            alert('Please Select Advance Type');
        }
        
        if(paymentDate==''){
            alert('Please Fill Payment Date');
        }

        $.ajax({
            type:'GET',
            url:'{{ route("supplierAdvance.create") }}?page=5&amount='+amount+'&advanceType='+advanceType+'&trip_id='+trip_id+'&paymentDate='+paymentDate+'&text='+notes,
            success:function(response){
            //console.log(response);
            $("#sAdvanceAmount").val('');
            $("#sadvanceType").val('');
            $("#sadvanceDate").val('');
            $("#sNote").val('');
            $("#supplierAdvanceModel").modal('hide');
            fetchReports();
             }
            });
    }
</script>
<!--Add Party Charge Modal -->
<div class="modal fade" id="partyAdvanceModel" tabindex="-1" role="dialog" aria-labelledby="partyAdvanceModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="partyAdvanceModel">Add Party Advance</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Advance Amount</label>
                                                            <input class="form-control" placeholder="Advance Amount" type="number" name="partyAdvanceAmount" id="partyAdvanceAmount"  />

                                                            <input class="form-control" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />
                                                           </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Advance Type <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="addAdvanceTypeModel()"></i></a></label>
                                                            <select class="form-select advanceType" name="advanceType" id="advanceType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                            </select>
                                                          </div>
                                                    </div>
                                                

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Advnace Date</label>
                                                            <input type="date" class="form-control" name="advanceDate" id="advanceDate" required />
                                                         </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Note</label>
                                                            <textarea class="form-control" placeholder="Notes"  name="partyNote" id="partyNote" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SavePartyAdvanceCharge()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>

<script>
    function SavePartyAdvanceCharge(){
       
        var amount = $("#partyAdvanceAmount").val();
        var trip_id = $("#trip_id").val();
        var advanceType = $("#advanceType").val();
        var paymentDate = $("#advanceDate").val();
        var notes = $("#partyNote").val();

        if(amount==''){
            alert('Please Enter Amount');
        }
        if(advanceType==''){
            alert('Please Select Advance Type');
        }
        
        if(paymentDate==''){
            alert('Please Fill Payment Date');
        }

        $.ajax({
            type:'GET',
            url:'{{ route("partyAdvance.create") }}?page=4&amount='+amount+'&advanceType='+advanceType+'&trip_id='+trip_id+'&paymentDate='+paymentDate+'&notes='+notes,
            success:function(response){
            console.log(response);
            $("#partyAdvanceAmount").val('');
            $("#advanceType").val('');
            $("#advanceDate").val('');
            $("#partyNote").val('');
            $("#partyAdvanceModel").modal('hide');
            
            fetchReports();
            location.reload();
             }
            });
    }
</script>



<div class="modal fade m-5" id="addAdvanceTypeModel" tabindex="-1" role="dialog" aria-labelledby="addAdvanceTypeModel" aria-hidden="true" style="z-index: 1700;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAdvanceTypeModel">Add Advance Type</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Name</label>
                                                            <input class="form-control" placeholder="Name" type="text" name="aName" id="aName" required />
                                                            
                                                        </div>
                                                    </div>

                                                    
                                                   
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onClick="AddAdvanceType()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>



<!--Add Party Charge Modal -->
<div class="modal fade" id="supplierChargeModel" tabindex="-1" role="dialog" aria-labelledby="supplierChargeModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supplierChargeModel">Add Supplier Charge</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Bill Type </label>
                                                            <select class="form-select sbillType" name="sbillType" id="sbillType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                                <option value="1" selected>Add to Bill</option>
                                                                <option value="2" selected>Reduce From Bill</option>
                                                            </select>
                                                            
                                                          </div>
                                                         
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Charge Type <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="AddChargeType()"></i></a></label>
                                                            <select class="form-select chargesType" name="schargesType" id="schargesType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                            </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Charge Amount</label>
                                                            <input class="form-control" placeholder="Charge Amount" type="number" name="schargesAmount" id="schargesAmount"  />

                                                            <input class="form-control" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />
                                                           </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Charge Date</label>
                                                            <input type="date" class="form-control" name="schargesDate" id="schargesDate" required />
                                                         </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Note</label>
                                                            <textarea class="form-control" placeholder="Notes"  name="schargeNote" id="schargeNote" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SaveSupplirCharge()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>

<script>
    function SaveSupplirCharge(){
       
        var billType = $("#sbillType").val();
        var chargesType = $("#schargesType").val();
        var trip_id = $("#trip_id").val();
        var chargesAmount = $("#schargesAmount").val();
        var chargesDate = $("#schargesDate").val();
        var notes = $("#schargeNote").val();

        if(billType==''){
            alert('Please Select Bill Type');
        }
        if(chargesType==''){
            alert('Please Select Charge Type');
        }
        if(chargesAmount==''){
            alert('Please fill Charge Amount');
        }
        if(chargesDate==''){
            alert('Please Fill Charge Date');
        }

        $.ajax({
            type:'GET',
            url:'{{ route("supplierCharge.create") }}?page=3&billType='+billType+'&chargesType='+chargesType+'&trip_id='+trip_id+'&chargesAmount='+chargesAmount+'&notes='+notes+'&chargesDate='+chargesDate,
            success:function(response){
                
            $("#sbillType").val('');
            $("#schargesType").val('');
            $("#schargesAmount").val('');
            $("#schargesDate").val('');
            $("#schargeNote").val('');
            $("#supplierChargeModel").modal('hide');
            fetchReports();
             }
            });
    }
    </script>









<!--Add Party Charge Modal -->

<div class="modal fade" id="partyChargeModel" tabindex="-1" role="dialog" aria-labelledby="partyChargeModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="partyChargeModel">Add Party Charge</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Bill Type </label>
                                                            <select class="form-select billType" name="billType" id="billType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                                <option value="1" selected>Add to Bill</option>
                                                                <option value="2" selected>Reduce From Bill</option>
                                                                
                                                            </select>
                                                          </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Charge Type <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="AddChargeType()"></i></a></label>
                                                            <select class="form-select chargesType" name="chargesType" id="chargesType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                  
                                                                
                                                            </select>
                                                          </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Charge Amount</label>
                                                            <input class="form-control" placeholder="Charge Amount" type="number" name="chargesAmount" id="chargesAmount"  />

                                                            <input class="form-control" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />
                                                           </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Charge Date</label>
                                                            <input type="date" class="form-control" name="chargesDate" id="chargesDate" required />
                                                         </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Note</label>
                                                            <textarea class="form-control" placeholder="Notes"  name="chargeNote" id="chargeNote" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SavePartyCharge()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>

<script>
    function SavePartyCharge(){
        var billType = $("#billType").val();
        var chargesType = $("#chargesType").val();
        var trip_id = $("#trip_id").val();
        var chargesAmount = $("#chargesAmount").val();
        var chargesDate = $("#chargesDate").val();
        var notes = $("#chargeNote").val();
        $.ajax({
            type:'GET',
            url:'{{ route("addShort") }}?page=saveCharge&billType='+billType+'&chargesType='+chargesType+'&trip_id='+trip_id+'&chargesAmount='+chargesAmount+'&notes='+notes+'&chargesDate='+chargesDate,
            success:function(response){
            console.log(response);
            $("#billType").val('');
            $("#chargesType").val('');
            $("#chargesAmount").val('');
            $("#chargesDate").val('');
            $("#chargeNote").val('');
            $("#partyChargeModel").modal('hide');
            fetchReports();
             }
            });
    }
    </script>




<!-- Add Charge Type -->
<div class="modal fade m-5" id="chargeTypeAdd" tabindex="-1" role="dialog" aria-labelledby="chargeTypeAdd" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chargeTypeAdd">Add Charge Type</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Charge Type Name</label>
                                                            <input class="form-control" placeholder="Name" type="text" name="xChargeName" id="xChargeName" required />
                                                            
                                                        </div>
                                                    </div>

                                                    
                                                   
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onClick="xAddCharge()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>


<!-- Add Expenses Modal -->
<div class="modal fade" id="expensesModel" tabindex="-1" role="dialog" aria-labelledby="expensesModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="expensesModel">Add Expenses</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Expenses Type <a href="#" onclick="AddExpenses();"><i class="mdi mdi-plus-box" style="font-size:20px;"></i></a></label>
                                                            <select class="form-select expensesType" name="expensesType" id="xexpensesType" required>
                                                                <option value="bg-danger" selected>Select</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Expenses Amount</label>
                                                            <input class="form-control" placeholder="Expenses Amount" type="expensesAmount" name="expensesAmount" id="expensesAmount"  />

                                                            <input class="form-control" placeholder="Expenses Amount" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />

                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Expenses Date</label>
                                                            <input type="date" class="form-control" placeholder="Expenses Amount" type="expensesDate" name="expensesDate" id="expensesDate" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Payment Type <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="addAdvanceTypeModel()"></i></a></label>
                                                            <select class="form-select advanceType" name="epayType" id="epayType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                            </select>
                                                          </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Note</label>
                                                            <textarea class="form-control" placeholder="Expenses Notes"  name="expensesNote" id="expensesNote" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SaveExpenses()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>

<script>
    function SaveExpenses(){
        var expensesType = $("#xexpensesType").val();
        var expensesAmount = $("#expensesAmount").val();
        var trip_id = $("#trip_id").val();
        var epayType = $("#epayType").val();
        
        
        var notes = $("#expensesNote").val();
        if(expensesType==''){
            alert('Please Select Expenses Type');
        }
        if(expensesAmount==''){
            alert('Please Fill Expenses Name');
        } 
        if(expensesDate==''){
            alert('Please Fill Expenses Date');
        }

        if(epayType==''){
            alert('Please Select Payment Type');
        }

        $.ajax({
            type:'GET',
            url:'{{ route("addShort") }}?page=SaveExpenses&expensesType='+expensesType+'&expensesAmount='+expensesAmount+'&trip_id='+trip_id+'&expensesDate='+expensesDate+'&notes='+notes+'&payType='+epayType,
            success:function(response){
                fetchReports();
            
            $("#xexpensesType").val('');
            $("#expensesAmount").val('');
            $("#expensesDate").val('');
            $("#expensesNote").val('');
            $("#epayType").val('');
            $("#expensesModel").modal('hide');
          }
            });
    }
    </script>
//Add Expenses


<!-- Modal -->
<div class="modal fade m-5" id="expensesAdd" tabindex="-1" role="dialog" aria-labelledby="expensesAdd" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="expensesAdd">Add Expenses</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Name</label>
                                                            <input class="form-control" placeholder="Name" type="text" name="xName" id="xName" required />
                                                            
                                                        </div>
                                                    </div>

                                                    
                                                   
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onClick="ExShortSave()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>
@section('java_script')


<script>
function masterdelete(table,id){
    alert("Do you want to Delete?");
    $.ajax({
            type:'GET',
            url:'{{ url("master-delete") }}?page=delete&table='+table+'&id='+id,
            success:function(response){
                fetchReports();
             }
            });
}

function fetchReports(){
    var trip_id = $("#trip_id").val();
     $.ajax({
            type:'GET',
            url:'{{ url("tripsreports") }}?trip_id='+trip_id,
            success:function(response){
             var x =   JSON.parse(response);
                $("#reports").html(x.html);
                $("#payAmount").val(x.partyBal);
                $("#spayAmount").val(x.supBal);
             }
            });
    };

    fetchReports();
    

function AddChargeType(){
    $("#chargeTypeAdd").modal('show');
}

function xAddCharge(){
        var name = $("#xChargeName").val();
        if(name==''){
            alert('Please Fill Charge Name');
        }
        $.ajax({
            type:'GET',
            url:'{{ route("addShort") }}?page=xAddChargeType&name='+name,
            success:function(response){
            //console.log(response);
            $("#xChargeName").val('');
            $("#chargeTypeAdd").modal('hide');
            fetchChargeType();
              }
            });
    }

   function fetchChargeType($id=0){
     $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=charges_types&id=id&column=name',
            success:function(response){
                //console.log(response);
                $(".chargesType").html(response);
                $(".chargesType").val(id);
                $('.chargesType').trigger('change'); 
            }
            });
    };

    fetchChargeType();
</script>

<script>
function ExShortSave(){
        var name = $("#xName").val();
        if(name==''){
            alert('Please Fill Name');
        }
        $.ajax({
            type:'GET',
            url:'{{ route("addShort") }}?page=AddExpenses&name='+name,
            success:function(response){
            console.log(response);
            $("#xName").val('');
            $("#expensesAdd").modal('hide');
            fetchExpensesType();
              }
            });
    }

   function fetchExpensesType($id=0){
     $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=expense_types&id=id&column=name',
            success:function(response){
                //console.log(response);
                $(".expensesType").html(response);
                $(".expensesType").val(id);
                $('.expensesType').trigger('change'); 
            }
            });
    };

    fetchExpensesType();
</script>
<script>
    function AddAdvanceType(){
        var name = $("#aName").val();
        if(name==''){
            alert('Please Fill Charge Name');
        }
        $.ajax({
            type:'GET',
            url:'{{ route("addShort") }}?page=xAddAdvanceType&name='+name,
            success:function(response){
            //console.log(response);
            $("#aName").val('');
            $("#addAdvanceTypeModel").modal('hide');
            fetchAType();
              }
            });
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