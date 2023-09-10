  <?php
	include('../../../../../../constants/databases/dbcon_eprescription.php');

	if (isset($_GET['usersId'])) {
		$usersId = $_GET['usersId'];
		$Usr_users = "select * from users where users.isDeleted=0";
		$users_stmt = $con->prepare($Usr_users);
		$users_success = $users_stmt->execute();
		$rows_users = $users_stmt->fetchAll();

		echo json_encode($rows_users);
	} else if (isset($_GET['selectedPharmacyId'])) {
		//$usersIdDrugs=$_GET['usersIdMyPrescription'];
		$pharmacyId = $_GET['selectedPharmacyId'];
		$usrUsersId = $_GET['usersIdP'];
		$rolesId = $_GET['rolesId'];
		$search = $_GET['search'];

		if (isset($_GET['search'])) {
			ltrim($search);
			rtrim($search);

			$searchArray = explode(" ", $search);
			$cnt = count($searchArray);
		}

		if ($cnt = 1) {
			$columnValues = "firstName LIKE '$searchArray[0]%'  or gender LIKE '$searchArray[0]%'  or email LIKE '$searchArray[0]%' or mobilePhone LIKE '$searchArray[0]%' or prescription.prescriptionId LIKE '%$searchArray[0]%' ";
		} else if ($cnt = 2) {
			$columnValues = "firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%'";
		} else if ($cnt = 3) {
			$columnValues = "firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%' and grandFatherName  LIKE '$searchArray[2]%'";
		}
		if (isset($search)) {
			if ($rolesId == 2) {
				$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescription.patientId=users.usersId where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and pharmacyusers.usersId='$usrUsersId' and pharmacyusers.status='Active' and (" . $columnValues . ")  order by prescription.prescriptionDate DESC ";
				$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
				$prescDrugs_success = $prescDrugs_stmt->execute();
				$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
				echo json_encode($rows_prescDrugs);
			} else if ($rolesId == 4) {
				$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  INNER JOIN users on prescription.patientId=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and (" . $columnValues . ")   order by prescription.prescriptionDate DESC ";
				$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
				$prescDrugs_success = $prescDrugs_stmt->execute();
				$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
				echo json_encode($rows_prescDrugs);
			}
		} else {
			if ($rolesId = 2) {
				$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescription.patientId=users.usersId where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and pharmacyusers.usersId='$usrUsersId' and pharmacyusers.status='Active'  order by prescription.prescriptionDate DESC ";
				$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
				$prescDrugs_success = $prescDrugs_stmt->execute();
				$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
				echo json_encode($rows_prescDrugs);
			} else if ($rolesId == 4) {

				$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  INNER JOIN users on prescription.patientId=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId'   order by prescription.prescriptionDate DESC ";
				$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
				$prescDrugs_success = $prescDrugs_stmt->execute();
				$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
				echo json_encode($rows_prescDrugs);
			}
		}
		//prescription.patientId='".$usersIdDrugs."' and prescription.prescriberId='".$physcianId."' and 
	} else if (isset($_GET['pharmacyAdminUserId'])) {
		//$pharmacyAdminUserId=$_GET['pharmacyAdminUserId'];

		$pharmacy = "select * from pharmacy where isDeleted=0 and registeredById='" . $pharmacyAdminUserId . "'";
		$pharmacy_stmt = $con->prepare($pharmacy);
		$pharmacy_success = $pharmacy_stmt->execute();
		$rows_pharmacy  = $pharmacy_stmt->fetchAll();

		echo json_encode($rows_pharmacy);
	} else if (isset($_GET['pharmacistAdminId'])) {
		$pharmacyAdminUserId = $_GET['pharmacistAdminId'];

		$pharmacy = "select users.firstName,users.fatherName,users.grandFatherName,users.mobilePhone,users.gender,users.usersId, pharmacy.pharmacyId,  title.titleName, pharmacy.pharmacyName, pharmacy.pharmacyType, pharmacyusers.addedDate, pharmacistinfo.qualification, pharmacyusers.status from users INNER JOIN title on users.titleId=title.titleId INNER JOIN pharmacyusers on users.usersId=pharmacyusers.usersId INNER JOIN  roles on pharmacyusers.rolesId=roles.rolesId and roles.rolesName='Pharmacist' INNER JOIN pharmacy on pharmacyusers.pharmacyId=pharmacy.pharmacyId INNER JOIN pharmacistinfo on users.usersId=pharmacistinfo.usersId  where users.isDeleted=0  and pharmacyusers.addedById='" . $pharmacyAdminUserId . "'"; //and registeredById='".$pharmacistAdminId."'

		//INNER JOIN pharmacy on users.usersId=pharmacy.registeredById INNER JOIN usersrole on pharmacy.pharmacyId=users.
		$pharmacy_stmt = $con->prepare($pharmacy);
		$pharmacy_success = $pharmacy_stmt->execute();
		$rows_pharmacy  = $pharmacy_stmt->fetchAll();
		echo json_encode($rows_pharmacy);
	}
	?>

	
