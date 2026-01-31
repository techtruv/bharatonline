@extends('layouts.app')
@section('body')

<link rel="stylesheet" href="{{ asset('dashboard/assets/css/dashboard-animations.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/modern-forms.css') }}">

<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-header">
                    <h1>
                        <i class="uil-receipt"></i>
                        Voucher Entry Types
                    </h1>
                    <p class="dashboard-subtitle">
                        <i class="uil-info-circle me-1"></i>
                        Manage voucher entry types with code and name
                    </p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <div class="row mb-3">
            <div class="col-12">
                <x-alert />
            </div>
        </div>

        <!-- Add/Edit Form Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="form-card">
                    <div class="form-card-header">
                        <h5 class="form-card-title">
                            <i class="uil-plus-circle me-2"></i>
                            {{ isset($data) ? 'Edit Voucher Entry Type' : 'Add New Voucher Entry Type' }}
                        </h5>
                    </div>

                    <div class="form-card-body">
                        @if(isset($data))
                            <form action="{{ route('voucherEntryType.update', $data->id) }}" method="POST">
                            @method('PATCH')
                        @else
                            <form action="{{ route('voucherEntryType.store') }}" method="POST">
                        @endif
                            @csrf

                            <div class="row g-3">
                                <!-- Code Field -->
                                <div class="col-md-6">
                                    <div class="form-section">
                                        <label for="code" class="form-label">
                                            <i class="uil-barcode me-2"></i>
                                            Code
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control @error('code') is-invalid @enderror"
                                            id="code"
                                            name="code"
                                            placeholder="Enter code (e.g., VET001)"
                                            value="{{ old('code', isset($data->code) ? $data->code : '') }}"
                                            required
                                        >
                                        @error('code')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Name Field -->
                                <div class="col-md-6">
                                    <div class="form-section">
                                        <label for="name" class="form-label">
                                            <i class="uil-tag me-2"></i>
                                            Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name"
                                            name="name"
                                            placeholder="Enter name"
                                            value="{{ old('name', isset($data->name) ? $data->name : '') }}"
                                            required
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row g-3 mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="uil-check me-1"></i>
                                        {{ isset($data) ? 'Update Type' : 'Add Type' }}
                                    </button>
                                    @if(isset($data))
                                        <a href="{{ route('voucherEntryType.index') }}" class="btn btn-secondary">
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

        <!-- Voucher Entry Types Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="form-card">
                    <div class="form-card-header">
                        <h5 class="form-card-title">
                            <i class="uil-list-ul me-2"></i>
                            Voucher Entry Types List
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
                                                Code
                                            </th>
                                            <th>
                                                <i class="uil-tag me-1"></i>
                                                Name
                                            </th>
                                            <th>
                                                <i class="uil-clock-eight me-1"></i>
                                                Created Date
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
                                                <td data-label="Code">
                                                    <span class="badge bg-info">{{ $row->code }}</span>
                                                </td>
                                                <td data-label="Name">
                                                    <strong>{{ $row->name }}</strong>
                                                </td>
                                                <td data-label="Created Date">
                                                    <small class="text-muted">
                                                        <i class="uil-calendar-alt me-1"></i>
                                                        {{ $row->created_at->format('d M Y') }}
                                                    </small>
                                                </td>
                                                <td class="text-center" data-label="Actions">
                                                    <div class="action-buttons">
                                                        <a href="{{ route('voucherEntryType.edit', $row->id) }}" class="btn btn-sm btn-edit">
                                                            <i class="uil-edit"></i>
                                                            <span class="d-none d-md-inline">Edit</span>
                                                        </a>
                                                        <form action="{{ route('voucherEntryType.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this voucher entry type?');">
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
                                                <td colspan="5" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <i class="uil-inbox"></i>
                                                        <p class="mt-2">No voucher entry types found</p>
                                                        <small class="text-muted">Start by adding your first voucher entry type above</small>
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
                                <h5>No Voucher Entry Types Yet</h5>
                                <p class="text-muted">There are no voucher entry types created yet. Create your first one using the form above.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional styling for voucher entry type view */
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
            font-size: 0.875rem;
        }
    }
</style>

@endsection