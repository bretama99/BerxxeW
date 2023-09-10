  <?php
	include('../../../../../../constants/databases/dbcon_eprescription.php');

	if (isset($_GET['selectedPharmacyId'])) {
		$pharmacyId = $_GET['selectedPharmacyId'];
		$usrUsersId = $_GET['usersId'];
		$rolesId = $_GET['rolesId'];

		if ($rolesId == 2) {
			$Usr_prescDrugs = "select prescribeddrugs.*, users.userName, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescribeddrugs.dispensedById=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Dispensed' and prescription.pharmacyId= '$pharmacyId' and pharmacyusers.usersId='$usrUsersId' and pharmacyusers.status='Active'  order by prescription.prescriptionDate DESC ";
			$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
			$prescDrugs_success = $prescDrugs_stmt->execute();
			$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
			echo json_encode($rows_prescDrugs);
		} else if ($rolesId == 4) {
			$Usr_prescDrugs = "select prescribeddrugs.*, users.userName, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN users on prescribeddrugs.dispensedById=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Dispensed' and prescription.pharmacyId= '$pharmacyId'   order by prescription.prescriptionDate DESC ";
			$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
			$prescDrugs_success = $prescDrugs_stmt->execute();
			$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
			echo json_encode($rows_prescDrugs);
		}
	} else if (isset($_GET['selectedPharmacyIdForPharmacistManagement'])) {
		$pharmacyId = $_GET['selectedPharmacyIdForPharmacistManagement'];
		$usrUsersId = $_GET['usersId'];
		$toDate = $_GET['toDate'];
		$fromDate = $_GET['fromDate'];
		$logType = $_GET['logType'];

		if ($toDate == '' || $fromDate == '') {
			if ($logType == 2) {
				$log = "select  pharmacistmanagement.actionDate, pharmacistmanagement.status, users.firstName, users.fatherName, users.grandFatherName, users.userName,  pharmacy.pharmacyName, pharmacy.pharmacyType from pharmacistmanagement INNER JOIN users on pharmacistmanagement.usersId=users.usersId INNER JOIN pharmacy ON pharmacistmanagement.pharmacyId=pharmacy.pharmacyId where pharmacistmanagement.pharmacyId='$pharmacyId' and pharmacistmanagement.managedById='$usrUsersId'  order by pharmacistmanagement.actionDate DESC ";
				$log_stmt = $con->prepare($log);
				$log_success = $log_stmt->execute();
				$rows_logs = $log_stmt->fetchAll();
				echo json_encode($rows_logs);
			} else  if ($logType == 3) {

				$log = "select  users.firstName, users.fatherName, users.grandFatherName, users.userName, releasemedication.actionDate, pharmacy.pharmacyName, pharmacy.pharmacyType, drugs.drugsName from releasemedication  INNER JOIN pharmacy ON releasemedication.pharmacyId=pharmacy.pharmacyId INNER JOIN users on releasemedication.usersId =users.usersId INNER JOIN drugs on releasemedication.drugsId=drugs.drugsId where releasemedication.pharmacyId='$pharmacyId'   order by releasemedication.actionDate DESC";
				$log_stmt = $con->prepare($log);
				$log_success = $log_stmt->execute();
				$rows_logs = $log_stmt->fetchAll();
				echo json_encode($rows_logs);
			} else {
				$log = "select  pharmacymanagement.actionDate, pharmacymanagement.status,   pharmacy.pharmacyName, pharmacy.pharmacyType from pharmacymanagement  INNER JOIN pharmacy ON pharmacymanagement.pharmacyId=pharmacy.pharmacyId where pharmacymanagement.pharmacyId='$pharmacyId' and pharmacy.registeredById='$usrUsersId'  order by pharmacymanagement.actionDate DESC";
				$log_stmt = $con->prepare($log);
				$log_success = $log_stmt->execute();
				$rows_logs = $log_stmt->fetchAll();
				echo json_encode($rows_logs);
			}
		} else {

			if ($logType == 2) {
				$log = "select  pharmacistmanagement.actionDate, pharmacistmanagement.status, users.firstName, users.fatherName, users.grandFatherName, users.userName,  pharmacy.pharmacyName, pharmacy.pharmacyType from pharmacistmanagement INNER JOIN users on pharmacistmanagement.usersId=users.usersId INNER JOIN pharmacy ON pharmacistmanagement.pharmacyId=pharmacy.pharmacyId where pharmacistmanagement.pharmacyId='$pharmacyId' and pharmacistmanagement.managedById='$usrUsersId' and date(actionDate) <='$toDate' and date(actionDate) >='$fromDate'  order by pharmacistmanagement.actionDate DESC";
				$log_stmt = $con->prepare($log);
				$log_success = $log_stmt->execute();
				$rows_logs = $log_stmt->fetchAll();
				echo json_encode($rows_logs);
			} else  if ($logType == 3) {
				$log = "select  users.firstName, users.fatherName, users.grandFatherName, releasemedication.actionDate, pharmacy.pharmacyName, pharmacy.pharmacyType, drugs.drugsName from releasemedication  INNER JOIN pharmacy ON releasemedication.pharmacyId=pharmacy.pharmacyId INNER JOIN users on releasemedication.usersId =users.usersId INNER JOIN drugs on releasemedication.drugsId=drugs.drugsId where releasemedication.pharmacyId='$pharmacyId' and date(actionDate) <='$toDate' and date(actionDate) >='$fromDate'  order by releasemedication.actionDate DESC ";
				$log_stmt = $con->prepare($log);
				$log_success = $log_stmt->execute();
				$rows_logs = $log_stmt->fetchAll();
				echo json_encode($rows_logs);
			} else {

				$log = "select  pharmacymanagement.actionDate, pharmacymanagement.status,   pharmacy.pharmacyName, pharmacy.pharmacyType from pharmacymanagement  INNER JOIN pharmacy ON pharmacymanagement.pharmacyId=pharmacy.pharmacyId where pharmacymanagement.pharmacyId='$pharmacyId' and pharmacy.registeredById='$usrUsersId' and date(actionDate) <='$toDate' and date(actionDate) >='$fromDate'  order by pharmacymanagement.actionDate DESC";
				$log_stmt = $con->prepare($log);
				$log_success = $log_stmt->execute();
				$rows_logs = $log_stmt->fetchAll();
				echo json_encode($rows_logs);
			}
		}
	}

	?>