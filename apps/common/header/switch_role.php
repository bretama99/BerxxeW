<?php
ob_start();
session_start();
if (isset($_GET['SwitchRoleId'])) {
	$_SESSION['rolesId'] = $_GET['SwitchRoleId'];
	// $previousLink = $_GET['previousLink'];
	// $var = $_GET['var'];
	// $link = $previousLink . '&var=' . $var;
	header("location: ../../index.php?name=hub/analytics/analytics&var=analytics");
} else if (isset($_GET['pharmacyId'])) {
	$_SESSION['pharmacyId'] = $_GET['pharmacyId'];
	$_SESSION['pharmacyName'] = $_GET['pharmacyName'];
	$_SESSION['pharmacyType'] = $_GET['pharmacyType'];
	$previousLink = $_GET['previousLink'];
	$var = $_GET['var'];
	$link = $previousLink . '&var=' . $var;
	header("location: " . $link . "");
}
