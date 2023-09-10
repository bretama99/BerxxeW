<?php
session_start();
include('../../../../../../constants/databases/dbcon_eprescription.php');

$usrUsersId = $_SESSION['usrUsersId'];
$pharmacyId = $_SESSION['pharmacyId'];


$drugsId = $_POST['drugsId'];
$prescriptionId = $_POST['prescriptionId'];
$releaseAll = $_POST['releaseAll'];

// Transactions Begins
$con->beginTransaction();
if ($releaseAll == 0) {
	$releaseAll = " update prescription set isReleased=1  where prescriptionId='" . $prescriptionId . "'";
	$releaseAll_stmt = $con->prepare($releaseAll);
	$releaseAll_success = $releaseAll_stmt->execute();

	$releaseAllDrugs = " update prescribeddrugs set released=1, releasedById='" . $usrUsersId . "'  where prescriptionId='" . $prescriptionId . "' and drugsId='" . $drugsId . "' and status ='Prescribed' ";
	$releaseAllDrugs_stmt = $con->prepare($releaseAllDrugs);
	$releaseAllDrugs_success = $releaseAllDrugs_stmt->execute();
} else {

	$releaseAll = " update prescription set isReleased=1  where prescriptionId='" . $prescriptionId . "'";
	$releaseAll_stmt = $con->prepare($releaseAll);
	$releaseAll_success = $releaseAll_stmt->execute();

	$releaseAllDrugs = " update prescribeddrugs set released=1, releasedById='" . $usrUsersId . "'  where prescriptionId='" . $prescriptionId . "' and status ='Prescribed'";
	$releaseAllDrugs_stmt = $con->prepare($releaseAllDrugs);
	$releaseAllDrugs_success = $releaseAllDrugs_stmt->execute();
}

if ($releaseAllDrugs_success) {
	$qry_log = "insert into releasemedication(usersId,drugsId,pharmacyId) values('$usrUsersId','$drugsId','$pharmacyId')";
	$stmt_log = $con->prepare($qry_log);
	$stmt_log->execute();
}

if ($stmt_log) {
	$con->commit();
	echo 1;
} else {
	$con->rollback();
	echo 0;
}
