// function managePharmacy() {

//     alert("Are you sure you want to manage your pharmacy?");

//     var pharmacyId = $('input[name="managedPharmacyId[]"]').map(function () {
//         return this.value;
//     }).get();

//     var checkBox = $('input[name="pharmacyStatus[]"]').map(function () {
//         return this.value;
//     }).get();



//     $.ajax({
//         type: 'POST',
//         url: 'hub/pharmacy/my-pharmacy/models/managePharmacy.php',
//         data: {
//             'pharmacyId[]': pharmacyId,
//             'checkBox[]': checkBox,
//             // other data
//         },
//         success: function () {

//             $('#successfullyAdded').html('<div class="alert alert-block alert-success" data-dismiss="alert" style="margin-left:50%;">' +
//                 '<button type="button" class="close">' +
//                 '&nbsp; <i class="ace-icon fa fa-times"></i>' +
//                 '</button>' +
//                 '<i class="ace-icon fa fa-check green"></i> &nbsp; Pharmacies are successfully managed ' +
//                 '</div> ');
//             //displayPharmacies("<?php echo $usrUsersId;?>");



//         }
//     });


// }