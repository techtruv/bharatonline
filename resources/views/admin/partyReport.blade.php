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
                                    <h4 class="page-title">Party Report</h4>
                                    
                                </div>
                                </div>
                        </div>     
                        <!-- end page title --> 



         <div class="row">
         <x-alert />
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
                                                            <th>Party Name</th>
                                                            <th>Total Balance</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                  
                                                
                                                   <tbody>
                                                        @php
                                                    $total_PartyBalance=0;
                                                   @endphp
                                                      @foreach($records as $row)
                                                        @php 
                                                
                                                          $partyBalance= AddShortController::totalPartyBalance($row->id);
                                                        $total_PartyBalance+=$partyBalance;
                                                        @endphp
                                                        @if($partyBalance!=0)
                                                        
                                                         <tr>
                                                            <td>{{ $loop->index+1 }}</td>
                                                            <td> <a href="{{ route('partyBalanceList',$row->id) }}" >{{ isset($row->partyName) ? $row->partyName : ''  }}</a></td>
                                                            <td><a href="{{ route('partyBalanceList',$row->id) }}" class="btn btn-primary" > 
                                                            {{ isset($partyBalance) ? round($partyBalance) : ''  }}  </a></td>
                                                             </tr>
                                                            
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <th colspan="2" style="text-align:right">Total</th>
                                                    <th>{{ round($total_PartyBalance) }}</th>
                                                    
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