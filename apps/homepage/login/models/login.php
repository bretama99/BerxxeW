<?php
ob_start();
//error_reporting(0);
session_start();
include('../../../../constants/databases/dbcon_eprescription.php');
if (isset($_POST['Uname']) and isset($_POST['password'])) {
	$uname = $_POST['Uname'];
	$userName = ucfirst(strtolower($uname));
	$query = "SELECT usersId,userName,status,email,emailVerification,firstName,fatherName,grandFatherName,titleId,usersDefaultRolesId FROM users WHERE userName='$userName' OR email='$userName'";
	$stmt = $con->prepare($query);
	$success = $stmt->execute();
	$rows = $stmt->fetchAll();
	if ($success) {
		foreach ($rows as $row) {
			$usersId = $row['usersId'];
			$email = $row['email'];
			$dbUsersName = $row['userName'];
			$status = $row['status'];
			$emailVerification = $row['emailVerification'];
			$titleId = $row['titleId'];
			$firstName = $row['firstName'];
			$fatherName = $row['fatherName'];
			$grandFatherName = $row['grandFatherName'];
			$usersDefaultRolesId = $row['usersDefaultRolesId'];
		}
		if (($userName == $dbUsersName) || ($userName == $email)) {

			if ($emailVerification == 0) {
				$_SESSION['error_user'] = 'Please Verify Your Email';
				header("location: ../../../index.php");
			} else {
				if ($status == 'active') {
					$Uname = ucfirst(strtolower($_POST['Uname']));
					include('../../../../constants/security/cryptsalt.php');
					$password = $_POST['password'];
					$password = hash_hmac('sha512', $password, $salt);
					$query = "SELECT userName,password,usersDefaultRolesId FROM users WHERE userName='$Uname' OR email='$Uname'";
					$stmt = $con->prepare($query);
					$success = $stmt->execute();
					$rows = $stmt->fetchAll();
					if ($success) {

						foreach ($rows as $row) {
							$db_password = $row['password'];
							$db_uname = $row['userName'];
							$usersDefaultRolesId = $row['usersDefaultRolesId'];
						}
						if ($password == $db_password) {
							$Rquery = "SELECT rolesId FROM usersrole WHERE usersId='$usersId' AND isDefault='1' AND active=1 order by usersRoleId DESC limit 1";
							$stmtR = $con->prepare($Rquery);
							$successR = $stmtR->execute();
							$rowsR = $stmtR->fetchAll();
							if ($successR) {
								foreach ($rowsR as $row) {
									$rolesId = $row['rolesId'];
								}
							} else {
								$rolesId = 0;
							}
							$Time = date("Y-m-d h:i:s", time());
							$Update_L = "update users set lastLoginTime='$Time', lastLoginLatitude='" . $_SESSION['latitude'] . "', lastLoginLongitude='" . $_SESSION['longitude'] . "' where usersId='$usersId' ";
							$stmtL = $con->prepare($Update_L);
							$resultL = $stmtL->execute();
							session_start();
							session_regenerate_id(true);
							$_SESSION['Uname'] = $db_uname;
							$_SESSION['rolesId'] = $rolesId;
							$_SESSION['email'] = $email;
							include('../../../settings/client/client_info.php');
							$loginhistory = "insert into loginhistory (usersId,browserDetails,ipaddress,osType,deviceType,location,latitude,longitude) values('$usersId','$browserDetails','$ipaddress','$osType','$deviceType','$location','" . $_SESSION['latitude'] . "', '" . $_SESSION['longitude'] . "')";
							$stmtLH = $con->prepare($loginhistory);
							$SuccessLH = $stmtLH->execute();
							if (true) {
								header("location:../../../dashboard/?name=hub/analytics/analytics&var=analytics");
							}
						} else {
							$_SESSION['error_user'] = 'Incorrect  Password';
							header("location: ../../../index.php");
						}
					}
				} elseif ($status == 'limitedAccess') {
					$_SESSION['error_user'] = 'we are reviewing your request we will update you soon';
					header("location: ../../../index.php");
				} elseif ($status == 'disabled') {
					$_SESSION['error_user'] = 'User access denied, please contact Administrator';
					header("location: ../../../index.php");
				}
			}
		} else {
			$_SESSION['error_user'] = 'Incorrect Username, please sign up if you are a new user.';
			header("location: ../../../index.php");
		}
	} else {
		$_SESSION['error_user'] = 'User not Registered';
		header("location: ../../../index.php");
	}
} else {
	$_SESSION['error_user'] = 'Please Input Username and Password';
	header("location: ../../../index.php");
}
