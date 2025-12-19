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
                    <i class="uil-building"></i>
                    {{ isset($data) ? 'Edit Bank' : 'Add New Bank' }}
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
                    {{ isset($data) ? 'Update Bank Information' : 'Add New Bank' }}
                </div>

                <div class="form-card-body">
                    <x-alert />

                    @if(isset($data))
                        <form action="{{ route('bank.update',$data->id) }}" method="post" id="bankForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('bank.store') }}" method="post" id="bankForm">
                    @endif
                        @csrf

                        <!-- Bank Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="uil-building"></i>
                                Bank Details
                            </div>

                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="code" class="form-label">
                                            <i class="uil-file-text"></i>
                                            Bank Code <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" 
                                            name="code" 
                                            id="code"
                                            placeholder="Enter bank code"
                                            value="{{ old('code', isset($data->code) ? $data->code : '') }}"
                                            required
                                        >
                                        @if($errors->has('code'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('code') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">
                                            <i class="uil-file-text"></i>
                                            Bank Name <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                            name="name" 
                                            id="name"
                                            placeholder="Enter bank name"
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
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Form Actions -->
                <div class="form-card-footer">
                    <button type="reset" form="bankForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="submit" form="bankForm" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update Bank' : 'Add Bank' }}
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Banks List Table -->
    <div class="row">
        <div class="col-12">
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-list"></i>
                    Banks List
                </div>

                <div class="form-card-body">
                    <!-- Table Toolbar -->
                    <div class="table-toolbar">
                        <div class="search-box">
                            <i class="uil-search"></i>
                            <input type="text" id="tableSearch" class="form-control" placeholder="Search banks...">
                        </div>
                    </div>

                    <!-- Modern Table -->
                    <div class="table-responsive">
                        <table class="modern-table" id="banksTable">
                            <thead>
                                <tr>
                                    <th class="sortable" data-column="0">
                                        <i class="uil-hashtag"></i> S.N.
                                    </th>
                                    <th class="sortable" data-column="1">
                                        <i class="uil-file-text"></i> Code
                                    </th>
                                    <th class="sortable" data-column="2">
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
                                    <td data-label="Code">
                                        <strong>{{ $row->code }}</strong>
                                    </td>
                                    <td data-label="Name">
                                        <strong>{{ $row->name }}</strong>
                                    </td>
                                    <td data-label="Actions" style="text-align: center;">
                                        <a href="{{route('bank.edit',$row->id)}}" class="btn btn-view" title="Edit">
                                            <i class="uil-edit"></i>
                                        </a>
                                        <form action="{{route('bank.destroy',$row->id)}}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this bank?')">
                                                <i class="uil-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 2rem; color: #666;">
                                        <i class="uil-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                                        No banks found. <a href="{{ route('bank.create') }}" class="text-primary">Create one</a>
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
