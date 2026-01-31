
@php
use App\Http\Controllers\AdminController;
@endphp
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
                    <i class="uil-receipt me-2"></i>
                    {{ isset($data) ? 'Update Billing Type Information' : 'Add New Billing Type' }}
                </div>

                @if(isset($data))
                    <form action="{{ route('billType.update',$data->id) }}" method="post" class="compact-form">
                        @method('PATCH')
                @else
                    <form action="{{ route('billType.store') }}" method="post" class="compact-form">
                @endif
                    @csrf

                    <!-- Compact Form Table -->
                    <div class="compact-form-table">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <!-- Row 1: Billing Type Information -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-file-text"></i>
                                        Billing Type Name <span class="required">*</span>
                                    </td>
                                    <td class="compact-field" colspan="3">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            name="name"
                                            id="name"
                                            placeholder="Enter billing type name"
                                            value="{{ old('name', isset($data->name) ? $data->name : '') }}"
                                            required
                                        >
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Compact Form Actions -->
                    <div class="d-flex justify-between align-items-center mt-3 pt-2 border-top">
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

    <!-- Billing Types List Table -->
    <div class="row">
        <div class="col-12">
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-list"></i>
                    Billing Types List
                </div>

                <div class="form-card-body">
                    <!-- Table Toolbar -->
                    <div class="table-toolbar">
                        <div class="search-box">
                            <i class="uil-search"></i>
                            <input type="text" id="tableSearch" class="form-control" placeholder="Search billing types...">
                        </div>
                    </div>

                    <!-- Modern Table -->
                    <div class="table-responsive">
                        <table class="modern-table" id="billTypesTable">
                            <thead>
                                <tr>
                                    <th class="sortable" data-column="0">
                                        <i class="uil-hashtag"></i> S.N.
                                    </th>
                                    <th class="sortable" data-column="1">
                                        <i class="uil-file-text"></i> Name
                                    </th>
                                    <th style="text-align: center;">
                                        <i class="uil-cog"></i> Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($records as $row)
                                <tr>
                                    <td data-label="S.N.">{{ $loop->index+1 }}</td>
                                    <td data-label="Name">
                                        <strong>{{ $row->name }}</strong>
                                    </td>
                                    <td data-label="Actions" style="text-align: center;">
                                        <a href="{{route('billType.edit',$row->id)}}" class="btn btn-view" title="Edit">
                                            <i class="uil-edit"></i>
                                        </a>
                                        <form action="{{route('billType.destroy',$row->id)}}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this billing type?')">
                                                <i class="uil-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 2rem; color: #666;">
                                        <i class="uil-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                                        No billing types found. <a href="{{ route('billType.create') }}" class="text-primary">Create one</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

