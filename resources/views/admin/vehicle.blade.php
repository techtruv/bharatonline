@extends('layouts.app')
@section('body')
   <!-- Start Content-->
  <div class="container-fluid">

  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Vehicle</h4>  
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                 <x-alert/>
                                <div class="card">
                                    <div class="card-body">
                                
                                  <a href="{{ route('vehicle.index') }}"><button  type="button" class="btn btn-primary right"> Show Vehicle </button></a>
                                        <br>
                                        </br>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="form-row-preview">

                                                @if(isset($data))
                                                <form action="{{ route('vehicle.update',$data->id) }}" method="post">
                                                @method('PATCH')
                                                @else
                                                <form action="{{ route('vehicle.store') }}" method="post">
                                                @endif
                                                    @csrf
                                                    <div class="row">
                                                        
                                                        <div class="mb-3 col-md-3">
                                                           
                                                             <label for="inputPassword4" class="form-label">Vehicle Number</label>
                                                             <input type="text" class="form-control" name="vehicleNumber" id="inputCity" value="{{ old('vehicleNumber',isset($data->vehicleNumber) ? $data->vehicleNumber : '' )}}">
                                                        
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                             <label for="inputPassword4" class="form-label">Vehicle Type</label>
                                                             <select name="vehicleType" id="vehicleType" class="form-select js-example-basic-single">
                                                                <option>--Choose Vehicle--</option>
                                                                @foreach($vehicleType as $type)
                                                                <option value="{{ $type->id }}">{{ $type->truckName }}</option>
                                                                @endforeach
                                                            </select>

                                                            <script>document.getElementById("vehicleType").value = "{{ old('vehicleType',isset($data->vehicleType) ? $data->vehicleType : '' )}}"; </script>
                                                        </div>

                                                         <div class="mb-3 col-md-3">
                                                             <label for="inputPassword4" class="form-label">OwnerShip</label>
                                                            <select id="ownership" onchange = "getDriver()" name="ownership" class="form-select js-example-basic-single">
                                                                <option value="My Truck" selected="selected">My Truck</option>
                                                                <option value="Market Truck">Market Truck</option>
                                                            
                                                            </select>
                                                            <script>document.getElementById("ownership").value = "{{ old('ownership',isset($data->ownership) ? $data->ownership : '' )}}"; </script>
                                                        </div>


                                                        <div class="mb-3 col-md-3" id="dri_name">
                                                             <label for="inputPassword4" class="form-label">Driver</label>
                                                            <select id="driverName" name="driverName" class="form-select ">
                                                                <option value="">--Choose Driver--</option>
                                                                @foreach($drivers as $driver)
                                                                <option value="{{ $driver->id }}">{{ $driver->driverName }} {{ $driver->mobile }}</option>
                                                                @endforeach                                                      
                                                            </select>

                                                             <script>document.getElementById("driverName").value = "{{ old('driverName',isset($data->driver_id) ? $data->driver_id : '' )}}"; </script>
                                                        </div>

                                                         <div class="mb-3 col-md-3" id="supp_name">
                                                             <label for="inputPassword4" class="form-label">Supplier</label>
                                                            <select id="supplierName" name="supplierName" class="form-select ">
                                                                <option>--Choose Supplier--</option>
                                                                @foreach($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">{{ $supplier->supplierName }} {{ $supplier->mobile }}</option>
                                                                @endforeach                                                           
                                                            </select>
                                                            <script>document.getElementById("supplierName").value = "{{ old('supplierName',isset($data->supplier_id) ? $data->supplier_id : '' )}}"; </script>
                                                        </div>
                                                     
                                                        <div class="mb-3 col-md-3" id="d_name">
                                                           
                                                             <label for="inputPassword4" class="form-label">Driver Name</label>
                                                             <input type="text" class="form-control" name="driver_name" id="inputCity" value="{{ old('driver_name',isset($data->driver_name) ? $data->driver_name : '' )}}">
                                                        
                                                        </div>
  
                                                        <div class="mb-3 col-md-3" id="d_con">
                                                           
                                                             <label for="inputPassword4" class="form-label">Driver Contact Number</label>
                                                             <input type="text" class="form-control" name="driver_contact" id="inputCity" value="{{ old('driver_contact',isset($data->driver_contact) ? $data->driver_contact : '' )}}">
                                                        
                                                        </div>

                                                        
                                                         <div class="mb-3 col-md-3">
                                                         </br>   
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                         </div>
                                                    </div>
                                                 </form>                      
                                            </div> <!-- end preview-->
                                        
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>

</div>



@endsection

@section('java_script')

<script type="text/javascript">
    
                $("#dri_name").show();
                $("#d_name").hide();
                $("#d_con").hide();
                $("#supp_name").hide();

    function getDriver(){
        var ownership = $("#ownership").val();
       
        if (ownership == 'My Truck') {
                $("#dri_name").show();
                $("#d_name").hide();
                $("#d_con").hide();
                $("#supp_name").hide();
            }else if(ownership == 'Market Truck'){
                $("#dri_name").hide();
                $("#d_name").show();
                $("#d_con").show();
                $("#supp_name").show();
            } else {
                
            }
    }   
                                                               
     
getDriver();

</script>

@endsection