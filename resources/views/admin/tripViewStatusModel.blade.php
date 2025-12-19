<!--Add Supplier Payment Modal -->
<div class="modal fade" id="supplierPaymentModel" tabindex="-1" role="dialog" aria-labelledby="supplierPaymentModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supplierPaymentModel">Add Supplier Payment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Payment Amount</label>
                                                            <input class="form-control" placeholder="Payment Amount" type="number" name="spayAmount" id="spayAmount"  />

                                                            <input class="form-control" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />
                                                           </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Payment Type <a href="#"><i class="mdi mdi-plus-box" style="font-size:20px;" onclick="addAdvanceTypeModel()"></i></a></label>
                                                            <select class="form-select advanceType" name="spayType" id="spayType" >
                                                                <option value="bg-danger" selected>Select</option>
                                                            </select>
                                                          </div>
                                                    </div>
                                                

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Payment Date</label>
                                                            <input type="date" class="form-control" name="spayDate" id="spayDate" required />
                                                         </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">Note</label>
                                                            <textarea class="form-control" placeholder="Notes"  name="spaymentNote" id="spaymentNote" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SaveSupplierPayment()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>


<!-- Add Complete Modal -->
<div class="modal fade" id="onCompleteModel" tabindex="-1" role="dialog" aria-labelledby="expensesModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="onCompleteModel">Complete</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                               
                                                   

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">End Date</label>
                                                            <input type="date" class="form-control" placeholder="End Date"  name="endDate" id="endDate" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">End KMS Reading</label>
                                                            <input class="form-control" placeholder="End KMS" type="text" name="endKmsReading" id="endKmsReading"  />

                                                            <input class="form-control" placeholder="Expenses Amount" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SaveComplete()">Save</button>
                                                    </div>
                                                </div>
                                            </div>
    </div>
  </div>
</div>

//Start POD Receive Models



<!-- Add onPODReceive Modal -->
<div class="modal fade" id="onPODReceive" tabindex="-1" role="dialog" aria-labelledby="expensesModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="onPODReceive">POD Receive Model</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="SavePODReceive" enctype="multipart/form-data" > 
      @csrf
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                               
                                                   

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">POD Receive Date</label>
                                                            <input type="date" class="form-control" placeholder="POD Receive Date"  name="pod_receuve_date" id="pod_receuve_date" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">POD Receive DOC</label>
                                                            <input class="form-control" placeholder="End KMS" type="file" name="pod_receuve_doc" id="pod_receuve_doc" multiple />

                                                            <input class="form-control" placeholder="Expenses Amount" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" >Save</button>
                                                    </div>
                                                </div>
                                            </div>

                    </form>
    </div>
  </div>
</div>

<!-- Add onPODReceive Modal -->
<div class="modal fade" id="onPODReceive" tabindex="-1" role="dialog" aria-labelledby="expensesModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="onPODReceive">POD Receive Model</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="SavePODReceive" enctype="multipart/form-data" > 
      @csrf
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                               
                                                   

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">POD Receive Date</label>
                                                            <input type="date" class="form-control" placeholder="POD Receive Date"  name="pod_receuve_date" id="pod_receuve_date" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">POD Receive DOC</label>
                                                            <input class="form-control" placeholder="End KMS" type="file" name="pod_receuve_doc" id="pod_receuve_doc"  />

                                                            <input class="form-control" placeholder="Expenses Amount" type="hidden" name="trip_id" id="trip_id" value="{{ $data->id }}"  />

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" >Save</button>
                                                    </div>
                                                </div>
                                            </div>

                    </form>
    </div>
  </div>
</div>


<!-- Add onPODReceive Modal -->
<div class="modal fade" id="onPODsubmit" tabindex="-1" role="dialog" aria-labelledby="expensesModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="onPODsubmit">POD Submit</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  
      <div class="modal-body px-4 pb-4 pt-0">
                                                <div class="row">
                                               
                                                   

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label form-label">POD Submit Date</label>
                                                            <input type="date" class="form-control" placeholder="POD Submit Date"  name="pod_submitted_date" id="pod_submitted_date" required />
                                                        </div>
                                                    </div>

                                                    
                                                <div class="row">
                                                <div class="col-6 text-end"></div>
                                                    <div class="col-6 text-end">
                                                        <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="btn-save-event" onclick="SavePODSubmit()" >Save</button>
                                                    </div>
                                                </div>
                                            </div>

                  
    </div>
  </div>
</div>