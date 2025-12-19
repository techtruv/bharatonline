@php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddShortController;
@endphp
@extends('layouts.app')
@section('body')
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

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
                                 
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="form-row-preview">
                                               <form action="" method="get">
                                               
                                               @csrf
                                                    <div class="row g-2">
                                                      <div class="mb-6 col-md-6">
                                                            <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search..">
                                                       
                                                            <!--<label for="inputPassword4" class="form-label">From Date</label>-->
                                                            <!-- <input type="date" name="from_date"  id="from_date" class="form-control" id="inputCity" -->
                                                            <!-- value="{{ isset($_GET['from_date']) ? $_GET['from_date'] : ''  }}"-->
                                                            <!--  >-->
                                                        </div>
                                                        
                                                       <!-- <div class="mb-2 col-md-2">-->
                                                       <!--     <label for="inputPassword4" class="form-label">To Date</label>-->
                                                       <!--      <input type="date" name="to_date"  id="to_date" class="form-control" id="inputCity" -->
                                                       <!--      value="{{ isset($_GET['to_date']) ? $_GET['to_date'] : ''  }}"-->
                                                       <!--       >-->
                                                       <!-- </div>-->
                                                        
                                                        
                                                       <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">-->
                                                        
                                                       <!-- <div class="mb-2 col-md-2">-->
                                                       <!--     <label for="inputEmail4" class="form-label">Select Party -->
                                                       <!--      </label>-->
                                                       <!--      <select id="partyName" name="partyName" class="form-select js-example-basic-single">-->
                                                               
                                                       <!--     </select>-->
                                                       <!--       <script> $("#partyName").val(<?php echo isset($_GET['partyName']) ? $_GET['partyName'] : ''  ?>);</script>-->
                                                       <!-- </div>-->
                                                        
                                                       <!--<div class="mb-2 col-md-2">-->
                                                       <!--     <label for="inputEmail4" class="form-label">Origin</label>-->
                                                       <!--      <select id="origin" name="origin" class="form-select js-example-basic-single routes">-->
                                                                
                                                       <!--     </select>-->
                                                       <!--             <script> $("#origin").val(<?php echo isset($_GET['origin']) ? $_GET['origin'] : ''  ?>);</script>-->
                                                      
                                                       <!-- </div>-->
                                                       <!--<div class="mb-2 col-md-2">-->
                                                       <!--     <label for="inputPassword4" class="form-label">Destination</label>-->
                                                       <!--      <select id="destination" name="destination" class="form-select js-example-basic-single routes">-->
                                                                
                                                       <!--     </select>-->
                                                       <!--             <script> $("#destination").val(<?php echo isset($_GET['destination']) ? $_GET['destination'] : ''  ?>);</script>-->
                                                      
                                                       <!-- </div>-->

                                                       <!--<div class="mb-2 col-md-2">-->
                                                       <!--     <label for="inputPassword4" class="form-label">Status</label>-->
                                                       <!--      <select id="status" name="status" class="form-select js-example-basic-single">-->
                                                       <!--         <option value="">Select</option>-->
                                                       <!--         <option value="1">Start</option>-->
                                                       <!--         <option value="2">Complete Trip</option>-->
                                                       <!--         <option value="3">POD Received  </option>-->
                                                       <!--         <option value="4">POD Submited</option>-->
                                                       <!--         <option value="5">Settlement</option>-->
                                                       <!--     </select>-->
                                                       <!--      <script> $("#status").val(<?php echo isset($_GET['status']) ? $_GET['status'] : ''  ?>);</script>-->
                                                      
                                                       <!-- </div>-->

                                                        
                                                 </div>
                                                   <!--<button type="submit" class="btn btn-primary">Search</button>-->
                                                   <!-- <a href="{{ route('trips.index') }}" type="submit" class="btn btn-danger">Reset</a>-->
                                                </form>                      
                                            </div> <!-- end preview-->
                                        
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{ route('trips.create') }}"><button  type="button" class="btn btn-primary right"> + Add Trip</button></a>
                                        <br>
                                        </br>
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            
                                        </ul> <!-- end nav-->
                                        <div class="tab-content" id="myTable">
                                            <div class="tab-pane show active" id="buttons-table-preview">
                                                <table  class="table table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                        
                                                            <th>Date</th>
                                                            <th>Party Name</th>
                                                            <th>Truck No.</th>
                                                            <th>Route</th>
                                                            <th>Trips Status</th>
                                                            <th>Party Balance</th>
                                                            <th>Supplier Balance</th>
                                                            <th>View</th>
                                                            <th>Action</th>
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
                                                   $supplierBalance= AddShortController::supplierBalance($row->id);
                                                @endphp

                                                    @if($id==1)
                                                        @if($partyBalance==0 && $supplierBalance==0)
                                                    @endif


                                                        <tr>
                                                            <td>{{ date('d-m-Y',strtotime($row->startDate)) }}</td>
                                                            <td>{{ isset($partyName) ? $partyName : ''  }}</td>
                                                            <td>{{ isset($vehicleNumber) ? $vehicleNumber : ''  }} <span style="color:blue;">( {{ isset($ownership) ? $ownership : ''  }} )</span></td>
                                                            <td>{{ isset($origin) ? $origin : '' }} => {{ isset($destination) ? $destination : '' }}  </td>
                                                            <td> <span class="btn btn-success" >
                                                                    @if($row->status==1)  
                                                                        Start  
                                                                    @elseif($row->status==2)
                                                                        Complete Trip
                                                                    @elseif($row->status==3)
                                                                        POD Received 
                                                                    @elseif($row->status==4)
                                                                        POD Submited
                                                                    @elseif($row->status==5)
                                                                        Settlement
                                                                    @endif 
                                                                </span>
                                                            </td>
                                                            <td> ₹ {{ isset($partyBalance) ? number_format($partyBalance,2) : '0' }}</td>
                                                            <td> ₹ {{ isset($supplierBalance) ? number_format($supplierBalance,2) : '0' }}</td>
                                                            
                                                            <td><a href="{{ route('trips.show',$row->id) }}"><span class="btn btn-primary" > View </span></a></td>
                                                            <td>
                                                             <a href="{{route('trips.edit',$row->id)}}" class="btn btn-success" rel="tooltip" title="Edit">
                                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                                </a> 
                                                                <a href="#" class="btn" rel="tooltip" title="Delete">
                                                                
                                                                <form action="{{route('trips.destroy',$row->id)}}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-danger">
                                                                    
                                                                    <i class="mdi mdi-window-close" onclick="return confirm('Are you sure to Delete?')"></i>
                                                                    </button>
                                                                </form>
                                                                </a>
                                                            </td>
                                                        </tr>


                                                    @if($id==1)
                                                         @endif
                                                    @endif
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
  <script>
  $(document).ready(function(){

function sendRequest(){
    $.ajax({
        url: "{{ route('trips.indexAll',1) }}",
        success: function(data){    
            //do stuff with data..
        },
        complete: function() {
            setInterval(sendRequest, 60000); // Call AJAX every 5 mins (in milliseconds)
        }
    });
};

sendRequest();

});


//Fetch Parties list 

function fetchParty(id=0){
  
            $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=parties&id=id&column=partyName',
            success:function(response){
                console.log(response);
                $("#partyName").html(response);
                $("#partyName").val(id);
                $('#partyName').trigger('change'); 
                document.getElementById("partyName").value = "<?php echo isset($data->partyName) ? $data->partyName : '' ?>";

            }
            });
        }   
//onload rung party function
fetchParty();
//Fetch Supplier List

  function fetchOrigin(id=0){
  
            $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=routes&id=id&column=name',
            success:function(response){
                //console.log(response);
                $(".routes").html(response);
                $(".routes").val(id);
                $('.routes').trigger('change'); 
                document.getElementById("origin").value = "<?php echo isset($data->origin) ? $data->origin : '' ?>";
                document.getElementById("destination").value = "<?php echo isset($data->destination) ? $data->destination : '' ?>";
            }
            });
        }   
//onload run party
fetchOrigin();

  </script>  
  
  
@endsection