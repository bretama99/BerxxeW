function managePharmacist() {
    alert("Are you sure you want to manage your users?");
    var usersId = $('input[name="usersId[]"]').map(function () {
        return this.value;
    }).get();

    var pharmacyId = $('input[name="pharmacyId[]"]').map(function () {
        return this.value;
    }).get();

    var checkBox = $('input[name="status[]"]').map(function () {
        return this.value;
    }).get();

    $.ajax({
        type: 'POST',
        url: 'hub/pharmacy/my-pharmacy/models/managePharmacist.php',
        data: {
            'usersId[]': usersId,
            'pharmacyId[]': pharmacyId,
            'checkBox[]': checkBox,
        },
        success: function () {
            $('#myPharmacistManage').html('<div class="alert alert-block alert-success" data-dismiss="alert" style="margin-left:50%;">' +
                '<button type="button" class="close">' +
                '&nbsp; <i class="ace-icon fa fa-times"></i>' +
                '</button>' +
                '<i class="ace-icon fa fa-check green"></i> &nbsp; Pharmacists are successfully managed ' +
                '</div> ');
            // displayPharmacist("<?php echo $usrUsersId; ?>");
        }
    });


}