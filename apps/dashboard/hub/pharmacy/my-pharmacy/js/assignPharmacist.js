function assignPharmacist() {

    //alert("Are you sure you want to assign users to pharmacy?");
    var checkboxUsersId = $('input[name="checkboxUsersId[]"]').map(function () {
        return this.value;
    }).get();

    var assignToPharmacyId = $('select[name="assignToPharmacyId[]"]').map(function () {
        return this.value;
    }).get();


    var assignPharmacyAdminId = $('input[name="assignPharmacyAdminId[]"]').map(function () {
        return this.value;
    }).get();


    var rolesId = $('input[name="rolesId[]"]').map(function () {
        return this.value;
    }).get();

    var assignedUsersId = $('input[name="assignedUsersId[]"]').map(function () {
        return this.value;
    }).get();



    $.ajax({
        type: 'POST',
        url: 'hub/pharmacy/my-pharmacy/models/managePharmacist.php',
        data: {
            'checkboxUsersId[]': checkboxUsersId,
            'assignToPharmacyId[]': assignToPharmacyId,
            'assignPharmacyAdminId[]': assignPharmacyAdminId,
            'rolesId[]': rolesId,
            'assignedUsersId[]': assignedUsersId,

        },
        success: function () {

            displayPharmacist("<?php echo $usrUsersId; ?>");
            pharmacistSearchBox();
            $('#managePharmacistSave').hide();


        }
    });


}