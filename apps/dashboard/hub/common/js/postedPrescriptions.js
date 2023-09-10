//---------------------------------display posted uploaded prescriptions---------

function displayPostedUploadedPrescriptions(pharmacyId, pharmacistId) {

  $.ajax({
    url: "hub/pharmacy/my-pharmacy/models/displaypostedprescriptions.php", data: { 'pharmacyId': pharmacyId, 'pharmacistId': pharmacistId, 'actionType': 'Posted' },
  }).done(function (data) {

    var result = $.parseJSON(data);

    var sn = 0;
    if (result.length == 0) {
      $('#postedPrescriptionsBody').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
        '<button type="button" class="close">' +
        '&nbsp; <i class="ace-icon fa fa-times"></i>' +
        '</button>' +
        '<i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; There is no new posted prescriptions' +
        '</div> ');

    } else {


      var dataDisplay = '<table id="example" class="table table-stripped table-bordered table-hover">' +
        '<thead>' +
        '<tr>' +
        '<th>S/N</th>' +
        '<th>Profile</th>' +
        '<th>Full name</th>' +
        '<th>Gender</th>' +
        '<th>Mobile Phone</th>' +
        '<th>Email</th>' +
        '<th>Req. Date</th>' +
        '<th>Prescription</th>' +
        '<th title=" Distance from client to pharmacy">Km</th>' +

        '</tr>' +
        '</thead>' +

        '<tbody>';



      $.each(result, function (key, value) {

        sn = sn + 1;

        dataDisplay += '<tr>' +

          '<td>' + sn + '</td>' +
          '<td>' +
          '<a href="#" data-toggle="modal" data-target="#view_profile_pic' + value['usersId'] + '">' +
          '<div style="width:30px; height:30px;" >' +
          '<img   style="border:2px solid #C9D6E5;border-radius:100%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;" src="../../images/profile_pic/' + value['profilePicture'] + '"  />' +
          '</div>' +
          '</a>' +


          '<div id="view_profile_pic' + value['usersId'] + '" class="modal fade" role="dialog">' +
          '<div class="modal-dialog">' +

          '<div class="modal-content">' +
          '<img width="90%" height="90%" alt="profile picture" src="../../images/profile_pic/' + value['profilePicture'] + '" />' +
          '<div class="modal-footer">' +
          '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>' +
          '</div>' +
          '</div>' +

          '</div>' +
          '</div>' +


          '</td>' +
          '<td>' + value['firstName'] + ' ' + value['fatherName'] + ' ' + value['grandFatherName'] + '</td>' +
          '<td>' + value['gender'] + '</td>' +
          '<td>' + value['mobilePhone'] + '</td>' +
          '<td>' + value['email'] + '</td>' +
          '<td>' + value['addedDate'] + '</td>' +
          '<td>' +
          '<a href="#" data-toggle="modal" data-target="#viewUploadedPrescription' + value['uploadedPrescriptionsId'] + '">' +
          '<div style="width:60px; height:30px;" >' +
          '<img   style="border:2px solid #C9D6E5;border-radius:50%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;"  src="../../files/providersDocuments/uploadedprescriptions/' + value['imageName'] + '"  />' +
          '</div>' +
          '</a>' +

          '<div id="viewUploadedPrescription' + value['uploadedPrescriptionsId'] + '" class="modal" role="dialog">' +
          '<div class="modal-dialog">' +
          '<div class="modal-content">' +
          '<img width="90%" height="90%" alt="Uploaded Prescription" src="../../files/providersDocuments/uploadedprescriptions/' + value['imageName'] + '" />' +
          '<div class="widget-box col-sm-12" id="widget-box-12">' +
          '<div class="widget-body">' +
          '<div class="widget-main alert alert-info">' +
          '<br><b>Client Comment:</b> ' + value['comment'] + ' ' +

          '</div>' +

          '</div>' +
          '</div>' +
          '<div class="modal-footer">' +
          '<button type="button" onclick="acceptPostedPerscriptions(this);" uploadedPrescriptionsIdAccept="' + value['uploadedPrescriptionsId'] + '"  pharmacyIdAccept="' + value['pharmacyId'] + '" distanceFromRequesterAccept="' + value['distance'] + '"  pharmacistIdAccept="' + pharmacistId + '"    title="click here to confirm medication is available and notify the client to collect medications" class="btn btn-success" data-dismiss="modal">Accept</button>' +
          '<button type="button"  onclick="releasePostedPerscriptions(this)"  uploadedPrescriptionsIdPostedPrescription="' + value['uploadedPrescriptionsId'] + '"  pharmacyIdposted="' + value['pharmacyId'] + '"  pharmacistIdPosted="' + pharmacistId + '"   title="click here to clear the request" class="btn btn-warning" data-dismiss="modal">Release</button>' +
          '<button type="button" title="click here to close the opened window" class="btn btn-danger" data-dismiss="modal">Close</button>' +
          '</div>' +
          '</div>' +

          '</div>' +
          '</div>' +

          '</td>' +
          '<td>' + value['distance'] + '</td>' +

          '</tr>';

      });
      dataDisplay += '</tbody>' +
        '</table>';


      var divId = "postedPrescriptionsBody";

      $('#' + divId).html(dataDisplay);
    }

  });


}

//--------------------------------end of display posted uploaded prescriptions---------



//---------------------------------display posted uploaded prescriptions---------

function displayAcceptedPostedPrescriptions(pharmacyId, pharmacistId) {

  $.ajax({
    url: "hub/pharmacy/my-pharmacy/models/displaypostedprescriptions.php", data: { 'pharmacyId': pharmacyId, 'pharmacistId': pharmacistId, 'actionType': 'Accepted' },
  }).done(function (data) {

    var result = $.parseJSON(data);

    var sn = 0;

    if (result.length == 0) {
      $('#acceptedPrescriptionsBody').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
        '<button type="button" class="close">' +
        '&nbsp; <i class="ace-icon fa fa-times"></i>' +
        '</button>' +
        '<i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; There is no new Accepted prescriptions' +
        '</div> ');

    } else {

      var dataDisplay = '<table id="example" class="table table-stripped table-bordered table-hover">' +
        '<thead>' +
        '<tr>' +
        '<th>S/N</th>' +
        '<th>Profile</th>' +
        '<th>Full name</th>' +
        '<th>Gender</th>' +
        '<th>Mobile Phone</th>' +
        '<th>Email</th>' +
        '<th>Req. Date</th>' +
        '<th>Prescription</th>' +
        '<th title=" Distance from client to pharmacy">Km</th>' +

        '</tr>' +
        '</thead>' +

        '<tbody>';



      $.each(result, function (key, value) {

        sn = sn + 1;

        dataDisplay += '<tr>' +

          '<td>' + sn + '</td>' +
          '<td>' +
          '<a href="#" data-toggle="modal" data-target="#view_profile_pic' + value['usersId'] + '">' +
          '<div style="width:30px; height:30px;" >' +
          '<img   style="border:2px solid #C9D6E5;border-radius:100%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;" src="../../images/profile_pic/' + value['profilePicture'] + '"  />' +
          '</div>' +
          '</a>' +


          '<div id="view_profile_pic' + value['usersId'] + '" class="modal fade" role="dialog">' +
          '<div class="modal-dialog">' +

          '<div class="modal-content">' +
          '<img width="90%" height="90%" alt="profile picture" src="../../images/profile_pic/' + value['profilePicture'] + '" />' +
          '<div class="modal-footer">' +
          '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>' +
          '</div>' +
          '</div>' +

          '</div>' +
          '</div>' +


          '</td>' +
          '<td>' + value['firstName'] + ' ' + value['fatherName'] + ' ' + value['grandFatherName'] + '</td>' +
          '<td>' + value['gender'] + '</td>' +
          '<td>' + value['mobilePhone'] + '</td>' +
          '<td>' + value['email'] + '</td>' +
          '<td>' + value['actionDate'] + '</td>' +
          '<td>' +
          '<a href="#" data-toggle="modal" data-target="#viewUploadedPrescription' + value['uploadedPrescriptionsId'] + '">' +
          '<div style="width:60px; height:30px;" >' +
          '<img   style="border:2px solid #C9D6E5;border-radius:50%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;"  src="../../files/providersDocuments/uploadedprescriptions/' + value['imageName'] + '"  />' +
          '</div>' +
          '</a>' +

          '<div id="viewUploadedPrescription' + value['uploadedPrescriptionsId'] + '" class="modal" role="dialog">' +
          '<div class="modal-dialog">' +
          '<div class="modal-content">' +
          '<img width="90%" height="90%" alt="Uploaded Prescription" src="../../files/providersDocuments/uploadedprescriptions/' + value['imageName'] + '" />' +
          '<div class="widget-box col-sm-12" id="widget-box-12">' +
          '<div class="widget-body">' +
          '<div class="widget-main alert alert-info">' +
          '<br><b>Client Comment:</b> ' + value['comment'] + ' ' +

          '</div>' +

          '</div>' +
          '</div>' +
          '<div class="modal-footer">' +
          '<button type="button" onclick="dispenseAcceptedPerscriptions(this);" uploadedPrescriptionsIdDispenseAcceptedPrescription="' + value['uploadedPrescriptionsId'] + '"  pharmacyIdDispenseAccepted="' + value['pharmacyId'] + '"  pharmacistIdDispenseAccepted="' + pharmacistId + '"    title="click here to dispense medication from store for client" class="btn btn-success" data-dismiss="modal">Dispense</button>' +
          '<button type="button"  onclick="releaseAcceptedPerscriptions(this)"  uploadedPrescriptionsIdReleaseAcceptedPrescription="' + value['uploadedPrescriptionsId'] + '"  pharmacyIdReleaseAccepted="' + value['pharmacyId'] + '"  pharmacistIdReleaseAccepted="' + pharmacistId + '"   title="click here to release the request, incase you accept the medication request by mistake or other reason" class="btn btn-warning" data-dismiss="modal">Release</button>' +
          '<button type="button" title="click here to close the opened window" class="btn btn-danger" data-dismiss="modal">Close</button>' +
          '</div>' +
          '</div>' +

          '</div>' +
          '</div>' +

          '</td>' +
          '<td>' + value['distance'] + '</td>' +

          '</tr>';

      });
      dataDisplay += '</tbody>' +
        '</table>';


      var divId = "acceptedPrescriptionsBody";

      $('#' + divId).html(dataDisplay);
    }

  });


}

//--------------------------------end of display posted accepted uploaded prescriptions---------

//----------------------releasePostedPerscriptions -----------------

function releasePostedPerscriptions(id) {

  var uploadedPrescriptionsId = $(id).attr('uploadedPrescriptionsIdPostedPrescription');
  var pharmacyId = $(id).attr('pharmacyIdposted');
  var pharmacistId = $(id).attr('pharmacistIdPosted');
  $.ajax({
    type: 'POST',
    url: 'dashboard/mypharmacy/postedprescriptions.php',
    data: {
      'uploadedPrescriptionsId': uploadedPrescriptionsId,
      'pharmacyId': pharmacyId,
      'pharmacistId': pharmacistId,
      'actionType': "release"
      // other data
    },
    success: function (response, textStatus, jqXHR) {



      if (response.trim() == 0) {

        $('#postedPrescriptionsNotifications').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
          '<button type="button" class="close" data-dismiss="alert">' +
          '&nbsp; <i class="ace-icon fa fa-times"></i>' +
          '</button>' +
          '<i class="ace-icon fa fa-warning red"></i> &nbsp; Prescription is not released. Please try again.' +
          '</div> ');

      }
      else {

        var pharmacyId1 = $.parseJSON(response)[0];
        var pharmacistId1 = $.parseJSON(response)[1];
        var postedCounter = $.parseJSON(response)[2];
        var acceptedCounter = $.parseJSON(response)[3];

        $('#postedPrescriptionCounter').html(postedCounter - 1);
        $('#acceptedPrescriptionCounter').html(acceptedCounter);


        $('#postedPrescriptionsNotifications').html('<div class="alert alert-block alert-success" style="margin-left:50%;">' +
          '<button type="button" class="close" data-dismiss="alert">' +
          '&nbsp; <i class="ace-icon fa fa-times"></i>' +
          '</button>' +
          '<i class="ace-icon fa fa-check green"></i> &nbsp; Successfully Released.' +
          '</div> ');

        displayPostedUploadedPrescriptions(pharmacyId1, pharmacistId1);


      }



    }


  });


}


//----------------------end of releasePostedPerscriptions ----------


//----------------------acceptedPostedPerscriptions -----------------

function acceptPostedPerscriptions(id) {

  var uploadedPrescriptionsId = $(id).attr('uploadedPrescriptionsIdAccept');
  var pharmacyId = $(id).attr('pharmacyIdAccept');
  var pharmacistId = $(id).attr('pharmacistIdAccept');
  var distanceFromRequester = $(id).attr('distanceFromRequesterAccept');

  $.ajax({
    type: 'POST',
    url: 'dashboard/mypharmacy/postedprescriptions.php',
    data: {
      'uploadedPrescriptionsId': uploadedPrescriptionsId,
      'pharmacyId': pharmacyId,
      'pharmacistId': pharmacistId,
      'distanceFromRequester': distanceFromRequester,
      'actionType': "accept"
      // other data
    },
    success: function (response, textStatus, jqXHR) {

      if (response.trim() == 0) {

        $('#postedPrescriptionsNotifications').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
          '<button type="button" class="close" data-dismiss="alert">' +
          '&nbsp; <i class="ace-icon fa fa-times"></i>' +
          '</button>' +
          '<i class="ace-icon fa fa-warning red"></i> &nbsp; Transaction Rolledback. Please try again.' +
          '</div> ');

      }
      else {

        var pharmacyId1 = $.parseJSON(response)[0];
        var pharmacistId1 = $.parseJSON(response)[1];
        var postedCounter = $.parseJSON(response)[2];
        var acceptedCounter = $.parseJSON(response)[3];

        $('#postedPrescriptionCounter').html(postedCounter - 1);
        $('#acceptedPrescriptionCounter').html(parseInt(acceptedCounter) + 1);

        $('#postedPrescriptionsNotifications').html('<div class="alert alert-block alert-success" style="margin-left:50%;">' +
          '<button type="button" class="close" data-dismiss="alert">' +
          '&nbsp; <i class="ace-icon fa fa-times"></i>' +
          '</button>' +
          '<i class="ace-icon fa fa-check green"></i> &nbsp; Successfully Accepted.' +
          '</div> ');

        displayPostedUploadedPrescriptions(pharmacyId1, pharmacistId1);



      }

    }


  });


}


//----------------------end of releasePostedPerscriptions ----------




//----------------------releaseAcceptedPerscriptions -----------------

function releaseAcceptedPerscriptions(id) {

  var uploadedPrescriptionsId = $(id).attr('uploadedPrescriptionsIdReleaseAcceptedPrescription');
  var pharmacyId = $(id).attr('pharmacyIdReleaseAccepted');
  var pharmacistId = $(id).attr('pharmacistIdReleaseAccepted');
  $.ajax({
    type: 'POST',
    url: 'dashboard/mypharmacy/acceptedprescriptions.php',
    data: {
      'uploadedPrescriptionsId': uploadedPrescriptionsId,
      'pharmacyId': pharmacyId,
      'pharmacistId': pharmacistId,
      'actionType': "release"
      // other data
    },
    success: function (response, textStatus, jqXHR) {



      if (response.trim() == 0) {

        $('#acceptedPrescriptionsNotifications').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
          '<button type="button" class="close" data-dismiss="alert">' +
          '&nbsp; <i class="ace-icon fa fa-times"></i>' +
          '</button>' +
          '<i class="ace-icon fa fa-warning red"></i> &nbsp; Prescription is not released. Please try again.' +
          '</div> ');

      }
      else {

        var pharmacyId1 = $.parseJSON(response)[0];
        var pharmacistId1 = $.parseJSON(response)[1];

        var postedCounter = $.parseJSON(response)[2];
        var acceptedCounter = $.parseJSON(response)[3];

        $('#postedPrescriptionCounter').html(postedCounter);
        $('#acceptedPrescriptionCounter').html(acceptedCounter - 1);

        //alert ("Are you sure you want to Release?")


        $('#acceptedPrescriptionsNotifications').html('<div class="alert alert-block alert-success" style="margin-left:50%;">' +
          '<button type="button" class="close" data-dismiss="alert">' +
          '&nbsp; <i class="ace-icon fa fa-times"></i>' +
          '</button>' +
          '<i class="ace-icon fa fa-check green"></i> &nbsp; Successfully Released.' +
          '</div> ');

        displayAcceptedPostedPrescriptions(pharmacyId1, pharmacistId1);


      }



    }


  });


}


//----------------------end of releasePostedPerscriptions ----------


//----------------------dispenseAcceptedPerscriptions -----------------

function dispenseAcceptedPerscriptions(id) {

  var uploadedPrescriptionsId = $(id).attr('uploadedPrescriptionsIdDispenseAcceptedPrescription');
  var pharmacyId = $(id).attr('pharmacyIdDispenseAccepted');
  var pharmacistId = $(id).attr('pharmacistIdDispenseAccepted');
  $.ajax({
    type: 'POST',
    url: 'dashboard/mypharmacy/acceptedprescriptions.php',
    data: {
      'uploadedPrescriptionsId': uploadedPrescriptionsId,
      'pharmacyId': pharmacyId,
      'pharmacistId': pharmacistId,
      'actionType': "dispense"
      // other data
    },
    success: function (response, textStatus, jqXHR) {



      if (response.trim() == 0) {

        $('#acceptedPrescriptionsNotifications').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
          '<button type="button" class="close" data-dismiss="alert">' +
          '&nbsp; <i class="ace-icon fa fa-times"></i>' +
          '</button>' +
          '<i class="ace-icon fa fa-warning red"></i> &nbsp; Prescription is not dispensed. Please try again.' +
          '</div> ');

      }
      else {

        var pharmacyId1 = $.parseJSON(response)[0];
        var pharmacistId1 = $.parseJSON(response)[1];

        var postedCounter = $.parseJSON(response)[2];
        var acceptedCounter = $.parseJSON(response)[3];

        $('#postedPrescriptionCounter').html(postedCounter);
        $('#acceptedPrescriptionCounter').html(acceptedCounter - 1);

        //alert ("Are you sure you want to Release?")


        $('#acceptedPrescriptionsNotifications').html('<div class="alert alert-block alert-success" style="margin-left:50%;">' +
          '<button type="button" class="close" data-dismiss="alert">' +
          '&nbsp; <i class="ace-icon fa fa-times"></i>' +
          '</button>' +
          '<i class="ace-icon fa fa-check green"></i> &nbsp; Successfully Dispensed.' +
          '</div> ');

        displayAcceptedPostedPrescriptions(pharmacyId1, pharmacistId1);


      }



    }


  });


}


//----------------------end of releasePostedPerscriptions ----------




//---------------------------------display posted uploaded prescriptions---------

function displayDispensedPostedPrescriptions(pharmacyId) {

  $.ajax({
    url: "hub/pharmacy/my-pharmacy/models/displaypostedprescriptions.php", data: { 'pharmacyId': pharmacyId, 'actionType': 'Dispensed' },
  }).done(function (data) {

    var result = $.parseJSON(data);

    var sn = 0;

    if (result.length == 0) {
      $('#dispensedPrescriptionsBody').html('<div class="alert alert-block alert-warning" style="margin-left:50%;">' +
        '<button type="button" class="close">' +
        '&nbsp; <i class="ace-icon fa fa-times"></i>' +
        '</button>' +
        '<i class="ace-icon fa fa-exclamation-circle red"></i> &nbsp; There is no new Dispensed prescriptions' +
        '</div> ');

    } else {

      var dataDisplay = '<table id="example" class="table table-stripped table-bordered table-hover">' +
        '<thead>' +
        '<tr>' +
        '<th>S/N</th>' +
        '<th>Profile</th>' +
        '<th>Full name</th>' +
        '<th>Gender</th>' +
        '<th>Mobile Phone</th>' +
        '<th>Email</th>' +
        '<th>Req. Date</th>' +
        '<th>Prescription</th>' +
        '<th title=" Distance from client to pharmacy">Km</th>' +

        '</tr>' +
        '</thead>' +

        '<tbody>';



      $.each(result, function (key, value) {

        sn = sn + 1;

        dataDisplay += '<tr>' +

          '<td>' + sn + '</td>' +
          '<td>' +
          '<a href="#" data-toggle="modal" data-target="#view_profile_pic' + value['usersId'] + '">' +
          '<div style="width:30px; height:30px;" >' +
          '<img   style="border:2px solid #C9D6E5;border-radius:100%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;" src="../../images/profile_pic/' + value['profilePicture'] + '"  />' +
          '</div>' +
          '</a>' +


          '<div id="view_profile_pic' + value['usersId'] + '" class="modal fade" role="dialog">' +
          '<div class="modal-dialog">' +

          '<div class="modal-content">' +
          '<img width="90%" height="90%" alt="profile picture" src="../../images/profile_pic/' + value['profilePicture'] + '" />' +
          '<div class="modal-footer">' +
          '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>' +
          '</div>' +
          '</div>' +

          '</div>' +
          '</div>' +


          '</td>' +
          '<td>' + value['firstName'] + ' ' + value['fatherName'] + ' ' + value['grandFatherName'] + '</td>' +
          '<td>' + value['gender'] + '</td>' +
          '<td>' + value['mobilePhone'] + '</td>' +
          '<td>' + value['email'] + '</td>' +
          '<td>' + value['actionDate'] + '</td>' +
          '<td>' +
          '<a href="#" data-toggle="modal" data-target="#viewUploadedPrescription' + value['uploadedPrescriptionsId'] + '">' +
          '<div style="width:60px; height:30px;" >' +
          '<img   style="border:2px solid #C9D6E5;border-radius:50%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;"  src="../../files/providersDocuments/uploadedprescriptions/' + value['imageName'] + '"  />' +
          '</div>' +
          '</a>' +

          '<div id="viewUploadedPrescription' + value['uploadedPrescriptionsId'] + '" class="modal" role="dialog">' +
          '<div class="modal-dialog">' +
          '<div class="modal-content">' +
          '<img width="90%" height="90%" alt="Uploaded Prescription" src="../../files/providersDocuments/uploadedprescriptions/' + value['imageName'] + '" />' +
          '<div class="widget-box col-sm-12" id="widget-box-12">' +
          '<div class="widget-body">' +
          '<div class="widget-main alert alert-info">' +
          '<br><b>Client Comment:</b> ' + value['comment'] + ' ' +

          '</div>' +

          '</div>' +
          '</div>' +
          '<div class="modal-footer">' +

          '<button type="button" title="click here to close the opened window" class="btn btn-danger" data-dismiss="modal">Close</button>' +
          '</div>' +
          '</div>' +

          '</div>' +
          '</div>' +

          '</td>' +
          '<td>' + value['distance'] + '</td>' +

          '</tr>';

      });
      dataDisplay += '</tbody>' +
        '</table>';


      var divId = "dispensedPrescriptionsBody";

      $('#' + divId).html(dataDisplay);
    }

  });


}

//--------------------------------end of display posted accepted uploaded prescriptions---------
