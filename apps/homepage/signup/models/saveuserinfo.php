<?php
session_start();
include('../../../../constants/databases/dbcon_eprescription.php'); // connecting to database
include('../../../../constants/security/cryptsalt.php');
include('../../../../apps/common/email/email-send.php');
$User_Updated = 0;
$Role_Requested = 0;
$User_Registered = 0;
if (isset($_POST['userInfo'])) {
	$email = ucfirst(strtolower($_POST['email']));
	$rolesId = $_POST['rolesId'];
	$password = $_POST['password'];
	$mobilePhone = $_POST['mobilePhone'];
	$password = hash_hmac('sha512', $password, $salt);
	$userName = ucfirst(strtolower($_POST['userName']));
	$firstName = $_POST['firstName'];
	$fatherName = $_POST['fatherName'];
	$grandFatherName = $_POST['grandFatherName'];
	$titleId = $_POST['titleId'];
	$gender = $_POST['gender'];

	if($rolesId==1){
		
			$dateOfBirth = $_POST['PatientdateOfBirth'];

	}
	else{
			$dateOfBirth = $_POST['dateOfBirth'];

	}
	$licenceId = $_POST['licenceId'];
	if ($gender == 'Male') {
		$profilePicture = "defaultMale.jpg";
	}
	if ($gender == 'Female') {
		$profilePicture = "defaultFemale.jpg";
	}

	$Check_Uname = "select count(*) from users where userName = '$userName' ";
	$stmtUn = $con->prepare($Check_Uname);
	$stmtUn->execute();
	$rowsUn = $stmtUn->fetchColumn();
	if ($rowsUn == 0) { // count num rows here must be zero
		$Check_Uname = "select count(*) from users where email = '$email' ";
		$stmtUn = $con->prepare($Check_Uname);
		$stmtUn->execute();
		$rowsUn = $stmtUn->fetchColumn();
		if ($rowsUn == 0) {
			$AddU_query = "insert into users (titleId,firstName,fatherName,grandFatherName,gender,dateOfBirth,email,mobilePhone,userName,password,usersDefaultRolesId,status,profilePicture,licenceId) 
					  values('$titleId','$firstName','$fatherName','$grandFatherName','$gender','$dateOfBirth','$email','$mobilePhone','$userName','$password','$rolesId','limitedAccess','$profilePicture','$licenceId')";
			$stmtaddU = $con->prepare($AddU_query);
			$resultU = $stmtaddU->execute();
			//$usersId= $resultU->last();
			if ($resultU) {
				$User_Id_query = "select usersId from users where userName='$userName' AND email='$email' AND mobilePhone='$mobilePhone' order by usersId DESC limit 1";
				$UI_stmt = $con->prepare($User_Id_query);
				$UI_success = $UI_stmt->execute();
				$UI_rows = $UI_stmt->fetchAll();
				foreach ($UI_rows as $row) {
					$usersId = $row['usersId'];
				}
				if ($usersId != 0) { // for patient users only
					$User_Registered = 1;
				}
			} else {
				$_SESSION['error_signup'] = 'User not registered';
				header("location: ../../../index.php");
			}
		} else {
			$_SESSION['error_signup'] = 'Email is already Used by another person. Try another';
			header("location: ../../../index.php");
		}
	} else {
		$_SESSION['error_signup'] = 'Username is already Used by another person. try another';
		header("location: ../../../index.php");
	}


	if ($User_Registered == 1) {
		// if ($rolesId == 1) {
			$AddUR_query = "insert into usersrole (usersId,rolesId,isDefault,addedById) 
		values('$usersId',1,1,'$usersId')";
			$stmtAddUR = $con->prepare($AddUR_query);
			$resultUR = $stmtAddUR->execute();
			if ($resultUR) {
				$Role_Requested = 1;
			}
		// }

		if ($rolesId == 2) {
			$roleRequestId = 0;
			$educationalLevelId = $_POST['educationalLevelId'];
			$graduatedFrom = $_POST['graduatedFrom'];
			$graduationYear = $_POST['graduationYear'];
			$licenceNo = $_POST['licenceNo'];
			$licenceExpirationDate = $_POST['licenceExpirationDate'];
			$qualification = $_POST['qualification'];
			$Check_R = "select count(*) from rolerequest where usersId = '$usersId' AND rolesId=2";
			$stmtR = $con->prepare($Check_R);
			$stmtR->execute();
			$rowsR = $stmtR->fetchColumn();
			if ($rowsR == 0) {
				$Add_query = "insert into rolerequest (usersId,rolesId) values('$usersId','$rolesId') ";
				$stmtAddC = $con->prepare($Add_query);
				$resultC = $stmtAddC->execute();
				if ($resultC) {
					$RRI_query = "select roleRequestId from rolerequest where usersId='$usersId' AND rolesId='$rolesId' AND status='Pending' order by roleRequestId DESC limit 1";
					$RRI_stmt = $con->prepare($RRI_query);
					$RRI_success = $RRI_stmt->execute();
					$RRI_rows = $RRI_stmt->fetchAll();
					foreach ($RRI_rows as $row) {
						$roleRequestId = $row['roleRequestId'];
					}
					if ($roleRequestId != 0) {
						$AddRR_query = "insert into pharmacistinfo (roleRequestId,usersId,educationalLevelId,graduatedFrom,graduationYear,licenceNo,licenceExpirationDate,qualification) 
				  values('$roleRequestId','$usersId','$educationalLevelId','$graduatedFrom','$graduationYear','$licenceNo','$licenceExpirationDate','$qualification') ";
						$stmtAddRR = $con->prepare($AddRR_query);
						$resultRR = $stmtAddRR->execute();
						if ($resultRR) {
							$Role_Requested = 1;
						} else {
							// roleback
							$_SESSION['error_user'] = 'Error requesting role';
							header("location: ../../../index.php");
						}
					}
				}
			} else {
				// roleback
				$_SESSION['error_user'] = 'you have already requested for this role';
				header("location: ../../../index.php");
			}
		}

		if ($rolesId == 3) {
			$roleRequestId = 0;
			$educationalLevelId = $_POST['educationalLevelId'];
			$graduatedFrom = $_POST['graduatedFrom'];
			$graduationYear = $_POST['graduationYear'];
			$HealthInstitutionName = $_POST['HealthInstitutionName'];
			$licenceNo = $_POST['licenceNo'];
			$licenceExpirationDate = $_POST['licenceExpirationDate'];
			$specializationId = $_POST['specializationId'];
			$Check_R = "select count(*) from rolerequest where usersId = '$usersId' AND rolesId=3";
			$stmtR = $con->prepare($Check_R);
			$stmtR->execute();
			$rowsR = $stmtR->fetchColumn();
			if ($rowsR == 0) {
				$Add_query = "insert into rolerequest (usersId,rolesId) values('$usersId','$rolesId') ";
				$stmtAddC = $con->prepare($Add_query);
				$resultC = $stmtAddC->execute();
				if ($resultC) {
					$RRI_query = "select roleRequestId from rolerequest where usersId='$usersId' AND rolesId='$rolesId' AND status='Pending' order by roleRequestId DESC limit 1";
					$RRI_stmt = $con->prepare($RRI_query);
					$RRI_success = $RRI_stmt->execute();
					$RRI_rows = $RRI_stmt->fetchAll();
					foreach ($RRI_rows as $row) {
						$roleRequestId = $row['roleRequestId'];
					}
					if ($roleRequestId != 0) {
						$AddRR_query = "insert into physicianinfo (roleRequestId,usersId,educationalLevelId,graduatedFrom,graduationYear,HealthInstitutionName,licenceNo,licenceExpirationDate,specializationId) 
					  values('$roleRequestId','$usersId','$educationalLevelId','$graduatedFrom','$graduationYear','$HealthInstitutionName','$licenceNo','$licenceExpirationDate','$specializationId') ";
						$stmtAddRR = $con->prepare($AddRR_query);
						$resultRR = $stmtAddRR->execute();
						if ($resultRR) {

							$Role_Requested = 1;
						} else {
							//rollback
							$_SESSION['error_user'] = 'Error requesting role';
							header("location: ../../../index.php");
						}
					}
				}
			} else {
				$_SESSION['error_user'] = 'you have already requested for this role';
				header("location: ../../../index.php");
			}
		}
	}

	if ($Role_Requested == 1) {


		if ($rolesId == 2) {
			$folder_name = '../../../../files/providersDocuments/pharmacist/';
		} elseif ($rolesId == 3) {
			$folder_name = '../../../../files/providersDocuments/physician/';
		}
		function generateRString($length = 20)
		{
			$characters = '0123456789abcdefghijklmnopqrst';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

			$temp = $_FILES["file"]["tmp_name"][$i];
			$name = $_FILES["file"]["name"][$i];
			$Random_String = generateRString();
			$filePathO = $_FILES['file']['name'][$i];
			$fileTypeO = substr($filePathO, strrpos($filePathO, '.') + 1);
			$fileName = $userName . '_' . $Random_String . '.' . $fileTypeO;
			$fileSize = $_FILES['file']['size'][$i];

			if ($rolesId == 2) {
				if (move_uploaded_file($temp, $folder_name . $fileName)) {
					$insertFile = "insert into providersdocuments(File_For,folder,fileName,fileType,fileSize,usersId) values('Pharmacist','providersDocuments/pharmacist','$fileName','$fileTypeO','$fileSize','$usersId')";
					$stmtInsertFile = $con->prepare($insertFile);
					$result_File = $stmtInsertFile->execute();
				}
			} elseif ($rolesId == 3) {
				if (move_uploaded_file($temp, $folder_name . $fileName)) {
					$insertFile = "insert into providersdocuments(File_For,folder,fileName,fileType,fileSize,usersId) values('Physician','providersDocuments/physician','$fileName','$fileTypeO','$fileSize','$usersId')";
					$stmtInsertFile = $con->prepare($insertFile);
					$result_File = $stmtInsertFile->execute();
				}
			}
		}



		function generateRandomString($length = 10)
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		$randomValue = generateRandomString();
		$Random_s_query = "insert into registrationconfirmation (randomValue,usersId) values('$randomValue','$usersId')";
		$stmtRS = $con->prepare($Random_s_query);
		$SuccessRS = $stmtRS->execute();
		if ($SuccessRS) {
			$serverName = $_SERVER['SERVER_NAME'];
			if ($serverName == 'localhost' || $serverName == '127.0.0.1') {
				$serverName = $serverName . '/erxHub';
			}
			$link = "usersId=" . $usersId . '&randomValue=' . $randomValue;

			$bodyContent = '<h3>e-Prescription confirmation link</h3>';
			$bodyContent = '<h3><b>eRx Ethiopia</b><br>Click the link below to confirm your email<br></h3>';
			$bodyContent .= '<p><b><a href="' . $serverName . '/apps/homepage/signup/confirmemail.php?' . $link . '">click here to confirm email</a></b><br><br>
							<span style="color:red;">
							Please Do not reply to this email</span></p>';


			$email_send = new EmailSender();
			$returnMessage = $email_send->sendMail($email, $bodyContent);
			$_SESSION['success_signup'] = $returnMessage;
			header("location: ../../../index.php");
		}
	}
}
