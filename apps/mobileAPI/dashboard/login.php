<?php
include('../../../constants/databases/dbcon_eprescription.php');
include('../../../constants/security/cryptsalt.php');
//include('../../settings/client/client_info.php');
if (isset($_POST['Uname']) and isset($_POST['password'])) {
	$uname = $_POST['Uname'];
	$userName = ucfirst(strtolower($uname));
	$password = $_POST['password'];
	$lastLoginLatitude = $_POST['lastLoginLatitude'];
	$lastLoginLongitude = $_POST['lastLoginLongitude'];
	$password = hash_hmac('sha512', $password, $salt);
	$query = "select firstName,fatherName,grandFatherName,userName,gender,users.usersId,email,mobilePhone,officePhone, custodianPhone,
		dateOfBirth,lastLoginTime,users.status, users.lastLoginLongitude, users.lastLoginLatitude,  users.usersDefaultRolesId as rolesId, profilePicture,countryName,stateName,zoneName,woredaName,kebelle,rolesName,emailVerification, title.titleName
		from users join usersrole ON users.usersId=usersrole.usersId
		join roles ON roles.rolesId=users.usersDefaultRolesId
		join title ON users.titleId=title.titleId
		left join woreda ON users.woredaId=woreda.woredaId
		left join zone ON users.zoneId=zone.zoneId
		left join state ON users.stateId=state.stateId
		left join country ON users.countryId=country.countryId
		where users.password='$password' AND (users.userName='$userName' OR users.email='$userName') and (users.status='Active' OR users.status='limitedAccess') group by users.usersId";
	$stmt = $con->prepare($query);
	$success = $stmt->execute();
	$rows = $stmt->fetchAll();
if ($success && count($rows) ==1) {
		
		$Time = date("Y-m-d h:i:s", time());
		$Update_L = "update users set lastLoginTime='$Time', lastLoginLongitude='$lastLoginLongitude', lastLoginLatitude='$lastLoginLatitude' where users.userName='$userName' OR users.email='$userName' ";
		$stmtL = $con->prepare($Update_L);
		$resultL = $stmtL->execute();
        echo json_encode($rows);
		
	} else{
		//array_push($rows, array("code" => "Unsuccessful", "message" => "Make sure your username and password are valid. contact the support service for more details."));
		echo json_encode("Make sure your username and password are valid. contact the support service for more details.");
		}


}
?>