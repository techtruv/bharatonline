@extends('layouts.app')
@section('body')

<link rel="stylesheet" href="{{ asset('dashboard/assets/css/dashboard-animations.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/modern-forms.css') }}">

<div class="dashboard-container">
    <div class="container-fluid">
        

        <!-- Alert Messages -->
        <div class="row mb-3">
            <div class="col-12">
                <x-alert />
            </div>
        </div>

        <!-- Add/Edit Form Section -->
        <div class="row">
            <div class="col-12">
                <div class="form-card">
                    <div class="form-card-header">
                        <h5 class="form-card-title">
                            <i class="uil-plus-circle me-2"></i>
                            {{ isset($data) ? 'Edit HSN Master' : 'Add New HSN Master' }}
                        </h5>
                    </div>

                    <div class="form-card-body">
                        @if(isset($data))
                            <form action="{{ route('hsnMaster.update', $data->id) }}" method="POST">
                            @method('PATCH')
                        @else
                            <form action="{{ route('hsnMaster.store') }}" method="POST">
                        @endif
                            @csrf

                            <div class="row g-3">
                                <!-- HSN Code Field -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <label for="hsn_code" class="form-label">
                                            <i class="uil-barcode me-2"></i>
                                            HSN Code
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('hsn_code') is-invalid @enderror" 
                                            id="hsn_code" 
                                            name="hsn_code" 
                                            placeholder="Enter HSN code (e.g., 1001)"
                                            value="{{ old('hsn_code', isset($data->hsn_code) ? $data->hsn_code : '') }}"
                                            required
                                        >
                                        @error('hsn_code')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Type Field -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <label for="type" class="form-label">
                                            <i class="uil-tag me-2"></i>
                                            Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            placeholder="Enter type (e.g., Goods, Services)"
                                            value="{{ old('type', isset($data->type) ? $data->type : '') }}"
                                            required
                                        >
                                        @error('type')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Commodity Field -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <label for="commodity" class="form-label">
                                            <i class="uil-box me-2"></i>
                                            Commodity
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('commodity') is-invalid @enderror" 
                                            id="commodity" 
                                            name="commodity" 
                                            placeholder="Enter commodity name"
                                            value="{{ old('commodity', isset($data->commodity) ? $data->commodity : '') }}"
                                            required
                                        >
                                        @error('commodity')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- SGST % Field -->
                                <div class="col-md-3">
                                    <div class="form-section">
                                        <label for="sgst_percent" class="form-label">
                                            <i class="uil-percent me-2"></i>
                                            SGST %
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input 
                                                type="number" 
                                                step="0.01"
                                                class="form-control @error('sgst_percent') is-invalid @enderror" 
                                                id="sgst_percent" 
                                                name="sgst_percent" 
                                                placeholder="0.00"
                                                value="{{ old('sgst_percent', isset($data->sgst_percent) ? $data->sgst_percent : '') }}"
                                                min="0"
                                                max="100"
                                                required
                                            >
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('sgst_percent')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- CGST % Field -->
                                <div class="col-md-3">
                                    <div class="form-section">
                                        <label for="cgst_percent" class="form-label">
                                            <i class="uil-percent me-2"></i>
                                            CGST %
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input 
                                                type="number" 
                                                step="0.01"
                                                class="form-control @error('cgst_percent') is-invalid @enderror" 
                                                id="cgst_percent" 
                                                name="cgst_percent" 
                                                placeholder="0.00"
                                                value="{{ old('cgst_percent', isset($data->cgst_percent) ? $data->cgst_percent : '') }}"
                                                min="0"
                                                max="100"
                                                required
                                            >
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('cgst_percent')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- IGST % Field -->
                                <div class="col-md-3">
                                    <div class="form-section">
                                        <label for="igst_percent" class="form-label">
                                            <i class="uil-percent me-2"></i>
                                            IGST %
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input 
                                                type="number" 
                                                step="0.01"
                                                class="form-control @error('igst_percent') is-invalid @enderror" 
                                                id="igst_percent" 
                                                name="igst_percent" 
                                                placeholder="0.00"
                                                value="{{ old('igst_percent', isset($data->igst_percent) ? $data->igst_percent : '') }}"
                                                min="0"
                                                max="100"
                                                required
                                            >
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('igst_percent')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Total GST Display (Read-only) -->
                                <div class="col-md-3">
                                    <div class="form-section">
                                        <label class="form-label">
                                            <i class="uil-calculator me-2"></i>
                                            Total GST (S+C)
                                        </label>
                                        <div class="input-group">
                                            <input 
                                                type="number" 
                                                step="0.01"
                                                class="form-control bg-light" 
                                                id="total_gst" 
                                                placeholder="0.00"
                                                readonly
                                            >
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row g-3 mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="uil-check me-1"></i>
                                        {{ isset($data) ? 'Update HSN Master' : 'Add HSN Master' }}
                                    </button>
                                    @if(isset($data))
                                        <a href="{{ route('hsnMaster.index') }}" class="btn btn-secondary">
                                            <i class="uil-arrow-left me-1"></i>
                                            Back to List
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- HSN Masters Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="form-card">
                    <div class="form-card-header">
                        <h5 class="form-card-title">
                            <i class="uil-list-ul me-2"></i>
                            HSN Masters List
                        </h5>
                    </div>

                    <div class="form-card-body">
                        @if($records->count() > 0)
                            <div class="table-responsive">
                                <table class="modern-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <i class="uil-hash me-1"></i>
                                                S.N.
                                            </th>
                                            <th>
                                                <i class="uil-barcode me-1"></i>
                                                HSN Code
                                            </th>
                                            <th>
                                                <i class="uil-tag me-1"></i>
                                                Type
                                            </th>
                                            <th>
                                                <i class="uil-box me-1"></i>
                                                Commodity
                                            </th>
                                            <th>
                                                <i class="uil-percent me-1"></i>
                                                SGST %
                                            </th>
                                            <th>
                                                <i class="uil-percent me-1"></i>
                                                CGST %
                                            </th>
                                            <th>
                                                <i class="uil-percent me-1"></i>
                                                IGST %
                                            </th>
                                            <th>
                                                <i class="uil-calculator me-1"></i>
                                                Total (S+C)
                                            </th>
                                            <th class="text-center">
                                                <i class="uil-cog me-1"></i>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($records as $row)
                                            <tr>
                                                <td data-label="S.N.">{{ $loop->index + 1 }}</td>
                                                <td data-label="HSN Code">
                                                    <span class="badge bg-info">{{ $row->hsn_code }}</span>
                                                </td>
                                                <td data-label="Type">
                                                    <span class="badge bg-primary">{{ $row->type }}</span>
                                                </td>
                                                <td data-label="Commodity">
                                                    <strong>{{ $row->commodity }}</strong>
                                                </td>
                                                <td data-label="SGST %">
                                                    <span class="gst-badge">{{ $row->sgst_percent }}%</span>
                                                </td>
                                                <td data-label="CGST %">
                                                    <span class="gst-badge">{{ $row->cgst_percent }}%</span>
                                                </td>
                                                <td data-label="IGST %">
                                                    <span class="gst-badge">{{ $row->igst_percent }}%</span>
                                                </td>
                                                <td data-label="Total (S+C)">
                                                    <span class="badge bg-success">{{ $row->sgst_percent + $row->cgst_percent }}%</span>
                                                </td>
                                                <td class="text-center" data-label="Actions">
                                                    <div class="action-buttons">
                                                        <a href="{{ route('hsnMaster.edit', $row->id) }}" class="btn btn-sm btn-edit">
                                                            <i class="uil-edit"></i>
                                                            <span class="d-none d-md-inline">Edit</span>
                                                        </a>
                                                        <form action="{{ route('hsnMaster.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this HSN Master?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-delete">
                                                                <i class="uil-trash"></i>
                                                                <span class="d-none d-md-inline">Delete</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <i class="uil-inbox"></i>
                                                        <p class="mt-2">No HSN Masters found</p>
                                                        <small class="text-muted">Start by adding your first HSN Master above</small>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="uil-inbox"></i>
                                <h5>No HSN Masters Yet</h5>
                                <p class="text-muted">There are no HSN Masters created yet. Create your first one using the form above.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional styling for HSN master view */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 48px;
        color: #d1d5db;
        display: block;
        margin-bottom: 10px;
    }

    .empty-state h5 {
        color: #374151;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-edit {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        color: white;
        text-decoration: none;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .badge.bg-info {
        background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
        color: white;
    }

    .badge.bg-primary {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed) !important;
        color: white;
    }

    .badge.bg-success {
        background: linear-gradient(135deg, #10b981, #059669) !important;
        color: white;
    }

    .gst-badge {
        display: inline-block;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        padding: 0.35rem 0.7rem;
        border-radius: 0.375rem;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .input-group-text {
        background-color: #f3f4f6;
        border-color: #e5e7eb;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .form-card-header {
            flex-wrap: wrap;
        }

        .action-buttons {
            gap: 3px;
        }

        .btn-edit, .btn-delete {
            padding: 0.3rem 0.6rem;
            font-size: 0.75rem;
        }
    }
</style>

<script>
    // Calculate total GST on input change
    document.addEventListener('DOMContentLoaded', function() {
        const sgstInput = document.getElementById('sgst_percent');
        const cgstInput = document.getElementById('cgst_percent');
        const totalInput = document.getElementById('total_gst');

        function calculateTotal() {
            const sgst = parseFloat(sgstInput.value) || 0;
            const cgst = parseFloat(cgstInput.value) || 0;
            totalInput.value = (sgst + cgst).toFixed(2);
        }

        if (sgstInput && cgstInput && totalInput) {
            sgstInput.addEventListener('input', calculateTotal);
            cgstInput.addEventListener('input', calculateTotal);
            calculateTotal(); // Initialize on load
        }
    });
</script>

@endsection
