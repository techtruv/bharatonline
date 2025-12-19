@extends('layouts.app')
@section('body')
   <!-- Start Content-->
  <div class="container-fluid">

  <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Session</h4>  
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                   <x-alert/>
                                <div class="card">
                                    <div class="card-body">

                              
                                  <a href="{{ route('party.index') }}"><button  type="button" class="btn btn-primary right">  show Party</button></a>
                                        <br>
                                        </br>


                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="form-row-preview">

                                                @if(isset($data))
                                                <form action="{{ route('party.update',$data->id) }}" method="post">
                                                @method('PATCH')
                                                @else
                                                <form action="{{ route('party.store') }}" method="post">
                                                @endif
                                                    @csrf
                                                    <div class="row g-2">
                                                        
                                                        <div class="mb-3 col-md-3">
                                                           
                                                             <label for="inputPassword4" class="form-label">Party Name</label>
                                                             <input type="text" class="form-control" name="partyName" id="inputCity" value="{{ old('partyName',isset($data->partyName) ? $data->partyName : '' )}}">
                                                        
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