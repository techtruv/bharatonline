@extends('layouts.app')

@section('body')
<div class="container-fluid pt-4 pb-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="d-flex align-items-center">
                <i class="uil uil-book-open" style="font-size: 32px; color: #166534; margin-right: 15px;"></i>
                <div>
                    <h2 class="mb-0" style="color: #111827; font-weight: 700;">Ledger Master</h2>
                    <p class="text-muted mb-0">Manage all ledger accounts</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-end">
            @if(isset($data))
                <a href="{{ route('ledgerMaster.index') }}" class="btn btn-secondary me-2">
                    <i class="uil uil-arrow-left"></i> Back
                </a>
            @elseif(!isset($records))
                <a href="{{ route('ledgerMaster.index') }}" class="btn btn-secondary me-2">
                    <i class="uil uil-arrow-left"></i> Back
                </a>
            @else
                <a href="{{ route('ledgerMaster.create') }}" class="btn btn-primary">
                    <i class="uil uil-plus"></i> Add New Ledger
                </a>
            @endif
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="uil uil-exclamation-triangle"></i>
            <strong>Validation Error!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="uil uil-check-circle"></i>
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="uil uil-exclamation-circle"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Content -->
    @if(isset($data))
        <!-- Edit Form -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0" style="color: #166534;">Edit Ledger Master</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ledgerMaster.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.ledger_form', ['data' => $data, 'groups' => $groups, 'types' => $types])
                </form>
            </div>
        </div>
    @elseif(!isset($records))
        <!-- Create Form -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0" style="color: #166534;">Add New Ledger Master</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ledgerMaster.store') }}" method="POST">
                    @csrf
                    @include('admin.ledger_form', ['data' => null, 'groups' => $groups, 'types' => $types])
                </form>
            </div>
        </div>
    @else
        <!-- Table View -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0" style="color: #166534;">All Ledgers</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <input type="text" id="searchLedger" class="form-control d-inline-block" 
                               style="width: 250px;" placeholder="Search by name or type...">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #f3f4f6;">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">Type</th>
                                <th style="width: 25%;">Name</th>
                                <th style="width: 15%;">Short Name</th>
                                <th style="width: 12%;">Opening Balance</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 18%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($records) && count($records) > 0)
                                @foreach($records as $key => $record)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $record->type }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $record->name }}</strong>
                                        </td>
                                        <td>{{ $record->short_name ?? '-' }}</td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $record->dr_cr == 'DR' ? '#10b981' : '#ef4444' }};">
                                                {{ $record->dr_cr }} ₹{{ number_format($record->opening_balance, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $record->status == 'Active' ? '#059669' : '#6b7280' }};">
                                                {{ $record->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('ledgerMaster.edit', $record->id) }}" 
                                               class="btn btn-sm btn-primary" title="Edit">
                                                <i class="uil uil-edit"></i>
                                            </a>
                                            <form action="{{ route('ledgerMaster.destroy', $record->id) }}" method="POST" 
                                                  class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="uil uil-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <p class="text-muted mb-0">No ledgers found</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>



<style>
    .nav-tabs .nav-link {
        color: #666;
        border: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        font-weight: 500;
    }

    .nav-tabs .nav-link:hover {
        border-bottom: 2px solid #166534;
        color: #166534;
    }

    .nav-tabs .nav-link.active {
        color: #166534;
        background-color: transparent;
        border-bottom: 2px solid #166534;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .badge {
        font-size: 0.85rem;
        padding: 6px 10px;
        font-weight: 500;
    }

    .btn-sm {
        padding: 6px 10px;
        font-size: 0.875rem;
    }
</style>

<script>
    // Initialize all tabs on page load
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            var targetId = this.getAttribute('data-bs-target');
            if (targetId) {
                var target = document.querySelector(targetId);
                if (target) {
                    // Hide all panes
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.style.display = 'none';
                        pane.classList.remove('show', 'active');
                    });
                    // Show target pane
                    target.style.display = 'block';
                    target.classList.add('show', 'active');

                    // Update active tab button
                    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(btn => {
                        btn.classList.remove('active');
                        btn.setAttribute('aria-selected', 'false');
                        btn.style.color = '#333 !important';
                        btn.style.backgroundColor = 'transparent';
                    });
                    this.classList.add('active');
                    this.setAttribute('aria-selected', 'true');
                    this.style.color = '#166534 !important';
                    this.style.backgroundColor = '#f3faf8';
                }
            }
        });
    });

    // Search functionality
    document.getElementById('searchLedger')?.addEventListener('keyup', function() {
        let searchTerm = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endsection
