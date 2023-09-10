<?php
include('../../../apps/common/email/email-send.php');
include("../../../apps/dashboard/hub/physician/find-physician/models/nearestPhysicians.php");
include('../../../constants/databases/dbcon_eprescription.php');
$search = '';
if (isset($_POST['filterPhysicians'])) {
	$search = $_POST['filterPhysicians'];
	ltrim($search);
	rtrim($search);
}
$searchArray = explode(" ", $search);
$cnt = count($searchArray);
if ($cnt = 1) {
	$columnValues = "firstName LIKE '$searchArray[0]%'  or gender LIKE '$searchArray[0]%'  or email LIKE '$searchArray[0]%' or mobilePhone LIKE '$searchArray[0]%' or specialization.specializationName LIKE '$searchArray[0]%' OR physicianinfo.HealthInstitutionName LIKE '$searchArray[0]%' OR physicianinfo.graduatedFrom LIKE '$searchArray[0]%'";
} else if ($cnt = 2) {
	$columnValues = "firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%'";
} else if ($cnt = 3) {
	$columnValues = "firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%' and grandFatherName  LIKE '$searchArray[2]%'";
}

if (isset($_SESSION['latitude']) && isset($_SESSION['longitude']) && $search == '') {
	$rows = getNearestPhyscians($_SESSION['latitude'], $_SESSION['longitude']);
} else if (isset($_SESSION['latitude']) && isset($_SESSION['longitude']) && $search != '') {
	$rows = searchPhysicians($_SESSION['latitude'], $_SESSION['longitude'], $search);
} else {
	$Usr_quer="";
	if ($search != '') {
		$Usr_query = "select users.*, specialization.specializationName from users INNER JOIN physicianinfo ON users.usersId=physicianinfo.usersId INNER JOIN specialization ON physicianinfo.specializationId= specialization.specializationId  LEFT JOIN rolerequest on rolerequest.usersId=users.usersId where (" . $columnValues . ") and rolerequest.isDeleted=0 and rolerequest.status='Approved' AND users.status='active' AND users.usersDefaultRolesId=3 group by users.usersId";
	} else {
		$Usr_query = "select users.*,title.titleName,specialization.specializationName from users INNER JOIN physicianinfo ON users.usersId=physicianinfo.usersId INNER JOIN specialization ON physicianinfo.specializationId= specialization.specializationId INNER JOIN title ON users.titleId=title.titleId LEFT JOIN rolerequest on rolerequest.usersId=users.usersId where rolerequest.isDeleted=0 and rolerequest.status='Approved' and users.status='active' AND users.usersDefaultRolesId=3 group by users.usersId LIMIT 100";
	}

	$Usr_stmt = $con->prepare($Usr_query);
	$Usr_success = $Usr_stmt->execute();
	$rows = $Usr_stmt->fetchAll();
	echo json_encode($rows);
}

if ($search == '')
	$search = "All Physicians";
