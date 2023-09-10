<?php include('../../../../constants/databases/dbcon_eprescription.php'); ?>
<?php
if (isset($_POST['change'])) {
	include('../../../../constants/security/cryptsalt.php');
	$Pword = $_POST['Pword'];
	$CPword = $_POST['CPword'];
	$usersId = $_POST['usersId'];
	if ($Pword == $CPword) {
		$enc_new_password = hash_hmac('sha512', $password, $salt);
		$update_query = "update users set password = '$enc_new_password' where usersId = '$usersId'";
		$stmtU = $con->prepare($update_query);
		$successU = $stmtU->execute();
		if ($successU) {
			$delete_query = "delete from confirm where User_Id='$User_Id' "; // all should be deleted
			$stmtD = $con->prepare($delete_query);
			$successD = $stmtD->execute();
			if ($successD) {
				$_SESSION['success_change'] = "password changed successfully, Login using new password";
				header("location: index.php");
			}
		}
	} else
		$_SESSION['errorpass_change'] = "Both passwords are not equal";
	header("location: change_pass.php?User_Id=$User_Id&random_string=$random_string");
}
?>