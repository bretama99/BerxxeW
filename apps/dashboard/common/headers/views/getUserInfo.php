<?php
$Uname = $_SESSION['Uname'];
$Usr_query = "select usersId,lastLoginTime,firstName,fatherName,profilePicture from users where userName='$Uname'";
$Usr_stmt = $con->prepare($Usr_query);
$Usr_success = $Usr_stmt->execute();
$rows = $Usr_stmt->fetchAll();
foreach ($rows as $row) {
	$usrUsersId = $row['usersId'];
	$lastLoginTime = $row['lastLoginTime'];
	$usrFirstName = $row['firstName'];
	$usrFatherName = $row['fatherName'];
	$usrProfilePicture = $row['profilePicture'];
	$usrFullName = $usrFirstName . ' ' . $usrFatherName;
}
$_SESSION['usrUsersId'] = $usrUsersId;
$lastLogin = strtotime($lastLoginTime);
$currentTime = strtotime(date("Y-m-d h:i:s", time()));
$intervalMinutes = round(abs($currentTime - $lastLogin) / 60);
if ($intervalMinutes > 30) {
	/* session_destroy();
																   session_regenerate_id(true);
																   header("location:../index.php?notify=Session expired"); */
} else {
	$Time = date("Y-m-d h:i:s", time());
	$Update_L = "update users set lastLoginTime='$Time' where usersId='$usrUsersId' ";
	$stmtL = $con->prepare($Update_L);
	$resultL = $stmtL->execute();
}
?>