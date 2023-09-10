  <?php

	if (isset($_GET['oncall']))
		$oncall = $_GET['oncall']();

	if (isset($_POST['oncall']))
		$oncall = $_POST['oncall']();



	// ---------------1. Login API	--------------------------------	

	// API:   localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=login&username=valueOfUsername&password=valueOfPassword

	// example localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=login&username=powner&password=12345678

	//type: Post
	function login()
	{
		ob_start();
		//error_reporting(0);
		include('../../../constants/databases/dbcon_eprescription.php'); // connecting to database
		if (isset($_POST['Uname']) and isset($_POST['password'])) {
			$uname = $_POST['Uname'];
			$userName = ucfirst(strtolower($uname));
			$dbUsersName = "";
			$email = "";
			$query = "SELECT usersId,userName,status,email,emailVerification,firstName,fatherName,grandFatherName,titleId FROM users WHERE userName='$userName' OR email='$userName'";
			$stmt = $con->prepare($query);
			$success = $stmt->execute();
			$rows = $stmt->fetchAll();
			//$rows_no = $rows->count();
			if ($success) {
				//print_r($query);
				foreach ($rows as $row) {


					$usersId = $row['usersId'];
					$email = $row['email'];
					$dbUsersName = $row['userName'];
					$status = $row['status'];
					$emailVerification = $row['emailVerification'];
					$titleId = $row['titleId'];
					$firstName = $row['firstName'];
					$fatherName = $row['fatherName'];
					$grandFatherName = $row['grandFatherName'];
				}

				if (($userName == $dbUsersName) ||  ($userName == $email)) {

					if ($status == 'limitedAccess' || $status == 'active') {

						$Uname = ucfirst(strtolower($_POST['Uname']));
						include('../../../constants/security/cryptsalt.php');
						$password = $_POST['password'];
						$password = hash_hmac('sha512', $password, $salt);
						$query = "SELECT userName,password,usersDefaultRolesId FROM users WHERE userName='$Uname' OR email='$Uname'";
						$stmt = $con->prepare($query);
						$success = $stmt->execute();
						$rows = $stmt->fetchAll();
						if ($success) {
							foreach ($rows as $row) {
								$db_password = $row['password'];
								$db_uname = $row['userName'];
								$usersDefaultRolesId = $row['usersDefaultRolesId'];
							}
							if ($password == $db_password) {

								// get Role id from user roles
								$Rquery = "SELECT rolesId FROM usersrole WHERE usersId='$usersId' AND isDefault='1' AND active=1 order by usersRoleId DESC limit 1";
								$stmtR = $con->prepare($Rquery);
								$successR = $stmtR->execute();
								$rowsR = $stmtR->fetchAll();
								if ($successR) {
									foreach ($rowsR as $row) {
										$rolesId = $row['rolesId'];
									}
								} else {
									$rolesId = 0;
								}

								if ($titleId == '' or $firstName == '' or $fatherName == '' or $grandFatherName == '') {
									$rowsArray = [];
									array_push($rowsArray, array("code" => "Unsuccessful", "message" => "Please Complete Signup"));
									echo json_encode($rowsArray);
								} else {
									// set last login time 
									$Time = date("Y-m-d h:i:s", time());
									$Update_L = "update users set lastLoginTime='$Time' where usersId='$usersId' ";
									$stmtL = $con->prepare($Update_L);
									$resultL = $stmtL->execute();
									//session_start();
									//include('../include/client_info.php');
									//$loginhistory = "insert into loginhistory (usersId,browserDetails,ipaddress,osType,deviceType,location) values('$usersId','$browserDetails','$ipaddress','$osType','$deviceType','$location')";
									//$stmtLH = $con->prepare($loginhistory);
									//$SuccessLH=$stmtLH->execute();
									//if($SuccessLH){
									$U_query = "select firstName,fatherName,grandFatherName,userName,password,gender,users.usersId,email,mobilePhone,officePhone, 
															dateOfBirth,lastLoginTime,users.status, pharmacyId, profilePicture,users.countryId,countryName,users.stateId,stateName,users.zoneId,zoneName,users.woredaId,woredaName,kebelle,rolesName,emailVerification,usersrole.rolesId
															from users join usersrole ON users.usersId=usersrole.usersId
															join roles ON roles.rolesId=usersrole.rolesId
															left join woreda ON users.woredaId=woreda.woredaId
															left join zone ON users.zoneId=zone.zoneId
															left join state ON users.stateId=state.stateId
															left join country ON users.countryId=country.countryId
															left join pharmacyusers on roles.rolesId=pharmacyusers.rolesId
															where users.usersId='$usersId' AND usersrole.isDefault='1' group by users.usersId";
									$U_stmt = $con->prepare($U_query);
									$U_success = $U_stmt->execute();
									$U_rows = $U_stmt->fetchAll(PDO::FETCH_ASSOC);
									echo json_encode($U_rows);
									//}
								}
							} else {
								$rowsArray = [];
								array_push($rowsArray, array("code" => "Unsuccessful", "message" => "Password is not correct"));
								echo json_encode($rowsArray);
							}
						}
					} elseif ($status == 'disabled') {
						$rowsArray = [];
						array_push($rowsArray, array("code" => "Unsuccessful", "message" => "User access denied, please contact Administrator"));
						echo json_encode($rowsArray);
					}
				} else {
					$rowsArray = [];
					array_push($rowsArray, array("code" => "Unsuccessful", "message" => "Incorrect Username, please sign up if you are a new user."));
					echo json_encode($rowsArray);
				}
			}
			// end of success
			else {
				$rowsArray = [];
				$rowsArray = array_push($rowsArray, array("code" => "Unsuccessful", "message" => "User not Registered"));
				echo json_encode($rowsArray);
			}
		}
	}

	//---------Display Pharmacy for pharmacist-----------------------------------

	function displayPharmacyPharmacist()
	{

		if (isset($_GET['pharmacyOwnerId']))
			$pharmacyOwnerId = $_GET['pharmacyOwnerId'];

		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacy = "select * from pharmacy INNER JOIN pharmacyusers on pharmacy.pharmacyId=pharmacyusers.pharmacyId where pharmacyusers.usersId='$pharmacyOwnerId' and (pharmacy.status='Active' and pharmacyusers.status='Active')";
		$pharmacy_stmt = $con->prepare($pharmacy);
		$pharmacy_success = $pharmacy_stmt->execute();
		$rows_pharmacy  = $pharmacy_stmt->fetchAll(PDO::FETCH_ASSOC);
		// $rows_pharmacy  = $pharmacy_stmt->fetchAll();


		echo json_encode($rows_pharmacy);
	}


	// 2. -------------------------Display Pharmacy for pharmacy owner -----------------------------

	// API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=displayPharmacy&pharmacyOwnerId=valueOfPharmacyOwnerId
	// example localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=displayPharmacy&pharmacyOwnerId=26
	function displayPharmacy()
	{


		if (isset($_GET['pharmacyOwnerId']))
			$pharmacyOwnerId = $_GET['pharmacyOwnerId'];

		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacy = "select * from pharmacy where isDeleted=0 and registeredById='$pharmacyOwnerId' ";
		$pharmacy_stmt = $con->prepare($pharmacy);
		$pharmacy_success = $pharmacy_stmt->execute();
		$rows_pharmacy  = $pharmacy_stmt->fetchAll(PDO::FETCH_ASSOC);
		// $rows_pharmacy  = $pharmacy_stmt->fetchAll();


		//echo json_encode($rows_pharmacy);
	}


	//  3------------------------- List of prescriptions send to pharmacy ---------------------

	// API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=displayPrescription&pharmacyId=valueOfPharmacyId&usersId=valueOfUserId&usersRolesId=valueOfUsersId
	//example: localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=displayPrescription&pharmacyId=11&usersId=26&usersRolesId=2

	// Method: GET
	function displayPrescription()
	{

		include('../../../constants/databases/dbcon_eprescription.php');

		if (isset($_POST['pharmacyId']))
			$pharmacyId = $_POST['pharmacyId'];
		if (isset($_POST['usersId']))
			$usersId = $_POST['usersId'];
		if (isset($_POST['usersRolesId']))
			$usersRolesId = $_POST['usersRolesId'];
		if (isset($_POST['search']))
			$search = $_POST['search'];


		if ($_POST['pharmacyId']) {
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
				if ($usersRolesId == 2) {
					$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescription.patientId=users.usersId where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and pharmacyusers.usersId='$usersId' and pharmacyusers.status='Active' and (" . $columnValues . ")  order by prescription.prescriptionDate DESC ";
				} else if ($usersRolesId == 4) {
					$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  INNER JOIN users on prescription.patientId=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and (" . $columnValues . ")   order by prescription.prescriptionDate DESC ";
				}
			} else {
				if ($usersRolesId == 2) {
					$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescription.patientId=users.usersId where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and pharmacyusers.usersId='$usersId' and pharmacyusers.status='Active'  order by prescription.prescriptionDate DESC ";
				} else if ($usersRolesId == 4) {
					$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  INNER JOIN users on prescription.patientId=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId'   order by prescription.prescriptionDate DESC ";
				}
			}
			$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
			$prescDrugs_success = $prescDrugs_stmt->execute();
			$rows_prescDrugs = $prescDrugs_stmt->fetchAll(PDO::FETCH_ASSOC);
			//  $rows_prescDrugs = $prescDrugs_stmt->fetchAll();
			echo json_encode($rows_prescDrugs);
		} else {
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
				if ($usersRolesId == 2) {
					$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescription.patientId=users.usersId where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and pharmacyusers.usersId='$usersId' and pharmacyusers.status='Active' and (" . $columnValues . ")  order by prescription.prescriptionDate DESC ";
				} else if ($usersRolesId == 4) {
					$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  INNER JOIN users on prescription.patientId=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and (" . $columnValues . ")   order by prescription.prescriptionDate DESC ";
				}
			} else {
				if ($usersRolesId == 2) {
					$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescription.patientId=users.usersId where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId' and pharmacyusers.usersId='$usersId' and pharmacyusers.status='Active'  order by prescription.prescriptionDate DESC ";
				} else if ($usersRolesId == 4) {
					$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  INNER JOIN users on prescription.patientId=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and prescribeddrugs.released=0 and prescription.pharmacyId= '$pharmacyId'   order by prescription.prescriptionDate DESC ";
				}
			}
			$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
			$prescDrugs_success = $prescDrugs_stmt->execute();
			//  $rows_prescDrugs = $prescDrugs_stmt->fetchAll(PDO::FETCH_ASSOC);
			$rows_prescDrugs = $prescDrugs_stmt->fetchAll();
			echo json_encode($rows_prescDrugs);
		}
	}


	function displayPrescriptionOnHub()
	{
		include('../../../constants/databases/dbcon_eprescription.php');

		if (isset($_POST['usersId']))
			$usersId = $_POST['usersId'];
		if (isset($_POST['usersRolesId']))
			$usersRolesId = $_POST['usersRolesId'];
		if (isset($_POST['search']))
			$search = $_POST['search'];
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
			if ($usersRolesId == 2) {
				//  $Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescription.patientId=users.usersId where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and (".$columnValues.") order by prescription.prescriptionDate DESC ";
				$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  INNER JOIN users on prescription.patientId=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and (" . $columnValues . ") order by prescription.prescriptionDate DESC ";
			} else if ($usersRolesId == 4) {
				$Usr_prescDrugs = "select prescribeddrugs.*, users.firstName,users.fatherName, users.grandFatherName,users.gender, users.mobilePhone, users.email, prescription.diagnosis, prescription.prescriptionDate, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId  INNER JOIN users on prescription.patientId=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Prescribed' and (" . $columnValues . ") order by prescription.prescriptionDate DESC ";
			}
		}
		$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
		$prescDrugs_success = $prescDrugs_stmt->execute();
		$rows_prescDrugs = $prescDrugs_stmt->fetchAll(PDO::FETCH_ASSOC);
		//  $rows_prescDrugs = $prescDrugs_stmt->fetchAll();
		echo json_encode($rows_prescDrugs);
	}




	// 4. Release All Medications from a  Prescriptions ------------------------------

	// 4.1  Realse a Single Medication from a prescription

	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=releaseMedication&pharmacyId=valueOfPharmacyId&pharmacistId=valueOfPharmacistId&drugsId=valueOfDrugId&prescriptionId=valueOfDrugId&releaseAll=0

	// example: localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=releaseMedication&pharmacyId=11&pharmacistId=26&drugsId=361&prescriptionId=187&releaseAll=0


	// 4.2  Realse all  Medications in a prescription

	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=releaseMedication&pharmacyId=valueOfPharmacyId&pharmacistId=valueOfPharmacistId&prescriptionId=valueOfPrescriptionId&releaseAll=1

	// example: localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=releaseMedication&pharmacyId=11&pharmacistId=26&drugsId=361&prescriptionId=187&releaseAll=0

	// return 1 if succesful else 0

	function releaseMedication()
	{
		include('../../../constants/databases/dbcon_eprescription.php');

		$usersId = $_POST['usersId'];
		$prescribedDrugsId = explode(",", substr($_POST['prescribedDrugsId'], 0, -1));
		$prescriptionId = $_POST['prescriptionId'];
		$releaseAll = $_POST['releaseAll']; // 1 means all, 0 means sel0ected drug
		$pharmacyId = $_POST['pharmacyId'];
		$arraySize = count($prescribedDrugsId);


		if ($releaseAll == 0) {


			$releaseAll = " update prescription set isReleased=1  where prescriptionId='" . $prescriptionId . "'";
			$releaseAll_stmt = $con->prepare($releaseAll);
			$releaseAll_success = $releaseAll_stmt->execute();

			if ($releaseAll_success) {
				for ($i = 0; $i < $arraySize; $i++) {
					$releaseAllDrugs = " update prescribeddrugs set released=1, releasedById='" . $usersId . "'  where prescriptionId='" . $prescriptionId . "' and prescribedDrugsId='$prescribedDrugsId[$i]' and status ='Prescribed'";
					$releaseAllDrugs_stmt = $con->prepare($releaseAllDrugs);
					$releaseAllDrugs_success = $releaseAllDrugs_stmt->execute();
					$rows_releaseAllDrugs_success = $releaseAllDrugs_success->fetchAll();
				}
			}
		} else {

			$releaseAll = " update prescription set isReleased=1  where prescriptionId='" . $prescriptionId . "'";
			$releaseAll_stmt = $con->prepare($releaseAll);
			$releaseAll_success = $releaseAll_stmt->execute();

			$releaseAllDrugs = " update prescribeddrugs set released=1, releasedById='" . $usersId . "'  where prescriptionId='" . $prescriptionId . "' and status ='Prescribed'";
			$releaseAllDrugs_stmt = $con->prepare($releaseAllDrugs);
			$releaseAllDrugs_success = $releaseAllDrugs_stmt->execute();
			$rows_releaseAllDrugs_success = $releaseAllDrugs_success->fetchAll();
		}

		if ($releaseAllDrugs_success)
			echo json_encode($rows_releaseAllDrugs_success);
	}

	// 5. Dispense All Medications from a  Prescriptions ------------------------------

	// 5.1  Dispense a Single Medication from a prescription

	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=dispenseMedication&pharmacyId=valueOfPharmacyId&pharmacistId=valueOfPharmacistId&prescribedDrugsId=valueOfPrescribedDrugsId&prescriptionId=valueOfPrescriptionId&trackingNumber=valueOfTrackingNumber&pickedBy=valueOfPickedBy&DispenseAll=0


	// 5.2  Dispense all Medication available in a prescription

	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=dispenseMedication&pharmacyId=valueOfPharmacyId&pharmacistId=valueOfPharmacistId&prescriptionId=valueOfPrescriptionId&trackingNumber=valueOfTrackingNumber&pickedBy=valueOfPickedBy&DispenseAll=1


	//here trackingNumber and prescribedDrugsId are arrays
	// returns 1 if successful  and 0 otherwise.
	// Type: GET

	function dispenseMedication()
	{

		include('../../../constants/databases/dbcon_eprescription.php');

		$prescriptionId = $_POST['prescriptionId'];
		$prescribedDrugsId = explode(",", substr($_POST['prescribedDrugsId'], 0, -1));
		$pickedBy = $_POST['pickedBy'];
		$trackingNumber = explode(",", substr($_POST['trackingNumber'], 0, -1));
		$pharmacyId = $_POST['pharmacyId'];
		$dispenseAll = $_POST['dispenseAll'];
		$dispensedById = $_POST['pharmacistId'];

		$status = 1;
		$arraySize = count($trackingNumber);
		for ($i = 0; $i < $arraySize; $i++) {
			if ($pharmacyId == '' || $trackingNumber[$i] == '') {
				$status = 0;
			}
		}
		if ($status == 1) {
			for ($i = 0; $i < $arraySize; $i++) {
				$updateQuery = "update prescribeddrugs set pharmacyId='$pharmacyId', status = 'Dispensed',pickedBy='$pickedBy', trackingNumber = '$trackingNumber[$i]', dispensedById='$dispensedById' where prescribedDrugsId = '$prescribedDrugsId[$i]' and status='Prescribed'";
				$stmtU = $con->prepare($updateQuery);
				$successPreD = $stmtU->execute();
			}

			if ($successPreD) {

				$sql = "select count(*) from prescribeddrugs where prescriptionId='$prescriptionId' and status='Prescribed'";
				$result = $con->prepare($sql);
				$result->execute();
				$number_of_rows = $result->fetchColumn();
				if ($number_of_rows == 0) {
					$update_query = "update prescription set status = 'Dispensed' where prescriptionId = '$prescriptionId' and status='Prescribed'";
					$stmtU = $con->prepare($update_query);
					$successU = $stmtU->execute();
				}
			}
		}

		if ($successPreD)
			$status = 1;
		else $status = 0;

		echo $status;
	}

	//  6. Displaying Dispensed Medications for a selected pharmacy ------------------
	// API:   localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=displayDispensedMedications&selectedPharmacyId=valueOfSelectedPharmacyId&usersId=valueOfUsersId&usersRolesId=valueOfUsersId

	function displayDispensedMedications()
	{

		include('../../../constants/databases/dbcon_eprescription.php');


		$pharmacyId = $_GET['selectedPharmacyId'];
		$usrUsersId = $_GET['usersId'];
		$usersRolesId = $_GET['usersRolesId'];

		if ($usersRolesId == 2) {
			$Usr_prescDrugs = "select prescribeddrugs.*, users.userName, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN pharmacyusers on prescription.pharmacyId=pharmacyusers.pharmacyId INNER JOIN users on prescribeddrugs.dispensedById=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Dispensed' and prescription.pharmacyId= '$pharmacyId' and pharmacyusers.usersId='$usrUsersId' and pharmacyusers.status='Active'  order by prescription.prescriptionDate DESC ";
		} else if ($usersRolesId === 4) {


			$Usr_prescDrugs = "select prescribeddrugs.*, users.userName, prescription.chiefCompliant,  drugs.drugsName, prescription.prescriptionId as prescriptionId from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId INNER JOIN prescription on prescribeddrugs.prescriptionId=prescription.prescriptionId INNER JOIN users on prescribeddrugs.dispensedById=users.usersId  where prescribeddrugs.isDeleted=0  and prescribeddrugs.status ='Dispensed' and prescription.pharmacyId= '$pharmacyId'   order by prescription.prescriptionDate DESC ";
		}
		$prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
		$prescDrugs_success = $prescDrugs_stmt->execute();
		$rows_prescDrugs = $prescDrugs_stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($rows_prescDrugs);
	}

	//  7. Registering a new pharmacy ------------------
	//API:   localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=addPharmacy&pharmacyName=ValueOfpharmacyName&pharmacyType=valueOfpharmacyType&licenceNumber=valueOflicenceNumber&registrationNumber=valueOfregistrationNumber&country=valueOfcountry&state=valueOfstate&zone=valueOfzone&woreda=valueOfworeda&kebelle=valueOfkebelle&streetNumber=valueOfstreetNumber&email=valueOfemail&phoneNumber=valueOfphoneNumber&longitude=valueOflongitude&latitude=valueOflatitude&tinNumber=valueOftinNumber&registeredById=valueOfRegisteredById
	// returns  1 if successful and returns 0 otherwise
	//--------------

	function addPharmacy()
	{

		include('../../../constants/databases/dbcon_eprescription.php');

		$pharmacyName = isset($_POST['pharmacyName']) ? $_POST['pharmacyName'] : '';
		$pharmacyType = isset($_POST['pharmacyType']) ? $_POST['pharmacyType'] : '';
		$licenceNumber = isset($_POST['licenceNumber']) ? $_POST['licenceNumber'] : '';
		$registrationNumber = isset($_POST['registrationNumber']) ? $_POST['registrationNumber'] : '';

		$country = isset($_POST['country']) ? $_POST['country'] : 0;
		$state = isset($_POST['state']) ? $_POST['state'] : 0;
		$zone = isset($_POST['zone']) ? $_POST['zone'] : 0;
		$woreda = isset($_POST['woreda']) ? $_POST['woreda'] : 0;
		$kebelle = isset($_POST['kebelle']) ? $_POST['kebelle'] : '';
		$streetNumber = isset($_POST['streetNumber']) ? $_POST['streetNumber'] : '';
		$tinNumber = isset($_POST['tinNumber']) ? $_POST['tinNumber'] : '';
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '';

		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];


		$regById = $_POST['registeredById'];

		$resp = 0;
		if ($pharmacyName == '' || $pharmacyType == '' || $licenceNumber == '' || $registrationNumber == '' || $country == 0 || $state == 0 || $zone == 0  || $woreda == 0 || $kebelle == '' || $email == ''  || $phoneNumber == '' || $latitude == '' || $longitude == '' || $tinNumber == '') {

			$resp = 0;
		} else {


			$Add_query = "insert into pharmacy(pharmacyName, pharmacyType, licenceNumber, registrationNumber,countryId, stateId, zoneId, woredaId, kebelle, streetNumber, email, phoneNumber, tinNumber, longitude,latitude,registeredById) values('$pharmacyName', '$pharmacyType', '$licenceNumber', '$registrationNumber','$country',  '$state', '$zone', '$woreda', '$kebelle', '$streetNumber', '$email', '$phoneNumber',  '$tinNumber','$longitude','$latitude','$regById')";
			$stmtadd = $con->prepare($Add_query);
			$stmtadd->execute();
			$resp = 1;
		}

		echo $resp;
	}


	//-------8  display pharmacist--------------
	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=displayPharmacist&pharmacyOwnerId=valueOfPharmacyOwnerId
	// example localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=displayPharmacy&pharmacyOwnerId=26

	// displays pharmacists assigned in different pharmacy

	function  displayPharmacist()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacyAdminUserId = $_GET['pharmacyOwnerId'];

		$pharmacy = "select users.firstName,users.fatherName,users.grandFatherName,users.mobilePhone,users.gender,users.usersId, pharmacy.pharmacyId,  title.titleName, pharmacy.pharmacyName, pharmacy.pharmacyType, pharmacyusers.addedDate, pharmacistinfo.qualification, pharmacyusers.status from users INNER JOIN title on users.titleId=title.titleId INNER JOIN pharmacyusers on users.usersId=pharmacyusers.usersId INNER JOIN  roles on pharmacyusers.rolesId=roles.rolesId and roles.rolesName='Pharmacist' INNER JOIN pharmacy on pharmacyusers.pharmacyId=pharmacy.pharmacyId INNER JOIN pharmacistinfo on users.usersId=pharmacistinfo.usersId  where users.isDeleted=0  and pharmacyusers.addedById='" . $pharmacyAdminUserId . "'";

		$pharmacy_stmt = $con->prepare($pharmacy);
		$pharmacy_success = $pharmacy_stmt->execute();
		$rows_pharmacy  = $pharmacy_stmt->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($rows_pharmacy);
	}


	//------9 search pharmacist dynamically for selecting and assigning into a pharamacy
	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=searchPharmacist&search=valueOfSearch
	function searchPharmacist()
	{

		include('../../../constants/databases/dbcon_eprescription.php');
		$search = $_POST['search'];

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

			$pharmacistList = " SELECT title.titleName,roles.rolesName, roles.rolesId, pharmacistinfo.qualification, pharmacistinfo.licenceNo,pharmacistinfo.licenceExpirationDate,users.usersId, firstName, fatherName, grandFatherName, gender, email, mobilePhone from users  INNER JOIN title on users.titleId=title.titleId and users.isDeleted=0  INNER JOIN usersrole on users.usersId =usersrole.usersId and usersrole.active=1 INNER JOIN roles on usersrole.rolesId =roles.rolesId and roles.isDeleted=0 INNER JOIN pharmacistinfo on users.usersId=pharmacistinfo.usersId where (" . $columnValues . ") and roles.rolesName='Pharmacist' limit 50";
		} else {

			$pharmacistList = " SELECT title.titleName,roles.rolesName, roles.rolesId, pharmacistinfo.qualification, pharmacistinfo.licenceNo,pharmacistinfo.licenceExpirationDate,users.usersId, firstName, fatherName, grandFatherName, gender, email, mobilePhone from users  INNER JOIN title on users.titleId=title.titleId and users.isDeleted=0  INNER JOIN usersrole on users.usersId =usersrole.usersId and usersrole.active=1 INNER JOIN roles on usersrole.rolesId =roles.rolesId and roles.isDeleted=0 INNER JOIN pharmacistinfo on users.usersId=pharmacistinfo.usersId where roles.rolesName='Pharmacist' limit 50";
		}
		$pharmacistList_stmt = $con->prepare($pharmacistList);
		$pharmacistList_success = $pharmacistList_stmt->execute();
		$rows_pharmacistList  = $pharmacistList_stmt->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($rows_pharmacistList);
	}




	//------10 to disable selected pharmacists from acccessing  pharamacies by pharmacy owner.
	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=enableDisablePharmacistToAccessPharmacy&pharmacyId=valueOfpharmacyId&pharmacistId=valueOfpharmacistId&checkBox=valueOfCheckBox&pharmacyOwnerId=valueOfPharmacyOwnerId

	//  pharmacyId, status,pharmacistId  are array variables
	// the value of checkedBox is Active or Disabled 
	//returns 1 if successful else 0

	function enableDisablePharmacistToAccessPharmacy()
	{

		include('../../../constants/databases/dbcon_eprescription.php');

		$pharmacyId = $_POST['pharmacyId'];
		$checkBox = $_POST['status'];
		$usersId = $_POST['pharmacistId'];
		$usrUsersId = $_POST['pharmacyOwnerId'];

		//echo $pharmacyId[0].'  check'.$checkBox[0].'   phacist'.$usersId[0].'  owner'.$usrUsersId;

		$status = 0;
		for ($j = 0; $j < count($pharmacyId); $j++) {

			$sql = "select count(*) from pharmacyusers where pharmacyId='" . $pharmacyId[$j] . "' and status !='" . $checkBox[$j] . "' and usersId='" . $usersId[$j] . "'";
			$result = $con->prepare($sql);
			$result->execute();
			$numberOfAssignment1 = $result->fetchColumn();


			$pharmacyUser = " update pharmacyusers set status='" . $checkBox[$j] . "'  where usersId='" . $usersId[$j] . "' and pharmacyId= '" . $pharmacyId[$j] . "' and status !='" . $checkBox[$j] . "' ";
			$pharmacyUser_stmt = $con->prepare($pharmacyUser);
			$pharmacyUser_success = $pharmacyUser_stmt->execute();



			if ($numberOfAssignment1 == 1) {

				$status = 1;
				$qry_log = "insert into pharmacistmanagement(usersId, PharmacyId,managedById,status) VALUES( '" . $usersId[$j] . "','" . $pharmacyId[$j] . "','" . $usrUsersId . "', '" . $checkBox[$j] . "')";
				$log_stmt = $con->prepare($qry_log);
				$log_success = $log_stmt->execute();
			}
		}

		echo $status;
	}



	// -----------------11---------assigning pharmacists to pharmacies by pharmacy owner

	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=assignPharmacistToPharmacy&pharmacyId=valueOfpharmacyId&pharmacistId=valueOfpharmacistId&checkBox=valueOfCheckBox&pharmacyOwnerId=valueOfPharmacyOwnerId

	//  pharmacyId, checkBox,pharmacistId  are array variables
	// the value of checkedBox is 1 or 0. 1 means selected (or checked) and 0 means not checked
	//returns 1 if successful else 0
	// rolesId is required, because a pharmacy owner can be a pharmacist as well (two previlages). for pharmacist it is always 2. no need to post.
	function assignPharmacistToPharmacy()
	{

		include('../../../constants/databases/dbcon_eprescription.php');

		$checkboxUsersId = $_POST['checkBox'];
		$assignToPharmacyId = $_POST['pharmacyId'];
		$assignPharmacyAdminId = $_POST['pharmacyOwnerId'];
		$assignedUsersId = $_POST['pharmacistId'];
		$status = 0;


		for ($j = 0; $j < count($assignToPharmacyId); $j++) {

			if ($checkboxUsersId[$j] == 1) {

				$sql = "select count(*) from pharmacyusers where rolesId=2 and pharmacyId='" . $assignToPharmacyId[$j] . "' and usersId='" . $assignedUsersId[$j] . "'";
				$result = $con->prepare($sql);
				$result->execute();
				$numberOfAssignment = $result->fetchColumn();
				if ($numberOfAssignment == 0) {
					$status = 1;
					$pharmacyUser = " INSERT into pharmacyusers (usersId,pharmacyId,addedById,rolesId, status) VALUES('" . $assignedUsersId[$j] . "','" . $assignToPharmacyId[$j] . "','" . $assignPharmacyAdminId . "' ,2,'Active')";
					$pharmacyUser_stmt = $con->prepare($pharmacyUser);
					$pharmacyUser_success = $pharmacyUser_stmt->execute();
				}
			}
		}
		echo $status;
	}


	//----12 find pharmacy  any system user can find for a pharmacy ..


	//API:  localhost/eprescription/mobileAPI/dashboard/pharmacy.php?oncall=findPharmacy&search=valueOfSearch

	function findPharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$search = $_POST['search'];

		ltrim($search);

		if ($search != '') {

			$pharmacy = "select pharmacy.*,woreda.woredaName,zone.zoneName, state.stateName,country.countryName from pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  INNER JOIN country on country.countryId=pharmacy.countryId where pharmacy.isDeleted=0 and (pharmacy.pharmacyType like '$search%'  or pharmacy.pharmacyName like '$search%'  or pharmacy.kebelle like '$search%'  or pharmacy.streetNumber like '$search%'  or pharmacy.pharmacyType like '$search%'  or pharmacy.email like '$search%'  or pharmacy.phoneNumber like '$search%'  or pharmacy.licenceNumber like '$search%'  or pharmacy.registrationNumber like '$search%'  or country.countryName like '$search%'  or state.stateName like '$search%'  or zone.ZoneName like '$search%'  or woreda.woredaName like '$search%' )";
		} else {
			$pharmacy = "select pharmacy.*,woreda.woredaName,zone.zoneName, state.stateName,country.countryName from pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  INNER JOIN country on country.countryId=pharmacy.countryId where pharmacy.isDeleted=0";
		}


		$pharmacy_stmt = $con->prepare($pharmacy);
		$pharmacy_success = $pharmacy_stmt->execute();
		$rows_pharmacy  = $pharmacy_stmt->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($rows_pharmacy);
	}



	function findActivePharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$search = $_POST['search'];

		ltrim($search);

		if ($search != '') {

			$pharmacy = "select pharmacy.*,woreda.woredaName,zone.zoneName, state.stateName,country.countryName from pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  INNER JOIN country on country.countryId=pharmacy.countryId where pharmacy.isDeleted=0 and (pharmacy.pharmacyType like '$search%'  or pharmacy.pharmacyName like '$search%'  or pharmacy.kebelle like '$search%'  or pharmacy.streetNumber like '$search%'  or pharmacy.pharmacyType like '$search%'  or pharmacy.email like '$search%'  or pharmacy.phoneNumber like '$search%'  or pharmacy.licenceNumber like '$search%'  or pharmacy.registrationNumber like '$search%'  or country.countryName like '$search%'  or state.stateName like '$search%'  or zone.ZoneName like '$search%'  or woreda.woredaName like '$search%' and pharmacy.status = 'Active')";
		} else {
			$pharmacy = "select pharmacy.*,woreda.woredaName,zone.zoneName, state.stateName,country.countryName from pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  INNER JOIN country on country.countryId=pharmacy.countryId where pharmacy.isDeleted=0 and pharmacy.status = 'Active'";
		}


		$pharmacy_stmt = $con->prepare($pharmacy);
		$pharmacy_success = $pharmacy_stmt->execute();
		$rows_pharmacy  = $pharmacy_stmt->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($rows_pharmacy);
	}






	// 13 ...................Manage pharmacy availablity (ON or OFF)
	function managePharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacyId = $_POST['pharmacyId'];
		$status = $_POST['status'];
		$usrUsersId = $_POST['usersId'];
		// value of status= Active or Disabled
		//for ($j=0;$j<count($pharmacyId);$j++){
		$pharmacyUpdate = " update pharmacy set status='" . $status . "'  where pharmacyId= '" . $pharmacyId . "' ";
		$pharmacyUpdate_stmt = $con->prepare($pharmacyUpdate);
		$pharmacyUpdate_success = $pharmacyUpdate_stmt->execute();
		$qry_log = "insert into pharmacymanagement(pharmacyId,usersId,status) VALUES( '" . $pharmacyId . "','" . $usrUsersId . "', '" . $status . "')";
		$log_stmt = $con->prepare($qry_log);
		$log_success = $log_stmt->execute();
	}



	function myPatients()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$search = $_POST['search'];
		$usrUsersId = $_POST['doctorId'];
		$cnt = 0;
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

			$Usr_query = "select users.* from users INNER JOIN prescription on prescription.patientId=users.usersId where (" . $columnValues . ") and prescription.isDeleted=0 and prescription.prescriberId='" . $usrUsersId . "' group by users.usersId";
		} else {
			$Usr_query = "select users.* from users INNER JOIN prescription on prescription.patientId=users.usersId where prescription.isDeleted=0 and prescription.prescriberId='" . $usrUsersId . "' group by users.usersId";
		}

		$Usr_stmt = $con->prepare($Usr_query);
		$Usr_success = $Usr_stmt->execute();
		$rows = $Usr_stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($rows);
	}



	function getDrugs()
	{
		$search = $_GET['search'];
		include('../../../constants/databases/dbcon_eprescription.php');

		if ($search == '') {
			$qry = "select drugsId, drugsName from drugs where drugsStatus ='1' limit 30";
			$qry_stmt = $con->prepare($qry);
			$qry_success = $qry_stmt->execute();
			$row_qry = $qry_stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {

			$qry = "select drugsId, drugsName from drugs where drugsStatus ='1' and drugsName LIKE '$search%' limit 30";
			$qry_stmt = $con->prepare($qry);
			$qry_success = $qry_stmt->execute();
			$row_qry = $qry_stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		echo json_encode($row_qry);
	}


	function getTitles()
	{
		include('../../../constants/databases/dbcon_eprescription.php');

		$qry = "select * from title";
		$qry_stmt = $con->prepare($qry);
		$qry_success = $qry_stmt->execute();
		$row_qry = $qry_stmt->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($row_qry);
	}

	function getAssignedPharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$rolesId = $_GET['rolesId'];
		$usrUsersId = $_GET['usersId'];
		$numberOfPharmacy = 0;
		if ($rolesId == 4) {
			$select_pharmacy = "select pharmacy.pharmacyName, pharmacy.pharmacyType, pharmacy.pharmacyId from pharmacy where registeredById='$usrUsersId' and (status='Active' or status='Disabled')";
			$select_stmt = $con->prepare($select_pharmacy);
			$resultPharmacy1 = $select_stmt->execute();
			$rows_qry  = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($rows_qry);
		} else if ($rolesId == 2) {
			$select_pharmacy = "select pharmacy.pharmacyName, pharmacy.pharmacyId, pharmacy.pharmacyType from pharmacy INNER JOIN pharmacyusers on pharmacy.pharmacyId=pharmacyusers.pharmacyId where pharmacyusers.usersId='$usrUsersId' and pharmacyusers.status='Active'  and (pharmacy.status='Active' or pharmacy.status='Disabled')";
			$select_stmt = $con->prepare($select_pharmacy);
			$resultPharmacy1 = $select_stmt->execute();
			$rows_qry  = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($rows_qry);
		}
	}

	function getAcceptedPrescriptionDetailsPatient()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$usersId = $_GET['usersId'];


		$select_pharmacy = "select uploadedprescriptionstatus.*,pharmacy.pharmacyName,pharmacy.pharmacyType,pharmacy.kebelle,pharmacy.phoneNumber, pharmacy.streetNumber, pharmacy.latitude,pharmacy.longitude  from uploadedprescriptionstatus INNER JOIN pharmacy on uploadedprescriptionstatus.pharmacyId=pharmacy.pharmacyId 
	 INNER JOIN uploadedprescriptions ON uploadedprescriptionstatus.uploadedPrescriptionsId=uploadedprescriptions.uploadedPrescriptionsId where uploadedprescriptions.usersId='$usersId' and uploadedprescriptionstatus.status='Accepted'";
		$select_stmt = $con->prepare($select_pharmacy);
		$resultPharmacy1 = $select_stmt->execute();
		$rows_qry  = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
		if (sizeof($rows_qry) != 0)
			echo json_encode($rows_qry);
		else echo 0;
	}


	function getPostedPrescriptionDetailsPatient()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$userId = $_GET['usersId'];
		$select_pharmacy = "select uploadedPrescriptionsId, imageName, comment, status, uploadedDate  from uploadedprescriptions where usersId='$userId' and (status='Pending' || status='Not in Range')";
		$select_stmt = $con->prepare($select_pharmacy);
		$resultPharmacy1 = $select_stmt->execute();
		$rows_qry  = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
		if (sizeof($rows_qry) != 0)
			echo json_encode($rows_qry);
		else echo 0;
	}

	function cancelPostedPrescriptionDetailsPatient()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$uploadedPrescriptionsId = $_POST['uploadedPrescriptionsId'];

		$con->beginTransaction();

		$Check_A = "select count(*) from uploadedprescriptionstatus where uploadedPrescriptionsId='$uploadedPrescriptionsId' and status='Dispensed'";
		$stmtA = $con->prepare($Check_A);
		$successA = $stmtA->execute();
		$cnt = $stmtA->fetchColumn();
		$status = 0;
		if ($cnt == 0) {
			$select_pharmacy = "update uploadedprescriptions set status='Cancelled' where uploadedPrescriptionsId='$uploadedPrescriptionsId' and status !='Processed'";
			$select_stmt = $con->prepare($select_pharmacy);
			$resultSel = $select_stmt->execute();

			$query_del = "delete FROM nearbypharmacycache where uploadedPrescriptionsId='$uploadedPrescriptionsId'";
			$stmt_del = $con->prepare($query_del);
			$resultDel = $stmt_del->execute();

			$query_update = " update uploadedprescriptionstatus set status='Cancelled' where uploadedPrescriptionsId='$uploadedPrescriptionsId' and status !='Dispensed'";
			$update_stmt = $con->prepare($query_update);
			$resultUpdate = $update_stmt->execute();


			if ($resultSel && $resultDel && $resultUpdate) {
				$con->commit();
				$status = 1;
			} else {
				$con->rollback();
				// echo 0
			}
		}

		echo $status;
	}



	function getPostedPrescriptionDetailsPharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacyId = $_GET['PharmacyId'];
		$U_query = "select titleName,firstName,fatherName,grandFatherName,gender,users.usersId,users.email,mobilePhone, profilePicture, uploadedprescriptions.uploadedPrescriptionsId, imageName,comment,uploadedprescriptions.status,uploadedDate,  nearbypharmacycache.distance,  nearbypharmacycache.pharmacyId, nearbypharmacycache.addedDate from uploadedprescriptions 
                INNER JOIN users ON uploadedprescriptions.usersId=users.usersId
                INNER JOIN nearbypharmacycache on uploadedprescriptions.uploadedPrescriptionsId=nearbypharmacycache.uploadedPrescriptionsId 
                INNER JOIN pharmacy on nearbypharmacycache.pharmacyId=pharmacy.pharmacyId
                JOIN title ON users.titleId=title.titleId where nearbypharmacycache.pharmacyId='" . $pharmacyId . "' and nearbypharmacycache.released=0   order by nearbypharmacycache.addedDate DESC LIMIT 30 ";
		$U_stmt = $con->prepare($U_query);
		$U_success = $U_stmt->execute();
		$U_rows = $U_stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($U_rows);
	}

	function getAcceptedPrescriptionDetailsPharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');

		$pharmacyId = $_GET['PharmacyId'];

		$U_query = "select titleName,firstName,fatherName,grandFatherName,gender,users.usersId,users.email,mobilePhone, profilePicture, uploadedprescriptions.uploadedPrescriptionsId, uploadedprescriptionstatus.status,imageName, comment, actionDate, distanceFromRequester as distance, pharmacy.pharmacyId from uploadedprescriptions 
                INNER JOIN users ON uploadedprescriptions.usersId=users.usersId
                INNER JOIN uploadedprescriptionstatus on uploadedprescriptions.uploadedPrescriptionsId=uploadedprescriptionstatus.uploadedPrescriptionsId 
                INNER JOIN pharmacy on uploadedprescriptionstatus.pharmacyId=pharmacy.pharmacyId
                JOIN title ON users.titleId=title.titleId where uploadedprescriptionstatus.pharmacyId='" . $pharmacyId . "'  and uploadedprescriptionstatus.status='Accepted' order by uploadedprescriptionstatus.actionDate DESC LIMIT 30 ";
		$U_stmt = $con->prepare($U_query);
		$U_success = $U_stmt->execute();
		$U_rows = $U_stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($U_rows);
	}

	function releasePostedPrescriptionDetailsPharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacyId = $_POST['PharmacyId'];
		$uploadedPrescriptionsId = $_POST['uploadedPrescriptionsId'];
		$update_query = "update nearbypharmacycache set released=1 where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId'";
		$stmtU = $con->prepare($update_query);
		$successPre = $stmtU->execute();

		if ($successPre)
			echo 1;
		else echo 0;
	}


	function acceptPostedPrescriptionDetailsPharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacyId = $_POST['PharmacyId'];
		$pharmacistId = $_POST['usersId'];
		$uploadedPrescriptionsId = $_POST['uploadedPrescriptionsId'];
		$distanceFromRequester = $_POST['distanceFromRequester'];

		$con->beginTransaction();

		$update_query = "update nearbypharmacycache set released=1 where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId'";
		$stmtU = $con->prepare($update_query);
		$successUpdate = $stmtU->execute();

		$select_query = " select count(*)  from uploadedprescriptionstatus where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId'";
		$stmtSel = $con->prepare($select_query);
		$successSel = $stmtSel->execute();
		$cnt = $stmtSel->fetchColumn();
		$successinsert = 0;
		if ($cnt == 0) {
			$insert_query = "INSERT INTO uploadedprescriptionstatus(uploadedPrescriptionsId,pharmacyId,pharmacistId,distanceFromRequester,status) VALUES ('$uploadedPrescriptionsId','$pharmacyId','$pharmacistId','$distanceFromRequester','Accepted')";
			$stmtIns = $con->prepare($insert_query);
			$successinsert = $stmtIns->execute();

			if ($successUpdate &&  $successSel  && $successinsert) {
				$con->commit();
				echo 1;
			} else {
				$con->rollback();
				echo 0;
			}
		}
	}


	function releaseAcceptedPrescriptionDetailsPharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacyId = $_POST['PharmacyId'];
		$pharmacistId = $_POST['usersId'];
		$uploadedPrescriptionsId = $_POST['uploadedPrescriptionsId'];
		$con->beginTransaction();
		$update_query = "update nearbypharmacycache set released=1 where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId'";
		$stmtU = $con->prepare($update_query);
		$successPre = $stmtU->execute();

		$update_queryRe = "update uploadedprescriptionstatus set status='Released', pharmacistId='$pharmacistId' where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId' and status='Accepted'";
		$stmtRe = $con->prepare($update_queryRe);
		$successRe = $stmtRe->execute();


		if ($successPre && $successRe) {
			$con->commit();

			echo 1;
		} else {
			$con->rollback();

			echo 0;
		}
	}

	function dispenseAcceptedPrescriptionDetailsPharmacy()
	{
		include('../../../constants/databases/dbcon_eprescription.php');
		$pharmacyId = $_POST['PharmacyId'];
		$pharmacistId = $_POST['usersId'];
		$uploadedPrescriptionsId = $_POST['uploadedPrescriptionsId'];

		$con->beginTransaction();

		$update_queryRe = "update uploadedprescriptionstatus set status='Dispensed', pharmacistId='$pharmacistId' where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId' and status='Accepted'";
		$stmtRe = $con->prepare($update_queryRe);
		$successRe = $stmtRe->execute();


		$update_queryC = "update uploadedprescriptions set status='Processed' where uploadedPrescriptionsId='$uploadedPrescriptionsId' and status ='Pending'";
		$stmtC = $con->prepare($update_queryC);
		$successC = $stmtC->execute();

		if ($successRe && $successC) {
			$con->commit();
			echo 1;
		} else {
			$con->rollback();

			echo 0;
		}
	}

	?>