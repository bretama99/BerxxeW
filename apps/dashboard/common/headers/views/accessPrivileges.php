<?php
	include('../../constants/security/cryptsalt.php');
	if (isset($_GET['var'])) {
		$tasksVarNameGet = $_GET['var'];
	} else {
		$tasksVarNameGet = "";
	}
	$rolesId = $_SESSION['rolesId'];
	$canView = 0;
	$canAdd = 0;
	$canEdit = 0;
	$canDelete = 0;
	$RT_query = "select canView,canAdd,canEdit,canDelete from tasks where tasksVarName='$tasksVarNameGet'";
	$RT_stmt = $con->prepare($RT_query);
	$RT_success = $RT_stmt->execute();
	$RT_rows = $RT_stmt->fetchAll();
	foreach ($RT_rows as $row) {
		$canViewT = $row['canView'];
		$canAddT = $row['canAdd'];
		$canEditT = $row['canEdit'];
		$canDeleteT = $row['canDelete'];

		if (strpos($canViewT, $rolesId) !== false) {
			$canView = 1;
		}
		if (strpos($canAddT, $rolesId) !== false) {
			$canAdd = 1;
		}
		if (strpos($canEditT, $rolesId) !== false) {
			$canEdit = 1;
		}
		if (strpos($canDeleteT, $rolesId) !== false) {
			$canDelete = 1;
		}
	}
	?>