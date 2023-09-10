function displayDispensedMedications(selectedPharmacyId, usersId, rolesId) {
  $.ajax({
    url: "hub/pharmacy/my-pharmacy/models/dispensedmedications.php", data: { 'selectedPharmacyId': selectedPharmacyId, 'rolesId': rolesId, 'usersId': usersId },
  }).done(function (data) {
    var result = $.parseJSON(data);
    var dataDisplay;
    var sn = 0;
    if (result.length == 0) {
      $('#noDispensedMedication').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
        '<button type="button" class="close">' +
        '&nbsp; <i class="ace-icon fa fa-times" data-dismiss="alert"></i>' +
        '</button>' +
        '<i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; There is no Dispensed Medications for pharmacy: ' +
        '</div> ');
    } else {
      dataDisplay = '<tr><th>S/N</th><th colspan="2"> Drug Name</th><th>totalQty</th><th>Prescription#</th><th>Dispensed Date</th> <th>Dispensed By</th> <th style="width:0.5%;"></th></tr>';
    }
    $.each(result, function (key, value) {
      sn++;

      dataDisplay += "<tr><td>" + sn + "</td><td colspan='2'>" + value['drugsName'] + "</td> <td> " + value['totalQty'] + "</td><td>" + value['prescriptionId'] + "</td><td>" + value['dispensedDate'] + "</td><td>" + value['userName'] + "</td>";
      dataDisplay += '<td class="center"><div class="action-buttons"><a href="#modal-table" class="green bigger-140 show-details-btn-medic" title="Show Other Details for Prescription No: ' + value['prescriptionId'] + '" data-toggle="modal" prescriptionId1=' + value['prescriptionId'] + ' drugsId1=' + value['drugsId'] + '  onclick="showOtherDetails(this);"><i class="ace-icon fa fa-angle-double-down"></i></a></div></td></tr>';
    });


    $("#dispensedMedicationsTable").html(dataDisplay);
  });
}
//-----------------------------end of display dispensed medications -------------------


//------------------------display pharmacy log history -------------------------------
function displayPharmacyLogs(selectedPharmacyId, usersId, searchButtonClick = 0) {

  var toDate = '';
  var fromDate = '';
  var pharmacy = '';
  var pharmacist = '';
  var medication = '';

  var logType = '';


  if (searchButtonClick == 1) {

    toDate = document.getElementById('filterLogPharmacyToDate').value;
    fromDate = document.getElementById('filterLogPharmacyFromDate').value;

    var logType = $("input[name=statusLog]:checked").val();
  }

  $.ajax({
    url: "hub/pharmacy/my-pharmacy/models/pharmacyLogs.php", data: { 'selectedPharmacyIdForPharmacistManagement': selectedPharmacyId, 'usersId': usersId, 'fromDate': fromDate, 'toDate': toDate, 'logType': logType },
  }).done(function (data) {
    var result = $.parseJSON(data);
    var dataDisplay;
    var sn = 0;
    if (result.length == 0) {
      $('#pharmacyLogsTable').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
        '<button type="button" class="close">' +
        '&nbsp; <i class="ace-icon fa fa-times" data-dismiss="alert"></i>' +
        '</button>' +
        '<i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; There is no log history, filter your searching properly.' +
        '</div> ');
    } else {
      dataDisplay = '<tr><th>S/N</th><th colspan="2"> Action</th><th>Action Date</th></tr>';
    }
    if (logType == 1 || logType == '') {
      $.each(result, function (key, value) {
        sn++;
        dataDisplay += "<tr><td>" + sn + "</td><td colspan='2'> <u>" + value['pharmacyName'] + " (" + value['pharmacyType'] + ")</u></b> is changed to <b>" + value['status'] + " </b></td> <td>" + value['actionDate'] + "</td></tr>";
      });
    } else if (logType == 2) {
      $.each(result, function (key, value) {
        sn++;
        dataDisplay += "<tr><td>" + sn + "</td><td colspan='2'> Access privillege to <u>" + value['pharmacyName'] + " (" + value['pharmacyType'] + ")</u>  for pharmacist <b>" + value['firstName'] + " " + value['fatherName'] + " " + value['grandFatherName'] + " (userName: " + value['userName'] + ")</b> is changed to <b>" + value['status'] + " </b></td> <td>" + value['actionDate'] + "</td></tr>";
      });
    } else if (logType == 3) {
      $.each(result, function (key, value) {
        sn++;
        dataDisplay += "<tr><td>" + sn + "</td><td colspan='2'> Drug Name:<u>" + value['drugsName'] + " is released from  " + value['pharmacyName'] + "(" + value['pharmacyType'] + ")</u>  by pharmacist <b>" + value['firstName'] + " " + value['fatherName'] + " " + value['grandFatherName'] + " (userName: " + value['userName'] + ")</b> </td> <td>" + value['actionDate'] + "</td></tr>";
      });
    }
    $("#pharmacyLogsTable").html(dataDisplay);
  });
}
//-----------------------enabling and disabling active pharmacy by pharmacy owner ----
function manageCheckBoxPharmacy(checkBox) {
  var boxId = $(checkBox).attr('boxIdPharmacy');
  var x = document.getElementById(boxId).value;
  if (x == 'Active')
    document.getElementById(boxId).value = 'Disabled';
  else if (x == 'Disabled')
    document.getElementById(boxId).value = 'Active';
}
//-----------------------enabling and disabling active pharmacy by pharmacy owner ----
//-------------------------Manage pharmacy --------------------
function managePharmacy() {
  alert("Are you sure you want to manage your pharmacy?");

  var pharmacyId = $('input[name="managedPharmacyId[]"]').map(function () {
    return this.value;
  }).get();
  var checkBox = $('input[name="pharmacyStatus[]"]').map(function () {
    return this.value;
  }).get();

  $.ajax({
    type: 'POST',
    url: 'hub/pharmacy/my-pharmacy/models/managePharmacy.php',
    data: {
      'pharmacyId[]': pharmacyId,
      'checkBox[]': checkBox,
    },
    success: function () {
      $('#successfullyAdded').html('<div class="alert alert-block alert-success" data-dismiss="alert" style="margin-left:50%;">' +
        '<button type="button" class="close">' +
        '&nbsp; <i class="ace-icon fa fa-times"></i>' +
        '</button>' +
        '<i class="ace-icon fa fa-check green"></i> &nbsp; Pharmacies are successfully managed ' +
        '</div> ');
    }
  });
}