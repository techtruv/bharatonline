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
                    <h2><i class="uil-barcode me-2"></i>HSN Master</h2>
                    <p class="text-muted">Manage Harmonized System of Nomenclature (HSN) and Service Accounting Code (SAC)</p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <div class="row mb-3">
            <div class="col-12">
                <x-alert />
            </div>
        </div>

        <!-- Search & Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="form-card">
                    <div class="form-card-body">
                        <form method="GET" action="{{ route('hsnMaster.index') }}" class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><i class="uil-search me-1"></i>Search HSN/Commodity</label>
                                <input type="text" name="search" class="form-control" placeholder="Enter HSN code or commodity name..." value="{{ $searchTerm }}">
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="uil-search me-1"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create New Button -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('hsnMaster.create') }}" class="btn btn-success btn-lg">
                    <i class="uil-plus-circle me-2"></i>Add New HSN Master
                </a>
            </div>
        </div>

        <!-- HSN Masters List -->
        <div class="row">
            <div class="col-12">
                <div class="form-card">
                    <div class="form-card-header">
                        <h5 class="form-card-title">
                            <i class="uil-list-ul me-2"></i>
                            HSN Masters List
                        </h5>
                        <span class="badge bg-primary">{{ $hsnMasters->total() }} Records</span>
                    </div>

                    <div class="form-card-body">
                        @if($hsnMasters->count() > 0)
                            <div class="table-responsive">
                                <table class="modern-table">
                                    <thead>
                                        <tr>
                                            <th><i class="uil-hash me-1"></i>S.N.</th>
                                            <th><i class="uil-barcode me-1"></i>HSN Code</th>
                                            <th><i class="uil-tag me-1"></i>Type</th>
                                            <th><i class="uil-box me-1"></i>Commodity Name</th>
                                            <th><i class="uil-percent me-1"></i>SGST</th>
                                            <th><i class="uil-percent me-1"></i>CGST</th>
                                            <th><i class="uil-percent me-1"></i>IGST</th>
                                            <th><i class="uil-calculator me-1"></i>Total (S+C)</th>
                                            <th class="text-center"><i class="uil-cog me-1"></i>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($hsnMasters as $row)
                                            <tr>
                                                <td data-label="S.N.">{{ ($hsnMasters->currentPage() - 1) * $hsnMasters->perPage() + $loop->iteration }}</td>
                                                <td data-label="HSN Code">
                                                    <span class="badge bg-info">{{ $row->hsn_code }}</span>
                                                </td>
                                                <td data-label="Type">
                                                    <span class="badge bg-primary">{{ $row->type }}</span>
                                                </td>
                                                <td data-label="Commodity Name">
                                                    <strong>{{ $row->commodity }}</strong>
                                                </td>
                                                <td data-label="SGST">
                                                    <small class="d-block">{{ $row->sgst_percent }}%</small>
                                                </td>
                                                <td data-label="CGST">
                                                    <small class="d-block">{{ $row->cgst_percent }}%</small>
                                                </td>
                                                <td data-label="IGST">
                                                    <small class="d-block text-success fw-bold">{{ $row->igst_percent }}%</small>
                                                </td>
                                                <td data-label="Total (S+C)">
                                                    <span class="badge bg-success">{{ $row->sgst_percent + $row->cgst_percent }}%</span>
                                                </td>
                                                <td class="text-center" data-label="Actions">
                                                    <div class="action-buttons">
                                                        <a href="{{ route('hsnMaster.edit', $row->id) }}" class="btn btn-sm btn-edit" title="Edit">
                                                            <i class="uil-edit"></i>
                                                        </a>
                                                        <form action="{{ route('hsnMaster.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-delete" title="Delete">
                                                                <i class="uil-trash"></i>
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
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    {{ $hsnMasters->links() }}
                                </div>
                            </div>
                        @else
                            <div class="empty-state text-center py-5">
                                <i class="uil-inbox" style="font-size: 48px; color: #d1d5db;"></i>
                                <h5 class="mt-3">No HSN Masters Found</h5>
                                <p class="text-muted">Start by creating your first HSN Master</p>
                                <a href="{{ route('hsnMaster.create') }}" class="btn btn-primary mt-3">
                                    <i class="uil-plus-circle me-2"></i>Create First HSN
                                </a>
                            </div>
                        @endif
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

    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state i {
        font-size: 48px;
        color: #d1d5db;
        display: block;
    }

    .empty-state h5 {
        color: #374151;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .btn-edit {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        padding: 0.4rem 0.6rem;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border: none;
        padding: 0.4rem 0.6rem;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        color: white;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        font-weight: 500;
    }
</style>

@endsection
