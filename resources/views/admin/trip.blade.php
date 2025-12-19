@extends('layouts.app')
@section('body')
   <!-- Start Content-->
  <div class="container-fluid">

  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Trip</h4>  
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 

                <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                 
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="form-row-preview">
                                                 @if(isset($data))
                                                <form action="{{ route('trips.update',$data->id) }}" method="post">
                                                @method('PATCH')
                                                @else
                                                <form action="{{ route('trips.store') }}" method="post">
                                                @endif
                                                    @csrf
                                                    <div class="row g-2">
                                                        <h4> Trip Details</h4>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputEmail4" class="form-label">Select Party *
                                                            <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="Addparty()"></i></a>
                                                             </label>
                                                             <select id="partyName" name="partyName" class="form-select js-example-basic-single">
                                                               
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Truck Registration No.* 
                                                            <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="AddVehicle()"></i></a>
                                                            </label>
                                                             <select id="vehicleNumber" onchange="onVehiclechange()" name="vehicleNumber" class="form-select js-example-basic-single">
                                                               
                                                            </select>

                                                    
                                                        </div>


                                                        <div class="mb-3 col-md-3" id="optionData">
                                                           
                                                             
                                                        </div>

                                                        
                                                    </div>


                                                      <div class="row g-2">
                                                        <h4>Route  <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="AddRoute()"></i></a></h4>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputEmail4" class="form-label">Origin*</label>
                                                             <select id="origin" name="origin" class="form-select js-example-basic-single routes">
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Destination*</label>
                                                             <select id="destination" name="destination" class="form-select js-example-basic-single routes">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>


                                                      <div class="row g-2">
                                                        <h4>Billing Information</h4>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputEmail4" class="form-label">Party Billing Type *</label>
                                                             <select id="billingType" name="billingType" onchange="onPartyBillingTypechange()" class="form-select js-example-basic-single partybillType">
                                                                
                                                            </select>

                                                           
                                                       
                                                        </div>
                                                        
                                                        <div class="row g-2" id="supplier_per" style="display: none;">          
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Rate  <span id="title_rate_per"></span></label>
                                                             <input type="text" name="party_rate_per" onchange="onFreightRatechange()" class="form-control" id="party_rate_per" value="{{ old('party_rate_per',isset($data->party_rate_per) ? $data->party_rate_per : '' )  }}">
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Weight <span id="total_units"></span></label>
                                                             <input type="text" name="party_unit_per" onchange="onFreightRatechange()" class="form-control" id="party_unit_per" value="{{ old('party_unit_per',isset($data->party_unit_per) ? $data->party_unit_per : '' )  }}">
                                                        </div>
                                                        </div>
                                                        </div>

                                                       
                                                        <div class="row g-2">     
                                                            <div class="mb-3 col-md-3">
                                                                <label for="inputPassword4" class="form-label">Party Freight Amount*</label>
                                                                <input type="text" name="partyFreightAmount" class="form-control" id="partyFreightAmount" value="{{ old('partyFreightAmount',isset($data->partyFreightAmount) ? $data->partyFreightAmount : '' )  }}">
                                                            </div>
                                                        </div>


                                                    <div  id="supplierBillingDiv">
                                                     <div class="row g-2" >
                                                        
                                                        <div class="mb-3 col-md-3" >
                                                            <label for="inputEmail4" class="form-label">Supplier Billing Type *</label>
                                                             <select id="supplierBillingType" name="supplierBillingType" onchange="onSupplierBillingType()" class="form-select js-example-basic-single supbillType">
                                                                
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                   
                                                    <div class="row g-2" id="truck_per">     
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Rate  <span id="title_rate_per"></span></label>
                                                             <input type="text" name="truck_rate_per" onchange="onTruckHireAmoutn()" class="form-control" id="truck_rate_per"
                                                             value="{{ old('truck_rate_per',isset($data->truck_rate_per) ? $data->truck_rate_per : '' )  }}"
                                                             >
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Weight <span id="total_units"></span></label>
                                                             <input type="text" name="truck_unit_per" onchange="onTruckHireAmoutn()" class="form-control" id="truck_unit_per"
                                                             value="{{ old('truck_unit_per',isset($data->truck_unit_per) ? $data->truck_unit_per : '' )  }}"
                                                             
                                                             >
                                                        </div>
                                                        </div>
                                                        </div>
                                                    
                                                        
                                                    
                                                    <div class="row g-2" id="truckHireDiv">
                                                        
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Truck Hire Amount*</label>
                                                             <input type="text" name="truckHireAmount" class="form-control" id="truckHireAmount"
                                                             value="{{ old('truckHireAmount',isset($data->truckHireAmount) ? $data->truckHireAmount : '' )  }}"
                                                             >
                                                        </div>
                                                    </div>
                                                    </div>


        
                                                    <div class="row g-2">
                                                       
                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Start Date*</label>
                                                             <input type="date" name="startDate"  id="startDate" class="form-control" id="inputCity" 
                                                             value="{{ old('startDate',isset($data->startDate) ? $data->startDate :'' )  }}"
                                                              >
                                                        </div>


                                                        <div class="mb-3 col-md-3">
                                                            <label for="inputPassword4" class="form-label">Start Kms Reading*</label>
                                                             <input type="text" class="form-control" name="startKmsReading" id="startKmsReading"
                                                             value="{{ old('startKmsReading',isset($data->startKmsReading) ? $data->startKmsReading : '' )  }}"
                                                             >
                                                        </div>
                                                    </div>

                                                    <div class="row g-2">
                                                        <h4>Billing Information</h4>
                                                        <table class="table mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>SN</th>
                                                    <th>LR No</th>
                                                    <th>Material Name</th>
                                                    <th>Note</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td></td> 
                                                    <td><input type="text" class="form-control" name="lrNo" id="lrNo">
                                                    <input type="hidden" class="form-control" name="lr_table_id" id="lr_table_id">
                                                    </td>
                                                    <td> <input type="text" class="form-control" name="materialName" id="materialName">
                                                      </td>
                                                    <td><input type="text" class="form-control" name="note" id="note" placeholder="Add Notes" />
                                                   </td>
                                                   <td>
                                                 
                                                   <button type="button" class="btn btn-primary" onclick="save_material();">Add</button>
                                                   </td>
                                                </tr>
                                               
                                                </tbody>
                                                <tfoot id="material_details">
                                                </tfoot>
                                            </table>
                                                      
                                            
                                                    
                                                    <button type="submit" class="btn btn-primary">{{ isset($data) ? "Update" : "Submit" }}</button>
                                                </form>                      
                                            </div> <!-- end preview-->
                                        
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>

</div> 


@include('admin.tripjs');
@include('admin.tripModel');
@endsection

@section('java_script')





