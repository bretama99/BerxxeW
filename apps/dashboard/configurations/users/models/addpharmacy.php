<?php
include('../../../../../constants/databases/dbcon_eprescription.php');
$pharmacyNameAdd = $_POST['pharmacyNameAdd'];
$pharmacyTypeAdd = $_POST['pharmacyTypeAdd'];
$licenceNumberAdd = $_POST['licenceNumberAdd'];
$registrationNumberAdd = $_POST['registrationNumberAdd'];
$countryAdd = $_POST['countryAdd'];
$stateAdd = $_POST['stateAdd'];
$zoneAdd = $_POST['zoneAdd'];
$woredaAdd = $_POST['woredaAdd'];
$kebelleAdd = $_POST['kebelleAdd'];
$streetNumberAdd = $_POST['streetNumberAdd'];
$emailAdd = $_POST['emailAdd'];
$phoneNumberAdd = $_POST['phoneNumberAdd'];
$openingTimeAdd = $_POST['openingTimeAdd'];
$closingTimeAdd = $_POST['closingTimeAdd'];
$latitudeAdd = $_POST['latitudeAdd'];
$longitudeAdd = $_POST['longitudeAdd'];
$tinNumberAdd = $_POST['tinNumberAdd'];
$regById = $_POST['regById'];

if (isset($_POST['pharmacyNameAdd'])) {
    if ($pharmacyNameAdd == '' || $pharmacyTypeAdd == '' || $licenceNumberAdd == '' || $registrationNumberAdd == '' || $countryAdd == 0 || $stateAdd == 0 || $zoneAdd == 0  || $woredaAdd == 0 || $kebelleAdd == '' || $emailAdd == ''  || $phoneNumberAdd == '' || $latitudeAdd == '' || $longitudeAdd == '' || $tinNumberAdd == '' || $openingTimeAdd == '' || $closingTimeAdd == '') {
        $resp = 0;
    } else {
        $Add_query = "insert into pharmacy(pharmacyName, pharmacyType, licenceNumber, registrationNumber,countryId, stateId, zoneId, woredaId, kebelle, streetNumber, email, phoneNumber,  tinNumber,longitude,latitude,openingAt,closingAt,registeredById) values('$pharmacyNameAdd', '$pharmacyTypeAdd', '$licenceNumberAdd', '$registrationNumberAdd','$countryAdd',  '$stateAdd', '$zoneAdd', '$woredaAdd', '$kebelleAdd', '$streetNumberAdd', '$emailAdd', '$phoneNumberAdd',  '$tinNumberAdd','$longitudeAdd','$latitudeAdd','$openingTimeAdd','$closingTimeAdd','$regById')";
        $stmtadd = $con->prepare($Add_query);
        $stmtadd->execute();
        $resp = 1;
    }
}
echo $resp;
