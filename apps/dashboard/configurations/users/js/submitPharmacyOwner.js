function submitPharmacyOwnerForm() {
    var pharmacyNameAdd = document.getElementById('pharmacyNameAdd').value;
    var pharmacyTypeAdd = document.getElementById('pharmacyTypeAdd').value;
    var licenceNumberAdd = document.getElementById('licenceNumberAdd').value;
    var registrationNumberAdd = document.getElementById('registrationNumberAdd').value;
    var countryAdd = document.getElementById('country').value;
    var stateAdd = document.getElementById('state').value;
    var zoneAdd = document.getElementById('zone').value;
    var woredaAdd = document.getElementById('woreda').value;
    var kebelleAdd = document.getElementById('kebelleAdd').value;
    var streetNumberAdd = document.getElementById('streetNumberAdd').value;
    var emailAdd = document.getElementById('emailAdd').value;
    var phoneNumberAdd = document.getElementById('phoneNumberAdd').value;
    var openingTimeAdd = document.getElementById('openingTimeAdd').value;
    var closingTimeAdd = document.getElementById('closingTimeAdd').value;
    var latitudeAdd = document.getElementById('lat').value;
    var longitudeAdd = document.getElementById('lng').value;
    var tinNumberAdd = document.getElementById('tinNumberAdd').value;
    var regById = document.getElementById('regById').value;
    if (pharmacyNameAdd != '' || pharmacyTypeAdd != '' || licenceNumberAdd != '' || registrationNumberAdd != '' || countryAdd != 0 || stateAdd != 0 || zoneAdd != 0 || woredaAdd != 0 || kebelleAdd != '' || emailAdd != '' || phoneNumberAdd != '' || latitudeAdd != '' || longitudeAdd != '' || tinNumberAdd != '' || openingTimeAdd != '' || closingTimeAdd != '') {
        document.getElementById('pharmacyOwnerInfo').submit();
    } else {
        alert("please fill all the fields");
        document.getElementById('ErrorDisplay').innerHTML = "<b style='color:red;'>Please fill all the fields</b>";
    }

}