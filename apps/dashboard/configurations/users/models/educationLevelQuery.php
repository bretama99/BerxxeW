<?php
$I_query = "select * from pharmacistinfo where usersId='$usersId' ";
$I_stmt = $con->prepare($I_query);
$I_success = $I_stmt->execute();
$I_rows = $I_stmt->fetchAll();
foreach ($I_rows as $rowi) {
    $educationalLevelId = $rowi['educationalLevelId'];
    $graduatedFrom = $rowi['graduatedFrom'];
    $graduationYear = $rowi['graduationYear'];
    $licenceNo = $rowi['licenceNo'];
    $licenceExpirationDate = $rowi['licenceExpirationDate'];
    $qualification = $rowi['qualification'];

    echo '<div class="widget-box col-sm-6" id="widget-box-12">
							<div class="widget-body">
							<div class="widget-main alert alert-info">';
    echo 'Graduated from ' . $graduatedFrom . ' In ' . $graduationYear . '<br>';
    echo 'Pharmacist licence Number ' . $licenceNo . '<br>';
    echo 'licence Expiration Date is ' . $licenceExpirationDate . '<br>';
    echo 'Qualification is ' . $qualification . '<br>';
    echo ' </div>
							  </div>
							</div>';
}

$PI_query = "select educationalLevelId,graduatedFrom,graduationYear,licenceNo,licenceExpirationDate,specializationName,HealthInstitutionName
					from physicianinfo join specialization ON physicianinfo.specializationId=specialization.specializationId where usersId='$usersId' ";
$PI_stmt = $con->prepare($PI_query);
$PI_success = $PI_stmt->execute();
$PI_rows = $PI_stmt->fetchAll();
foreach ($PI_rows as $rowi) {
    $educationalLevelId = $rowi['educationalLevelId'];
    $graduatedFrom = $rowi['graduatedFrom'];
    $graduationYear = $rowi['graduationYear'];
    $licenceNo = $rowi['licenceNo'];
    $licenceExpirationDate = $rowi['licenceExpirationDate'];
    $specializationName = $rowi['specializationName'];
    $HealthInstitutionName = $rowi['HealthInstitutionName'];
    echo '<div class="widget-box col-sm-6" id="widget-box-12">
							<div class="widget-body">
							<div class="widget-main alert alert-info">';
    echo 'Graduated from ' . $graduatedFrom . ' In ' . $graduationYear . '<br>';
    echo 'Physician licence Number ' . $licenceNo . '<br>';
    echo 'licence Expiration Date is ' . $licenceExpirationDate . '<br>';
    echo 'Works In ' . $HealthInstitutionName . ' specialized by ' . $specializationName . '<br>';
    echo ' </div>
							  </div>
							</div>';
}
