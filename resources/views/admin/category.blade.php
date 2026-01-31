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
                    <i class="uil-tag me-2"></i>
                    {{ isset($data) ? 'Update Category Information' : 'Add New Category' }}
                </div>

                @if(isset($data))
                    <form action="{{ route('category.update',$data->id) }}" method="post" class="compact-form">
                        @method('PATCH')
                @else
                    <form action="{{ route('category.store') }}" method="post" class="compact-form">
                @endif
                    @csrf

                    <!-- Compact Form Table -->
                    <div class="compact-form-table">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <!-- Row 1: Category Information -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-file-text"></i>
                                        Category <span class="required">*</span>
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                            name="category"
                                            id="category"
                                            placeholder="Enter category name"
                                            value="{{ old('category', isset($data->category) ? $data->category : '') }}"
                                            required
                                        >
                                        @if($errors->has('category'))
                                            <div class="invalid-feedback">{{ $errors->first('category') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-weight"></i>
                                        Weight
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="number"
                                            class="form-control form-control-sm {{ $errors->has('weight') ? 'is-invalid' : '' }}"
                                            name="weight"
                                            id="weight"
                                            placeholder="0.00"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('weight', isset($data->weight) ? $data->weight : '') }}"
                                        >
                                        @if($errors->has('weight'))
                                            <div class="invalid-feedback">{{ $errors->first('weight') }}</div>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Row 2: HSN and Unit -->
                                <tr>
                                    <td class="compact-label">
                                        <i class="uil-barcode"></i>
                                        HSN Code
                                    </td>
                                    <td class="compact-field">
                                        <input
                                            type="text"
                                            class="form-control form-control-sm {{ $errors->has('hsn_code') ? 'is-invalid' : '' }}"
                                            name="hsn_code"
                                            id="hsn_code"
                                            placeholder="Enter HSN code"
                                            value="{{ old('hsn_code', isset($data->hsn_code) ? $data->hsn_code : '') }}"
                                        >
                                        @if($errors->has('hsn_code'))
                                            <div class="invalid-feedback">{{ $errors->first('hsn_code') }}</div>
                                        @endif
                                    </td>
                                    <td class="compact-label">
                                        <i class="uil-box"></i>
                                        Unit
                                    </td>
                                    <td class="compact-field">
                                        <select
                                            class="form-select form-select-sm {{ $errors->has('unit_id') ? 'is-invalid' : '' }}"
                                            name="unit_id"
                                            id="unit_id"
                                        >
                                            <option value="">-- Select Unit --</option>
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->id }}" {{ old('unit_id', isset($data->unit_id) ? $data->unit_id : '') == $unit->id ? 'selected' : '' }}>
                                                    {{ $unit->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('unit_id'))
                                            <div class="invalid-feedback">{{ $errors->first('unit_id') }}</div>
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

    <!-- Categories List Table -->
    <div class="row">
        <div class="col-12">
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-list"></i>
                    Categories List
                </div>

                <div class="form-card-body">
                    <!-- Table Toolbar -->
                    <div class="table-toolbar">
                        <div class="search-box">
                            <i class="uil-search"></i>
                            <input type="text" id="tableSearch" class="form-control" placeholder="Search categories...">
                        </div>
                    </div>

                    <!-- Modern Table -->
                    <div class="table-responsive">
                        <table class="modern-table" id="categoriesTable">
                            <thead>
                                <tr>
                                    <th class="sortable" data-column="0">
                                        <i class="uil-hashtag"></i> S.N.
                                    </th>
                                    <th class="sortable" data-column="1">
                                        <i class="uil-tag"></i> Category
                                    </th>
                                    <th class="sortable" data-column="2">
                                        <i class="uil-weight"></i> Weight
                                    </th>
                                    <th class="sortable" data-column="3">
                                        <i class="uil-barcode"></i> HSN Code
                                    </th>
                                    <th class="sortable" data-column="4">
                                        <i class="uil-box"></i> Unit
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
                                    <td data-label="Category">
                                        <strong>{{ $row->category }}</strong>
                                    </td>
                                    <td data-label="Weight">
                                        {{ $row->weight ? $row->weight : '-' }}
                                    </td>
                                    <td data-label="HSN Code">
                                        {{ $row->hsn_code ? $row->hsn_code : '-' }}
                                    </td>
                                    <td data-label="Unit">
                                        {{ $row->unit ? $row->unit->name : '-' }}
                                    </td>
                                    <td data-label="Actions" style="text-align: center;">
                                        <a href="{{route('category.edit',$row->id)}}" class="btn btn-view" title="Edit">
                                            <i class="uil-edit"></i>
                                        </a>
                                        <form action="{{route('category.destroy',$row->id)}}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="uil-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 2rem; color: #666;">
                                        <i class="uil-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                                        No categories found. <a href="{{ route('category.create') }}" class="text-primary">Create one</a>
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
