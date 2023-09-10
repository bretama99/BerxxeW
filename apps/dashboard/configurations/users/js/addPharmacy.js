$(document).ready(function () {
    $('#submitAddPharmacy').click(function (event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            dataType: 'html',
            url: 'configurations/users/models/addpharmacy.php',
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

                $('form[name="addPharmacy"]').hide();

                $('div[id="pharmacyOwnerFile"]').show();

            },
        });
    });
});



