function showOtherDetails(drugsId1) {
  var dispenseAll1 = 2;
  var prescriptionId = $(drugsId1).attr("prescriptionId1");
  var drugsId = $(drugsId1).attr("drugsId1");
  $.ajax({
    url: "hub/common/deleteprescription.php",
    data: {
      prescriptionDetailsId: prescriptionId,
      prescriptionDrugsId: drugsId,
      dispenseAll: dispenseAll1,
    },
  }).done(function (data) {
    var result = $.parseJSON(data);
    var dataDisplay;
    $.each(result, function (key, value) {
      var approvalIcon;
      if (value["status"] == "Dispensed") approvalIcon = "success";

      if (value["status"] == "Returned") approvalIcon = "danger";
      else approvalIcon = "warning";

      dataDisplay +=
        "<tr><td>Prescription No.</td><td>" +
        value["prescriptionId1"] +
        "</td></tr><tr><td>Prescription Date</td><td>" +
        value["prescriptionDate"] +
        "</td></tr>  <tr><td>Diagnosis</td><td>" +
        value["diagnosis"] +
        "</td></tr><tr><td>Drug Name</td><td>" +
        value["drugsName"] +
        "</td></tr><tr><td>Dose</td><td>" +
        value["drugsDose"] +
        " " +
        value["drugsDoseUnit"] +
        ", " +
        value["drugsFrequency"] +
        ", times a " +
        ", " +
        value["drugsRoute"] +
        ", " +
        value["drugsDuration"] +
        " " +
        value["drugsDurationUnit"] +
        ", totalQty: " +
        value["totalQty"] +
        "</td></tr><tr><td>Drug Instructions</td><td>" +
        value["drugsInstructions"] +
        "</td></tr><tr><td>Additional Instructions</td><td>" +
        value["drugsAdditionalInstructions"] +
        "</td></tr><tr><td>Dispense Status</td><td> <span class='label label-sm label-" +
        approvalIcon +
        "' >" +
        value["status"] +
        "</span> <a href='' class='green' onclick='update("+prescriptionId+")'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i></a> </td></tr><tr><td>Physician Name</td><td>" +
        value["firstName"] +
        "  " +
        value["fatherName"] +
        "  " +
        value["grandFatherName"] +
        "</td></tr>";

      if (value["status"] == "Returned") {
          dataDisplay += "<tr><td>Comment</td><td>" +
        value["comment"] +
        "</td></tr> ";
      }

      dataDisplay += "</tr>";
    });

    $("#modalHeader").html("Prescription Details");
    document.getElementById("otherDetails").className =
      "table table-striped table-bordered table-hover";
    $("#otherDetails").html(dataDisplay);
  });
}

function update(prescriptionId){

    $.ajax({
    url: "hub/common/deleteprescription.php",
    data: { prescriptionId: prescriptionId, returnEdit:true },
  })
}
function showPharmacistDetails(usersId1) {
  var usersId = $(usersId1).attr("usersId1");

  $.ajax({
    url: "hub/common/deleteprescription.php",
    data: { usersId: usersId },
  }).done(function (data) {
    var result = $.parseJSON(data);
    var dataDisplay;
    $.each(result, function (key, value) {
      dataDisplay +=
        "<tr><td>Full Name</td><td>" +
        value["titleName"] +
        " " +
        value["firstName"] +
        " " +
        value["fatherName"] +
        " " +
        value["grandFatherName"] +
        "</td></tr><tr><td>Date of Birth</td><td>" +
        value["dateOfBirth"] +
        ", Gender: " +
        value["gender"] +
        " </td></tr><tr><td>Email Address</td><td>" +
        value["email"] +
        " </td></tr><tr><td>Phone No:</td><td>Mobile No: " +
        value["mobilePhone"] +
        "&nbsp; &nbsp; Office Phone No:" +
        value["officePhone"] +
        "</td></tr><tr><td>Qualification</td><td>" +
        value["qualification"] +
        "</td></tr><tr><td>Graduated From:</td><td><u>" +
        value["graduatedFrom"] +
        "</u>, Graduation Year:" +
        value["graduationYear"] +
        "</td></tr><tr><td>Educational Level</td><td>" +
        value["educationLevelName"] +
        "</td></tr>";

      dataDisplay += "</tr>";
    });

    $("#modalHeader").html("Pharmacist Details ..");
    document.getElementById("otherDetails").className =
      "table table-striped table-bordered table-hover";
    $("#otherDetails").html(dataDisplay);
  });
}