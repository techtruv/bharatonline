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
                        <i class="uil-folder-open"></i>
                        Account Groups
                    </h1>
                    <p class="dashboard-subtitle">
                        <i class="uil-info-circle me-1"></i>
                        Manage account groups with code, name, and hierarchy
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
                            {{ isset($data) ? 'Edit Account Group' : 'Add New Account Group' }}
                        </h5>
                    </div>

                    <div class="form-card-body">
                        @if(isset($data))
                            <form action="{{ route('accountGroup.update', $data->id) }}" method="POST">
                            @method('PATCH')
                        @else
                            <form action="{{ route('accountGroup.store') }}" method="POST">
                        @endif
                            @csrf

                            <div class="row g-3">
                                <!-- Code Field -->
                                <div class="col-md-4">
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
                                            placeholder="Enter code (e.g., AG001)"
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

                                <!-- Group Name Field -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <label for="group_name" class="form-label">
                                            <i class="uil-folder me-2"></i>
                                            Group Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('group_name') is-invalid @enderror" 
                                            id="group_name" 
                                            name="group_name" 
                                            placeholder="Enter group name"
                                            value="{{ old('group_name', isset($data->group_name) ? $data->group_name : '') }}"
                                            required
                                        >
                                        @error('group_name')
                                            <div class="invalid-feedback">
                                                <i class="uil-info-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Under Group Select -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <label for="under_group_id" class="form-label">
                                            <i class="uil-sitemap me-2"></i>
                                            Under Group
                                            <span class="text-muted">(Optional)</span>
                                        </label>
                                        <select 
                                            class="form-control @error('under_group_id') is-invalid @enderror" 
                                            id="under_group_id" 
                                            name="under_group_id"
                                        >
                                            <option value="">-- Select Parent Group --</option>
                                            @foreach($parentGroups as $group)
                                                <option 
                                                    value="{{ $group->id }}"
                                                    @if(old('under_group_id', isset($data->under_group_id) ? $data->under_group_id : '') == $group->id) selected @endif
                                                >
                                                    {{ $group->code }} - {{ $group->group_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('under_group_id')
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
                                        {{ isset($data) ? 'Update Group' : 'Add Group' }}
                                    </button>
                                    @if(isset($data))
                                        <a href="{{ route('accountGroup.index') }}" class="btn btn-secondary">
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

        <!-- Account Groups Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="form-card">
                    <div class="form-card-header">
                        <h5 class="form-card-title">
                            <i class="uil-list-ul me-2"></i>
                            Account Groups List
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
                                                <i class="uil-folder me-1"></i>
                                                Group Name
                                            </th>
                                            <th>
                                                <i class="uil-sitemap me-1"></i>
                                                Under Group
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
                                                <td data-label="Group Name">
                                                    <strong>{{ $row->group_name }}</strong>
                                                </td>
                                                <td data-label="Under Group">
                                                    @if($row->parentGroup)
                                                        <span class="badge bg-secondary">
                                                            {{ $row->parentGroup->code }} - {{ $row->parentGroup->group_name }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td data-label="Created Date">
                                                    <small class="text-muted">
                                                        <i class="uil-calendar-alt me-1"></i>
                                                        {{ $row->created_at->format('d M Y') }}
                                                    </small>
                                                </td>
                                                <td class="text-center" data-label="Actions">
                                                    <div class="action-buttons">
                                                        <a href="{{ route('accountGroup.edit', $row->id) }}" class="btn btn-sm btn-edit">
                                                            <i class="uil-edit"></i>
                                                            <span class="d-none d-md-inline">Edit</span>
                                                        </a>
                                                        <form action="{{ route('accountGroup.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this account group?');">
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
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <i class="uil-inbox"></i>
                                                        <p class="mt-2">No account groups found</p>
                                                        <small class="text-muted">Start by adding your first account group above</small>
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
                                <h5>No Account Groups Yet</h5>
                                <p class="text-muted">There are no account groups created yet. Create your first one using the form above.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional styling for account group view */
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

    .badge.bg-secondary {
        background: linear-gradient(135deg, #6b7280, #4b5563) !important;
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
