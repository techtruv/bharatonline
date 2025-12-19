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
                    <i class="uil-navigation"></i>
                    {{ isset($data) ? 'Edit Route' : 'Add New Route' }}
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
                    {{ isset($data) ? 'Update Route Information' : 'Add New Route' }}
                </div>

                <div class="form-card-body">
                    <x-alert />

                    @if(isset($data))
                        <form action="{{ route('route.update',$data->id) }}" method="post" id="routeForm">
                            @method('PATCH')
                    @else
                        <form action="{{ route('route.store') }}" method="post" id="routeForm">
                    @endif
                        @csrf

                        <!-- Route Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="uil-map-pin"></i>
                                Route Details
                            </div>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="state" class="form-label">
                                            <i class="uil-map-pin"></i>
                                            State <span class="required">*</span>
                                        </label>
                                        <select 
                                            id="state" 
                                            name="state" 
                                            class="form-select js-example-basic-single {{ $errors->has('state') ? 'is-invalid' : '' }}"
                                            required
                                        >
                                            <option value="">Select State</option>
                                        </select>
                                        @if($errors->has('state'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('state') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">
                                            <i class="uil-navigation"></i>
                                            Route Name <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                            name="name" 
                                            id="name"
                                            placeholder="Enter route name"
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
                    <button type="reset" form="routeForm" class="btn btn-outline-secondary">
                        <i class="uil-redo"></i> Reset
                    </button>
                    <button type="submit" form="routeForm" class="btn btn-primary">
                        <i class="uil-check-circle"></i> {{ isset($data) ? 'Update Route' : 'Add Route' }}
                    </button>
                </div>
            </div>

        </div>
    </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                     <h4>Route List</h4>
                        <br>
                        </br>
                        <ul class="nav nav-tabs nav-bordered mb-3">
                            
                        </ul> <!-- end nav-->
                        <div class="tab-content">
                            <div class="tab-pane show active" id="buttons-table-preview">
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Name</th>
                                            <th>State</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                
                                
                                   <tbody>
                                        @foreach($records as $row)
                                        @php 
                                        $statename = AdminController::getValueStatic2('states','name','id',$row->state);

                                        @endphp
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $statename }}</td>
                                            <td><a href="{{route('route.edit',$row->id)}}" class="btn btn-success" rel="tooltip" title="Edit">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>
                                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                                
                                                <form action="{{route('route.destroy',$row->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">
                                                    
                                                    <i class="mdi mdi-window-close" onclick="return confirm('Are you sure to Delete?')"></i>
                                                    </button>
                                                </form>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                           
                            </div> <!-- end preview-->
                                        
                                           
                        </div> <!-- end tab-content-->
                                        
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

</div> 
@endsection

@section('java_script')


<script type="text/javascript">
    

//Fetch Supplier List

  function fetchState(id=0){
  
            $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=states&id=id&column=name',
            success:function(response){
                console.log(response);
                $("#state").html(response);
                $("#state").val(id);
                $('#state').trigger('change'); 
                document.getElementById("state").value = "{{ old('state',isset($data->state) ? $data->state : '' )}}";
            }
            });
        }   
//onload run party
fetchState();

</script>
@endsection
