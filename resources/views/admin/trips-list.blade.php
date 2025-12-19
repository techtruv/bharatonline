@php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddShortController;
@endphp
@extends('layouts.app')
@section('body')
   <!-- Start Content-->
  <div class="container-fluid">

  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Trips</h4>
                                    
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 



         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{ route('trips.create') }}"><button  type="button" class="btn btn-primary right"> + Add Trip</button></a>
                                        <br>
                                        </br>
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            
                                        </ul> <!-- end nav-->
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="buttons-table-preview">
                                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                        
                                                            <th>Date</th>
                                                            <th>Party Name</th>
                                                            <th>Truck No.</th>
                                                            <th>Route</th>
                                                            <th>Trips Status</th>
                                                            <th>Party Balance</th>
                                                            
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                
                                                
                                                   <tbody>
                                                   @foreach($records as $row)
                                                @php
                                                   $partyName = AdminController::getValueStatic2('parties','partyName','id',$row->partyName);
                                                  
                                                   $vehicleNumber = AdminController::getValueStatic2('vehicles','vehicleNumber','id',$row->vehicleNumber);
                                                   
                                                   $ownership = AdminController::getValueStatic2('vehicles','ownership','id',$row->vehicleNumber);
                                                   
                                                   $origin = AdminController::getValueStatic2('routes','name','id',$row->origin);
                                                   
                                                   $destination = AdminController::getValueStatic2('routes','name','id',$row->destination);
                                                   $partyBalance= AddShortController::partyBalance($row->id);
                                                @endphp

                                                        <tr>
                                                            <td>{{ date('d-m-Y',strtotime($row->startDate)) }}</td>
                                                            <td>{{ isset($partyName) ? $partyName : ''  }}</td>
                                                            <td>{{ isset($vehicleNumber) ? $vehicleNumber : ''  }} <span style="color:blue;">( {{ isset($ownership) ? $ownership : ''  }} )</span></td>
                                                            <td>{{ isset($origin) ? $origin : '' }} => {{ isset($destination) ? $destination : '' }}  </td>
                                                            <td> <span class="btn btn-success" > @if($row->status==1)  Start    @elseif($row->status==2)
                                Complete Trip
                            @elseif($row->status==3)
                                 POD Received
                            @elseif($row->status==4)
                                 POD Submited
                            @elseif($row->status==5)
                                Settlement
                            @endif </span></td>
                                                            <td> ₹ {{ isset($partyBalance) ? number_format($partyBalance,2) : '0' }}</td>
                                                            <td><a href="{{ route('trips.show',$row->id) }}"><span class="btn btn-primary" > View </span></a></td>
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