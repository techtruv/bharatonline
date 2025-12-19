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
                    <i class="uil-user"></i>
                    {{ isset($data) ? 'Update Driver Information' : 'Add New Driver' }}
                </div>

                <div class="form-card-body">
                    @if(isset($data))
                        <form action="{{ route('driver.update',$data->id) }}" method="post" id="driverForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('driver.store') }}" method="post" id="driverForm">
                    @endif
                        @csrf

                        <!-- Driver Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="uil-user-circle"></i>
                                Driver Details
                            </div>

                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="driverName" class="form-label">
                                            <i class="uil-user-circle"></i>
                                            Driver Name <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('driverName') ? 'is-invalid' : '' }}" 
                                            name="driverName" 
                                            id="driverName"
                                            placeholder="Enter driver name"
                                            value="{{ old('driverName', isset($data->driverName) ? $data->driverName : '') }}"
                                            required
                                        >
                                        @if($errors->has('driverName'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('driverName') }}
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
                        </div>

                        <!-- Opening Balance Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="uil-wallet"></i>
                                Opening Balance
                            </div>

                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="openingType" class="form-label">
                                            <i class="uil-list"></i>
                                            Opening Type <span class="required">*</span>
                                        </label>
                                        <select 
                                            id="openingType" 
                                            name="openingType" 
                                            class="form-select {{ $errors->has('openingType') ? 'is-invalid' : '' }}"
                                            required
                                        >
                                            <option value="">-- Select Opening Type --</option>
                                            <option value="1" {{ (old('openingType', isset($data->openingType) ? $data->openingType : '') == '1') ? 'selected' : '' }}>
                                                Driver Has to Pay
                                            </option>
                                            <option value="2" {{ (old('openingType', isset($data->openingType) ? $data->openingType : '') == '2') ? 'selected' : '' }}>
                                                Driver Has to Get
                                            </option>
                                        </select>
                                        @if($errors->has('openingType'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('openingType') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="openingBalance" class="form-label">
                                            <i class="uil-rupee"></i>
                                            Opening Balance <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="number" 
                                            class="form-control {{ $errors->has('openingBalance') ? 'is-invalid' : '' }}" 
                                            name="openingBalance" 
                                            id="openingBalance"
                                            placeholder="Enter opening balance"
                                            value="{{ old('openingBalance', isset($data->openingBalance) ? $data->openingBalance : '0') }}"
                                            required
                                        >
                                        @if($errors->has('openingBalance'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('openingBalance') }}
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
                    <a href="{{ route('driver.index') }}" class="btn btn-outline-secondary">
                        <i class="uil-arrow-left"></i> Back to List
                    </a>
                    <button type="reset" form="driverForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="submit" form="driverForm" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update Driver' : 'Add Driver' }}
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection