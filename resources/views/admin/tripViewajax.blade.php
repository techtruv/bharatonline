<script>

//Start SaveSupplierPayment
function SaveSupplierPayment() {

    var amount = $("#spayAmount").val();
    var trip_id = $("#trip_id").val();
    var advanceType = $("#spayType").val();
    var paymentDate = $("#spayDate").val();
    var notes = $("#spaymentNote").val();

    if (amount == '') {
        alert('Please Select Payment Amount');
    }
    if (advanceType == '') {
        alert('Please Select Payment Type');
    }

    if (paymentDate == '') {
        alert('Please Fill Payment Date');
    }

    $.ajax({
        type: 'GET',
        url: '{{ route("supplierPayment.create") }}?amount=' + amount + '&advanceType=' + advanceType + '&trip_id=' + trip_id + '&paymentDate=' + paymentDate + '&text=' + notes,
        success: function(response) {
            //console.log(response);
            $("#spayAmount").val('');
            $("#spayType").val('');
            $("#spayDate").val('');
            $("#spaymentNote").val('');
            $("#supplierPaymentModel").modal('hide');
            fetchReports();
        }
    });
}

//end SaveSupplierPayment
</script>