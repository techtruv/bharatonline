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
                    <i class="uil-user me-2"></i>
                    {{ isset($data) ? 'Update Driver Information' : 'Add New Driver' }}
                </div>

                @if(isset($data))
                    <form action="{{ route('driver.update',$data->id) }}" method="post" class="compact-form">
                        @method('PATCH')
                @else
                    <form action="{{ route('driver.store') }}" method="post" class="compact-form">
                @endif
                    @csrf

                    <!-- Compact Form Table -->
                    <div class="compact-form-table">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <!-- Row 1: Driver Information -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-user-circle"></i>
                                        Driver Name <span class="required">*</span>
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('driverName') ? 'is-invalid' : '' }}"
                                            name="driverName"
                                            id="driverName"
                                            placeholder="Enter driver name"
                                            value="{{ old('driverName', isset($data->driverName) ? $data->driverName : '') }}"
                                            required
                                        >
                                        @if($errors->has('driverName'))
                                            <div class="invalid-feedback">{{ $errors->first('driverName') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-phone"></i>
                                        Mobile Number <span class="required">*</span>
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

                                <!-- Row 2: Opening Balance -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-list"></i>
                                        Opening Type <span class="required">*</span>
                                    </td>
                                    <td class="compact-field">
                                        <select
                                            id="openingType"
                                            name="openingType"
                                            class="form-select form-select-sm {{ $errors->has('openingType') ? 'is-invalid' : '' }}"
                                            required
                                        >
                                            <option value="">-- Select Type --</option>
                                            <option value="1" {{ (old('openingType', isset($data->openingType) ? $data->openingType : '') == '1') ? 'selected' : '' }}>
                                                Driver Has to Pay
                                            </option>
                                            <option value="2" {{ (old('openingType', isset($data->openingType) ? $data->openingType : '') == '2') ? 'selected' : '' }}>
                                                Driver Has to Get
                                            </option>
                                        </select>
                                        @if($errors->has('openingType'))
                                            <div class="invalid-feedback">{{ $errors->first('openingType') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-rupee"></i>
                                        Opening Balance <span class="required">*</span>
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="number"
                                            class="form-control form-control-sm {{ $errors->has('openingBalance') ? 'is-invalid' : '' }}"
                                            name="openingBalance"
                                            id="openingBalance"
                                            placeholder="0.00"
                                            value="{{ old('openingBalance', isset($data->openingBalance) ? $data->openingBalance : '0') }}"
                                            required
                                        >
                                        @if($errors->has('openingBalance'))
                                            <div class="invalid-feedback">{{ $errors->first('openingBalance') }}</div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Compact Form Actions -->
                    <div class="d-flex justify-between align-items-center mt-3 pt-2 border-top">
                        <a href="{{ route('driver.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="uil-arrow-left me-1"></i>Back to List
                        </a>
                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-outline-secondary btn-sm">
                                <i class="uil-redo me-1"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="uil-check-circle me-1"></i>{{ isset($data) ? 'Update' : 'Add' }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

</div>
@endsection