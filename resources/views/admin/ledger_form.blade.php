<!-- Tab Navigation -->
<ul class="nav nav-tabs mb-4" role="tablist" style="border-bottom: 2px solid #dee2e6;">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true" style="font-weight: 600; color: #166534 !important; background-color: #f3faf8;">
            <i class="uil uil-book"></i> Basic Information
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="corporate-tab" data-bs-toggle="tab" data-bs-target="#corporate" type="button" role="tab" aria-controls="corporate" aria-selected="false" style="font-weight: 600; color: #333 !important;">
            <i class="uil uil-building"></i> Corporate Address
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="other-tab" data-bs-toggle="tab" data-bs-target="#other" type="button" role="tab" aria-controls="other" aria-selected="false" style="font-weight: 600; color: #333 !important;">
            <i class="uil uil-file-info"></i> Other Details
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="false" style="font-weight: 600; color: #333 !important;">
            <i class="uil uil-user-circle"></i> Personal Details
        </button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" style="border: 1px solid #dee2e6; border-top: none; padding: 20px; border-radius: 0 0 4px 4px;">
    <!-- BASIC INFORMATION TAB -->
    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab" style="display: block;">
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-tag"></i> Type <span class="text-danger">*</span>
                </label>
                <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                    <option value="">-- Select Type --</option>
                    @if(isset($types) && count($types) > 0)
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ (isset($data) && $data->type == $type) || old('type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    @else
                        <option value="General">General</option>
                        <option value="Party">Party</option>
                        <option value="Vehicle">Vehicle</option>
                        <option value="Consignee">Consignee</option>
                        <option value="Consignor">Consignor</option>
                        <option value="Self Vehicle">Self Vehicle</option>
                    @endif
                </select>
                @error('type')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-pen"></i> Ledger Name <span class="text-danger">*</span>
                </label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ isset($data) ? $data->name : old('name') }}" 
                       placeholder="Enter ledger name" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-pen"></i> Short Name
                </label>
                <input type="text" name="short_name" class="form-control" maxlength="50"
                       value="{{ isset($data) ? $data->short_name : old('short_name') }}" 
                       placeholder="e.g., ACC001">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-folder-open"></i> Under Group
                </label>
                <select name="under_group_id" class="form-control @error('under_group_id') is-invalid @enderror">
                    <option value="">-- Select Group --</option>
                    @if(isset($groups) && count($groups) > 0)
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ (isset($data) && $data->under_group_id == $group->id) || old('under_group_id') == $group->id ? 'selected' : '' }}>
                                {{ $group->group_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('under_group_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-money-withdraw"></i> Opening Balance
                </label>
                <input type="number" name="opening_balance" class="form-control" step="0.01"
                       value="{{ isset($data) ? $data->opening_balance : old('opening_balance', 0) }}" 
                       placeholder="0.00">
            </div>

            <div class="col-md-3">
                <label class="form-label">
                    <i class="uil uil-exchange"></i> DR/CR <span class="text-danger">*</span>
                </label>
                <select name="dr_cr" class="form-control @error('dr_cr') is-invalid @enderror" required>
                    <option value="DR" {{ (isset($data) && $data->dr_cr == 'DR') || old('dr_cr') == 'DR' ? 'selected' : '' }}>DR (Debit)</option>
                    <option value="CR" {{ (isset($data) && $data->dr_cr == 'CR') || old('dr_cr') == 'CR' ? 'selected' : '' }}>CR (Credit)</option>
                </select>
                @error('dr_cr')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">
                    <i class="uil uil-scale-balance"></i> Balance Type <span class="text-danger">*</span>
                </label>
                <select name="balance_type" class="form-control @error('balance_type') is-invalid @enderror" required>
                    <option value="">-- Select --</option>
                    <option value="Bill by Bill" {{ (isset($data) && $data->balance_type == 'Bill by Bill') || old('balance_type') == 'Bill by Bill' ? 'selected' : '' }}>Bill by Bill</option>
                    <option value="On Account" {{ (isset($data) && $data->balance_type == 'On Account') || old('balance_type') == 'On Account' ? 'selected' : '' }}>On Account</option>
                </select>
                @error('balance_type')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-check-circle"></i> Status <span class="text-danger">*</span>
                </label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="Active" {{ (isset($data) && $data->status == 'Active') || old('status') == 'Active' ? 'selected' : 'selected' }}>Active</option>
                    <option value="Inactive" {{ (isset($data) && $data->status == 'Inactive') || old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-note"></i> Remarks
                </label>
                <textarea name="remarks" class="form-control" rows="3" placeholder="Additional remarks">{{ isset($data) ? $data->remarks : old('remarks') }}</textarea>
            </div>
        </div>
    </div>

    <!-- CORPORATE ADDRESS TAB -->
    <div class="tab-pane fade" id="corporate" role="tabpanel" aria-labelledby="corporate-tab" style="display: none;">
        <div class="row mb-4">
            <div class="col-md-12">
                <label class="form-label">
                    <i class="uil uil-location-pin-alt"></i> Address
                </label>
                <textarea name="address_line_1" class="form-control" rows="3"
                       placeholder="Full address">{{ isset($data) ? $data->address_line_1 : old('address_line_1') }}</textarea>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-map"></i> State
                </label>
                <input type="text" name="state" class="form-control"
                       value="{{ isset($data) ? $data->state : old('state') }}" 
                       placeholder="State name">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-phone"></i> Phone No.
                </label>
                <input type="text" name="telephone" class="form-control" maxlength="15"
                       value="{{ isset($data) ? $data->telephone : old('telephone') }}" 
                       placeholder="+91 XX XXXXXXXX">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-envelope"></i> Email
                </label>
                <input type="email" name="email" class="form-control"
                       value="{{ isset($data) ? $data->email : old('email') }}" 
                       placeholder="contact@example.com">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-message-circle"></i> WhatsApp
                </label>
                <input type="text" name="whatsapp" class="form-control" maxlength="15"
                       value="{{ isset($data) ? $data->whatsapp : old('whatsapp') }}" 
                       placeholder="+91 XXXXXXXXXX">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-user"></i> Contact Person Name
                </label>
                <input type="text" name="contact_person_name" class="form-control"
                       value="{{ isset($data) ? $data->contact_person_name : old('contact_person_name') }}" 
                       placeholder="Full name">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-mobile-vibrate"></i> Contact Person Mobile
                </label>
                <input type="text" name="mobile" class="form-control" maxlength="15"
                       value="{{ isset($data) ? $data->mobile : old('mobile') }}" 
                       placeholder="+91 XXXXXXXXXX">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-briefcase"></i> Designation
                </label>
                <input type="text" name="contact_person_designation" class="form-control"
                       value="{{ isset($data) ? $data->contact_person_designation : old('contact_person_designation') }}" 
                       placeholder="Job title">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-mobile-vibrate"></i> Contact Person Mobile 2
                </label>
                <input type="text" name="contact_person_mobile_2" class="form-control" maxlength="15"
                       value="{{ isset($data) ? $data->contact_person_mobile_2 : old('contact_person_mobile_2') }}" 
                       placeholder="+91 XXXXXXXXXX">
            </div>
        </div>

        <hr class="my-4">
        <h6 style="color: #166534; font-weight: 600;"><i class="uil uil-receipt"></i> GST Details</h6>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-receipt"></i> GST Number
                </label>
                <input type="text" name="gst_number" class="form-control" maxlength="20"
                       value="{{ isset($data) ? $data->gst_number : old('gst_number') }}" 
                       placeholder="e.g., 27AAPCA5055K1ZO">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-building"></i> GST Type <span class="text-danger">*</span>
                </label>
                <select name="gst_registration_type" class="form-control @error('gst_registration_type') is-invalid @enderror">
                    <option value="">-- Select Type --</option>
                    <option value="Registered" {{ (isset($data) && $data->gst_registration_type == 'Registered') || old('gst_registration_type') == 'Registered' ? 'selected' : '' }}>Registered</option>
                    <option value="Unregistered" {{ (isset($data) && $data->gst_registration_type == 'Unregistered') || old('gst_registration_type') == 'Unregistered' ? 'selected' : '' }}>Unregistered</option>
                </select>
                @error('gst_registration_type')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- OTHER DETAILS TAB -->
    <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab" style="display: none;">
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-id-card"></i> PAN No.
                </label>
                <input type="text" name="pan_no" class="form-control" maxlength="20"
                       value="{{ isset($data) ? $data->pan_no : old('pan_no') }}" 
                       placeholder="e.g., AAAPA1234A">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-id-card"></i> Aadhar No.
                </label>
                <input type="text" name="aadhar_no" class="form-control" maxlength="20"
                       value="{{ isset($data) ? $data->aadhar_no : old('aadhar_no') }}" 
                       placeholder="12-digit Aadhar number">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-receipt"></i> Service Tax No.
                </label>
                <input type="text" name="service_tax_no" class="form-control" maxlength="20"
                       value="{{ isset($data) ? $data->service_tax_no : old('service_tax_no') }}" 
                       placeholder="Service tax number">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-calendar-alt"></i> Credit Days
                </label>
                <input type="number" name="credit_days" class="form-control" min="0"
                       value="{{ isset($data) ? $data->credit_days : old('credit_days', 0) }}" 
                       placeholder="Number of days">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-money-withdraw"></i> Credit Limit (in Rs.)
                </label>
                <input type="number" name="credit_limit" class="form-control" step="0.01" min="0"
                       value="{{ isset($data) ? $data->credit_limit : old('credit_limit', 0) }}" 
                       placeholder="0.00">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-receipt"></i> Credit Bills
                </label>
                <input type="number" name="credit_bills" class="form-control" min="0"
                       value="{{ isset($data) ? $data->credit_bills : old('credit_bills', 0) }}" 
                       placeholder="Number of bills">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-flag"></i> Follow Up
                </label>
                <select name="follow_up" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="Inform Only" {{ (isset($data) && $data->follow_up == 'Inform Only') || old('follow_up') == 'Inform Only' ? 'selected' : '' }}>Inform Only</option>
                    <option value="Stop Billing" {{ (isset($data) && $data->follow_up == 'Stop Billing') || old('follow_up') == 'Stop Billing' ? 'selected' : '' }}>Stop Billing</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-calendar"></i> Collection Day
                </label>
                <input type="number" name="collection_day" class="form-control" min="1" max="31"
                       value="{{ isset($data) ? $data->collection_day : old('collection_day') }}" 
                       placeholder="Day of month (1-31)">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-tag"></i> Category <span class="text-danger">*</span>
                </label>
                <select name="category" class="form-control @error('category') is-invalid @enderror" required>
                    <option value="">-- Select Category --</option>
                    <option value="Distributor" {{ (isset($data) && $data->category == 'Distributor') || old('category') == 'Distributor' ? 'selected' : '' }}>Distributor</option>
                    <option value="Stockist" {{ (isset($data) && $data->category == 'Stockist') || old('category') == 'Stockist' ? 'selected' : '' }}>Stockist</option>
                    <option value="Wholesaler" {{ (isset($data) && $data->category == 'Wholesaler') || old('category') == 'Wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                    <option value="Retailer" {{ (isset($data) && $data->category == 'Retailer') || old('category') == 'Retailer' ? 'selected' : '' }}>Retailer</option>
                    <option value="None" {{ (isset($data) && $data->category == 'None') || old('category') == 'None' ? 'selected' : '' }}>None</option>
                </select>
                @error('category')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-percent"></i> Bill Description %
                </label>
                <input type="number" name="bill_desc_percent" class="form-control" step="0.01" min="0" max="100"
                       value="{{ isset($data) ? $data->bill_desc_percent : old('bill_desc_percent', 0) }}" 
                       placeholder="0.00">
            </div>
        </div>
    </div>

    <!-- PERSONAL DETAILS TAB -->
    <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab" style="display: none;">
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-building"></i> Bank Name
                </label>
                <input type="text" name="bank_name" class="form-control"
                       value="{{ isset($data) ? $data->bank_name : old('bank_name') }}" 
                       placeholder="e.g., State Bank of India">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-map-marker"></i> Bank Branch
                </label>
                <input type="text" name="bank_branch" class="form-control"
                       value="{{ isset($data) ? $data->bank_branch : old('bank_branch') }}" 
                       placeholder="Branch name">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-credit-card"></i> IFSC Code
                </label>
                <input type="text" name="ifsc_code" class="form-control" maxlength="11"
                       value="{{ isset($data) ? $data->ifsc_code : old('ifsc_code') }}" 
                       placeholder="e.g., SBIN0001234">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-credit-card"></i> Account No.
                </label>
                <input type="text" name="account_no" class="form-control"
                       value="{{ isset($data) ? $data->account_no : old('account_no') }}" 
                       placeholder="Bank account number">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <label class="form-label">
                    <i class="uil uil-location-pin-alt"></i> Bank Address
                </label>
                <textarea name="bank_address" class="form-control" rows="3"
                       placeholder="Full bank address">{{ isset($data) ? $data->bank_address : old('bank_address') }}</textarea>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-calendar-alt"></i> Date of Birth (DOB)
                </label>
                <input type="date" name="dob" class="form-control"
                       value="{{ isset($data) ? $data->dob : old('dob') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    <i class="uil uil-calendar-alt"></i> Date of Marriage (DOM)
                </label>
                <input type="date" name="dom" class="form-control"
                       value="{{ isset($data) ? $data->dom : old('dom') }}">
            </div>
        </div>
    </div>
</div>




<!-- Form Buttons -->
<div class="row mt-4">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="uil uil-save"></i> {{ isset($data) ? 'Update Ledger' : 'Create Ledger' }}
        </button>
        @if(isset($data))
            <a href="{{ route('ledgerMaster.index') }}" class="btn btn-secondary btn-lg">
                <i class="uil uil-times"></i> Cancel
            </a>
        @else
            <button type="reset" class="btn btn-secondary btn-lg">
                <i class="uil uil-refresh"></i> Reset
            </button>
        @endif
    </div>
</div>
<style>
    .nav-tabs .nav-link {
        color: #666;
        border: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        font-weight: 500;
    }

    .nav-tabs .nav-link:hover {
        border-bottom: 2px solid #166534;
        color: #166534;
    }

    .nav-tabs .nav-link.active {
        color: #166534;
        background-color: transparent;
        border-bottom: 2px solid #166534;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .badge {
        font-size: 0.85rem;
        padding: 6px 10px;
        font-weight: 500;
    }

    .btn-sm {
        padding: 6px 10px;
        font-size: 0.875rem;
    }
</style>

<script>
    // GST Verification (if needed)
    document.getElementById('verifyGstBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        
        let gstNumber = document.querySelector('input[name="gst_number"]')?.value.trim();
        
        if (!gstNumber) {
            alert('Please enter GST number first');
            return;
        }

        const gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
        if (!gstRegex.test(gstNumber)) {
            alert('Invalid GST format. Please enter a valid 15-character GST number.');
            return;
        }

        alert('GST Number is valid!');
        document.getElementById('isGstVerified').checked = true;
    });
</script>
