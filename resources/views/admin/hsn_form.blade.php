@extends('layouts.app')
@section('body')

<link rel="stylesheet" href="{{ asset('dashboard/assets/css/dashboard-animations.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/modern-forms.css') }}">

<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <h2>
                        <i class="uil-{{ $isEdit ? 'edit' : 'plus-circle' }} me-2"></i>
                        {{ $isEdit ? 'Edit HSN Master' : 'Create HSN Master' }}
                    </h2>
                    <p class="text-muted">{{ $isEdit ? 'Update HSN/SAC details' : 'Add a new HSN/SAC code' }}</p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <div class="row mb-3">
            <div class="col-12">
                <x-alert />
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="form-card">
                    <div class="form-card-body">
                        <form action="{{ $isEdit ? route('hsnMaster.update', $hsnMaster->id) : route('hsnMaster.store') }}" method="POST">
                            @csrf
                            @if($isEdit)
                                @method('PATCH')
                            @endif

                            <div class="row g-3">
                                <!-- HSN Code -->
                                <div class="col-md-6">
                                    <div class="form-section">
                                        <label for="hsn_code" class="form-label">
                                            <i class="uil-barcode me-2"></i>HSN Code
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('hsn_code') is-invalid @enderror" 
                                            id="hsn_code" 
                                            name="hsn_code" 
                                            placeholder="Enter HSN/SAC code"
                                            value="{{ old('hsn_code', $hsnMaster->hsn_code ?? '') }}"
                                            required
                                        >
                                        @error('hsn_code')
                                            <div class="invalid-feedback d-block">
                                                <i class="uil-info-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Type -->
                                <div class="col-md-6">
                                    <div class="form-section">
                                        <label for="type" class="form-label">
                                            <i class="uil-tag me-2"></i>Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            placeholder="e.g., Goods, Services"
                                            value="{{ old('type', $hsnMaster->type ?? '') }}"
                                            required
                                        >
                                        @error('type')
                                            <div class="invalid-feedback d-block">
                                                <i class="uil-info-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Commodity Name -->
                                <div class="col-12">
                                    <div class="form-section">
                                        <label for="commodity" class="form-label">
                                            <i class="uil-box me-2"></i>Commodity Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('commodity') is-invalid @enderror" 
                                            id="commodity" 
                                            name="commodity" 
                                            placeholder="e.g., Cotton Fabric, Consulting Services"
                                            value="{{ old('commodity', $hsnMaster->commodity ?? '') }}"
                                            required
                                        >
                                        @error('commodity')
                                            <div class="invalid-feedback d-block">
                                                <i class="uil-info-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- SGST Percent -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <label for="sgst_percent" class="form-label">
                                            <i class="uil-percent me-2"></i>SGST %
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="number" 
                                            step="0.01"
                                            class="form-control @error('sgst_percent') is-invalid @enderror" 
                                            id="sgst_percent" 
                                            name="sgst_percent" 
                                            placeholder="0.00"
                                            value="{{ old('sgst_percent', $hsnMaster->sgst_percent ?? 0) }}"
                                            min="0"
                                            max="100"
                                            required
                                        >
                                        @error('sgst_percent')
                                            <div class="invalid-feedback d-block">
                                                <i class="uil-info-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- CGST Percent -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <label for="cgst_percent" class="form-label">
                                            <i class="uil-percent me-2"></i>CGST %
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="number" 
                                            step="0.01"
                                            class="form-control @error('cgst_percent') is-invalid @enderror" 
                                            id="cgst_percent" 
                                            name="cgst_percent" 
                                            placeholder="0.00"
                                            value="{{ old('cgst_percent', $hsnMaster->cgst_percent ?? 0) }}"
                                            min="0"
                                            max="100"
                                            required
                                        >
                                        @error('cgst_percent')
                                            <div class="invalid-feedback d-block">
                                                <i class="uil-info-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- IGST Percent -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <label for="igst_percent" class="form-label">
                                            <i class="uil-percent me-2"></i>IGST %
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="number" 
                                            step="0.01"
                                            class="form-control @error('igst_percent') is-invalid @enderror" 
                                            id="igst_percent" 
                                            name="igst_percent" 
                                            placeholder="0.00"
                                            value="{{ old('igst_percent', $hsnMaster->igst_percent ?? 0) }}"
                                            min="0"
                                            max="100"
                                            required
                                        >
                                        @error('igst_percent')
                                            <div class="invalid-feedback d-block">
                                                <i class="uil-info-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row g-3 mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="uil-check me-2"></i>
                                        {{ $isEdit ? 'Update HSN Master' : 'Create HSN Master' }}
                                    </button>
                                    <a href="{{ route('hsnMaster.index') }}" class="btn btn-secondary btn-lg">
                                        <i class="uil-arrow-left me-2"></i>Back to List
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .page-header {
        border-bottom: 2px solid #166534;
        padding-bottom: 15px;
    }

    .page-header h2 {
        color: #166534;
        font-weight: 700;
        margin: 0;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .btn-primary {
        background-color: #166534;
        border-color: #166534;
    }

    .btn-primary:hover {
        background-color: #145230;
        border-color: #145230;
    }

    .text-danger {
        color: #ef4444;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>

@endsection
