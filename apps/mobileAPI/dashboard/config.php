  <?php

    if (isset($_GET['oncall']))
	 {
      $oncall =$_GET['oncall']();
	 }  
	 elseif (isset($_POST['oncall']))
	 {
      $oncall =$_POST['oncall']();
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
	     if (isset($_GET['usersId'])){
	     $usersId =$_GET['usersId'];
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
							     $U_success=$U_stmt->execute();
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
	     if (isset($_POST['usersId']) AND isset($_POST['email'])){
		  include('../../../constants/databases/dbcon_eprescription.php');
	     $usersId =$_POST['usersId'];
		 $email=$_POST['email'];
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
			$SuccessRS=$stmtRS->execute();
			if($SuccessRS)
				{
					$serverName=$_SERVER['SERVER_NAME'];
					if($serverName=='localhost' || $serverName=='127.0.0.1'){
					 $serverName=$serverName.'/eprescription';
					}
					$link ="usersId=".$usersId.'&randomValue='.$randomValue;
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
					$bodyContent .= '<p><b><a href="'.$serverName.'/confirmemail.php?'.$link.'">click here to confirm email</a></b><br><br>
							<span style="color:red;">
							Please Do not reply to this email</span></p>';

					$mail->Subject = 'e-Prescription';
					$mail->Body    = $bodyContent;

				if(!$mail->send()) {
				$Error = $mail->ErrorInfo;
				$Error_message = $message.$Error;
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
   function changeEmail(){
    if (isset($_POST['usersId']) AND isset($_POST['email'])){
	   include('../../../constants/databases/dbcon_eprescription.php');
      $usersId = $_POST['usersId'];
	  $email = $_POST['email'];
	  $email = ucfirst(strtolower($email));
	 $Check_email_query = "select count(*) from users where email = '$email' AND usersId!='$usersId' AND isDeleted=0 ";
	 $stmtE = $con->prepare($Check_email_query);
	 $stmtE->execute();
	 $rowsE = $stmtE->fetchColumn(); 
	 if($rowsE ==0){
		  $Update_email ="update users set email='$email' where usersId='$usersId'";
		  $stmtUpdate = $con->prepare($Update_email);
		  $result=$stmtUpdate->execute();
		  if($result){
		     echo json_encode("Email Changed Successfully");
		  }
	   }else{
	         echo json_encode("Email already exists. try another!");
		}
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
   function editAddress(){
  if (isset($_POST['usersId']) AND isset($_POST['countryId']) AND isset($_POST['stateId']) AND isset($_POST['zoneId']) AND isset($_POST['woredaId']) AND isset($_POST['kebelle'])){
     include('../../../constants/databases/dbcon_eprescription.php');
	$countryId=$_POST['countryId'];
	$stateId=$_POST['stateId'];
	$zoneId=$_POST['zoneId'];
	$woredaId=$_POST['woredaId'];
	$kebelle=$_POST['kebelle'];
	$usersId=$_POST['usersId'];		
	 $update_query ="update users set countryId='$countryId',stateId='$stateId',zoneId='$zoneId',woredaId='$woredaId',kebelle='$kebelle' where usersId='$usersId'";
	  $stmtA = $con->prepare($update_query);
	  $resultA=$stmtA->execute();
	  if($resultA){
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
 function changeUsername(){
if (isset($_POST['usersId']) AND isset($_POST['userName'])){
     include('../../../constants/databases/dbcon_eprescription.php');
	$usersId = $_POST['usersId'];
	$userName = $_POST['userName'];
	$userName = ucfirst(strtolower($userName));
	$Check_username_query = "select count(*) from users where userName = '$userName' AND usersId!='$usersId' AND isDeleted=0 ";
	$stmtU = $con->prepare($Check_username_query);
	$stmtU->execute();
	$rowsU = $stmtU->fetchColumn(); 
	 if($rowsU ==0){
		  $Update_uname ="update users set userName='$userName' where usersId='$usersId'";
		  $stmtUpdate = $con->prepare($Update_uname);
		  $result=$stmtUpdate->execute();
		  if($result){
			echo json_encode("Operation Successfully Completed");
		  }
	 }else{
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
function changePassword(){
if (isset($_POST['usersId']) AND isset($_POST['Old_pass']) AND isset($_POST['New_pass']) AND isset($_POST['Confirm_pass'])){
     include('../../../constants/databases/dbcon_eprescription.php');
	include('../../include/cryptsalt.php');
	$usersId = $_POST['usersId'];
	$Old_pass = $_POST['Old_pass'];
	$New_pass = $_POST['New_pass'];
	$Confirm_pass = $_POST['Confirm_pass'];
	if($New_pass == $Confirm_pass){
		$Old_enc_password=hash_hmac('sha512',$Old_pass,$salt);
		$P_query = "SELECT password from users where usersId='$usersId' ";
		$P_stmt = $con->prepare($P_query);
		$P_success=$P_stmt->execute();
		$P_rows = $P_stmt->fetchAll();
		foreach ($P_rows as $row) {
			$Db_pass = $row['password'];
		}
		if($Db_pass == $Old_enc_password){
			  $enc_password=hash_hmac('sha512',$New_pass,$salt);
			  $Update_Pword ="update users set password='$enc_password' where usersId='$usersId'";
			  $stmtUpdateP = $con->prepare($Update_Pword);
			  $resultP=$stmtUpdateP->execute();
			  if($resultP){
			     echo json_encode("Password Changed");
			   }
			}else{
			     echo json_encode("Old Password not Correct");
				}
		}else{
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
function changePhone(){
     if (isset($_POST['usersId']) AND isset($_POST['mobilePhone'])){
	         include('../../../constants/databases/dbcon_eprescription.php');
			$usersId = $_POST['usersId'];
			$mobilePhone = $_POST['mobilePhone'];
			  $Update_phone ="update users set mobilePhone='$mobilePhone' where usersId='$usersId'";
			  $stmtUpdate = $con->prepare($Update_phone);
			  $result=$stmtUpdate->execute();
			  if($result){
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
function changeDOB(){
	if (isset($_POST['usersId']) AND isset($_POST['dateOfBirth'])){
	 include('../../../constants/databases/dbcon_eprescription.php');
	$usersId = $_POST['usersId'];
	$dateOfBirth = $_POST['dateOfBirth'];
	  $Update_phone ="update users set dateOfBirth='$dateOfBirth' where usersId='$usersId'";
	  $stmtUpdate = $con->prepare($Update_phone);
	  $result=$stmtUpdate->execute();
	  if($result){
		 echo json_encode("Operation Successfully Completed");
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
function sendResetCode(){
	if(isset($_POST['email'])){
		     include('../../../constants/databases/dbcon_eprescription.php');
		    $email = $_POST['email'];
			$count=0;
		    $I_query = "SELECT usersId from users where email='$email' AND isDeleted='0' ";
			$I_stmt = $con->prepare($I_query);
			$I_success=$I_stmt->execute();
			$I_rows = $I_stmt->fetchAll();
			foreach ($I_rows as $row) {
				$usersId = $row['usersId'];
				$count=$count+1;
			}
		if($count>0)
		  {
			function generateRandomString($length = 5) 
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
			$randomValue = generateRandomString();
			$Random_s_query = "insert into passwordreset (randomValue,usersId) values('$randomValue','$usersId')";
		    $stmtRS = $con->prepare($Random_s_query);
		    $SuccessRS=$stmtRS->execute();
			if($SuccessRS)
				{
				    $serverName=$_SERVER['SERVER_NAME'];
					if($serverName=='localhost' || $serverName=='127.0.0.1'){
					 $serverName=$serverName.'/eprescription';
					}
				    $link ="usersId=".$usersId.'&randomValue='.$randomValue;
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

					$bodyContent = '<h3>eRX Ethiopia password recovery code</h3>';
					$bodyContent = '<h3><b>eRx Ethiopia</b><br>Use the code below to change your password for eRx Ethiopia</h3>';
					$bodyContent .= '<p><b style="font-size:30px;">'.$randomValue.'</b><br><br>
							<span style="color:red;">
							Please Do not reply to this email</span></p>';

					$mail->Subject = 'eRX Ethiopia';
					$mail->Body    = $bodyContent;
					if(!$mail->send()) {
					    $message = 'Email sending failed ';
					    $Error = $mail->ErrorInfo;
						$Error_message = $message.$Error;
						 echo json_encode("unable to send code");
						
					} else {
						 $resetInfo = array("usersId"=>$usersId, "randomValue"=>$randomValue);  
						 echo json_encode($resetInfo);
				    }
		   }
	    }
		else
		{
           echo json_encode("account not found");
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
			if(isset($_POST['Pword']) AND isset($_POST['Pword'])){
			   $Pword = $_POST['Pword'];
			   $usersId = $_POST['usersId'];
			     include('../../../constants/databases/dbcon_eprescription.php');
	            include('../../include/cryptsalt.php');
				$enc_new_password=hash_hmac('sha512',$Pword,$salt);
				$update_query ="update users set password = '$enc_new_password' where usersId = $usersId ";
				$stmtU = $con->prepare($update_query);
				$successU=$stmtU->execute();
				if($successU){
						$delete_query ="update passwordreset set resetStatus=1 where usersId=$usersId "; 
						$stmtD=$con->prepare($delete_query);
						$successD=$stmtD->execute();
						if($successD){
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
function patientSignup(){	

	if(isset($_POST['email']) AND isset($_POST['userName']) AND isset($_POST['password']) AND isset($_POST['mobilePhone'])){		
		  include('../../../constants/databases/dbcon_eprescription.php');
		 include('../../include/cryptsalt.php');
		 $email=ucfirst(strtolower($_POST['email']));
		 $password=$_POST['password'];
		 $mobilePhone=$_POST['mobilePhone'];
		 $password=hash_hmac('sha512',$password,$salt);
		 $userName=ucfirst(strtolower($_POST['userName']));
		 $firstName=$_POST['firstName'];
		 $fatherName=$_POST['fatherName'];
		 $grandFatherName=$_POST['grandFatherName'];
		 $titleId=$_POST['titleId'];
		 $gender=$_POST['gender'];
		 $dateOfBirth=$_POST['dateOfBirth'];
		 $licenceId=1;
		 $rolesId=1;
		 if($gender=='Male'){
		 $profilePicture="defaultMale.jpg";
		 }
		 if($gender=='Female'){
		 $profilePicture="defaultFemale.jpg";
		 }
		 $Check_Uname = "select count(*) from users where userName = '$userName' ";
					$stmtUn = $con->prepare($Check_Uname);
					$stmtUn->execute();
					$rowsUn = $stmtUn->fetchColumn(); 
					if($rowsUn ==0){ // count num rows here must be zero
						$Check_Uname = "select count(*) from users where email = '$email' ";
						$stmtUn = $con->prepare($Check_Uname);
						$stmtUn->execute();
						$rowsUn = $stmtUn->fetchColumn(); 
						if($rowsUn ==0){	
						  $AddU_query ="insert into users (firstName,fatherName,grandFatherName,titleId,gender,dateOfBirth,email,mobilePhone,userName,password,usersDefaultRolesId,status,profilePicture,licenceId) 
						  values('$firstName','$fatherName','$grandFatherName','$titleId','$gender','$dateOfBirth','$email','$mobilePhone','$userName','$password','$rolesId','limitedAccess','$profilePicture','$licenceId')";
						  $stmtaddU = $con->prepare($AddU_query);
						  $resultU=$stmtaddU->execute();
						  if($resultU){
										$User_Id_query = "select usersId from users where userName='$userName' AND email='$email' order by usersId DESC limit 1";
										$UI_stmt = $con->prepare($User_Id_query);
										$UI_success=$UI_stmt->execute();
										$UI_rows = $UI_stmt->fetchAll();
										foreach ($UI_rows as $row) {
											$usersId=$row['usersId'];
										}
									if($usersId!=0){
										$AddUR_query ="insert into usersrole (usersId,rolesId,isDefault,addedById) 
										values('$usersId',1,1,'$usersId')";
										$stmtAddUR = $con->prepare($AddUR_query);
										$resultUR=$stmtAddUR->execute();
										if($resultUR){									     
											 echo json_encode("Account created successfully");
										}
									  }
								 }
								  else{
										 echo json_encode("User not registered");
										}
							 }else{
								 echo json_encode("Email is already Used by another person. Try another");
							}
						}
						else{
						  echo json_encode("Username is already Used by another person. try another");
						}
					
				}
	}

	function uploadPrescription(){
		if (isset($_POST['usersId']) AND isset($_POST['image'])){
    
			 include('../../../constants/databases/dbcon_eprescription.php');  
			$image = $_POST['image'];
			$usersId = $_POST['usersId'];
			$patientname = $_POST['patientName'];
			$comment = $_POST['comment'];
			$lat = $_POST['lat'];
			$lng = $_POST['lng'];

		 
			$realImage = base64_decode($image);
			
			function generateRString($length = 5){
				$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				return $randomString;
			}
			$Random_String = generateRString();
			$imageName = $patientname.'_'.$Random_String;
		
			file_put_contents('../../files/providersDocuments/uploadedprescriptions/'.$imageName, $realImage);
		
		   $prescription = "insert into uploadedprescriptions (usersId,imageName,comment,latitude,longitude) values('$usersId','$imageName','$comment','$lat','$lng')";
		   $prescription_stmt = $con->prepare($prescription);		
		   $prescription_success=$prescription_stmt->execute();
		//    $rows_prescription  = $prescription_stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if($prescription_success){
			echo "Prescription sent successfully.";
		}
		}
	}




 ?>

	
