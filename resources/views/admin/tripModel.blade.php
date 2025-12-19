<!--Add Party Modal -->
<div class="modal fade" id="addPartyModel" tabindex="-1" role="dialog" aria-labelledby="addPartyModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPartyModel">Add Party</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Party Name</label>
                                                            <input class="form-control" placeholder="Party Name" type="text" name="mpartyName" id="mpartyName"  />

                                                           
                                                           </div>
                                                    </div>

                                                

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Mobile</label>
                                                            <input type="number" class="form-control" name="mmobile" id="mmobile" required />
                                                         </div>
                                                    </div>
                                                  
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SaveParty()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>



<!--Add addVehicle Model -->
<div class="modal fade" id="addVehicleModel" tabindex="-1" role="dialog" aria-labelledby="addVehicleModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addVehicleModel">Add Vehicle</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Vehicle Number</label>
                                                            <input class="form-control" placeholder="Vehicle Number" type="text" name="m_vehicleNumber" id="m_vehicleNumber"  />

                                                           
                                                           </div>
                                                    </div>
                                                   

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Vehicle Type</label>
                                                            <select name="m_vehicleType" id="m_vehicleType" class="form-select  vehicleType">
                                                                <option value="">--Choose Vehicle--</option>
                                                                @foreach($vehicleType as $type)
                                                                <option value="{{ $type->id }}">{{ $type->truckName }}</option>
                                                                @endforeach
                                                            </select>
                                                         </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Owner Ship</label>
                                                            <select id="m_ownership" onchange = "getDriver()" name="ownership" class="form-select ">
                                                                <option value="My Truck" selected="selected">My Truck</option>
                                                                <option value="Market Truck">Market Truck</option>
                                                            
                                                            </select>
                                                         </div>
                                                    </div>
                                                   
                                                    <div class="col-12" id="dri_name">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Driver Name</label>
                                                            <select id="m_driverName" name="driverName" class="form-select ">
                                                                <option value="">--Choose Driver--</option>
                                                                @foreach($drivers as $driver)
                                                                <option value="{{ $driver->id }}">{{ $driver->driverName }} {{ $driver->mobile }}</option>
                                                                @endforeach                                                      
                                                            </select>

                                                           
                                     
                                                            
                                                         </div>
                                                    </div>
                                                    
                                                    <div class="col-12" id="supp_name">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Supplier Name</label>
                                                            <select id="m_supplierName" name="supplierName" class="form-select">
                                                                <option value="">--Choose Supplier--</option>
                                                                @foreach($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">{{ $supplier->supplierName }} {{ $supplier->mobile }}</option>
                                                                @endforeach                                                           
                                                            </select>
                                                         </div>
                                                    </div>


                                                    <div class="col-12" id="d_name">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Driver Name</label>
                                                            <input type="text" class="form-control" name="driver_name" id="m_driver_name" value="{{ old('driver_name',isset($data->driver_name) ? $data->driver_name : '' )}}">
                                                        
                                                         </div>
                                                    </div>



                                                    <div class="col-12" id="d_con">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Driver Contact</label>
                                                            <input type="text" class="form-control" name="driver_contact" id="m_driver_contact" value="{{ old('driver_contact',isset($data->driver_contact) ? $data->driver_contact : '' )}}">
                                                        
                                                        
                                                         </div>
                                                    </div>
                                                  

                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SaveVehicle()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>


<!--End addVehicle Model -->



<!--Add Supplier Payment Modal -->
<div class="modal fade" id="AddRouteModel" tabindex="-1" role="dialog" aria-labelledby="AddRouteModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddRouteModel">Add Route</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                <div class="col-12" id="supp_name">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">State</label>
                                                            <select id="m_state" name="m_state" class="form-select m_state">
                                                                <option value="">--Choose State--</option>
                                                                                                                         
                                                            </select>
                                                         </div>
                                                    </div>
                                                

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Route</label>
                                                            <input type="text" class="form-control" name="m_route" id="m_route" required />
                                                         </div>
                                                    </div>
                                                  
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SaveRoute()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>