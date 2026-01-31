@extends('layouts.app')
@section('body')

<link rel="stylesheet" href="{{ asset('dashboard/assets/css/compact-forms.css') }}">

<div class="container-fluid">
    <!-- Compact Page Header -->
    <div class="row mb-3 d-none">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h4 mb-1 fw-bold">
                        <i class="uil-plus-circle me-2 text-primary"></i>
                        {{ isset($data) ? 'Edit Trip' : 'Add New Trip' }}
                    </h1>
                    <p class="text-muted mb-0 small">Create and manage transportation trips</p>
                </div>
                <div>
                    <a href="{{ route('trips.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="uil-arrow-left me-1"></i>Back to Trips
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Compact Form Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0 fw-semibold">
                        <i class="uil-edit me-2 text-primary"></i>
                        Trip Information
                    </h5>
                </div>
                <div class="card-body p-2">
                    @if(isset($data))
                    <form action="{{ route('trips.update',$data->id) }}" method="post" class="compact-form">
                    @method('PATCH')
                    @else
                    <form action="{{ route('trips.store') }}" method="post" class="compact-form">
                    @endif
                        @csrf

                        <!-- Ultra-Compact Table Format -->
                        <div class="form-table">
                            <!-- Basic Information -->
                            <div class="form-table-row">
                                <div class="form-table-cell">Trip ID</div>
                                <div class="form-table-cell">
                                    <input type="text" class="form-control" id="trip_id" value="{{ isset($data) ? $data->id : 'Auto-generated' }}" readonly>
                                </div>
                                <div class="form-table-cell">Start Date</div>
                                <div class="form-table-cell">
                                    <input type="date" name="startDate" id="startDate" class="form-control" value="{{ old('startDate', isset($data->startDate) ? $data->startDate : '') }}" required>
                                </div>
                            </div>

                            <!-- Party & Billing Information -->
                            <div class="form-table-row">
                                <div class="form-table-cell">Party to Bill</div>
                                <div class="form-table-cell">
                                    <div class="input-group">
                                        <select id="partyName" name="partyName" class="form-select" required>
                                            <option value="">Select Party</option>
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary" onclick="Addparty()">
                                            <i class="uil-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-table-cell">Consignor</div>
                                <div class="form-table-cell">
                                    <input type="text" name="consignor" class="form-control" placeholder="Sender name/address" value="{{ old('consignor', isset($data->consignor) ? $data->consignor : '') }}">
                                </div>
                            </div>

                            <div class="form-table-row">
                                <div class="form-table-cell">Consignee</div>
                                <div class="form-table-cell">
                                    <input type="text" name="consignee" class="form-control" placeholder="Receiver name/address" value="{{ old('consignee', isset($data->consignee) ? $data->consignee : '') }}">
                                </div>
                                <div class="form-table-cell">Vehicle</div>
                                <div class="form-table-cell">
                                    <div class="input-group">
                                        <select id="vehicleNumber" name="vehicleNumber" onchange="onVehiclechange()" class="form-select" required>
                                            <option value="">Select Vehicle</option>
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary" onclick="AddVehicle()">
                                            <i class="uil-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Route Information -->
                            <div class="form-table-row">
                                <div class="form-table-cell">Origin</div>
                                <div class="form-table-cell">
                                    <div class="input-group">
                                        <select id="origin" name="origin" class="form-select routes" required>
                                            <option value="">Select Origin</option>
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary" onclick="AddRoute()">
                                            <i class="uil-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-table-cell">Destination</div>
                                <div class="form-table-cell">
                                    <div class="input-group">
                                        <select id="destination" name="destination" class="form-select routes" required>
                                            <option value="">Select Destination</option>
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary" onclick="AddRoute()">
                                            <i class="uil-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Billing Information -->
                            <div class="form-table-row">
                                <div class="form-table-cell">Party Billing</div>
                                <div class="form-table-cell">
                                    <select id="billingType" name="billingType" onchange="onPartyBillingTypechange()" class="form-select partybillType" required>
                                        <option value="">Select Type</option>
                                    </select>
                                </div>
                                <div class="form-table-cell">Party Amount</div>
                                <div class="form-table-cell">
                                    <input type="text" name="partyFreightAmount" class="form-control" id="partyFreightAmount" value="{{ old('partyFreightAmount', isset($data->partyFreightAmount) ? $data->partyFreightAmount : '') }}" required>
                                </div>
                            </div>

                            <!-- Additional Billing Details -->
                            <div class="form-table-row">
                                <div class="form-table-cell">GST No</div>
                                <div class="form-table-cell">
                                    <input type="text" name="gst_no" class="form-control" placeholder="GST Number" value="{{ old('gst_no', isset($data->gst_no) ? $data->gst_no : '') }}">
                                </div>
                                <div class="form-table-cell">PAN No</div>
                                <div class="form-table-cell">
                                    <input type="text" name="pan_no" class="form-control" placeholder="PAN Number" value="{{ old('pan_no', isset($data->pan_no) ? $data->pan_no : '') }}">
                                </div>
                            </div>

                            <div class="form-table-row">
                                <div class="form-table-cell">Contact Person</div>
                                <div class="form-table-cell">
                                    <input type="text" name="contact_person" class="form-control" placeholder="Contact person name" value="{{ old('contact_person', isset($data->contact_person) ? $data->contact_person : '') }}">
                                </div>
                                <div class="form-table-cell">Contact Number</div>
                                <div class="form-table-cell">
                                    <input type="tel" name="contact_number" class="form-control" placeholder="Mobile number" value="{{ old('contact_number', isset($data->contact_number) ? $data->contact_number : '') }}">
                                </div>
                            </div>

                            <!-- Dynamic Party Billing Fields -->
                            <div class="form-table-row" id="supplier_per" style="display: none;">
                                <div class="form-table-cell">Rate</div>
                                <div class="form-table-cell">
                                    <input type="text" name="party_rate_per" onchange="onFreightRatechange()" class="form-control" id="party_rate_per" value="{{ old('party_rate_per', isset($data->party_rate_per) ? $data->party_rate_per : '') }}">
                                </div>
                                <div class="form-table-cell">Weight</div>
                                <div class="form-table-cell">
                                    <input type="text" name="party_unit_per" onchange="onFreightRatechange()" class="form-control" id="party_unit_per" value="{{ old('party_unit_per', isset($data->party_unit_per) ? $data->party_unit_per : '') }}">
                                </div>
                            </div>

                            <!-- Supplier Billing -->
                            <div class="form-table-row" id="supplierBillingDiv">
                                <div class="form-table-cell">Supplier Billing</div>
                                <div class="form-table-cell">
                                    <select id="supplierBillingType" name="supplierBillingType" onchange="onSupplierBillingType()" class="form-select supbillType" required>
                                        <option value="">Select Type</option>
                                    </select>
                                </div>
                                <div class="form-table-cell">Supplier Amount</div>
                                <div class="form-table-cell">
                                    <input type="text" name="truckHireAmount" class="form-control" id="truckHireAmount" value="{{ old('truckHireAmount', isset($data->truckHireAmount) ? $data->truckHireAmount : '') }}" required>
                                </div>
                            </div>

                            <!-- Dynamic Supplier Billing Fields -->
                            <div class="form-table-row" id="truck_per" style="display: none;">
                                <div class="form-table-cell">Rate</div>
                                <div class="form-table-cell">
                                    <input type="text" name="truck_rate_per" onchange="onTruckHireAmoutn()" class="form-control" id="truck_rate_per" value="{{ old('truck_rate_per', isset($data->truck_rate_per) ? $data->truck_rate_per : '') }}">
                                </div>
                                <div class="form-table-cell">Weight</div>
                                <div class="form-table-cell">
                                    <input type="text" name="truck_unit_per" onchange="onTruckHireAmoutn()" class="form-control" id="truck_unit_per" value="{{ old('truck_unit_per', isset($data->truck_unit_per) ? $data->truck_unit_per : '') }}">
                                </div>
                            </div>

                            <!-- Delivery & Additional Information -->
                            <div class="form-table-row">
                                <div class="form-table-cell">Start KMs</div>
                                <div class="form-table-cell">
                                    <input type="text" name="startKmsReading" id="startKmsReading" class="form-control" value="{{ old('startKmsReading', isset($data->startKmsReading) ? $data->startKmsReading : '') }}" required>
                                </div>
                                <div class="form-table-cell">Delivery Date</div>
                                <div class="form-table-cell">
                                    <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date', isset($data->delivery_date) ? $data->delivery_date : '') }}">
                                </div>
                            </div>

                            <div class="form-table-row">
                                <div class="form-table-cell">Driver</div>
                                <div class="form-table-cell" id="optionData">
                                    <!-- Driver selection will be populated here -->
                                </div>
                                <div class="form-table-cell">Delivery Status</div>
                                <div class="form-table-cell">
                                    <select name="delivery_status" class="form-select">
                                        <option value="pending" {{ old('delivery_status', isset($data->delivery_status) ? $data->delivery_status : '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_transit" {{ old('delivery_status', isset($data->delivery_status) ? $data->delivery_status : '') == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                        <option value="delivered" {{ old('delivery_status', isset($data->delivery_status) ? $data->delivery_status : '') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ old('delivery_status', isset($data->delivery_status) ? $data->delivery_status : '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-table-row">
                                <div class="form-table-cell">Remarks</div>
                                <div class="form-table-cell" colspan="3">
                                    <textarea name="remarks" class="form-control" rows="2" placeholder="Additional remarks or special instructions...">{{ old('remarks', isset($data->remarks) ? $data->remarks : '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Comprehensive Material Details Table -->
                        <div class="mt-3">
                            <h6 class="form-section-title">📦 Consignment Details</h6>
                            <div class="table-responsive">
                                <table class="table table-sm mb-2">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 50px;">SN</th>
                                            <th style="width: 120px;">LR No</th>
                                            <th style="width: 150px;">Material</th>
                                            <th style="width: 80px;">Qty</th>
                                            <th style="width: 90px;">Weight</th>
                                            <th style="width: 100px;">Dimensions</th>
                                            <th style="width: 120px;">Value (₹)</th>
                                            <th style="width: 150px;">Notes</th>
                                            <th style="width: 80px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="lrNo" id="lrNo" placeholder="LR001234">
                                                <input type="hidden" name="lr_table_id" id="lr_table_id">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="materialName" id="materialName" placeholder="Material name">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" name="quantity" placeholder="0">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" name="weight" step="0.01" placeholder="0.00">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="dimensions" placeholder="L×W×H">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" name="value" step="0.01" placeholder="0.00">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="note" id="note" placeholder="Special handling">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" onclick="save_material();">
                                                    <i class="uil-plus me-1"></i>Add
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot id="material_details">
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Summary Row -->
                            <div class="mt-2 p-2 bg-light rounded">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <strong>Total Quantity:</strong> <span id="total_qty">0</span>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Total Weight:</strong> <span id="total_weight">0.00 kg</span>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Total Value:</strong> ₹<span id="total_value">0.00</span>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Packages:</strong> <span id="total_packages">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Compact Form Actions -->
                        <div class="d-flex justify-between align-items-center mt-3 pt-2 border-top">
                            <button type="button" class="btn btn-outline-secondary btn-sm">
                                <i class="uil-times me-1"></i>Cancel
                            </button>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="uil-save me-1"></i>Save Draft
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="uil-check me-1"></i>{{ isset($data) ? "Update Trip" : "Create Trip" }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Compact Form JavaScript -->
<script src="{{ asset('dashboard/assets/js/compact-form.js') }}"></script>

@include('admin.tripjs');
@include('admin.tripModel');
@endsection

@section('java_script')





