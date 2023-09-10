  <?php
	session_start();
	include('../../../../../../constants/databases/dbcon_eprescription.php');
	if (isset($_POST['pharmacyId'])) {
		$pharmacyId = $_POST['pharmacyId'];
		$checkBox = $_POST['checkBox'];
		$usrUsersId = $_SESSION['usrUsersId'];
		for ($j = 0; $j < count($pharmacyId); $j++) {
			$sql = "select count(*) from pharmacy where pharmacyId='" . $pharmacyId[$j] . "' and status !='" . $checkBox[$j] . "'";
			$result = $con->prepare($sql);
			$result->execute();
			$numberOfAssignment1 = $result->fetchColumn();

			$pharmacyUpdate = "update pharmacy set status='" . $checkBox[$j] . "'  where pharmacyId= '" . $pharmacyId[$j] . "' and status !='" . $checkBox[$j] . "' ";
			$pharmacyUpdate_stmt = $con->prepare($pharmacyUpdate);
			$pharmacyUpdate_success = $pharmacyUpdate_stmt->execute();

			if ($numberOfAssignment1 == 1) {
				$qry_log = "insert into pharmacymanagement(pharmacyId,usersId,status) VALUES( '" . $pharmacyId[$j] . "','" . $usrUsersId . "', '" . $checkBox[$j] . "')";
				$log_stmt = $con->prepare($qry_log);
				$log_success = $log_stmt->execute();
			}
		}
	}

	?>

