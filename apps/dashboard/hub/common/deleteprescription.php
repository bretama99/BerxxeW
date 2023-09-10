  <?php

	include('../../../../constants/databases/dbcon_eprescription.php');

	if (isset($_GET['prescriptionId']) && isset($_GET['returnEdit'])) {
		$prescriptionId = $_GET['prescriptionId'];
			$Add_query = "update prescription set status='Prescribed' where prescriptionId='$prescriptionId' ";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();

	}

	if (isset($_GET['usersIdDrugs'])) {
		$usersIdDrugs = $_GET['usersIdDrugs'];

		$Usr_prescDrugs = "select prescribeddrugs.*, prescription.diagnosis, prescription.chiefCompliant, prescription.prescriptionDate, prescription.comment, drugs.drugsName, lpad(prescription.prescriptionId,7,0) as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  where prescription.patientId='" . $usersIdDrugs . "' and prescribeddrugs.isDeleted=0";
		$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
		$prescDrugs_success = $prescDrugs_stmt->execute();
		$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
		echo json_encode($rows_prescDrugs);

	} 

	else if (isset($_GET['prescriptionDetailsId'])) {
		$prescriptionDetailsId = $_GET['prescriptionDetailsId'];
		$dispenseAll = $_GET['dispenseAll'];
		$prescriptionDrugsId = $_GET['prescriptionDrugsId'];
		$dispenseStatus = "prescribeddrugs.status='Prescribed'";
		if ($dispenseAll == 2)
			$dispenseStatus = "prescribeddrugs.status='Prescribed' or prescribeddrugs.status='Dispensed' or prescribeddrugs.status='Returned'";
		if ($dispenseAll == 0 || $dispenseAll == 2) {
			$Usr_prescDrugsDetails = "select prescribeddrugs.drugsInstructions,  prescribeddrugs.drugsDose, prescribeddrugs.drugsDoseUnit, prescribeddrugs.prescribedDrugsId, drugsFrequency, drugsRoute, drugsDuration, drugsDurationUnit, totalQty, prescribeddrugs.status, prescribeddrugs.drugsAdditionalInstructions,  drugs.drugsName, lpad(prescription.prescriptionId,7,0) as prescriptionId1, prescription.prescriptionDate, prescription.diagnosis, prescription.comment, users.firstName, users.fatherName,users.grandFatherName from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN users on prescription.prescriberId=users.usersId where prescribeddrugs.prescriptionId='" . $prescriptionDetailsId . "' and ($dispenseStatus) and prescribeddrugs.drugsId='" . $prescriptionDrugsId . "'  and prescribeddrugs.isDeleted=0";
		} else if ($dispenseAll == 1) {
			$Usr_prescDrugsDetails = "select prescribeddrugs.drugsInstructions,  prescribeddrugs.drugsDose, prescribeddrugs.drugsDoseUnit, prescribeddrugs.prescribedDrugsId, drugsFrequency, drugsRoute, drugsDuration, drugsDurationUnit, totalQty, prescribeddrugs.status, prescribeddrugs.drugsAdditionalInstructions,  drugs.drugsName, lpad(prescription.prescriptionId,7,0) as prescriptionId1, prescription.prescriptionDate,  prescription.diagnosis, prescription.comment,  users.firstName, users.fatherName,users.grandFatherName from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN users on prescription.prescriberId=users.usersId where prescribeddrugs.prescriptionId='" . $prescriptionDetailsId . "' and prescribeddrugs.status='Prescribed'  and prescribeddrugs.isDeleted=0";
		}
		$prescDrugsDetails_stmt = $con->prepare($Usr_prescDrugsDetails);
		$rows_prescDrugsDetails_success = $prescDrugsDetails_stmt->execute();
		$rows_prescDrugsDetails = $prescDrugsDetails_stmt->fetchAll();

		echo json_encode($rows_prescDrugsDetails);
	} else if (isset($_GET['usersIdMyPrescription'])) {
		$usersIdDrugs = $_GET['usersIdMyPrescription'];
		$physcianId = $_GET['physcianId'];
		$Usr_prescDrugs = "select prescribeddrugs.*, prescription.diagnosis, prescription.chiefCompliant, prescription.prescriptionDate, prescription.comment, drugs.drugsName, lpad(prescription.prescriptionId,7,0) as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  where prescription.patientId='" . $usersIdDrugs . "' and prescription.prescriberId='" . $physcianId . "' and prescribeddrugs.isDeleted=0";
		$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
		$prescDrugs_success = $prescDrugs_stmt->execute();
		$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
		echo json_encode($rows_prescDrugs);
	} else if (isset($_GET['usersId'])) {
		$usersId = $_GET['usersId'];
		$Usr_prescDrugs = "select title.titleName, users.firstName, users.fatherName,users.grandFatherName,users.dateOfBirth, users.email, users.mobilePhone, users.officePhone, users.gender, pharmacistinfo.licenceNo, pharmacistinfo.licenceExpirationDate, pharmacistinfo.qualification, pharmacistinfo.graduatedFrom, pharmacistinfo.graduationYear, educationallevel.educationLevelName from users INNER JOIN pharmacistinfo on users.usersId=pharmacistinfo.usersId INNER JOIN educationallevel on pharmacistinfo.educationalLevelId=educationallevel.educationalLevelId  INNER JOIN rolerequest on pharmacistinfo.roleRequestId=rolerequest.roleRequestId INNER JOIN title on users.titleId=title.titleId where rolerequest.rolesId=2 and rolerequest.status='Approved' and rolerequest.usersId='$usersId'";
		$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
		$prescDrugs_success = $prescDrugs_stmt->execute();
		$rows_prescDrugs = $prescDrugs_stmt->fetchAll();

		echo json_encode($rows_prescDrugs);
	}
	?>