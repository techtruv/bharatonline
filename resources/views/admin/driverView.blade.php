@extends('layouts.app')
@section('body')
<!-- Start Content -->
<div class="container">
    <!-- Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="form-card">
                <div class="form-card-header">
                    <i class="uil-users"></i>
                    Driver Management
                </div>
                <div class="form-card-body" style="padding: 0.5rem 1rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h5 style="margin: 0; color: #166534;">
                            <i class="uil-list"></i> Drivers List
                        </h5>
                        <a href="{{ route('driver.create') }}" class="btn btn-primary">
                            <i class="uil-plus-circle"></i> Add New Driver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <div class="row">
        <div class="col-12">
            <x-alert />
        </div>
    </div>

    <!-- Drivers Table -->
    <div class="row">
        <div class="col-12">
            <div class="form-card">
                <div class="form-card-body">
                    <!-- Table Toolbar -->
                    <div class="table-toolbar">
                        <div class="search-box">
                            <i class="uil-search"></i>
                            <input type="text" id="tableSearch" class="form-control" placeholder="Search drivers by name or mobile...">
                        </div>
                    </div>

                    <!-- Modern Table -->
                    <div class="table-responsive">
                        <table class="modern-table" id="driversTable">
                            <thead>
                                <tr>
                                    <th class="sortable" data-column="0">
                                        <i class="uil-hashtag"></i> S.N.
                                    </th>
                                    <th class="sortable" data-column="1">
                                        <i class="uil-user-circle"></i> Driver Name
                                    </th>
                                    <th class="sortable" data-column="2">
                                        <i class="uil-phone"></i> Mobile
                                    </th>
                                    <th class="sortable" data-column="3">
                                        <i class="uil-wallet"></i> Opening Type
                                    </th>
                                    <th class="sortable" data-column="4">
                                        <i class="uil-rupee"></i> Opening Balance
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
                                    <td data-label="Driver Name">
                                        <strong>{{ $row->driverName }}</strong>
                                    </td>
                                    <td data-label="Mobile">
                                        <span class="badge bg-light text-dark">{{ $row->mobile }}</span>
                                    </td>
                                    <td data-label="Opening Type">
                                        @if($row->openingType==1)
                                            <span class="badge bg-warning text-dark">
                                                <i class="uil-arrow-down"></i> Has to Pay
                                            </span>
                                        @elseif($row->openingType==2)
                                            <span class="badge bg-info text-white">
                                                <i class="uil-arrow-up"></i> Has to Get
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td data-label="Opening Balance">
                                        <strong style="color: #166534;">{{ number_format($row->openingBalance, 2) }}</strong>
                                    </td>
                                    <td data-label="Actions" style="text-align: center;">
                                        <a href="{{route('driver.edit',$row->id)}}" class="btn btn-view" title="Edit">
                                            <i class="uil-edit"></i>
                                        </a>
                                        <form action="{{route('driver.destroy',$row->id)}}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this driver?')">
                                                <i class="uil-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 2rem; color: #666;">
                                        <i class="uil-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                                        No drivers found. <a href="{{ route('driver.create') }}" class="text-primary">Create one</a>
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