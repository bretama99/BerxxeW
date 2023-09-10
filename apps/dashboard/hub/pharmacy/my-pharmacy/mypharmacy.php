<meta http-equiv="Refresh" content="300">
<link rel="stylesheet" href="../../css/bootstrap-multiselect.min.css" />
<script src="hub/pharmacy/my-pharmacy/js/showDetails.js"></script>
<script src="hub/pharmacy/my-pharmacy/js/searchform/searchbox.js"></script>
<script src="hub/pharmacy/my-pharmacy/js/mypharmacy.js"></script>
<script src="hub/common/js/postedPrescriptions.js"></script>
<script src="hub/pharmacy/my-pharmacy/js/assignPharmacist.js"></script>
<script src="hub/pharmacy/my-pharmacy/js/managePharmacist.js"></script>
<script src="hub/pharmacy/my-pharmacy/js/managePharmacy.js"></script>
<script src="hub/pharmacy/my-pharmacy/js/displayPharmacist.js"></script>
<script src="hub/pharmacy/my-pharmacy/js/releaseMedication.js"></script>
<script type="text/javascript">
  //--------------------------------------------------
  function searchPharmacistDynamically() {

    var filterSearch = $('input[name=filterSearch]').val();

    if (filterSearch != '') {
      pharmacistListForAssignment(filterSearch);

    }

  }

  if (localStorage.getItem("pharmacyAdded") != '1') {
    window.onload = function() {
      displayDispensedMedications("<?php echo $_SESSION['pharmacyId'] ?>", "<?php echo $_SESSION['usrUsersId']; ?>", "<?php echo $_SESSION['rolesId']; ?>");
    };

  }
  //---------------------------------------------------
  var dispenseAll = 0;

  function displayDispenseAll(drugsId) {
    dispenseAll = 1;
    displayDispense(drugsId);
  }

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
    }).done(function(data) {

      console.log(data);

      var result = $.parseJSON(data);

      var dataDisplay;
      var sn = 1;

      $.each(result, function(key, value) {

        if (sn == 1) {
          dataDisplay += "<tr><td colspan='2'><b>Prescription No.:</b>&nbsp; " + value['prescriptionId1'] + ",  &nbsp; <b>Diagnosis:</b> " + value['diagnosis'] + "</td></tr> <tr><td><b>Drug Name</b>&nbsp;<td> <b>Tracking Number*</b> </td></tr>";
        }

        dataDisplay += "<tr><td style='width:90%;'>" + sn + ")&nbsp; " + value['drugsName'] + "</td><td><input type='text' name='trackingNumber[]' /> <input type='hidden' name='prescriptionIdDispense' value='" + prescriptionId + "' /> <input type='hidden' name='prescribedDrugsIdDispense[]' value='" + value['prescribedDrugsId'] + "' />  <input type='hidden' name='dispenseAll' value='" + dispenseAll + "' /></td></tr>";

        sn++;

      });

      dataDisplay += "<tr style='width:100%;'><td colspan='2'><b>Picked By:</b>&nbsp;<input type='text' size='60' name='pickedBy'/></td></tr>";


      $("#modalHeader").html("Dispense Medications ..");
      document.getElementById('otherDetails').className = 'table table-hover';
      $("#modalFooter").html("<button class='btn btn-sm btn-danger pull-left' data-dismiss='modal'><i class='ace-icon fa fa-times'></i>Close</button><button class='btn btn-sm btn-success pull-right' onclick='dispenseMedications(this);' ><i class='ace-icon fa fa-check'></i>Dispense</button>");

      $("#otherDetails").html(dataDisplay);

      dispenseAll = 0;
    });

  }
  //----------------------dispense Medication -----------------
  function dispenseMedications() {
    var prescriptionId = $('input[name="prescriptionIdDispense"]').map(function() {
      return this.value;
    }).get();

    var prescribedDrugsId = $('input[name="prescribedDrugsIdDispense[]"]').map(function() {
      return this.value;
    }).get();
    var trackingNumber = $('input[name="trackingNumber[]"]').map(function() {
      return this.value;
    }).get();
    var pickedBy = $('input[name="pickedBy"]').map(function() {
      return this.value;
    }).get();
    var dispenseAll = $('input[name="dispenseAll"]').map(function() {
      return this.value;
    }).get();

    $.ajax({
      type: 'POST',
      url: 'hub/pharmacy/my-pharmacy/models/dispensemedications.php',
      data: {
        'prescriptionId': prescriptionId,
        'prescribedDrugsId[]': prescribedDrugsId,
        'pharmacyId': '<?php echo $_SESSION['pharmacyId']; ?>',
        'trackingNumber[]': trackingNumber,
        'pickedBy': pickedBy,
        'dispenseAll': dispenseAll,
      },
      success: function(response, textStatus, jqXHR) {
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
  //-------------------------releasing a medication from pharmcy --------------------
  // function releaseMedication(drugsId) {
  //   alert("Are you sure you want to release this medication to pharmacy hub?");
  //   var prescriptionIdRelease = $(drugsId).attr('prescriptionIdRelease');
  //   var drugsIdRelease = $(drugsId).attr('drugsIdRelease');
  //   var pharmacyIdRelease = $(drugsId).attr('pharmacyIdRelease');
  //   var releaseAll = $(drugsId).attr('releaseAll');

  //   $.ajax({
  //     type: 'POST',
  //     url: 'hub/pharmacy/my-pharmacy/models/releasemedications.php',
  //     data: {
  //       'prescriptionId': prescriptionIdRelease,
  //       'drugsId': drugsIdRelease,
  //       'releaseAll': releaseAll,
  //     },
  //     success: function(response, textStatus, jqXHR) {
  //       if (response.trim() == 1) {
  //         displayPrescription("<?php echo $_SESSION['pharmacyId'] ?>", "<?php echo $_SESSION['usrUsersId']; ?>", "<?php echo $_SESSION['rolesId']; ?>");
  //         $('#successfullyDispensed').html('<div class="alert alert-block alert-success" data-dismiss="alert" style="margin-left:50%;">' +
  //           '<button type="button" class="close">' +
  //           '&nbsp; <i class="ace-icon fa fa-times"></i>' +
  //           '</button>' +
  //           '<i class="ace-icon fa fa-check green"></i> &nbsp; Medication is successfully released. ' +
  //           '</div> ');
  //         //displayPharmacies("<?php echo $usrUsersId; ?>");
  //       } else {
  //         $('#successfullyDispensed').html('<div class="alert alert-block alert-warning" data-dismiss="alert" style="margin-left:50%;">' +
  //           '<button type="button" class="close">' +
  //           '&nbsp; <i class="ace-icon fa fa-times"></i>' +
  //           '</button>' +
  //           '<i class="ace-icon fa fa-warning green"></i> &nbsp; Medication is not released. ' +
  //           '</div> ');
  //       }
  //     }
  //   });
  // }
  //------------------------end of releasing medication form pharmacy---------------
  jQuery(function($) {
    if (localStorage.getItem("pharmacyAdded") == '0')
      displayDispensedMedications(<?php echo $_SESSION['pharmacyId']; ?>, <?php echo $_SESSION['usrUsersId']; ?>, <?php echo $_SESSION['rolesId']; ?>);

    $('.show-details-btn').on('click', function(e) {
      e.preventDefault();
      $(this).closest('tr').next().toggleClass('open');
      var $row = $(this).closest('tr').next();
      $row.closest('tr').next().toggleClass('open');
      $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
    });

    if (localStorage.getItem("pharmacyAdded") == '1')
      localStorage.setItem("pharmacyAdded", '0');
  });

  // function filter prescriptions
  // function display prescriptions
  //-----------------------------------------------------------
  var myPharmacyList;
  var pharmacyOwnerId = '<?php echo $usrUsersId; ?>';

  function pharmacistSearchBox() {
    var pharmacyOwnerId = '<?php echo $usrUsersId; ?>';
    $('#managePharmacistSave').hide();
    var dataDisplay1 = searchbox + '<span><h5 style="color:blue;width:100%; font-size:15px; padding-left:15%;"> Search, Select and Assign Pharmacisit to a Pharmacy .. </h5><br><br></span>';
    $.ajax({
      url: "hub/pharmacy/my-pharmacy/models/managePharmacist.php",
      data: {
        'pharmacyOwnerId': pharmacyOwnerId
      },
    }).done(function(data) {
      myPharmacyList = $.parseJSON(data);
    });
    var divId1 = "divAssignPharmacistSearch";
    $('#' + divId1).html(dataDisplay1);
    pharmacistListForAssignment();
  }
  //---------------------------------display pharmacist list for assignment-----------------------
  function pharmacistListForAssignment(search) {
    $.ajax({
      url: "hub/pharmacy/my-pharmacy/models/managePharmacist.php",
      data: {
        'search': search
      },
    }).done(function(data) {
      var result = $.parseJSON(data);
      var dataDisplay = '<tr><th>S/N</th><th title="Full Name" colspan="2">Name</th><th>Qualification</th><th>Address</th> <th>Licence No.</th> <th>Licence Expiry Date</th><th>Assign Pharmacy</th> <th style="width:1%;" > </th></tr>';
      var sn = 1;
      $.each(result, function(key, value) {
        dataDisplay += "<tr><td class='hiden-480'>" + sn + "</td><td colspan='2'> " + value['titleName'] + " " + value['firstName'] + " " + value['fatherName'] + " " + value['grandFatherName'] + "  (" + value['gender'] + "  ) </td> <td>" + value['qualification'] + "</td> <td>" + value['mobilePhone'] + "</td> <td>" + value['licenceNo'] + "</td><td>" + value['licenceExpirationDate'] + "</td>";
        dataDisplay += '<td> <select name="assignToPharmacyId[]">';
        $.each(myPharmacyList, function(key1, value1) {
          dataDisplay += '<option value="' + value1['pharmacyId'] + '">' + value1['pharmacyName'] + '</option>';
        });
        dataDisplay += '</select>  </td>';
        dataDisplay += '<td> <input type="checkbox" name="checkboxUsersId[]" selectUsersId="' + value['usersId'] + '" id="' + value['usersId'] + '"  value="0"  onclick="manageCheckBoxAssignUsers(this)"/> <input type="hidden" name="assignPharmacyAdminId[]" value="' + <?php echo $usrUsersId; ?> + '"/> <input type="hidden" name="rolesId[]" value="' + value['rolesId'] + '"/>  <input type="hidden" name="assignedUsersId[]" value="' + value['usersId'] + '"/></td>';
        dataDisplay += '</tr>';
        sn = sn + 1;
      });
      if (sn >= 1) {
        dataDisplay += '<tr style="background-color:white;" id="managePharmacistSave"><td colspan="10"><br> <button style="float:right;" class="btn btn-lg btn-success"  onclick="assignPharmacist();"> <i class ="ace-icon fa fa-plus">  </i>Assign</button></td> </tr > ';
      }
      var divId = "divAssignPharmacist";
      $('#' + divId).html(dataDisplay);
    });
  }
  //-----------------------------------------------------------
  function manageCheckBox(checkBox) {
    var boxId = $(checkBox).attr('boxId');
    //$("#"+boxId).attr('checked', 'false');
    var x = document.getElementById(boxId).value;
    if (x == 'Active')
      document.getElementById(boxId).value = 'Disabled';
    else if (x == 'Disabled')
      document.getElementById(boxId).value = 'Active';

  }


  function manageCheckBoxAssignUsers(selectedUsers) {


    var selectUsersId = $(selectedUsers).attr('selectUsersId');
    //$("#"+boxId).attr('checked', 'false');
    var x = document.getElementById(selectUsersId).value;

    if (x == 1)
      document.getElementById(selectUsersId).value = 0;
    else if (x == 0)
      document.getElementById(selectUsersId).value = 1;

  }
  //---------------------------------------_Assign pharmacist ----------------------
</script>

<?php if (isset($_SESSION['pharmacyId']) || $_SESSION['rolesId'] == 4) { ?>

  <div class="row">
    <div class="col-sm-12 widget-container-col" id="widget-container-col-10">
      <div class="widget-box" id="widget-box-10">
        <div class="widget-header widget-header-small">
          <h5 class="widget-title smaller"></h5>
          <?php include('views/headersList.php'); ?>

        </div>

        <div class="widget-body">
          <div class="widget-main padding-6">
            <div class="tab-content">
              <?php include('views/addnewPharmacy.php'); ?>
              <?php include('views/myPharmaciest.php'); ?>
              <?php include('views/dispensedMedications.php'); ?>
              <?php include('views/pharmacyLogs.php'); ?>
              <?php include('views/pharmacyList.php'); ?>



              <div id="myReports" class="tab-pane">
                <div class="row">
                  <div class="col-xs-12">
                    <form class="form-horizontal" role="form">
                      <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="food">Reports:</label>
                        <div class="col-xs-12 col-sm-9">
                          <select id="food" class="multiselect" multiple="">
                            <option value="cheese"> Dispensed Medication</option>
                            <option value="tomatoes">Physicians</option>
                            <option value="mozarella">Pharmacists</option>
                          </select>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <table id="divMyReports" class="table table-striped table-bordered table-hover">
                </table>
              </div>
              <?php include('views/dispensedPrescriptions.php'); ?>
              <?php include('views/postedPrescriptions.php'); ?>
              <?php include('views/acceptedPrescriptions.php'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } else {
?>
  <div class="alert alert-block alert-warning" style="margin-left:50%;">
    <button type="button" class="close">
      &nbsp; <i class="ace-icon fa fa-times"></i>
    </button>
    <i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; This page is for pharmacy owner with registered and approved Pharmacy or for pharmacist working in any active pharmacy in our system.
  </div>
<?php
} ?>

<script>
  $(document).ready(function() {
    $('#submitAddPharmacy').click(function(event) {
      $.ajax({
        method: 'post',
        dataType: 'html',
        url: 'hub/pharmacy/my-pharmacy/models/addpharmacy.php',
        data: {
          'pharmacyNameAdd': $('#pharmacyNameAdd').val(),
          'pharmacyTypeAdd': $('#pharmacyTypeAdd').val(),
          'licenceNumberAdd': $('#licenceNumberAdd').val(),
          'registrationNumberAdd': $('#registrationNumberAdd').val(),
          'countryAdd': $('#country').val(),
          'stateAdd': $('#state').val(),
          'zoneAdd': $('#zone').val(),
          'woredaAdd': $('#woreda').val(),
          'kebelleAdd': $('#kebelleAdd').val(),
          'streetNumberAdd': $('#streetNumberAdd').val(),
          'openingTimeAdd': $('#openingTimeAdd').val(),
          'closingTimeAdd': $('#closingTimeAdd').val(),
          'emailAdd': $('#emailAdd').val(),
          'phoneNumberAdd': $('#phoneNumberAdd').val(),

          'latitudeAdd': $('#lat').val(),
          'longitudeAdd': $('#lng').val(),
          'tinNumberAdd': $('#tinNumberAdd').val(),
          'regById': $('#regById').val(),
        },
        success: function(response, textStatus, jqXHR) {

          if (response.trim() == 1) {

            localStorage.setItem("pharmacyAdded", '1');

            location.reload(true);
          } else {
            $('#notAdded').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
              '<button type="button" class="close" data-dismiss="alert">' +
              '&nbsp; <i class="ace-icon fa fa-times"></i>' +
              '</button>' +
              '<i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; Fill all the attributes with * properly.' +
              '</div> ');

            $('#notAddedFooter').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
              '<button type="button" class="close" data-dismiss="alert">' +
              '&nbsp; <i class="ace-icon fa fa-times"></i>' +
              '</button>' +
              '<i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; Fill all the attributes with * properly' +
              '</div> ');

          }


        },
        error: function(jqXHR, textStatus, errorThrown) {
          var message = (jqXHR.status === 420) ?
            jqXHR.statusText :
            'An error occurred during your request. Please try again.';

          $('#result').html(message);
        },
        complete: function(jqXHR, textStatus) {

        }
      });
    });
  });

  if (localStorage.getItem("pharmacyAdded") == '1') {

    $("#divSearchPatient").hide();
    document.getElementById('divSearchPatient').style.display = 'none'

    document.getElementById('prescriptionDiv').style.visibility = "none";

    document.getElementById("activeMyPrescription").className = "";
    document.getElementById("activeAddPharmacy").className = "";
    document.getElementById("activeMyPharmacy").className = "active";
    document.getElementById("myPharmacy").className = "tab-pane in active";

    $('#successfullyAdded').html('<div class="alert alert-block alert-success" style="margin-left:50%;">' +
      '<button type="button" class="close" data-dismiss="alert">' +
      '&nbsp; <i class="ace-icon fa fa-times"></i>' +
      '</button>' +
      '<i class="ace-icon fa fa-check green"></i> &nbsp; New Pharmacy is Successfully Registered.' +
      '</div> ');

  }
  //--------------------------------------------
  var divMaps = <?php echo json_encode($arrayMapDiv); ?>;

  var arrayLat = <?php echo json_encode($arrayLat); ?>;
  var arrayLng = <?php echo json_encode($arrayLng); ?>;

  var arrayPharmacyName = <?php echo json_encode($arrayPharmacyName); ?>;
  var arrayPharmacyType = <?php echo json_encode($arrayPharmacyType); ?>;

  function myMap() {
    for (var i = 0; i < divMaps.length; i++) {
      var mapProp = {
        center: new google.maps.LatLng(arrayLat[i], arrayLng[i]),
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        //disableDefaultUI: true
      };
      var map = new google.maps.Map(document.getElementById(divMaps[i]), mapProp);
      new google.maps.Marker({
        position: new google.maps.LatLng(arrayLat[i], arrayLng[i]),
        map: map,
        title: arrayPharmacyName[i] + ' ' + arrayPharmacyType[i],
      });
    }
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIA2P9qeYtaXVPJHlGU5CF-mJNE8hpCV0&callback=myMap"></script>
<script type="text/javascript" src="../../js/map.js"></script>

<script src="../../js/jquery-2.1.4.min.js"></script>

<script src="hub/pharmacy/my-pharmacy/js/multiSelect.js"></script>
<script src="../../js/bootstrap-multiselect.min.js"></script>

<?php
include("hub/ui/popupModal.php");
?>