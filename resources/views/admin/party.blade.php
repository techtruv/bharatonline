@extends('layouts.app')
@section('body')
<!-- Start Content -->
<div class="container-fluid p-2">

    <div class="row">
        <div class="col-12">
            <x-alert />

            <!-- Compact Form Container -->
            <div class="compact-form-container">
                <div class="compact-form-header">
                    <i class="uil-plus-circle me-2"></i>
                    {{ isset($data) ? 'Update Consignor Information' : 'Add New Consignor' }}
                </div>

                @if(isset($data))
                    <form action="{{ route('party.update',$data->id) }}" method="post" class="compact-form">
                        @method('PATCH')
                @else
                    <form action="{{ route('party.store') }}" method="post" class="compact-form" onsubmit="return handleFormSubmit(event)">
                @endif
                    @csrf
                    <input type="hidden" id="save_as_both" name="save_as_both" value="0">

                    <!-- Compact Form Table -->
                    <div class="compact-form-table">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <!-- Row 1: Basic Information -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-user-circle"></i>
                                        Name <span class="required">*</span>
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('partyName') ? 'is-invalid' : '' }}"
                                            name="partyName"
                                            id="partyName"
                                            placeholder="Enter name"
                                            value="{{ old('partyName', isset($data->partyName) ? $data->partyName : '') }}"
                                            required
                                        >
                                        @if($errors->has('partyName'))
                                            <div class="invalid-feedback">{{ $errors->first('partyName') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-envelope"></i>
                                        Email
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="email"
                                            class="form-control form-control-sm {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            name="email"
                                            id="email"
                                            placeholder="Enter email address"
                                            value="{{ old('email', isset($data->email) ? $data->email : '') }}"
                                        >
                                        @if($errors->has('email'))
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Row 2: Contact Numbers -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-phone"></i>
                                        Phone
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="tel"
                                            class="form-control form-control-sm {{ $errors->has('phone_no') ? 'is-invalid' : '' }}"
                                            name="phone_no"
                                            id="phone_no"
                                            placeholder="Enter phone number"
                                            value="{{ old('phone_no', isset($data->phone_no) ? $data->phone_no : '') }}"
                                        >
                                        @if($errors->has('phone_no'))
                                            <div class="invalid-feedback">{{ $errors->first('phone_no') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-mobile-android"></i>
                                        Mobile <span class="required">*</span>
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="tel"
                                            class="form-control form-control-sm {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                            name="mobile"
                                            id="mobile"
                                            placeholder="Enter mobile number"
                                            value="{{ old('mobile', isset($data->mobile) ? $data->mobile : '') }}"
                                            required
                                        >
                                        @if($errors->has('mobile'))
                                            <div class="invalid-feedback">{{ $errors->first('mobile') }}</div>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Row 3: Alternative Contact -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-mobile-android"></i>
                                        Alt Mobile
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="tel"
                                            class="form-control form-control-sm {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}"
                                            name="mobile_no"
                                            id="mobile_no"
                                            placeholder="Alternative mobile"
                                            value="{{ old('mobile_no', isset($data->mobile_no) ? $data->mobile_no : '') }}"
                                        >
                                        @if($errors->has('mobile_no'))
                                            <div class="invalid-feedback">{{ $errors->first('mobile_no') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-user"></i>
                                        Contact Person
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('contact_person_name') ? 'is-invalid' : '' }}"
                                            name="contact_person_name"
                                            id="contact_person_name"
                                            placeholder="Contact person name"
                                            value="{{ old('contact_person_name', isset($data->contact_person_name) ? $data->contact_person_name : '') }}"
                                        >
                                        @if($errors->has('contact_person_name'))
                                            <div class="invalid-feedback">{{ $errors->first('contact_person_name') }}</div>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Row 4: Business Details -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-mobile-android"></i>
                                        Contact Mobile
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="tel"
                                            class="form-control form-control-sm {{ $errors->has('contact_mobile_number') ? 'is-invalid' : '' }}"
                                            name="contact_mobile_number"
                                            id="contact_mobile_number"
                                            placeholder="Contact person mobile"
                                            value="{{ old('contact_mobile_number', isset($data->contact_mobile_number) ? $data->contact_mobile_number : '') }}"
                                        >
                                        @if($errors->has('contact_mobile_number'))
                                            <div class="invalid-feedback">{{ $errors->first('contact_mobile_number') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-barcode"></i>
                                        TIN Number
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('tin_no') ? 'is-invalid' : '' }}"
                                            name="tin_no"
                                            id="tin_no"
                                            placeholder="Enter TIN number"
                                            value="{{ old('tin_no', isset($data->tin_no) ? $data->tin_no : '') }}"
                                        >
                                        @if($errors->has('tin_no'))
                                            <div class="invalid-feedback">{{ $errors->first('tin_no') }}</div>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Row 5: GST and Address -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-barcode"></i>
                                        GST Number
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('gst_no') ? 'is-invalid' : '' }}"
                                            name="gst_no"
                                            id="gst_no"
                                            placeholder="Enter GST number"
                                            value="{{ old('gst_no', isset($data->gst_no) ? $data->gst_no : '') }}"
                                        >
                                        @if($errors->has('gst_no'))
                                            <div class="invalid-feedback">{{ $errors->first('gst_no') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-map-marker"></i>
                                        Address
                                    </td>
                                    <td class="compact-field" colspan="3">
                                        <textarea
                                            class="form-control form-control-sm {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                            name="address"
                                            id="address"
                                            placeholder="Enter complete address"
                                            rows="2"
                                        >{{ old('address', isset($data->address) ? $data->address : '') }}</textarea>
                                        @if($errors->has('address'))
                                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Compact Form Actions -->
                    <div class="d-flex justify-between align-items-center mt-3 pt-2 border-top">
                        <a href="{{ route('party.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="uil-arrow-left me-1"></i>Back to List
                        </a>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-outline-secondary btn-sm">
                                <i class="uil-redo me-1"></i>Reset
                            </button>
                            <button type="button" onclick="submitForm()" class="btn btn-primary btn-sm">
                                <i class="uil-check-circle me-1"></i>{{ isset($data) ? 'Update' : 'Add' }}
                            </button>
                        </div>
                    </div>

                </form>
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
