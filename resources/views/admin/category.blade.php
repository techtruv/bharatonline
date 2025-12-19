@php
use App\Http\Controllers\AdminController;
@endphp
@extends('layouts.app')
@section('body')
<!-- Start Content -->
<div class="container-fluid">

    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                    <i class="uil-tag"></i>
                    {{ isset($data) ? 'Edit Category' : 'Add New Category' }}
                </h4>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="row">
        <div class="col-12">
            <!-- Form Card -->
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-plus-circle"></i>
                    {{ isset($data) ? 'Update Category Information' : 'Add New Category' }}
                </div>

                <div class="form-card-body">
                    <x-alert />

                    @if(isset($data))
                        <form action="{{ route('category.update',$data->id) }}" method="post" id="categoryForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('category.store') }}" method="post" id="categoryForm">
                    @endif
                        @csrf

                        <!-- Category Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="uil-tag"></i>
                                Category Details
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="category" class="form-label">
                                            <i class="uil-file-text"></i>
                                            Category <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" 
                                            name="category" 
                                            id="category"
                                            placeholder="Enter category name"
                                            value="{{ old('category', isset($data->category) ? $data->category : '') }}"
                                            required
                                        >
                                        @if($errors->has('category'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('category') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="weight" class="form-label">
                                            <i class="uil-weight"></i>
                                            Weight <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="number" 
                                            class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" 
                                            name="weight" 
                                            id="weight"
                                            placeholder="Enter weight"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('weight', isset($data->weight) ? $data->weight : '') }}"
                                        >
                                        @if($errors->has('weight'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('weight') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                           
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="hsn_code" class="form-label">
                                            <i class="uil-barcode"></i>
                                            HSN Code <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('hsn_code') ? 'is-invalid' : '' }}" 
                                            name="hsn_code" 
                                            id="hsn_code"
                                            placeholder="Enter HSN code"
                                            value="{{ old('hsn_code', isset($data->hsn_code) ? $data->hsn_code : '') }}"
                                        >
                                        @if($errors->has('hsn_code'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('hsn_code') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="unit_id" class="form-label">
                                            <i class="uil-box"></i>
                                            Unit <span class="optional">(Optional)</span>
                                        </label>
                                        <select 
                                            class="form-control {{ $errors->has('unit_id') ? 'is-invalid' : '' }}" 
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
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('unit_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Form Actions -->
                <div class="form-card-footer">
                    <button type="reset" form="categoryForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="submit" form="categoryForm" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update Category' : 'Add Category' }}
                    </button>
                </div>
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
