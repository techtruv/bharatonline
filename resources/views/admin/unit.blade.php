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
                    <i class="uil-box"></i>
                    {{ isset($data) ? 'Edit Unit' : 'Add New Unit' }}
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
                    {{ isset($data) ? 'Update Unit Information' : 'Add New Unit' }}
                </div>

                <div class="form-card-body">
                    <x-alert />

                    @if(isset($data))
                        <form action="{{ route('unit.update',$data->id) }}" method="post" id="unitForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('unit.store') }}" method="post" id="unitForm">
                    @endif
                        @csrf

                        <!-- Unit Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="uil-box"></i>
                                Unit Details
                            </div>

                            <div class="row g-2">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">
                                            <i class="uil-file-text"></i>
                                            Unit Name <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                            name="name" 
                                            id="name"
                                            placeholder="Enter unit name (e.g., KG, Liter, Piece)"
                                            value="{{ old('name', isset($data->name) ? $data->name : '') }}"
                                            required
                                        >
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">
                                            <i class="uil-file-text"></i>
                                            Description <span class="optional">(Optional)</span>
                                        </label>
                                        <textarea 
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" 
                                            name="description" 
                                            id="description"
                                            placeholder="Enter unit description"
                                            rows="4"
                                        >{{ old('description', isset($data->description) ? $data->description : '') }}</textarea>
                                        @if($errors->has('description'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('description') }}
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
                    <button type="reset" form="unitForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="submit" form="unitForm" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update Unit' : 'Add Unit' }}
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Units List Table -->
    <div class="row">
        <div class="col-12">
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-list"></i>
                    Units List
                </div>

                <div class="form-card-body">
                    <!-- Table Toolbar -->
                    <div class="table-toolbar">
                        <div class="search-box">
                            <i class="uil-search"></i>
                            <input type="text" id="tableSearch" class="form-control" placeholder="Search units...">
                        </div>
                    </div>

                    <!-- Modern Table -->
                    <div class="table-responsive">
                        <table class="modern-table" id="unitsTable">
                            <thead>
                                <tr>
                                    <th class="sortable" data-column="0">
                                        <i class="uil-hashtag"></i> S.N.
                                    </th>
                                    <th class="sortable" data-column="1">
                                        <i class="uil-file-text"></i> Name
                                    </th>
                                    <th class="sortable" data-column="2">
                                        <i class="uil-file-text"></i> Description
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
                                    <td data-label="Description">
                                        {{ $row->description ? substr($row->description, 0, 50) . (strlen($row->description) > 50 ? '...' : '') : '-' }}
                                    </td>
                                    <td data-label="Actions" style="text-align: center;">
                                        <a href="{{route('unit.edit',$row->id)}}" class="btn btn-view" title="Edit">
                                            <i class="uil-edit"></i>
                                        </a>
                                        <form action="{{route('unit.destroy',$row->id)}}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this unit?')">
                                                <i class="uil-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 2rem; color: #666;">
                                        <i class="uil-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                                        No units found. <a href="{{ route('unit.create') }}" class="text-primary">Create one</a>
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
