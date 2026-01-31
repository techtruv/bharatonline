
@extends('layouts.app')
@section('body')
<!-- Start Content -->
<div class="container">


    <div class="row">
        <div class="col-12">
            <!-- Form Card -->
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-calendar-alt"></i>
                    {{ isset($data) ? 'Update Session Information' : 'Add New Session' }}
                </div>

                <div class="form-card-body">
                    <x-alert />

                    @if(isset($data))
                        <form action="{{ route('session.update',$data->id) }}" method="post" id="sessionForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('session.store') }}" method="post" id="sessionForm">
                    @endif
                        @csrf

                        <!-- Session Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="uil-calendar-alt"></i>
                                Session Details
                            </div>

                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="from_date" class="form-label">
                                            <i class="uil-calendar-alt"></i>
                                            From Date <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="date" 
                                            class="form-control {{ $errors->has('from_date') ? 'is-invalid' : '' }}" 
                                            name="from_date" 
                                            id="from_date"
                                            value="{{ old('from_date', isset($data->from_date) ? $data->from_date : '') }}"
                                            required
                                        >
                                        @if($errors->has('from_date'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('from_date') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="to_date" class="form-label">
                                            <i class="uil-calendar-alt"></i>
                                            To Date <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="date" 
                                            class="form-control {{ $errors->has('to_date') ? 'is-invalid' : '' }}" 
                                            name="to_date" 
                                            id="to_date"
                                            value="{{ old('to_date', isset($data->to_date) ? $data->to_date : '') }}"
                                            required
                                        >
                                        @if($errors->has('to_date'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('to_date') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="session_name" class="form-label">
                                            <i class="uil-file-text"></i>
                                            Session Name <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('session_name') ? 'is-invalid' : '' }}" 
                                            name="session_name" 
                                            id="session_name"
                                            placeholder="Enter session name"
                                            value="{{ old('session_name', isset($data->session_name) ? $data->session_name : '') }}"
                                            required
                                        >
                                        @if($errors->has('session_name'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('session_name') }}
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
                    <button type="reset" form="sessionForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="submit" form="sessionForm" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update Session' : 'Add Session' }}
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Sessions List Table -->
    <div class="row">
        <div class="col-12">
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-list"></i>
                    Sessions List
                </div>

                <div class="form-card-body">
                    <!-- Table Toolbar -->
                    <div class="table-toolbar">
                        <div class="search-box">
                            <i class="uil-search"></i>
                            <input type="text" id="tableSearch" class="form-control" placeholder="Search sessions...">
                        </div>
                    </div>

                    <!-- Modern Table -->
                    <div class="table-responsive">
                        <table class="modern-table" id="sessionsTable">
                            <thead>
                                <tr>
                                    <th class="sortable" data-column="0">
                                        <i class="uil-hashtag"></i> S.N.
                                    </th>
                                    <th class="sortable" data-column="1">
                                        <i class="uil-calendar-alt"></i> From Date
                                    </th>
                                    <th class="sortable" data-column="2">
                                        <i class="uil-calendar-alt"></i> To Date
                                    </th>
                                    <th class="sortable" data-column="3">
                                        <i class="uil-file-text"></i> Session Name
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
                                    <td data-label="From Date">{{ $row->from_date }}</td>
                                    <td data-label="To Date">{{ $row->to_date }}</td>
                                    <td data-label="Session Name">
                                        <strong>{{ $row->session_name }}</strong>
                                    </td>
                                    <td data-label="Actions" style="text-align: center;">
                                        <a href="{{route('session.edit',$row->id)}}" class="btn btn-view" title="Edit">
                                            <i class="uil-edit"></i>
                                        </a>
                                        <form action="{{route('session.destroy',$row->id)}}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this session?')">
                                                <i class="uil-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 2rem; color: #666;">
                                        <i class="uil-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                                        No sessions found. <a href="{{ route('session.create') }}" class="text-primary">Create one</a>
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

@endsection
