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
                      <i class="uil-building"></i>
                    {{ isset($data) ? 'Update Supplier Information' : 'Add New Supplier' }}
                </div>

                <div class="form-card-body">
                    @if(isset($data))
                        <form action="{{ route('supplier.update',$data->id) }}" method="post" id="supplierForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('supplier.store') }}" method="post" id="supplierForm">
                    @endif
                        @csrf

                        <!-- Supplier Information Section -->
                        <div class="row g-2">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="supplierName" class="form-label">
                                        <i class="uil-user-circle"></i>
                                        Supplier Name <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control {{ $errors->has('supplierName') ? 'is-invalid' : '' }}" 
                                        name="supplierName" 
                                        id="supplierName"
                                        placeholder="Enter supplier name"
                                        value="{{ old('supplierName', isset($data->supplierName) ? $data->supplierName : '') }}"
                                        required
                                    >
                                    @if($errors->has('supplierName'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('supplierName') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="mobile" class="form-label">
                                        <i class="uil-phone"></i>
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
                        </div>

                    </form>
                </div>

                <!-- Form Actions -->
                <div class="form-card-footer">
                    <a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary">
                        <i class="uil-arrow-left"></i> Back to List
                    </a>
                    <button type="reset" form="supplierForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="submit" form="supplierForm" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update Supplier' : 'Add Supplier' }}
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection