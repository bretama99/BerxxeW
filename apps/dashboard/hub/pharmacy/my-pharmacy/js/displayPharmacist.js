function displayPharmacist(pharmacyAdminId) {

    $.ajax({
        url: "hub/pharmacy/my-pharmacy/models/mypharmacist.php",
        data: {
            'pharmacistAdminId': pharmacyAdminId
        },
    }).done(function (data) {


        var result = $.parseJSON(data);


        var dataDisplay = '<tr><th>S/N</th><th title="Full Name" colspan="2">Name</th><th colspan="2">Qualification</th><th>Mobile No.</th> <th>Added Date</th> <th>Work on</th><th>Status</th> <th style="width:1%;" > <button  onclick="pharmacistSearchBox();"> <i  title="Click to Assign New Pharmacist to your Pharmacy "class ="ace-icon fa fa-plus"> </i> </button></th></tr>';

        //from result create a string of data and append to the div
        var sn = 1;
        $.each(result, function (key, value) {


            dataDisplay += "<tr><td class='hiden-480'>" + sn + "</td><td colspan='2'> " + value['titleName'] + " " + value['firstName'] + " " + value['fatherName'] + " " + value['grandFatherName'] + "</td> <td colspan='2'>" + value['qualification'] + "</td> <td>" + value['mobilePhone'] + "</td> <td>" + value['addedDate'] + "</td><td>" + value['pharmacyName'] + ", " + value['pharmacyType'] + "</td>";



            var checked1 = '';
            if (value['status'] == 'Active')
                checked1 = 'checked';

            dataDisplay += '<td> <input name="pharmacyId[]" type="hidden" value="' + value['pharmacyId'] + '"/><input type="hidden" name="usersId[]" value="' + value['usersId'] + '"/>' +
                '<label>' +
                '<input type="checkbox" boxId="' + sn + '" ' + checked1 + ' id="' + sn + '" value="' + value['status'] + '"  name="status[]"  class="ace ace-switch ace-switch-3" onclick="manageCheckBox(this)"  />' +
                '<span class="lbl middle" ></span>' +
                '</label>' +

                '</td>';


            dataDisplay += '<td class="center"><div class="action-buttons"><a href="#modal-table" class="green bigger-140 show-details-btn-medic" title="Show Other Details of the pharmacist" data-toggle="modal" usersId1=' + value['usersId'] + '   onclick="showPharmacistDetails(this);"><i class="ace-icon fa fa-angle-double-down"></i></a>';

            //alert(y)
            dataDisplay += "</td>";


            dataDisplay += '</tr>';
            sn = sn + 1;
            //<td> <span class="label label-sm label-'+approvalIcon+'">'+value['status']+'</span> </td>




        });
        if (sn >= 1) {
            dataDisplay += '<tr style="background-color:white;" id="managePharmacistSave"><td colspan="10"><br> <button style="float:right;" class="btn btn-lg btn-success"  onclick="managePharmacist();"> <i class ="ace-icon fa fa-check">  </i>Save</button></td> </tr > ';
        }




        var divId = "divPharmacist";

        //divId=  '"#'+divId+'"';


        $('#' + divId).html(dataDisplay);


    });


}