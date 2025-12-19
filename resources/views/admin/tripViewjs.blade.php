<script>

//Open expensesModel 
    function expensesModel(){
        $("#expensesModel").modal('show');
    }

    

    function AddExpenses(){
        $("#expensesAdd").modal('show');
    }
    function supplierChargeModel(){
        $("#supplierChargeModel").modal('show');
    }

    function partyChargeModel(){
        $("#partyChargeModel").modal('show');
    }

    function partyAdvanceModel(){
        $("#partyAdvanceModel").modal('show');
    }

    function supplierAdvanceModel(){
        $("#supplierAdvanceModel").modal('show');
    }


    function addAdvanceTypeModel(){
        $("#addAdvanceTypeModel").modal('show');
    }

    function partyPaymentModel(){
        $("#partyPaymentModel").modal('show');
    }

    function supplierPaymentModel(){
        $("#supplierPaymentModel").modal('show');
    }
    
    
    function onComplete(){
        $("#onCompleteModel").modal('show');
    }


</script>  

<script>
    function SaveComplete(){
        var endDate = $("#endDate").val();
        var endKmsReading = $("#endKmsReading").val();
        var trip_id = $("#trip_id").val();
        
        var status =true;
        if(endDate==''){
            status =false;
            alert('Please fill End Date');
        }
        
        if(status==true){
        $.ajax({
            type:'GET',
            url:'{{ route("addShort") }}?page=SaveComplete&endDate='+endDate+'&endKmsReading='+endKmsReading+'&trip_id='+trip_id,
            success:function(response){
                fetchReports();
            
            $("#endDate").val('');
            $("#endKmsReading").val('');
            $("#onCompleteModel").modal('hide');
            location.reload();
          }
            });
        }
    }
    </script>
    
//save POD 



<script>

    function onPODReceive(){
        $("#onPODReceive").modal('show');
    }
</script>  




<script type="text/javascript">
    
    $('#SavePODReceive').on('submit', function(event){
        event.preventDefault();
        var pod_receuve_date = $("#pod_receuve_date").val();
        var pod_receuve_doc = $("#pod_receuve_doc").val();
        var status =true;
        if(pod_receuve_date==''){
             status =false;
            alert('Please fill pod_receuve_date');
        }
        

        let formData = new FormData(this);
      
        if(status ==true){
        
            $.ajax({
            url: "{{ route('addPODReceive') }}",
            type: "POST",
            enctype: 'multipart/form-data', 

            // data: $(this).serialize(),
            data:  formData,
            contentType: false,
           processData: false,
           cache:false,
            success:function(response){
                console.log(response);
                $("#pod_receuve_date").val('');
            $("#pod_receuve_doc").val('');
            $("#onPODReceive").modal('hide');
            location.reload();
            },
            error: function(response) {
            }
            });
        }
    
    });



    </script>
    

    //save onComplete 
<script>

    function onPODSubmit(){
        $("#onPODsubmit").modal('show');
    }
</script>  




<script type="text/javascript">
    
    function SavePODSubmit(){
        var pod_submitted_date = $("#pod_submitted_date").val();
        var trip_id = $("#trip_id").val();
        
        var status =true;
        if(pod_submitted_date==''){
            status =false;
            alert('Please fill POD Submitted Date');
        }
        
        if(status ==true){
        $.ajax({
            type:'GET',
            url:'{{ route("addShort") }}?page=SavePODSubmit&pod_submitted_date='+pod_submitted_date+'&trip_id='+trip_id,
            success:function(response){
                fetchReports();
            
            $("#pod_submitted_date").val('');
            $("#onPODsubmit").modal('hide');
            location.reload();
          }
            });
        }
    }
    </script>
 