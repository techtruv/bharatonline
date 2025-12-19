

<script type="text/javascript">

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

// Start save_material

function save_material(){
       
    var lrNo = $("#lrNo").val();
    var lr_table_id = $("#lr_table_id").val();
    var materialName = $("#materialName").val();
    var note = $("#note").val();
    if(lrNo ==''){
        alert('Please LR No fill');
    }

    if(materialName ==''){
        alert('Please Material Name Fill');
    }

  $.ajax({
  type:'GET',
  url:'{{ url("save_material") }}?lr_no='+lrNo+'&id='+lr_table_id+'&material='+materialName+'&details='+note,
  success:function(response){
    fetchMaterial();
      $("#lrNo").val('');
      $("#lr_table_id").val('');
      $('#materialName').val(''); 
      $('#note').val(''); 
  }
  });
}   

// End save_material
// Fetch save_material
function delMaterial(id){
    
        $.ajax({
            type:'GET',
            url:'{{ url("master-delete") }}?table=l_r_lists&id='+id,
            success:function(response){
                fetchMaterial();
                }
            });
}

// End Fetch save_material

//Fetch Parties list 

function fetchMaterial(){
   
    var lr_table_id = <?php if(isset($data->id)) { echo $data->id; } else {
        ?> $("#lr_table_id").val(); <?php } ?>
    
  $.ajax({
  type:'GET',
  url:'{{ url("fetch_material") }}?id='+lr_table_id,
  success:function(response){
      
          $("#material_details").html(response);
      }
  });
}   
//onload rung party function
fetchMaterial();


function onPartyBillingTypechange(){
    var billingType = $("#billingType").val(); 

    if(billingType != '1')
       {
        $("#supplier_per").show();
       } else{
        $("#supplier_per").hide();
       }
   
}

onPartyBillingTypechange();


function onFreightRatechange(){
    var rate = $("#party_rate_per").val();
    var qty = $("#party_unit_per").val();

    var total = rate*qty;

     $("#partyFreightAmount").val(total);
}





function onSupplierBillingType(){
    var supplierBillingType = $("#supplierBillingType").val();
  
    if(supplierBillingType != '1')
       {
        $("#truck_per").show();
       } else{
        $("#truck_per").hide();
       }
   
}
 
onSupplierBillingType();

   
function onTruckHireAmoutn(){
    var rate = $("#truck_rate_per").val();
    var qty = $("#truck_unit_per").val();

    var total = rate*qty;

     $("#truckHireAmount").val(total);
}


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

// fetch Vehicle list

function fetchVehicle(id=0){
  
            $.ajax({
            type:'GET',
            url:'{{ url("fetchSelectTruck") }}?table=vehicles&id=id&column=vehicleNumber&column2=ownership',
            success:function(response){
                //console.log(response);
                $("#vehicleNumber").html(response);
                $("#vehicleNumber").val(id);
                $('#vehicleNumber').trigger('change'); 
                
                document.getElementById("vehicleNumber").value = "<?php echo isset($data->vehicleNumber) ? $data->vehicleNumber : '' ?>";
                onVehiclechange();
               
            }
            });
        }   
//onload rung party function
fetchVehicle();




//Fetch Supplier List

  function fetchSupplier(id=0){
  
            $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=suppliers&id=id&column=supplierName',
            success:function(response){
                console.log(response);
                $("#supplierName").html(response);
                $("#supplierName").val(id);
                $('#supplierName').trigger('change'); 
                document.getElementById("supplierName").value = "<?php echo isset($data->supplierName) ? $data->supplierName : '' ?>";
            }
            });
        }   
//onload run party
fetchSupplier();


//Fetch Supplier List

  function fetchDriver(id=0){
  
            $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=drivers&id=id&column=driverName',
            success:function(response){
                console.log(response);
                $("#driverName").html(response);
                $("#driverName").val(id);
                $('#driverName').trigger('change'); 
                document.getElementById("driverName").value = "<?php echo isset($data->driver_id) ? $data->driver_id : '' ?>";
            }
            });
        }   
//onload run party
fetchDriver();



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





  function fetchSuppBillingType(id=0){

            $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=billing_types&id=id&column=name',
            success:function(response){
                //console.log(response);
                $(".supbillType").html(response);
                $(".supbillType").val(id);
                $('.supbillType').trigger('change'); 
                
                $("#supplierBillingType").val(<?php echo isset($data->supplierBillingType) ? $data->supplierBillingType : '' ?>);
                onSupplierBillingType();
            }
            });
        }   
//onload run party
fetchSuppBillingType();

  function fetchPartyBillingType(id=0){

            $.ajax({
            type:'GET',
            url:'{{ url("common-get-select2") }}?table=billing_types&id=id&column=name',
            success:function(response){
                //console.log(response);
                $(".partybillType").html(response);
                $(".partybillType").val(id);
                $('.partybillType').trigger('change'); 
                
                $("#billingType").val(<?php echo isset($data->billingType) ? $data->billingType : '' ?>);
                onPartyBillingTypechange();
            }
            });
        }   
//onload run party
fetchPartyBillingType();


//Fetch Supplier List

  function onVehiclechange(){
          var vehicleNumber = $("#vehicleNumber").val();
          // alert(vehicleNumber);
            $.ajax({
            type:'GET',
            url:'{{ url("common-get-vehicle") }}?id='+vehicleNumber,
            success:function(response){
               var x = JSON.parse(response);
                console.log(response);
                $("#optionData").html(x.data);
                $("#optionData").val(vehicleNumber);
                $('#optionData').trigger('change'); 
                if(x.ownership=='Market Truck'){
                $("#truckHireDiv").show();
                $("#supplierBillingDiv").show();
              } 

              if(x.ownership=='My Truck'){
                 $("#truckHireDiv").hide();
                $("#supplierBillingDiv").hide();
              } 
            }
            });
        }   
//onload run party
onVehiclechange();


function Addparty(){
    $("#addPartyModel").modal('show');
}


//Start SaveParty
function SaveParty() {

var mpartyName = $("#mpartyName").val();
var mmobile = $("#mmobile").val();

var status=true;

if (mpartyName == '') {
    status=false;
    alert('Please Enter Name');
}
if (mmobile == '') {
    status=false;
    alert('Please Enter mobile');
}


if(status == true){
$.ajax({
    type: 'GET',
    url: '{{ route("addShort") }}?partyName='+mpartyName+'&mobile='+mmobile+'&page=addParty',
    success: function(response) {
        //console.log(response);
        $("#mpartyName").val('');
        $("#mmobile").val('');
        $("#addPartyModel").modal('hide');
        fetchParty();
    }
});
}
}

//end SaveParty


// Call vehicle Function
function AddVehicle(){
$("#addVehicleModel").modal('show');
}


function getDriver(){
        var ownership = $("#m_ownership").val();
       
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

//Fetch Supplier List

function fetchBillingType(id=0){

$.ajax({
type:'GET',
url:'{{ url("common-get-select2") }}?table=billing_types&id=id&column=name',
success:function(response){
    //console.log(response);
    $(".billType").html(response);
    $(".billType").val(id);
    $('.billType').trigger('change'); 
}
});
}   
//onload run party
fetchBillingType();

//Start SaveSupplierPayment
function SaveVehicle() {

    var m_vehicleNumber = $("#m_vehicleNumber").val();
    var m_vehicleType = $("#m_vehicleType").val();
    var m_ownership = $("#m_ownership").val();
    var m_driverName = $("#m_driverName").val();
    var m_supplierName = $("#m_supplierName").val();
    var m_driver_name = $("#m_driver_name").val();
    var m_driver_contact = $("#m_driver_contact").val();

   var status=true;

    if (m_vehicleNumber == '') {
        status=false;
        alert('Please Enter Vehicle Number');
    }

    if (m_vehicleNumber.length > '10') {
        status=false;
        alert('Please Enter valid Vehicle Number');
    }

    if (m_vehicleType == '') {
        status=false;
        alert('Please Enter Vehicle Type');
    }

    if (m_ownership == '') {
        status=false;
        alert('Please Enter Ownership');
    }

    
if(status == true){
    $.ajax({
        type: 'GET',
        url: '{{ route("addShort") }}?vehicleNumber='+m_vehicleNumber+'&vehicleType='+m_vehicleType+'&ownership='+m_ownership+'&driverName='+m_driverName+'&supplierName='+m_supplierName+'&driver_name='+m_driver_name+'&driver_contact='+m_driver_contact+'&page=addVehicle',
        success: function(response) {
            //console.log(response);
            $("#m_vehicleNumber").val('');
            $("#m_vehicleType").val('');
            $("#m_ownership").val('');
            $("#m_driverName").val('');
            $("#m_supplierName").val('');
            $("#m_driver_name").val('');
            $("#m_driver_contact").val('');
            $("#addVehicleModel").modal('hide');
            fetchVehicle();
        }
    });
}
}



function AddRoute(){
    $("#AddRouteModel").modal('show');
}



//Start SaveSupplierPayment
function SaveRoute() {

var m_state = $("#m_state").val();
var m_route = $("#m_route").val();

var status=true;

if (m_state == '') {
    status=false;
    alert('Please Select State');
}
if (m_route == '') {
    status=false;
    alert('Please Enter Route Name');
}


if(status == true){
$.ajax({
    type: 'GET',
    url: '{{ route("addShort") }}?state='+m_state+'&name='+m_route+'&page=addState',
    success: function(response) {
        //console.log(response);
        $("#m_state").val('');
        $("#m_route").val('');
        $("#AddRouteModel").modal('hide');
        fetchOrigin();
    }
});
}
}

//Fetch Supplier List

function fetchState(id=0){

$.ajax({
type:'GET',
url:'{{ url("common-get-select2") }}?table=states&id=id&column=name',
success:function(response){
//console.log(response);
$(".m_state").html(response);
$('.m_state').trigger('change'); 
}
});
}   
//onload run party
fetchState();



    $("#supp_name").hide();
   $(function() {
    $('#startDate').datepicker({ dateFormat: 'dd-mm-yy' }).val();
    });



</script>