function dispenseMedications() {

    var prescriptionId = $('input[name="prescriptionIdDispense"]').map(function () {
        return this.value;
    }).get();

    var prescribedDrugsId = $('input[name="prescribedDrugsIdDispense[]"]').map(function () {
        return this.value;
    }).get();
    var trackingNumber = $('input[name="trackingNumber[]"]').map(function () {
        return this.value;
    }).get();
    var pickedBy = $('input[name="pickedBy"]').map(function () {
        return this.value;
    }).get();
    var dispenseAll = $('input[name="dispenseAll"]').map(function () {
        return this.value;
    }).get();

    $.ajax({
        type: 'POST',
        url: 'hub/pharmacy/my-pharmacy/models/dispensemedications.php',
        data: {
            'prescriptionId': prescriptionId,
            'prescribedDrugsId[]': prescribedDrugsId,
            'pharmacyId': "<?php echo $_SESSION['pharmacyId']; ?>",
            'trackingNumber[]': trackingNumber,
            'pickedBy': pickedBy,
            'dispenseAll': dispenseAll,
            // other data
        },
        success: function (response, textStatus, jqXHR) {
            if (response.trim() == 1) {
                $('#modal-table').modal('hide');
                displayDispensedMedications("<?php echo $_SESSION['pharmacyId'] ?>", "<?php echo $_SESSION['usrUsersId']; ?>", "<?php echo $_SESSION['rolesId']; ?>");

                $('#successfullyDispensed').html('<div class="alert alert-block alert-success" style="margin-left:50%;">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&nbsp; <i class="ace-icon fa fa-times"></i>' +
                    '</button>' +
                    '<i class="ace-icon fa fa-check green"></i> &nbsp; Successfully Dispensed.' +
                    '</div> ');
            } else {

                $('#notDispensed').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&nbsp; <i class="ace-icon fa fa-times"></i>' +
                    '</button>' +
                    '<i class="ace-icon fa fa-warning red"></i> &nbsp; Fill the mandatory fields with *.' +
                    '</div> ');
            }
        }
    });
}