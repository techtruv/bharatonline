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
                    <i class="uil-building me-2"></i>
                    {{ isset($data) ? 'Update Supplier Information' : 'Add New Supplier' }}
                </div>

                @if(isset($data))
                    <form action="{{ route('supplier.update',$data->id) }}" method="post" class="compact-form">
                        @method('PATCH')
                @else
                    <form action="{{ route('supplier.store') }}" method="post" class="compact-form">
                @endif
                    @csrf

                    <!-- Compact Form Table -->
                    <div class="compact-form-table">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <!-- Row 1: Supplier Information -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-user-circle"></i>
                                        Supplier Name <span class="required">*</span>
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('supplierName') ? 'is-invalid' : '' }}"
                                            name="supplierName"
                                            id="supplierName"
                                            placeholder="Enter supplier name"
                                            value="{{ old('supplierName', isset($data->supplierName) ? $data->supplierName : '') }}"
                                            required
                                        >
                                        @if($errors->has('supplierName'))
                                            <div class="invalid-feedback">{{ $errors->first('supplierName') }}</div>
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
                            </tbody>
                        </table>
                    </div>

                    <!-- Compact Form Actions -->
                    <div class="d-flex justify-between align-items-center mt-3 pt-2 border-top">
                        <a href="{{ route('supplier.index') }}" class="btn btn-outline-secondary btn-sm">
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