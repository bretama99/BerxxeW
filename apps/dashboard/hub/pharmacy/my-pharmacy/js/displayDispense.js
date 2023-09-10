function displayDispense(drugsId) {
    var prescriptionId = $(drugsId).attr('prescriptionId');
    var drugsId = $(drugsId).attr('drugsId');
    $.ajax({
        url: "hub/common/deleteprescription.php",
        data: {
            'prescriptionDetailsId': prescriptionId,
            'prescriptionDrugsId': drugsId,
            'dispenseAll': dispenseAll
        },
    }).done(function (data) {
        var result = $.parseJSON(data);
        var dataDisplay;
        var sn = 1;
        $.each(result, function (key, value) {
            if (sn == 1) {
                dataDisplay += "<tr><td colspan='2'><b>Prescription No.:</b>&nbsp; " + value['prescriptionId1'] + ",  &nbsp; <b>Diagnosis:</b> " + value['diagnosis'] + "</td></tr> <tr><td><b>Drug Name</b>&nbsp;<td> <b>Tracking Number*</b> </td></tr>";
            }
            dataDisplay += "<tr><td style='width:90%;'>" + sn + ")&nbsp; " + value['drugsName'] + "</td><td><input type='text' name='trackingNumber[]' /> <input type='hidden' name='prescriptionIdDispense' value='" + prescriptionId + "' /> <input type='hidden' name='prescribedDrugsIdDispense[]' value='" + value[' prescribedDrugsId'] + "' />  <input type='hidden' name='dispenseAll' value='" + dispenseAll + "' /></td></tr>";
            sn++;
        });
        dataDisplay += "<tr style='width:100%;'><td colspan='2'><b>Picked By:</b>&nbsp;<input type='text' size='60' name='pickedBy' /></td></tr>";
        $("#modalHeader").html("Dispense Medications ..");
        document.getElementById('otherDetails').className = 'table table-hover';
        $("#modalFooter").html("<button class='btn btn-sm btn-danger pull-left' data-dismiss='modal'><i class='ace-icon fa fa-times'></i>Close</button><button class='btn btn-sm btn-success pull-right' onclick='dispenseMedications(this);' ><i class='ace-icon fa fa-check'></i>Dispense</button>");
        $("#otherDetails").html(dataDisplay);
        dispenseAll = 0;
    });
}