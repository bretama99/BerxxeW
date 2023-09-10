 <?php
	include('../../../../../../constants/databases/dbcon_eprescription.php');
	if (isset($_POST['pharmacyId'])) {
		$pharmacyId = $_POST['pharmacyId'];
		$checkBox = $_POST['checkBox'];
		$usersId = $_POST['usersId'];
		$usrUsersId = $_SESSION['usrUsersId'];
		for ($j = 0; $j < count($pharmacyId); $j++) {

			$sql = "select count(*) from pharmacyusers where status !='" . $checkBox[$j] . "' and addedById='" . $usrUsersId[$j] . "'";
			$result = $con->prepare($sql);
			$result->execute();
			$numberOfAssignment1 = $result->fetchColumn();

			$pharmacyUser = "UPDATE pharmacyusers set status='" . $checkBox[$j] . "'  where usersId='" . $usersId[$j] . "' and pharmacyId= '" . $pharmacyId[$j] . "' and status !='" . $checkBox[$j] . "' ";
			$pharmacyUser_stmt = $con->prepare($pharmacyUser);
			$if_true = $pharmacyUser_stmt->execute();

			if ($numberOfAssignment1 == 1) {
				$qry_log = "INSERT into pharmacistmanagement(usersId, pharmacyId,managedById,status) VALUES( '" . $usersId[$j] . "','" . $pharmacyId[$j] . "','" . $usrUsersId[$j] . "', 'Active')";
				$log_stmt = $con->prepare($qry_log);
				$log_success = $log_stmt->execute();
			}
		}
	} else  if (isset($_GET['pharmacyOwnerId'])) {
		$pharmacyOwnerId = $_GET['pharmacyOwnerId'];

		$pharmacyList = "select pharmacyName, pharmacyId from pharmacy where registeredById='" . $pharmacyOwnerId . "' and isDeleted=0 and status='Active'";
		$pharmacyList_stmt = $con->prepare($pharmacyList);
		$pharmacy_success = $pharmacyList_stmt->execute();
		$rows_pharmacyList  = $pharmacyList_stmt->fetchAll();

		echo json_encode($rows_pharmacyList);
	} else if (isset($_POST['assignToPharmacyId'])) {

		$checkboxUsersId = $_POST['checkboxUsersId'];
		$assignToPharmacyId = $_POST['assignToPharmacyId'];
		$assignPharmacyAdminId = $_POST['assignPharmacyAdminId'];
		$rolesId = $_POST['rolesId'];
		$assignedUsersId = $_POST['assignedUsersId'];

		for ($j = 0; $j < count($assignToPharmacyId); $j++) {

			if ($checkboxUsersId[$j] == 1) {

				$sql = "select count(*) from pharmacyusers where rolesId='" . $rolesId[$j] . "' and pharmacyId='" . $assignToPharmacyId[$j] . "' and usersId='" . $assignedUsersId[$j] . "'";
				$result = $con->prepare($sql);
				$result->execute();
				$numberOfAssignment = $result->fetchColumn();
				if ($numberOfAssignment == 0) {
					$pharmacyUser = "INSERT into pharmacyusers (usersId,pharmacyId,addedById,rolesId, status) VALUES('" . $assignedUsersId[$j] . "', '" . $assignToPharmacyId[$j] . "','" . $assignPharmacyAdminId[$j] . "' ,'" . $rolesId[$j] . "','Active')";
					$pharmacyUser_stmt = $con->prepare($pharmacyUser);
					$pharmacyUser_success = $pharmacyUser_stmt->execute();
					if ($pharmacyUser_success) {
						$qry_log = "INSERT into pharmacistmanagement(usersId, pharmacyId,managedById,status) VALUES( '" . $assignedUsersId[$j] . "','" . $assignToPharmacyId[$j] . "','" . $assignPharmacyAdminId[$j] . "', 'Active')";
						$log_stmt = $con->prepare($qry_log);
						$log_success = $log_stmt->execute();
					}
				}
			}
		}
	} else {
		$search = '';
		if (isset($_GET['search'])) {
			$search = $_GET['search'];
		}
		ltrim($search);
		rtrim($search);
		$searchArray = explode(" ", $search);
		$cnt = count($searchArray);
		if ($cnt = 1) {
			$columnValues = "firstName LIKE '$searchArray[0]%'  or gender LIKE '$searchArray[0]%'  or email LIKE '$searchArray[0]%' or mobilePhone LIKE '$searchArray[0]%'";
		} else if ($cnt = 2) {
			$columnValues = "firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%'";
		} else if ($cnt = 3) {
			$columnValues = "firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%' and grandFatherName  LIKE '$searchArray[2]%'";
		}

		if ($search != '') {

			$pharmacistList = " SELECT title.titleName,roles.rolesName, roles.rolesId, pharmacistinfo.qualification, pharmacistinfo.licenceNo,pharmacistinfo.licenceExpirationDate,users.usersId, firstName, fatherName, grandFatherName, gender, email, mobilePhone from users  INNER JOIN title on users.titleId=title.titleId and users.isDeleted=0  INNER JOIN usersrole on users.usersId =usersrole.usersId and usersrole.active=1 INNER JOIN roles on usersrole.rolesId =roles.rolesId and roles.isDeleted=0 INNER JOIN pharmacistinfo on users.usersId=pharmacistinfo.usersId where (" . $columnValues . ") and roles.rolesName='Pharmacist' limit 15";
		} else {

			$pharmacistList = " SELECT title.titleName,roles.rolesName, roles.rolesId, pharmacistinfo.qualification, pharmacistinfo.licenceNo,pharmacistinfo.licenceExpirationDate,users.usersId, firstName, fatherName, grandFatherName, gender, email, mobilePhone from users  INNER JOIN title on users.titleId=title.titleId and users.isDeleted=0  INNER JOIN usersrole on users.usersId =usersrole.usersId and usersrole.active=1 INNER JOIN roles on usersrole.rolesId =roles.rolesId and roles.isDeleted=0 INNER JOIN pharmacistinfo on users.usersId=pharmacistinfo.usersId where roles.rolesName='Pharmacist' limit 10";
		}
		$pharmacistList_stmt = $con->prepare($pharmacistList);
		$pharmacistList_success = $pharmacistList_stmt->execute();
		$rows_pharmacistList  = $pharmacistList_stmt->fetchAll();
		echo json_encode($rows_pharmacistList);
	}
	?>