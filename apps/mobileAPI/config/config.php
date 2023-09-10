  <?php
	if (isset($_GET['oncall'])) {
		$oncall = $_GET['oncall']();
	} elseif (isset($_POST['oncall'])) {
		$oncall = $_POST['oncall']();
	}
	// This Api will be used to get user profile info
	// http://localhost/eprescription/mobileAPI/config/config.php?oncall=displayProfile&usersId=22 
	// when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
GET Parameters
oncall=displayProfile
usersId=22 
*/
	function displayProfile(){
		if (isset($_GET['usersId'])) {
			$usersId = $_GET['usersId'];
			include('../../../constants/databases/dbcon_eprescription.php');
			$U_query = "select firstName,fatherName,grandFatherName,userName,password,gender,users.usersId,email,mobilePhone,officePhone, 
								dateOfBirth,lastLoginTime,users.status,profilePicture,users.countryId,countryName,users.stateId,stateName,users.zoneId,zoneName,users.woredaId,woredaName,kebelle,rolesName,emailVerification
								from users join usersrole ON users.usersId=usersrole.usersId
                                join roles ON roles.rolesId=usersrole.rolesId
								left join woreda ON users.woredaId=woreda.woredaId
								left join zone ON users.zoneId=zone.zoneId
								left join state ON users.stateId=state.stateId
								left join country ON users.countryId=country.countryId
								where users.usersId='$usersId'";
			$U_stmt = $con->prepare($U_query);
			$U_success = $U_stmt->execute();
			$U_rows = $U_stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($U_rows);
		}
	}

	// This Api will be used to verify user email address if emailVerification=0
	// http://localhost/eprescription/mobileAPI/config/config.php
	// when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
POST Parameters
oncall=verifyEmail
usersId=22
email=halefomdesta@gmail.com
*/
	function verifyEmail(){
		if (isset($_POST['usersId']) and isset($_POST['email'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			$usersId = $_POST['usersId'];
			$email = $_POST['email'];
			function generateRandString($length = 10)
			{
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				return $randomString;
			}
			$randomValue = generateRandString();
			$Random_s_query = "insert into registrationconfirmation (randomValue,usersId) values('$randomValue','$usersId')";
			$stmtRS = $con->prepare($Random_s_query);
			$SuccessRS = $stmtRS->execute();
			if ($SuccessRS) {
				$serverName = $_SERVER['SERVER_NAME'];
				if ($serverName == 'localhost' || $serverName == '127.0.0.1') {
					$serverName = $serverName . '/eprescription';
				}
				$link = "usersId=" . $usersId . '&randomValue=' . $randomValue;
				require '../../common/email/send/PHPMailerAutoload.php';
				$mail = new PHPMailer;

				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
				);
				$mail->Host = 'mail.medcoanalytics.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'info@erxethiopia.com'; // SMTP username
				$mail->Password = 'Medco95#'; // SMTP password
				$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                 // TCP port to connect to

				$mail->setFrom('info@erxethiopia.com', 'eRX Ethiopia');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');

				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent = '<h3>e-Prescription confirmation link</h3>';
				$bodyContent = '<h3><b>eRx Ethiopia</b><br>Click the link below to confirm your email<br></h3>';
				$bodyContent .= '<p><b><a href="' . $serverName . '/confirmemail.php?' . $link . '">click here to confirm email</a></b><br><br>
							<span style="color:red;">
							Please Do not reply to this email</span></p>';

				$mail->Subject = 'e-Prescription';
				$mail->Body    = $bodyContent;

				if (!$mail->send()) {
					$Error = $mail->ErrorInfo;
					$Error_message = $message . $Error;
				} else {
					echo json_encode('Confirmation link is sent to your email please confirm your email');
				}
			}
		}
	}

	// This Api will be used to change user email address
	// http://localhost/eprescription/mobileAPI/config/config.php
	// when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
POST Parameters
oncall=changeEmail
usersId=22
email=halefomdesta@gmail.com
*/
	function changeEmail()
	{
		if (isset($_POST['usersId']) and isset($_POST['email'])) {
			include('../../constants/databases/dbcon_eprescription.php');
			$usersId = $_POST['usersId'];
			$email = $_POST['email'];
			$email = ucfirst(strtolower($email));
			$Check_email_query = "select count(*) from users where email = '$email' AND usersId!='$usersId' AND isDeleted=0 ";
			$stmtE = $con->prepare($Check_email_query);
			$stmtE->execute();
			$rowsE = $stmtE->fetchColumn();
			if ($rowsE == 0) {
				$Update_email = "update users set email='$email' where usersId='$usersId'";
				$stmtUpdate = $con->prepare($Update_email);
				$result = $stmtUpdate->execute();
				if ($result) {
					echo json_encode("Email Changed Successfully");
				}
			} else {
				echo json_encode("Email already exists. try another!");
			}
		}
	}


	//email duplication checker

	function doesEmailExist(){
		if (isset($_GET['email'])) {
			$count=0;
			include('../../../constants/databases/dbcon_eprescription.php');
			$email = ucfirst(strtolower($_GET['email']));
			$count = 0;
			$I_query = "SELECT * from users where email='$email' ";
			$I_stmt = $con->prepare($I_query);
			$I_success = $I_stmt->execute();
			$I_rows = $I_stmt->fetchAll();
			foreach ($I_rows as $row) {
				$count = $count + 1;
			}
	
			echo $count;
		}
	}
	function doesUsernameExist(){
	
		if (isset($_GET['username'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			$username = ucfirst(strtolower($_GET['username']));
			$count = 0;
			$I_query = "SELECT * from users where username='$username'";
			$I_stmt = $con->prepare($I_query);
			$I_success = $I_stmt->execute();
			$I_rows = $I_stmt->fetchAll();
			foreach ($I_rows as $row) {
				$count = $count + 1;
			}
			
			echo $count;
		}
	}
	function doesPhoneExist(){
		if (isset($_GET['mobilePhone'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			$mobilePhone = ucfirst(strtolower($_GET['mobilePhone']));
			$count = 0;
			$I_query = "SELECT * from users where mobilePhone='$mobilePhone' AND isDeleted='0' ";
			$I_stmt = $con->prepare($I_query);
			$I_success = $I_stmt->execute();
			$I_rows = $I_stmt->fetchAll();
			foreach ($I_rows as $row) {
				$count = $count + 1;
			}
			echo $count;
		}
	}

	// This Api will be used to change user  address
	// http://localhost/eprescription/mobileAPI/config/config.php
	// when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
POST Parameters
oncall=editAddress
usersId=22
countryId=1
stateId=1
zoneId=1
woredaId=1
kebelle=18
*/
	function editAddress()
	{
		if (isset($_POST['usersId']) and isset($_POST['countryId']) and isset($_POST['stateId']) and isset($_POST['zoneId']) and isset($_POST['woredaId']) and isset($_POST['kebelle'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			$countryId = $_POST['countryId'];
			$stateId = $_POST['stateId'];
			$zoneId = $_POST['zoneId'];
			$woredaId = $_POST['woredaId'];
			$kebelle = $_POST['kebelle'];
			$usersId = $_POST['usersId'];
			$update_query = "update users set countryId='$countryId',stateId='$stateId',zoneId='$zoneId',woredaId='$woredaId',kebelle='$kebelle' where usersId='$usersId'";
			$stmtA = $con->prepare($update_query);
			$resultA = $stmtA->execute();
			if ($resultA) {
				echo json_encode("Operation Successfully Completed");
			}
		}
	}
	// This Api will be used to change userName
	// http://localhost/eprescription/mobileAPI/config/config.php
	// when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
POST Parameters
oncall=changeUsername
usersId=22
userName=hale
*/
// username can't be changed
function changeUsername()
	{
		if (isset($_POST['usersId']) and isset($_POST['userName'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			$usersId = $_POST['usersId'];
			$userName = $_POST['userName'];
			$userName = ucfirst(strtolower($userName));
			$Check_username_query = "select count(*) from users where userName = '$userName' AND usersId!='$usersId' AND isDeleted=0 ";
			$stmtU = $con->prepare($Check_username_query);
			$stmtU->execute();
			$rowsU = $stmtU->fetchColumn();
			if ($rowsU == 0) {
				$Update_uname = "update users set userName='$userName' where usersId='$usersId'";
				$stmtUpdate = $con->prepare($Update_uname);
				$result = $stmtUpdate->execute();
				if ($result) {
					echo json_encode("Operation Successfully Completed");
				}
			} else {
				echo json_encode("Username Occupied. try another");
			}
		}
	}


	// This Api will be used to change password
	// http://localhost/eprescription/mobileAPI/config/config.php
	// when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
POST Parameters
oncall=changePassword
usersId=22
Db_pass=071655ed09b98eea3d20e94b93db57f172344944c93e4622b506f66b81d8e906d1bf99f9bba85093372aeb031a15ee3b249013f8decd34bfc35fb2a2f32d9438
Old_pass=12345678
New_pass=12345678
Confirm_pass=12345678
*/
	function changePassword()
	{
		if (isset($_POST['usersId']) and isset($_POST['Old_pass']) and isset($_POST['New_pass']) and isset($_POST['Confirm_pass'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			include('../../../constants/security/cryptsalt.php');
			$usersId = $_POST['usersId'];
			$Old_pass = $_POST['Old_pass'];
			$New_pass = $_POST['New_pass'];
			$Confirm_pass = $_POST['Confirm_pass'];
			if ($New_pass == $Confirm_pass) {
				$Old_enc_password = hash_hmac('sha512', $Old_pass, $salt);
				$P_query = "SELECT password from users where usersId='$usersId' ";
				$P_stmt = $con->prepare($P_query);
				$P_success = $P_stmt->execute();
				$P_rows = $P_stmt->fetchAll();
				foreach ($P_rows as $row) {
					$Db_pass = $row['password'];
				}
				if ($Db_pass == $Old_enc_password) {
					$enc_password = hash_hmac('sha512', $New_pass, $salt);
					$Update_Pword = "update users set password='$enc_password' where usersId='$usersId'";
					$stmtUpdateP = $con->prepare($Update_Pword);
					$resultP = $stmtUpdateP->execute();
					if ($resultP) {
						echo json_encode("Password Changed");
					}
				} else {
					echo json_encode("Old Password not Correct");
				}
			} else {
				echo json_encode("Both Passwords do not match");
			}
		}
	}


	// This Api will be used to change mobile phone number
	// http://localhost/eprescription/mobileAPI/config/config.php
	//  when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
POST Parameters
oncall=changePhone
usersId=22
mobilePhone=0933790766
*/
	function changePhone()
	{
		if (isset($_POST['usersId']) and isset($_POST['mobilePhone'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			$usersId = $_POST['usersId'];
			$mobilePhone = $_POST['mobilePhone'];
			$Update_phone = "update users set mobilePhone='$mobilePhone' where usersId='$usersId'";
			$stmtUpdate = $con->prepare($Update_phone);
			$result = $stmtUpdate->execute();
			if ($result) {
				echo json_encode("Operation Successfully Completed");
			}
		}
	}
	// This Api will be used to change Date of Birth
	// http://localhost/eprescription/mobileAPI/config/config.php
	//when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
oncall=changeDOB
usersId=22
dateOfBirth=2017-04-14
*/
	function changeDOB()
	{
		if (isset($_POST['usersId']) and isset($_POST['dateOfBirth'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			$usersId = $_POST['usersId'];
			$dateOfBirth = $_POST['dateOfBirth'];
			$Update_phone = "update users set dateOfBirth='$dateOfBirth' where usersId='$usersId'";
			$stmtUpdate = $con->prepare($Update_phone);
			$result = $stmtUpdate->execute();
			if ($result) {
				echo json_encode("Operation Successfully Completed");
			}
		}
	}

	//Api used to change User profile Picture
	function changeProfilePic()
	{
		if (isset($_POST['change_profile_pic']) and isset($_POST['usersId'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			$Image_uploaded = 0;
			$usersId = $_POST['usersId'];
			$userName = $_POST['userName'];
			$Pre_Profile_pic = $_POST['Pre_Profile_pic'];
			if (isset($_FILES['profilePicture'])) {
				if (is_uploaded_file($_FILES['profilePicture']['tmp_name'])) {
					function generateRString($length = 5)
					{
						$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
						$charactersLength = strlen($characters);
						$randomString = '';
						for ($i = 0; $i < $length; $i++) {
							$randomString .= $characters[rand(0, $charactersLength - 1)];
						}
						return $randomString;
					}
					$Random_String = generateRString();
					$filePathO = $_FILES['profilePicture']['name'];
					$fileTypeO = substr($filePathO, strrpos($filePathO, '.') + 1);
					$Image_name = $userName . '_' . $Random_String . '.' . $fileTypeO;
					if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], '../../images/profile_pic/' . $Image_name)) {
						$Image_uploaded = 1;
					}
				}
			}
			if ($Image_uploaded == 1) {
				// update table 
				$Update_OIM_query = "update users set profilePicture='$Image_name' where usersId='$usersId'";
				$stmtupdate_OIM = $con->prepare($Update_OIM_query);
				$result_OIM = $stmtupdate_OIM->execute();
				if ($result_OIM) { // if table updated delete previous image
					if ($Pre_Profile_pic != "defaultFemale.jpg" and $Pre_Profile_pic != "defaultMale.jpg") {
						unlink("../../images/profile_pic/" . $Pre_Profile_pic); // as image is uploaded delete the image

					}
					$_SESSION['success'] = 'set';
					header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
				}
			}
		}
	}

	// This Api will be used to send password reset code to email
	// http://localhost/eprescription/mobileAPI/config/config.php
	//when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
oncall=sendResetCode
usersId=22
email=halefomdesta@gmail
*/

function generateRandomString($length = 4)
				{
					//$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$characters = '0123456789';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return $randomString;
				}
	function sendResetCode(){
		if (isset($_POST['email'])) {
			include('../../../constants/databases/dbcon_eprescription.php');
			include('../../../constants/email/emailConfig.php');
			$email = ucfirst(strtolower($_POST['email']));
			$count = 0;
			$I_query = "SELECT usersId from users where email='$email' AND isDeleted='0' ";
			$I_stmt = $con->prepare($I_query);
			$I_success = $I_stmt->execute();
			$I_rows = $I_stmt->fetchAll();
			foreach ($I_rows as $row) {
				$usersId = $row['usersId'];
				$count = $count + 1;
			}
		
			  if($count==1) {
				
				$randomValue = generateRandomString();
				$Random_s_query = "insert into passwordreset (randomValue,usersId) values('$randomValue','$usersId')";
				$stmtRS = $con->prepare($Random_s_query);
				$SuccessRS = $stmtRS->execute();
				if ($SuccessRS) {
					$link = "usersId=" . $usersId . '&randomValue=' . $randomValue;
					require '../../common/email/send/PHPMailerAutoload.php';
					$mail = new PHPMailer;

					$mail->isSMTP();                                  
					$mail->SMTPOptions = array(
						'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
						)
					);
					$mail->Host = $host;                    // Specify main and backup SMTP servers
					$mail->SMTPAuth = $SMTPAuth;                            // Enable SMTP authentication
					$mail->Username = $username; // SMTP username
					$mail->Password = $password; // SMTP password
					$mail->SMTPSecure =$SMTPSecure;                         // Enable TLS encryption, `ssl` also accepted
					$mail->Port = $port;                                 // TCP port to connect to

					$mail->setFrom($sentFrom, $senderName);
					$mail->addAddress($email);   // Add a recipient
					//$mail->addCC('cc@example.com');
					//$mail->addBCC('bcc@example.com');

					$mail->isHTML(true);  // Set email format to HTML
					$bodyContent = '<h3>MedcoScript password recovery code</h3>';
					$bodyContent = '<h3><b>MedcoScript</b><br>Use the code below to change your password.</h3>';
					$bodyContent .= '<p><b style="font-size:30px;">' . $randomValue . '</b><br><br>
							<span style="color:red;">
							Please Do not reply to this email</span></p>';

					$mail->Subject = 'Reset password';
					$mail->Body    = $bodyContent;

					if (!$mail->send()) {
						$message = 'Email sending failed ';
						$Error = $mail->ErrorInfo;
						$Error_message = $message . $Error;
						$resetInfo = array("usersId" => '', "randomValue" => '');
						echo json_encode($resetInfo);
					} else {
						$resetInfo = array("usersId" => $usersId, "randomValue" => $randomValue);
						echo json_encode($resetInfo);
					}
				}
			} else{
			$resetInfo = array("usersId" =>'', "randomValue" => '');
						echo json_encode($resetInfo);
			}
			
		}
	}
	// This Api will be used to reset password after entering the code sent to their email 
	// http://localhost/eprescription/mobileAPI/config/config.php
	//when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
oncall=resetPassword
usersId=22
Pword=12345678
*/
function resetPassword(){
		if (isset($_POST['password'])) {
			$Pword = $_POST['password'];
			$usersId = $_POST['usersId'];
			include('../../../constants/databases/dbcon_eprescription.php');
			include('../../../constants/security/cryptsalt.php');
			$enc_new_password = hash_hmac('sha512', $Pword, $salt);
			$update_query = "update users set password = '$enc_new_password' where usersId = $usersId ";
			$stmtU = $con->prepare($update_query);
			$successU = $stmtU->execute();
			if ($successU) {
				$delete_query = "update passwordreset set resetStatus=1 where usersId=$usersId ";
				$stmtD = $con->prepare($delete_query);
				$successD = $stmtD->execute();
				if ($successD) {
					echo json_encode("successful");
				} 
			}
		}
	}



	// This Api will be used for patient signup
	// http://localhost/eprescription/mobileAPI/config/config.php
	//when it is officially hosted you need to replace localhost with erxethiopia.com
	/*
oncall=patientSignup
titleId= 1 , 2 ,3 , 5.......
firstName=
fatherName=
grandFatherName=
email=
password=
mobilePhone=
userName=
dateOfBirth= YYYY-MM-DD
gender= Male / Female
*/
	function patientSignup()
	{

		if (isset($_POST['email']) && isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['mobilePhone'])) {
			
			include('../../../constants/databases/dbcon_eprescription.php');
			include('../../../constants/security/cryptsalt.php');
			$email = ucfirst(strtolower($_POST['email']));
			$password = $_POST['password'];
			$mobilePhone = $_POST['mobilePhone'];
			$password = hash_hmac('sha512', $password, $salt);
			$userName = ucfirst(strtolower($_POST['userName']));
			$firstName = $_POST['firstName'];
			$fatherName = $_POST['fatherName'];
			$grandFatherName = $_POST['grandFatherName'];
			$titleId = $_POST['titleId'];
			$gender = $_POST['gender'];
			$dateOfBirth = $_POST['dateOfBirth'];
			
			$licenceId = 1;
			$rolesId = 1;
			
			if ($gender == 'Male') 
				$profilePicture = "defaultMale.jpg";

			if ($gender == 'Female') 
				$profilePicture = "defaultFemale.jpg";
		
					$AddU_query = "insert into users (firstName,fatherName,grandFatherName,titleId,gender,dateOfBirth,email,mobilePhone,userName,password,usersDefaultRolesId,status,profilePicture,licenceId) 
						  values('$firstName','$fatherName','$grandFatherName','$titleId','$gender','$dateOfBirth','$email','$mobilePhone','$userName','$password','$rolesId','limitedAccess','$profilePicture','$licenceId')";
					$stmtaddU = $con->prepare($AddU_query);
					$resultU = $stmtaddU->execute();
					if ($resultU) {
						$usersId = $con->lastInsertId();
						if ($usersId != 0) {
							$AddUR_query = "insert into usersrole (usersId,rolesId,isDefault,addedById) 
										values('$usersId',1,1,'$usersId')";
							$stmtAddUR = $con->prepare($AddUR_query);
							$resultUR = $stmtAddUR->execute();
							if ($resultUR) {
								echo json_encode("Account created successfully");
							}
						}
					} else {
						echo json_encode("User not registered");
					}
				
			
		} else return "Fill all necessary fields";
	
	}

	function uploadPrescription()
	{
		if (isset($_POST['usersId']) and isset($_POST['image'])) {

			include('../../../constants/databases/dbcon_eprescription.php');
			$image = $_POST['image'];
			$usersId = $_POST['usersId'];
			$patientname = $_POST['patientName'];
			$comment = $_POST['comment'];
			$lat = $_POST['lat'];
			$lng = $_POST['lng'];
			$name = $_POST['name'];
			$realImage = base64_decode($image);
			function generateRString($length = 16)
			{
				$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				return $randomString;
			}
			$Random_String = generateRString();
			$hashed_name = hash('sha512', $name);
			$imageName = $patientname . '_' . $Random_String;

			file_put_contents('../../../files/providersDocuments/uploadedprescriptions/' . $imageName . '.jpg', $realImage);

			$prescription = "insert into uploadedprescriptions (usersId,imageName,comment,latitude,longitude) values('$usersId','$imageName','$comment','$lat','$lng')";
			$prescription_stmt = $con->prepare($prescription);
			$prescription_success = $prescription_stmt->execute();
			//    $rows_prescription  = $prescription_stmt->fetchAll(PDO::FETCH_ASSOC);

			if ($prescription_success) {
				echo "Prescription sent successfully.";
			}
		}
	}




	?>

	
