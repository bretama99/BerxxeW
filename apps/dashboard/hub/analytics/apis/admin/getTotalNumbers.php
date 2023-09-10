<?php
//http://localhost/erxHub/apps/dashboard/hub/analytics/apis/admin/getTotalInnumbers.php?oncall=getTotalUsers 
if (isset($_GET['oncall']))
 $oncall =$_GET['oncall'](); 
elseif (isset($_POST['oncall']))
 $oncall =$_POST['oncall']();

 function getTotalUsers(){
	include('../../constants/databases/dbcon_eprescription.php');
    $query = "select status, count(*) as numberOfUsers from users GROUP BY status";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;

 }

 function getTotalUsersWithAdditionalRoles(){
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select roles.rolesName as additionalRole, rolerequest.status, count(*) as total  from rolerequest INNER JOIN roles ON roles.rolesId=rolerequest.rolesId   GROUP BY rolerequest.rolesId, rolerequest.status";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;

 }

 function getTotalUsersWithDefaultRoles(){
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select roles.rolesName as defaultRole, users.status, count(*) as total  from users INNER JOIN roles ON users.usersDefaultRolesId=roles.rolesId   GROUP BY users.usersDefaultRolesId, users.status";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;

 }

 function getTotalPrescriptions(){
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select status, count(*) as total FROM prescription GROUP BY status";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
 }

 
 function getTotalPatients(){
	$total = new stdClass();
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select COUNT(DISTINCT(patientId)) as totalPatients from prescription";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//$total->totalPatients=json_encode($rows[0]["totalPatients"]);
	return $rows[0]["totalPatients"];
 }

 function getTotalPharmacies(){
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select state.StateName, pharmacy.pharmacyType as category, pharmacy.status as workingStatus, pharmacy.approval as status, count(*) as total  from pharmacy INNER JOIN state ON pharmacy.stateId=state.stateId   GROUP BY pharmacy.stateId, pharmacy.pharmacyType, pharmacy.status, pharmacy.approval";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
 }

 function getTotalHubVisitors(){
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select count(*) as totalVisitors from loginhistory";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows[0]["totalVisitors"];
 }

?>