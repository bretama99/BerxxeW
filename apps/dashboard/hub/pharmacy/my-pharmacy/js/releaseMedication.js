// function releaseMedication(drugsId) {

//     alert("Are you sure you want to release this medication to pharmacy hub?");


//     var prescriptionIdRelease = $(drugsId).attr('prescriptionIdRelease');
//     var drugsIdRelease = $(drugsId).attr('drugsIdRelease');
//     var pharmacyIdRelease = $(drugsId).attr('pharmacyIdRelease');
//     var releaseAll = $(drugsId).attr('releaseAll');


//     $.ajax({
//         type: 'POST',
//         url: 'hub/pharmacy/my-pharmacy/models/releasemedications.php',
//         data: {
//             'prescriptionId': prescriptionIdRelease,
//             'drugsId': drugsIdRelease,
//             'releaseAll': releaseAll,

//         },
//         success: function (response, textStatus, jqXHR) {
//             if (response.trim() == 1) {
//                 displayPrescription("<?php echo $_SESSION['pharmacyId'] ?>", "<?php echo $_SESSION['usrUsersId']; ?>", "<?php echo $_SESSION['rolesId']; ?>");
//                 $('#successfullyDispensed').html('<div class="alert alert-block alert-success" data-dismiss="alert" style="margin-left:50%;">' +
//                     '<button type="button" class="close">' +
//                     '&nbsp; <i class="ace-icon fa fa-times"></i>' +
//                     '</button>' +
//                     '<i class="ace-icon fa fa-check green"></i> &nbsp; Medication is successfully released. ' +
//                     '</div> ');
//                 //displayPharmacies("<?php echo $usrUsersId; ?>");
//             } else {
//                 $('#successfullyDispensed').html('<div class="alert alert-block alert-warning" data-dismiss="alert" style="margin-left:50%;">' +
//                     '<button type="button" class="close">' +
//                     '&nbsp; <i class="ace-icon fa fa-times"></i>' +
//                     '</button>' +
//                     '<i class="ace-icon fa fa-warning green"></i> &nbsp; Medication is not released. ' +
//                     '</div> ');
//             }


//         }
//     });


// }