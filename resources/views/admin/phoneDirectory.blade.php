@php
use App\Http\Controllers\AdminController;
@endphp
@extends('layouts.app')
@section('body')
<!-- Start Content -->
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <!-- Form Card -->
            <div class="form-card">
                <div class="form-card-header">
                   <i class="uil-phone"></i>
                    {{ isset($data) ? 'Update Phone Directory Information' : 'Add New Phone Directory' }}
                </div>

                <div class="form-card-body">
                    <x-alert />

                    @if(isset($data))
                        <form action="{{ route('phoneDirectory.update',$data->id) }}" method="post" id="phoneDirectoryForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('phoneDirectory.store') }}" method="post" id="phoneDirectoryForm">
                    @endif
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="uil-user-circle"></i>
                                Basic Information
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">
                                            <i class="uil-user-circle"></i>
                                            Name <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                            name="name" 
                                            id="name"
                                            placeholder="Enter name"
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

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="gst_no" class="form-label">
                                            <i class="uil-barcode"></i>
                                            GST Number <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('gst_no') ? 'is-invalid' : '' }}" 
                                            name="gst_no" 
                                            id="gst_no"
                                            placeholder="Enter GST number"
                                            value="{{ old('gst_no', isset($data->gst_no) ? $data->gst_no : '') }}"
                                        >
                                        @if($errors->has('gst_no'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('gst_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                           
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label">
                                            <i class="uil-map-marker"></i>
                                            Address <span class="optional">(Optional)</span>
                                        </label>
                                        <textarea 
                                            class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" 
                                            name="address" 
                                            id="address"
                                            placeholder="Enter address"
                                            rows="1"
                                        >{{ old('address', isset($data->address) ? $data->address : '') }}</textarea>
                                        @if($errors->has('address'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('address') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                          
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="phone_no" class="form-label">
                                            <i class="uil-phone"></i>
                                            Phone Number <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" 
                                            name="phone_no" 
                                            id="phone_no"
                                            placeholder="Enter phone number"
                                            value="{{ old('phone_no', isset($data->phone_no) ? $data->phone_no : '') }}"
                                        >
                                        @if($errors->has('phone_no'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('phone_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="mobile_no" class="form-label">
                                            <i class="uil-mobile-android"></i>
                                            Mobile Number <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" 
                                            name="mobile_no" 
                                            id="mobile_no"
                                            placeholder="Enter mobile number"
                                            value="{{ old('mobile_no', isset($data->mobile_no) ? $data->mobile_no : '') }}"
                                        >
                                        @if($errors->has('mobile_no'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('mobile_no') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="mobile_no1" class="form-label">
                                            <i class="uil-mobile-android"></i>
                                            Mobile Number 1 <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control {{ $errors->has('mobile_no1') ? 'is-invalid' : '' }}" 
                                            name="mobile_no1" 
                                            id="mobile_no1"
                                            placeholder="Enter mobile number 1"
                                            value="{{ old('mobile_no1', isset($data->mobile_no1) ? $data->mobile_no1 : '') }}"
                                        >
                                        @if($errors->has('mobile_no1'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('mobile_no1') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="mobile_no2" class="form-label">
                                            <i class="uil-mobile-android"></i>
                                            Mobile Number 2 <span class="optional">(Optional)</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control {{ $errors->has('mobile_no2') ? 'is-invalid' : '' }}" 
                                            name="mobile_no2" 
                                            id="mobile_no2"
                                            placeholder="Enter mobile number 2"
                                            value="{{ old('mobile_no2', isset($data->mobile_no2) ? $data->mobile_no2 : '') }}"
                                        >
                                        @if($errors->has('mobile_no2'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('mobile_no2') }}
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
                    <button type="reset" form="phoneDirectoryForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="submit" form="phoneDirectoryForm" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update Phone Directory' : 'Add Phone Directory' }}
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Phone Directories List Table -->
    <div class="row">
        <div class="col-12">
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-list"></i>
                    Phone Directories List
                </div>

                <div class="form-card-body">
                    <!-- Table Toolbar -->
                    <div class="table-toolbar">
                        <div class="search-box">
                            <i class="uil-search"></i>
                            <input type="text" id="tableSearch" class="form-control" placeholder="Search phone directories...">
                        </div>
                    </div>

                    <!-- Modern Table -->
                    <div class="table-responsive">
                        <table class="modern-table" id="phoneDirectoriesTable">
                            <thead>
                                <tr>
                                    <th class="sortable" data-column="0">
                                        <i class="uil-hashtag"></i> S.N.
                                    </th>
                                    <th class="sortable" data-column="1">
                                        <i class="uil-user-circle"></i> Name
                                    </th>
                                    <th class="sortable" data-column="2">
                                        <i class="uil-phone"></i> Phone
                                    </th>
                                    <th class="sortable" data-column="3">
                                        <i class="uil-mobile-android"></i> Mobile
                                    </th>
                                    <th class="sortable" data-column="4">
                                        <i class="uil-mobile-android"></i> Mobile 1
                                    </th>
                                    <th class="sortable" data-column="5">
                                        <i class="uil-mobile-android"></i> Mobile 2
                                    </th>
                                    <th class="sortable" data-column="6">
                                        <i class="uil-barcode"></i> GST No
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
                                    <td data-label="Phone">
                                        {{ $row->phone_no ? $row->phone_no : '-' }}
                                    </td>
                                    <td data-label="Mobile">
                                        {{ $row->mobile_no ? $row->mobile_no : '-' }}
                                    </td>
                                    <td data-label="Mobile 1">
                                        {{ $row->mobile_no1 ? $row->mobile_no1 : '-' }}
                                    </td>
                                    <td data-label="Mobile 2">
                                        {{ $row->mobile_no2 ? $row->mobile_no2 : '-' }}
                                    </td>
                                    <td data-label="GST No">
                                        {{ $row->gst_no ? $row->gst_no : '-' }}
                                    </td>
                                    <td data-label="Actions" style="text-align: center;">
                                        <a href="{{route('phoneDirectory.edit',$row->id)}}" class="btn btn-view" title="Edit">
                                            <i class="uil-edit"></i>
                                        </a>
                                        <form action="{{route('phoneDirectory.destroy',$row->id)}}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this phone directory?')">
                                                <i class="uil-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 2rem; color: #666;">
                                        <i class="uil-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                                        No phone directories found. <a href="{{ route('phoneDirectory.create') }}" class="text-primary">Create one</a>
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
