@extends('layouts.app')
@section('body')

<link rel="stylesheet" href="{{ asset('dashboard/assets/css/compact-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/compact-forms.css') }}">

<div class="compact-dashboard">
    <div class="container-fluid">
        <!-- Compact Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h4 mb-1 fw-bold">
                            <i class="uil-plus-circle me-2 text-primary"></i>
                            New Trip
                        </h1>
                        <p class="text-muted mb-0 small">Create a new transportation trip</p>
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
                            Trip Details
                        </h5>
                    </div>
                    <div class="card-body p-2">
                        <form class="compact-form">
                            <!-- Table-format Form Layout -->
                            <div class="form-table">
                                <!-- Basic Information -->
                                <div class="form-table-row">
                                    <div class="form-table-cell">Trip ID</div>
                                    <div class="form-table-cell">
                                        <input type="text" class="form-control" id="trip_id" value="T-2024-001" readonly>
                                    </div>
                                    <div class="form-table-cell">Start Date</div>
                                    <div class="form-table-cell">
                                        <input type="date" class="form-control" id="start_date" required>
                                    </div>
                                </div>

                                <div class="form-table-row">
                                    <div class="form-table-cell">Party</div>
                                    <div class="form-table-cell">
                                        <select class="form-select" id="party" required>
                                            <option value="">Select Party</option>
                                            <option value="1">ABC Logistics</option>
                                            <option value="2">XYZ Traders</option>
                                            <option value="3">PQR Industries</option>
                                        </select>
                                    </div>
                                    <div class="form-table-cell">Supplier</div>
                                    <div class="form-table-cell">
                                        <select class="form-select" id="supplier" required>
                                            <option value="">Select Supplier</option>
                                            <option value="1">Fast Transport Co.</option>
                                            <option value="2">Speed Logistics</option>
                                            <option value="3">Quick Delivery</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Route Information -->
                                <div class="form-table-row">
                                    <div class="form-table-cell">Origin</div>
                                    <div class="form-table-cell">
                                        <select class="form-select" id="origin" required>
                                            <option value="">Select Origin</option>
                                            <option value="delhi">Delhi</option>
                                            <option value="mumbai">Mumbai</option>
                                            <option value="bangalore">Bangalore</option>
                                            <option value="chennai">Chennai</option>
                                        </select>
                                    </div>
                                    <div class="form-table-cell">Destination</div>
                                    <div class="form-table-cell">
                                        <select class="form-select" id="destination" required>
                                            <option value="">Select Destination</option>
                                            <option value="delhi">Delhi</option>
                                            <option value="mumbai">Mumbai</option>
                                            <option value="bangalore">Bangalore</option>
                                            <option value="chennai">Chennai</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-table-row">
                                    <div class="form-table-cell">Distance (km)</div>
                                    <div class="form-table-cell">
                                        <input type="number" class="form-control" id="distance" placeholder="0">
                                    </div>
                                    <div class="form-table-cell">Billing Type</div>
                                    <div class="form-table-cell">
                                        <select class="form-select" id="billing_type" required>
                                            <option value="">Select Type</option>
                                            <option value="fixed">Fixed Rate</option>
                                            <option value="per_km">Per KM</option>
                                            <option value="per_ton">Per Ton</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Vehicle & Driver -->
                                <div class="form-table-row">
                                    <div class="form-table-cell">Vehicle</div>
                                    <div class="form-table-cell">
                                        <select class="form-select" id="vehicle" required>
                                            <option value="">Select Vehicle</option>
                                            <option value="1">MH-12-AB-1234 (Tata Ace)</option>
                                            <option value="2">KA-05-CD-5678 (Ashok Leyland)</option>
                                            <option value="3">TN-09-EF-9012 (Mahindra)</option>
                                        </select>
                                    </div>
                                    <div class="form-table-cell">Driver</div>
                                    <div class="form-table-cell">
                                        <select class="form-select" id="driver" required>
                                            <option value="">Select Driver</option>
                                            <option value="1">Rajesh Kumar</option>
                                            <option value="2">Priya Sharma</option>
                                            <option value="3">Amit Singh</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-table-row">
                                    <div class="form-table-cell">Start KMs</div>
                                    <div class="form-table-cell">
                                        <input type="number" class="form-control" id="start_kms" placeholder="0">
                                    </div>
                                    <div class="form-table-cell">LR Number</div>
                                    <div class="form-table-cell">
                                        <input type="text" class="form-control" id="lr_number" placeholder="Enter LR number">
                                    </div>
                                </div>

                                <!-- Material & Pricing -->
                                <div class="form-table-row">
                                    <div class="form-table-cell">Material</div>
                                    <div class="form-table-cell" colspan="3">
                                        <input type="text" class="form-control" id="material" placeholder="Material description">
                                    </div>
                                </div>

                                <div class="form-table-row">
                                    <div class="form-table-cell">Party Rate (₹)</div>
                                    <div class="form-table-cell">
                                        <input type="number" class="form-control" id="party_rate" placeholder="0.00" step="0.01">
                                    </div>
                                    <div class="form-table-cell">Supplier Rate (₹)</div>
                                    <div class="form-table-cell">
                                        <input type="number" class="form-control" id="supplier_rate" placeholder="0.00" step="0.01">
                                    </div>
                                </div>

                                <div class="form-table-row">
                                    <div class="form-table-cell">Est. Profit (₹)</div>
                                    <div class="form-table-cell">
                                        <input type="number" class="form-control" id="estimated_profit" placeholder="0.00" readonly>
                                    </div>
                                    <div class="form-table-cell">Notes</div>
                                    <div class="form-table-cell">
                                        <input type="text" class="form-control" id="notes" placeholder="Additional notes...">
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
                                        <i class="uil-check me-1"></i>Create Trip
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Reference Panel -->
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">
                            <i class="uil-info-circle me-2 text-info"></i>
                            Recent Parties
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 14px; font-weight: 600;">AL</div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">ABC Logistics</div>
                                    <div class="text-muted" style="font-size: 11px;">Last trip: 2 days ago</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 14px; font-weight: 600;">XT</div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">XYZ Traders</div>
                                    <div class="text-muted" style="font-size: 11px;">Last trip: 5 days ago</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 14px; font-weight: 600;">PI</div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">PQR Industries</div>
                                    <div class="text-muted" style="font-size: 11px;">Last trip: 1 week ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">
                            <i class="uil-truck me-2 text-success"></i>
                            Available Vehicles
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <i class="uil-truck text-primary" style="font-size: 20px;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">MH-12-AB-1234</div>
                                    <div class="text-muted" style="font-size: 11px;">Tata Ace • Available</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success" style="font-size: 10px;">Ready</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <i class="uil-truck text-success" style="font-size: 20px;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">KA-05-CD-5678</div>
                                    <div class="text-muted" style="font-size: 11px;">Ashok Leyland • Available</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success" style="font-size: 10px;">Ready</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <i class="uil-truck text-warning" style="font-size: 20px;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">TN-09-EF-9012</div>
                                    <div class="text-muted" style="font-size: 11px;">Mahindra • Maintenance</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-warning" style="font-size: 10px;">Busy</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-semibold">
                            <i class="uil-user me-2 text-primary"></i>
                            Available Drivers
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 12px; font-weight: 600;">RK</div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">Rajesh Kumar</div>
                                    <div class="text-muted" style="font-size: 11px;">Exp: 5 years • Available</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success" style="font-size: 10px;">Free</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 12px; font-weight: 600;">PS</div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">Priya Sharma</div>
                                    <div class="text-muted" style="font-size: 11px;">Exp: 3 years • Available</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success" style="font-size: 10px;">Free</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center p-2 rounded bg-light cursor-pointer">
                                <div class="flex-shrink-0 me-2">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 12px; font-weight: 600;">AS</div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-medium small">Amit Singh</div>
                                    <div class="text-muted" style="font-size: 11px;">Exp: 7 years • On trip</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-info" style="font-size: 10px;">Busy</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="text-muted small mb-1">💡 Tip</div>
                                <div class="fw-medium small">Use keyboard shortcuts:</div>
                                <div class="text-muted" style="font-size: 11px;">Ctrl+S (Save) • Ctrl+Enter (Submit) • Esc (Cancel)</div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted small mb-1">📊 Auto-calculation</div>
                                <div class="fw-medium small">Profit calculates automatically</div>
                                <div class="text-muted" style="font-size: 11px;">Party Rate - Supplier Rate</div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted small mb-1">⚡ Quick Actions</div>
                                <div class="fw-medium small">Click reference items to auto-fill</div>
                                <div class="text-muted" style="font-size: 11px;">Parties • Vehicles • Drivers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Compact Form JavaScript -->
<script src="{{ asset('dashboard/assets/js/compact-form.js') }}"></script>

@endsection