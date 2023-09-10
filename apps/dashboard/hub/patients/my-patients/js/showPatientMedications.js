async function showMedication(usersId) {
   $.ajax({
      url: "hub/common/deleteprescription.php",
      data: { usersIdDrugs: usersId },
   }).done( function (data) {
     var result = $.parseJSON(data);
     
      var dataDisplay =
         '<tr><th>S/N</th><th colspan="2"> Drug Name</th><th>Dose</th> <th style="width:8%;">Status</th> <th style="width:0.5%;"></th></tr>';
      var sn = 0;
      var presId = new Array(result.length);
      var i = 0;
      $.each(result, function (key, value) {
         presId[i] = value["prescriptionId"];
         i++;
      });
      var j = 0, k = 0;
      $.each(result, function (key, value) {
         var hash = "";
           $.ajax({
             url: "../../constants/security/hash.php",
             data: {
                contentForHash:
                   usersId + "" + value["status"] + "" + value["prescriptionId"],
             },
          }).done(function (data1) {
             hash = $.parseJSON(data1);
          });
            if (sn == 0 || presId[sn] != presId[sn - 1]) {
               j++;
               dataDisplay +=
                  "<tr style='background-color:#f9f9f9;'><td colspan='9' style='font-family: Times New Roman, Times, serif; font-style: italic;'><b>" +
                  j +
                  ") Prescription Number:</b> <u>EP-" +
                  value["prescriptionId"] +
                  "</u>,&nbsp;&nbsp;&nbsp;&nbsp;<b>Diagnosis:</b><u>" +
                  value["diagnosis"] +
                  "&nbsp;&nbsp;&nbsp;</u>,  <b>Chief Compliant:</b>  <u>" +
                  value["chiefCompliant"] +
                  " &nbsp; &nbsp;</u>, &nbsp;&nbsp;&nbsp;&nbsp; <b>Prescribed Date:</b><u>" +
                  value["prescriptionDate"] +
                  " </u>, &nbsp;&nbsp;&nbsp;&nbsp; <u style='margin-right:0%;' class='pull-right'>";
               if (value["status"] == "Returned")
                  dataDisplay +=
                     "<div class='action-buttons'><a href='?name=hub/prescriptions/prescribe/addprescription&var=prescriptions&Id=" +
                     usersId +
                     "&status=" +
                     value["status"] +
                     "&hash=" +
                     hash +
                     "&prescriptionId=" +
                     value["prescriptionId"] +
                     "' class='green bigger-140 show-details-btn-medic' title='Re-prescribe Returned Prescription' prescriptionId=" +
                     value["prescriptionId"] +
                     " id='drugInfo' onclick='returnPrescription(this);''><i class='ace-icon fa fa-angle-double-right mr-4' style='color:red;'></i></a></div>  </u>";
               else if (value["status"] == "Pending")
                  dataDisplay +=
                     "<div class='action-buttons'><a href='?name=hub/prescriptions/prescribe/addprescription&var=prescriptions&Id=" +
                     usersId +
                     "&status=" +
                     value["status"] +
                     "&hash=" +
                     hash +
                     "&prescriptionId=" +
                     value["prescriptionId"] +
                     "' class='warning bigger-140 show-details-btn-medic' title='Edit Pending Prescription' prescriptionId=" +
                     value["prescriptionId"] +
                     " id='drugInfo' onclick='pendingPrescription(this);''><i class='ace-icon fa fa-angle-double-right mr-4' style='color:yellew;'></i></a></div>  </u>";
               dataDisplay += "</td></tr>";

               k = 1;
            }
            dataDisplay +=
               "<tr><td class='hiden-480'>" +
               j +
               "." +
               k +
               "</td><td colspan='2'>" +
               value["drugsName"] +
               "</td> </td> </td> <td> " +
               value["drugsDose"] +
               " " +
               value["drugsDoseUnit"] +
               ", " +
               value["drugsFrequency"] +
               ", " +
               value["drugsRoute"] +
               ", " +
               value["drugsDuration"] +
               " " +
               value["drugsDurationUnit"] +
               ", totalQty=" +
               value["totalQty"] +
               "</td>";
            k++;
            var approvalIcon;
            if (value["status"] == "Dispensed") approvalIcon = "success";
            if (value["status"] == "Returned") approvalIcon = "danger";
            else approvalIcon = "warning";
            dataDisplay +=
               '<td> <span class="label label-sm label-' +
               approvalIcon +
               '">' +
               value["status"] +
               ' </span> </td><td class="center"><div class="action-buttons"><a href="#modal-table" class="green bigger-140 show-details-btn-medic" title="Show Other Details for Prescription No: ' +
               value["prescriptionId"] +
               '" data-toggle="modal" prescriptionId1=' +
               value["prescriptionId"] +
               " drugsId1=" +
               value["drugsId"] +
               '  onclick="showOtherDetails(this);"><i class="ace-icon fa fa-angle-double-down"></i></a></div>';
            dataDisplay += "</td></tr>";
            sn = sn + 1;
         
      });

      var divId = "medicationDiv" + usersId;
      $("#" + divId).html(dataDisplay);
   });
}
