<?php 
   use App\Http\Controllers\AdminController;
   use App\Http\Controllers\AddShortController;
   use Illuminate\Http\Request;
   use App\Models\Driver;
   $paymentBal =  AddShortController::partyBalance($data->id);
   $ownership='';
  if(isset($data->vehicleNumber)){
   $ownership = AdminController::getValueStatic2('vehicles','ownership','id',$data->vehicleNumber);
  }
  
   ?>
<!DOCTYPE html>
<html>
   <body style="font-family: Courier!important;">
      <style>
         body{
         border: 1px solid black;
         }
         table,td,th {
         border-spacing: -1px;
         font-size: 14px;
         border: 0.5px solid black;
         }
         th{
         padding-left: 26px;
         padding-bottom: 6px;
         padding-top: 6px;
         padding-right:  6px;
         text-align: left; 
         }
         #background{
         position:absolute;
         z-index:0;
         background:white;
         display:block;
         min-height:50%; 
         min-width:50%;
         color:yellow;
         }
         #content{
         position:absolute;
         z-index:1;
         }
         #bg-text
         {
         color:lightgrey;
         font-size:120px;
         transform:rotate(300deg);
         -webkit-transform:rotate(300deg);
         }
      </style>
      <!-- <div id="background">
         <p id="bg-text">{{ $com->company_name }}</p> 
         	</div> -->
      <div >
    
         <table style="width: 100%" style="border:1px solid black">
            <thead>
               <tr>
                  <th colspan="20" style="padding-left:  0px!important; font-size: 16px;">
                     <center>Invoice</center>
                  </th>
               </tr>
               <tr>
                  <th colspan="20" style="padding-left:  0px!important; font-size: 28px;">
                     <center>{{ $com->name }}<br><span style="font-size: 14px;">{{ $com->address }}</span></center>
                  </th>
               </tr>
               <tr>
                  <th colspan="20" style="padding-left:  10px!important;text-align: center;">Mob. No : {{ $com->mobile }},{{ $com->phone }} </th>
                  </tr>
                  <tr>
                  <th colspan="20" style="padding-right:   10px!important; text-align: center; border-bottom: 0.5px solid black">Email :  {{ $com->email }} @if($com->gst_no) || <span style = "margin-right:110px;">GST No.  :    {{ $com->gst_no }} @endif </span> </th>
                  </tr>

                <tr style="background:black;color:white;">
                    <th colspan="10" >Trip Reports</th>
                    <th colspan="10" style=" text-align: right; ">Generated on {{ date('d-m-Y H:i:s') }}</th>
                </tr>

                <tr >
                    <th colspan="10" rowspan="4" style="border: 0.5px solid black">Bill To <br> {{ AdminController::getValueStatic2('parties','partyName','id',$data->partyName) }}</th>
                    <th colspan="5" style=" border-bottom: 0.5px solid black; border-left: 0.5px solid black" >{{ AdminController::getValueStatic2('routes','name','id',$data->origin) }} <br><span> {{ date('d-m-Y',strtotime($data->startDate)) }} </span></th>
                    <th colspan="1" style=" border-bottom: 0.5px solid black" >To</th>
                    <th colspan="4" style=" border-bottom: 0.5px solid black" >{{ AdminController::getValueStatic2('routes','name','id',$data->destination) }}</th>
                    

                </tr>
                <tr>
                  <th colspan="10" style=" border: 0.5px solid black" > Truck : {{ AdminController::getValueStatic2('vehicles','vehicleNumber','id',$data->vehicleNumber) }}</th>
                  </tr>
                  @if($ownership != "Market Truck")
                    <?php
                    $vehicleNumber=AdminController::getRecordFirst('vehicles','id',$data->vehicleNumber);
                    //$vehicleNumber = AdminController::getValueStatic2('vehicles','vehicleNumber','id',$data->vehicleNumber);
                                                    
                    $drivers = Driver::find($vehicleNumber->driver_id);
                    $driverName = $drivers->driverName;
                                                    
                    ?>
                  <tr>
                     <th colspan="10" style=" border: 0.5px solid black" > Driver : {{ $driverName }}</th>
                  </tr>
                  @endif
                  <tr>
                  <th colspan="10" style=" border: 0.5px solid black" > Trip Status : 
                  @if($paymentBal!=0)
                     {{ "Started" }}
                                        @else
                   Settled
                   @endif
                    </th>
                </tr>
                <tr style="background:black;color:white;">
                  <th colspan="20" style=" border: 0.5px solid black" > Material  Details </th>
                </tr>
                <tr>
                  <th colspan="2" >SN</th>
                  <th colspan="6"  >LR No</th>
                  <th colspan="12" >Material</th>
                </tr>

                <?php
                  $material_records =  AdminController::getRecords('l_r_lists','trip_id',$data->id);
                   ?>
                   @foreach($material_records as $tc)
                  <tr>
                      <th colspan="2">{{ $loop->index+1 }}</th>
                      <th colspan="6">{{ $tc->lr_no }}</th>
                      <th colspan="12">{{ $tc->material }}</th>
                  </tr>
                  @endforeach

            </thead>
         </table>

         <table style="width: 100%" style="border:1px solid black">
            <thead>
               <tr style="background:black;color:white;">
                  <th colspan="20" style=" border-bottom: 0.5px solid black">
                     <b>Payment Details</b>
                  </th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <th colspan="14" style=" border: 0.5px solid black;padding-left:4px;">
                        Freight Amount
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black; text-align:right; padding-right:4px;">
                        {{ $data->partyFreightAmount }}
                  </th>
               </tr>
               <?php
                  $partyAdvances =  AdminController::getRecords('party_advances','trip_id',$data->id);
               ?>
                  @if(!$partyAdvances->isEmpty())
               <tr>
                  <th colspan="20" style=" border: 0.5px solid black;padding-left:4px;">
                       Advances(-)
                  </th>
               </tr>
             
               @foreach ($partyAdvances as $advx) 
               <tr>
               <th colspan="8" style=" border: 0.5px solid black;padding-left:4px; text-align:center;">
                 Via  {{ AdminController::getValueStatic2('advance_types','name','id',$advx->advanceType)  }}
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black;padding-left:4px; text-align:center;">

                  On {{ date('d-m-Y',strtotime($advx->paymentDate)) }}
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black; text-align:right; padding-right:4px;">
                        {{ $advx->amount }}
                  </th>
               </tr>
               @endforeach
               @endif
              
               <?php
                  $chargeAdds =  AdminController::getRecords2('party_charges','trip_id',$data->id,'billType',1);
               ?>
               @if(!$chargeAdds->isEmpty())
               <tr>
               <th colspan="20" style=" border: 0.5px solid black;padding-left:4px;">
                       Charges(+)
                  </th>
               </tr>
               
              
                @foreach ($chargeAdds as $chags)
               <tr>
               <th colspan="8" style=" border: 0.5px solid black;padding-left:4px; text-align:center;">
                 Via  {{ AdminController::getValueStatic2('advance_types','name','id',$chags->chargesType)  }}
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black;padding-left:4px; text-align:center;">

                  On {{ date('d-m-Y',strtotime($chags->chargesDate)) }}
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black; text-align:right; padding-right:4px;">
                        {{ $chags->chargesAmount }}
                  </th>
               </tr>
               @endforeach
               @endif
               
               <?php
                  $chargeAdds =  AdminController::getRecords2('party_charges','trip_id',$data->id,'billType',2);
               ?>
               @if(!$chargeAdds->isEmpty())
               <tr>
               <th colspan="20" style=" border: 0.5px solid black;padding-left:4px;">
                       Deductions(-)
                  </th>
               </tr>
              
                @foreach ($chargeAdds as $chags)
               <tr>
               <th colspan="8" style=" border: 0.5px solid black;padding-left:4px; text-align:center;">
                 Via  {{ AdminController::getValueStatic2('advance_types','name','id',$chags->chargesType)  }}
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black;padding-left:4px; text-align:center;">

                  On {{ date('d-m-Y',strtotime($chags->chargesDate)) }}
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black; text-align:right; padding-right:4px;">
                        {{ $chags->chargesAmount }}
                  </th>
               </tr>
               @endforeach
               @endif
               <?php
                  $payadds =  AdminController::getRecords('party_payments','trip_id',$data->id);
               ?>
               @if(!$payadds->isEmpty())
               <tr>
                  <th colspan="20" style=" border: 0.5px solid black;padding-left:4px;">
                       Payments(-)
                  </th>
               </tr>
              
                @foreach ($payadds as $payadd)
               <tr>
               <th colspan="8" style=" border: 0.5px solid black;padding-left:4px; text-align:center;">
                 Via  {{ AdminController::getValueStatic2('advance_types','name','id',$payadd->advanceType)  }}
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black;padding-left:4px; text-align:center;">

                  On {{ date('d-m-Y',strtotime($payadd->paymentDate)) }}
                  </th>
                  <th colspan="6" style=" border: 0.5px solid black; text-align:right; padding-right:4px;">
                        {{ $payadd->amount }}
                  </th>
               </tr>
               @endforeach
               @endif
              
               <tr>
                  <th colspan="14" style=" border: 0.5px solid black;padding-left:4px;">
                  Total Pending Balance 
                  </th>

                  <th colspan="6" style=" border: 0.5px solid black;padding-left:4px;text-align:right;">
                  {{   $paymentBal }}
                  </th>
               </tr>
            </tbody>
         </table>


        
      </div>
   </body>
</html>