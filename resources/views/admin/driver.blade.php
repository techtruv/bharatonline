@extends('layouts.app')
@section('body')
   <!-- Start Content-->
  <div class="container-fluid">

  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Driver</h4>  
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                             <x-alert/>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                
                                 <a href="{{ route('driver.index') }}"><button  type="button" class="btn btn-primary right">  Show Driver </button></a>
                                        <br>
                                        </br>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="form-row-preview">

                                                @if(isset($data))
                                                <form action="{{ route('driver.update',$data->id) }}" method="post">
                                                @method('PATCH')
                                                @else
                                                <form action="{{ route('driver.store') }}" method="post">
                                                @endif
                                                    @csrf
                                                    <div class="row g-2">
                                                        
                                                        <div class="mb-3 col-md-3">
                                                           
                                                             <label for="inputPassword4" class="form-label">Driver Name</label>
                                                             <input type="text" class="form-control" name="driverName" id="inputCity" value="{{ old('driverName',isset($data->driverName) ? $data->driverName : '' )}}">
                                                        
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                             <label for="inputPassword4" class="form-label">Mobile</label>
                                                             <input type="number" class="form-control" name="mobile" id="inputCity"
                                                             value="{{ old('mobile',isset($data->mobile) ? $data->mobile : '' )}}">
                                                        </div>

                                                     
                                                        <div class="mb-3 col-md-3">
                                                              <label for="inputEmail4" class="form-label">Opening Type</label>
                                                             <select id="openingType" class="form-select js-example-basic-single" name="openingType">
                                                                <option value="">-Select-</option>
                                                                <option value="1">Driver Has to Pay</option>
                                                                <option value="2">Driver Has to Got</option>
                                                               
                                                            </select>

                                                            <script>document.getElementById("openingType").value = "{{ old('openingType',isset($data->openingType) ? $data->openingType : '' )}}"; </script>
                                                        </div>

                                                        <div class="mb-3 col-md-3">
                                                             <label for="inputPassword4" class="form-label">Opening Balance</label>
                                                             <input type="number" class="form-control" name="openingBalance" id="inputCity"
                                                             value="{{ old('openingBalance',isset($data->openingBalance) ? $data->openingBalance : '' )}}">
                                                        </div>

                                                        
                                                         <div class="mb-3 col-md-3">
                                                         </br>   
                                                            <button type="submit" class="btn btn-primary">{{ isset($data) ? "Update" : "Submit" }}</button>
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