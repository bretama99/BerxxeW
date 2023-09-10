$(document).ready(function () {
    $('#submitAddPharmacy').click(function (event) {
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
                'emailAdd': $('#emailAdd').val(),
                'phoneNumberAdd': $('#phoneNumberAdd').val(),
                'openingTimeAdd': $('#openingTimeAdd').val(),
                'closingTimeAdd': $('#closingTimeAdd').val(),
                'latitudeAdd': $('#lat').val(),
                'longitudeAdd': $('#lng').val(),
                'tinNumberAdd': $('#tinNumberAdd').val(),
                'regById': $('#regById').val(),
            },
            success: function (response, textStatus, jqXHR) {

                if (response.trim) {

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
            error: function (jqXHR, textStatus, errorThrown) {

                var message = (jqXHR.status === 420) ?
                    jqXHR.statusText :
                    'An error occurred during your request. Please try again.';

                $('#result').html(message);
            },
            complete: function (jqXHR, textStatus) {
                //...
            }
        });
    });
});

if (localStorage.getItem("pharmacyAdded") == '1') {
    // document.getElementById('divSearchPatient').style.display = 'none';
    $('#successfullyAdded').html('<div class="alert alert-block alert-success" style="margin-left:50%;">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&nbsp; <i class="ace-icon fa fa-times"></i>' +
        '</button>' +
        '<i class="ace-icon fa fa-check green"></i> &nbsp; New Pharmacy is Successfully Registered.' +
        '</div> ');
}


