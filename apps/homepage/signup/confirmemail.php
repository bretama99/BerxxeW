<?php
if (isset($_GET['usersId']) and isset($_GET['usersId'])) {
	$confirmed = 0;
	session_start();
	$usersId = $_GET['usersId'];
	$randomValue = $_GET['randomValue'];
	include('../../../constants/databases/dbcon_eprescription.php');
	$Check_confirm_query = "SELECT usersId FROM registrationconfirmation WHERE usersId ='$usersId' AND randomValue='$randomValue' AND usedStatus=0";
	$stmtC = $con->prepare($Check_confirm_query);
	$success = $stmtC->execute();
	$rowsCount = $stmtC->fetchColumn();
	if ($rowsCount > 0) {
		$update_query = "update users set emailVerification =1 where usersId = '$usersId'";
		$stmtU = $con->prepare($update_query);
		$successU = $stmtU->execute();
		if ($successU) {
			$update_query = "update registrationconfirmation set usedStatus =1 where usersId = '$usersId'";
			$stmtU = $con->prepare($update_query);
			$successU2 = $stmtU->execute();
			if ($successU2) {
				$_SESSION['active'] = 'login';
				$_SESSION['success_user'] = "email confirmed successfully";
				header("location: ../../../index.php");
			} else {
				$_SESSION['active'] = 'login';
				$_SESSION['error_user'] = "email not confirmed";
				header("location: index.php");
			}
		}
	} else {
		$_SESSION['active'] = 'login';
		$_SESSION['error_user'] = "invalid confirmation link";
		header("location: index.php");
	}
} else {
	header("location: index.php");
}
