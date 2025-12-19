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
                                    <h4 class="page-title">Supplier Report</h4>
                                    
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 



         <div class="row">
         <x-alert />
         
          <form>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                           

                                            <div class="mb-4 col-md-4">
                                                <select id="supplierName" name="supplierName" class="form-select js-example-basic-single">
                                                                <option>--Choose Supplier--</option>
                                                                @foreach($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">{{ $supplier->supplierName }} {{ $supplier->mobile }}</option>
                                                                @endforeach                                                           
                                                            </select>
                                            </div>
                                            <script> $("#supplierName").val(<?php echo isset($_GET['supplierName']) ? $_GET['supplierName'] : ''  ?>);
                                            </script>
                                            <div class="mb-4 col-md-4">
                                                <button class="btn btn-primary pull-right">Search</button>  
                                                <a href="{{ Route('supplierledgerReport') }}" class="btn btn-success pull-right">Reset</a>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                      
                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            
                                        </ul> <!-- end nav-->
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="buttons-table-preview">
                                                <table  class="table table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                        
                                                            <th>SN</th>
                                                            <th>Supplier Name</th>
                                                            <th>Total Balance</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                
                                                
                                                   <tbody>
                                                       @php
                                                    $total_supplierBalance=0;
                                                   @endphp
                                                   @foreach($records as $row)
                                                        @php 
                                                
                                                          $supplierBalance= AddShortController::totalSupplierBalance($row->id);
                                                        $total_supplierBalance+=$supplierBalance;
                                                        @endphp
                                                        @if($supplierBalance!=0)
                                                        
                                                         <tr>
                                                            <td>{{ $loop->index+1 }}</td>
                                                            <td>{{ isset($row->supplierName) ? $row->supplierName : ''  }}</td>
                                                            <td><a href="{{ route('supplierBalanceList',$row->id) }}" class="btn btn-primary" > 
                                                            {{ isset($supplierBalance) ? round($supplierBalance) : ''  }}  </a></td>
                                                             </tr>
                                                            
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <th colspan="2" style="text-align:right">Total</th>
                                                    <th>{{ round($total_supplierBalance) }}</th>
                                                    
                                                    </tfoot>
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