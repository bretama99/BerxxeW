function showMedication(usersId, physcianId) {

   $.ajax({
      url: "hub/common/deleteprescription.php", data: { 'usersIdMyPrescription': usersId, 'physcianId': physcianId },
   }).done(function (data) {

      var result = $.parseJSON(data);

      var dataDisplay = '<tr><th>S/N</th><th colspan="2"> Drug Name</th><th>Dose</th> <th style="width:8%;">Status</th> <th style="width:0.5%;"></th></tr>';

      //from result create a string of data and append to the div
      var sn = 0;

      var presId = new Array(result.length);
      var i = 0;

      $.each(result, function (key, value) {
         presId[i] = value['prescriptionId'];
         i++;
      });

      var j = 0, k = 0;
      $.each(result, function (key, value) {

         //alert ( "presId"+presId[sn] +", PresId-1"+presId[sn-1]);
         //prescN1=presId[sn-1];

         if (sn == 0 || (presId[sn] != presId[sn - 1])) {

            j++;
            dataDisplay += "<tr style='background-color:#f9f9f9;'><td   colspan='9' style='font-family: Times New Roman, Times, serif; font-style: italic;'><b>" + j + ") Prescription Number:</b> <u>EP-" + value['prescriptionId'] + "</u>,&nbsp;&nbsp;&nbsp;&nbsp;<b>Diagnosis:</b><u>" + value['diagnosis'] + "&nbsp;&nbsp;&nbsp;</u>,  <b>Chief Compliant:</b>  <u>" + value['chiefCompliant'] + " &nbsp; &nbsp;</u>, &nbsp;&nbsp;&nbsp;&nbsp; <b>Prescribed Date:</b><u>" + value['prescriptionDate'] + " </u></td></tr> ";
            k = 1;
         }
         dataDisplay += "<tr><td class='hiden-480'>" + j + "." + k + "</td><td colspan='2'>" + value['drugsName'] + "</td> </td> </td> <td> " + value['drugsDose'] + ' ' + value['drugsDoseUnit'] + ', ' + value['drugsFrequency'] + ', ' + value['drugsRoute'] + ', ' + value['drugsDuration'] + ' ' + value['drugsDurationUnit'] + ', totalQty=' + value['totalQty'] + "</td>";

         k++;

         var approvalIcon;

         if (value['status'] == 'Dispensed')
            approvalIcon = "success";

         else
            approvalIcon = "warning";

         dataDisplay += '<td> <span class="label label-sm label-' + approvalIcon + '">' + value['status'] + ' </span> </td><td class="center"><div class="action-buttons"><a href="#modal-table" class="green bigger-140 show-details-btn-medic" title="Show Other Details for Prescription No: ' + value['prescriptionId'] + '" data-toggle="modal" prescriptionId1=' + value['prescriptionId'] + ' drugsId1=' + value['drugsId'] + '  onclick="showOtherDetails(this);"><i class="ace-icon fa fa-angle-double-down"></i></a></div>';

         dataDisplay += "</td></tr>";
         sn = sn + 1;
      });
      var divId = "medicationDiv" + physcianId;
      $('#' + divId).html(dataDisplay);
   });
}