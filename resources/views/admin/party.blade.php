@extends('layouts.app')
@section('body')
<!-- Start Content -->
<div class="container-fluid">

    

    <div class="row">
        <div class="col-12">
            <x-alert />

            <!-- Form Card -->
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-plus-circle"></i>
                    {{ isset($data) ? 'Update Consignor Information' : 'Add New Consignor' }}
                </div>

                <div class="form-card-body">
                    @if(isset($data))
                        <form action="{{ route('party.update',$data->id) }}" method="post" id="partyForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('party.store') }}" method="post" id="partyForm" onsubmit="return handleFormSubmit(event)">
                    @endif
                        @csrf
                        <input type="hidden" id="save_as_both" name="save_as_both" value="0">

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="partyName" class="form-label">
                                            <i class="uil-user-circle"></i>
                                            Name <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('partyName') ? 'is-invalid' : '' }}" 
                                            name="partyName" 
                                            id="partyName"
                                            placeholder="Enter name"
                                            value="{{ old('partyName', isset($data->partyName) ? $data->partyName : '') }}"
                                            required
                                        >
                                        @if($errors->has('partyName'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('partyName') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">
                                            <i class="uil-envelope"></i>
                                            Email <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="email" 
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                            name="email" 
                                            id="email"
                                            placeholder="Enter email address"
                                            value="{{ old('email', isset($data->email) ? $data->email : '') }}"
                                        >
                                        @if($errors->has('email'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label">
                                            <i class="uil-map-marker"></i>
                                            Address <span class="optional">(Optional)</span>
                                        </label>
                                        <textarea 
                                            class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" 
                                            name="address" 
                                            id="address"
                                            placeholder="Enter address"
                                            rows="1"
                                        >{{ old('address', isset($data->address) ? $data->address : '') }}</textarea>
                                        @if($errors->has('address'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('address') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        

                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="phone_no" class="form-label">
                                            <i class="uil-phone"></i>
                                            Phone Number <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" 
                                            name="phone_no" 
                                            id="phone_no"
                                            placeholder="Enter phone number"
                                            value="{{ old('phone_no', isset($data->phone_no) ? $data->phone_no : '') }}"
                                        >
                                        @if($errors->has('phone_no'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('phone_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="mobile" class="form-label">
                                            <i class="uil-mobile-android"></i>
                                            Mobile Number <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" 
                                            name="mobile" 
                                            id="mobile"
                                            placeholder="Enter mobile number"
                                            value="{{ old('mobile', isset($data->mobile) ? $data->mobile : '') }}"
                                            required
                                        >
                                        @if($errors->has('mobile'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('mobile') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="mobile_no" class="form-label">
                                            <i class="uil-mobile-android"></i>
                                            Alternative Mobile Number <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" 
                                            name="mobile_no" 
                                            id="mobile_no"
                                            placeholder="Enter alternative mobile number"
                                            value="{{ old('mobile_no', isset($data->mobile_no) ? $data->mobile_no : '') }}"
                                        >
                                        @if($errors->has('mobile_no'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('mobile_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="contact_person_name" class="form-label">
                                            <i class="uil-user"></i>
                                            Contact Person Name <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('contact_person_name') ? 'is-invalid' : '' }}" 
                                            name="contact_person_name" 
                                            id="contact_person_name"
                                            placeholder="Enter contact person name"
                                            value="{{ old('contact_person_name', isset($data->contact_person_name) ? $data->contact_person_name : '') }}"
                                        >
                                        @if($errors->has('contact_person_name'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('contact_person_name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="contact_mobile_number" class="form-label">
                                            <i class="uil-mobile-android"></i>
                                            Contact Person Mobile Number <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control {{ $errors->has('contact_mobile_number') ? 'is-invalid' : '' }}" 
                                            name="contact_mobile_number" 
                                            id="contact_mobile_number"
                                            placeholder="Enter contact person mobile number"
                                            value="{{ old('contact_mobile_number', isset($data->contact_mobile_number) ? $data->contact_mobile_number : '') }}"
                                        >
                                        @if($errors->has('contact_mobile_number'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('contact_mobile_number') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="tin_no" class="form-label">
                                            <i class="uil-barcode"></i>
                                            TIN Number <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('tin_no') ? 'is-invalid' : '' }}" 
                                            name="tin_no" 
                                            id="tin_no"
                                            placeholder="Enter TIN number"
                                            value="{{ old('tin_no', isset($data->tin_no) ? $data->tin_no : '') }}"
                                        >
                                        @if($errors->has('tin_no'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('tin_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="gst_no" class="form-label">
                                            <i class="uil-barcode"></i>
                                            GST Number <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('gst_no') ? 'is-invalid' : '' }}" 
                                            name="gst_no" 
                                            id="gst_no"
                                            placeholder="Enter GST number"
                                            value="{{ old('gst_no', isset($data->gst_no) ? $data->gst_no : '') }}"
                                        >
                                        @if($errors->has('gst_no'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('gst_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Form Actions -->
                <div class="form-card-footer">
                    <a href="{{ route('party.index') }}" class="btn btn-outline-secondary">
                        <i class="uil-arrow-left"></i> Back to List
                    </a>
                    <button type="reset" form="partyForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="button" onclick="submitForm()" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update' : 'Add' }}
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Save as Party Modal -->
<div class="modal fade" id="saveAsPartyModal" tabindex="-1" aria-labelledby="saveAsPartyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="saveAsPartyModalLabel">
                    <i class="uil-question-circle"></i> Save as Party?
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">
                    <i class="uil-info-circle text-info"></i>
                    <strong>Do you want to save this Consignor also as a Party?</strong>
                </p>
                <p class="text-muted">
                    This will create two records - one as Consignor and one as Party with the same information.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="submitFormWithoutParty()">
                    <i class="uil-times-circle"></i> No, Save as Consignor Only
                </button>
                <button type="button" class="btn btn-primary" onclick="submitFormWithParty()">
                    <i class="uil-check-circle"></i> Yes, Save as Both
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let partyForm = null;

    function handleFormSubmit(event) {
        event.preventDefault();
        partyForm = event.target;
        
        // Check if this is a new record (not editing)
        const isNewRecord = !document.querySelector('input[name="_method"]');
        
        if (isNewRecord) {
            // Show modal for new records
            const modal = new bootstrap.Modal(document.getElementById('saveAsPartyModal'));
            modal.show();
        } else {
            // For edit, just submit normally
            partyForm.submit();
        }
        
        return false;
    }

    function submitFormWithoutParty() {
        if (partyForm) {
            document.getElementById('save_as_both').value = '0';
            partyForm.submit();
        }
    }

    function submitFormWithParty() {
        if (partyForm) {
            document.getElementById('save_as_both').value = '1';
            partyForm.submit();
        }
    }

    function submitForm() {
        const form = document.getElementById('partyForm');
        form.dispatchEvent(new Event('submit'));
    }
</script>

@endsection
