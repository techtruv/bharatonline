@extends('layouts.app')
@section('body')
   <!-- Start Content-->
  <div class="container-fluid">

  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Supplier</h4>  
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                  <x-alert/>
                                <div class="card">
                                    <div class="card-body">
                               
                                 <a href="{{ route('supplier.index') }}"><button  type="button" class="btn btn-primary right"> Show Supplier </button></a>
                                        <br>
                                        </br>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="form-row-preview">

                                                @if(isset($data))
                                                <form action="{{ route('supplier.update',$data->id) }}" method="post">
                                                @method('PATCH')
                                                @else
                                                <form action="{{ route('supplier.store') }}" method="post">
                                                @endif
                                                    @csrf
                                                    <div class="row g-2">
                                                        
                                                        <div class="mb-3 col-md-3">
                                                           
                                                             <label for="inputPassword4" class="form-label">Supplier Name</label>
                                                             <input type="text" class="form-control" name="supplierName" id="inputCity" value="{{ old('supplierName',isset($data->supplierName) ? $data->supplierName : '' )}}">
                                                        
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                             <label for="inputPassword4" class="form-label">Mobile</label>
                                                             <input type="number" class="form-control" name="mobile" id="inputCity"
                                                             value="{{ old('mobile',isset($data->mobile) ? $data->mobile : '' )}}"
                                                             
                                                             >
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