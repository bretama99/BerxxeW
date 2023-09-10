<?php
ob_start();
    //error_reporting(0);
    session_start();
	include('../include/dbcon_eprescription.php'); // connecting to database
	if(isset($_POST['Uname']) AND isset($_POST['password'])){
		$uname = $_POST['Uname'];
		$userName=ucfirst(strtolower($uname));
		$dbUsersName="";
		$email="";
		$query = "SELECT usersId,userName,status,email,emailVerification,firstName,fatherName,grandFatherName,titleId FROM users WHERE userName='$userName' OR email='$userName'";
		$stmt = $con->prepare($query);
                $success=$stmt->execute();
                $rows = $stmt->fetchAll();
		//$rows_no = $rows->count();
		if ($success)  {
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
				
				   if($status=='limitedAccess' || $status=='active'){

									$Uname=ucfirst(strtolower($_POST['Uname']));
									include('../include/cryptsalt.php');
									$password = $_POST['password'];
									$password=hash_hmac('sha512',$password,$salt);
									$query = "SELECT userName,password,usersDefaultRolesId FROM users WHERE userName='$Uname' OR email='$Uname'";
									$stmt = $con->prepare($query);
									$success=$stmt->execute();
									$rows = $stmt->fetchAll();
									if ($success)  
									{
										foreach ($rows as $row) {
											$db_password = $row['password'];
											$db_uname = $row['userName'];
											$usersDefaultRolesId = $row['usersDefaultRolesId'];
										} 
										if ($password == $db_password) 
										{
											
										  // get Role id from user roles
											$Rquery = "SELECT rolesId FROM usersrole WHERE usersId='$usersId' AND isDefault='1' AND active=1 order by usersRoleId DESC limit 1";
											$stmtR = $con->prepare($Rquery);
											$successR=$stmtR->execute();
											$rowsR = $stmtR->fetchAll();
											if ($successR)  
											{
											  foreach ($rowsR as $row) {
													$rolesId = $row['rolesId'];
												} 
											}
											else{
											  $rolesId=0;
											 }
											 
											if($titleId=='' OR $firstName=='' OR $fatherName=='' OR $grandFatherName==''){
												 $rowsArray=[];
												 array_push($rowsArray, array("code"=>"Unsuccessful","message"=>"Please Complete Signup"));
												 echo json_encode($rowsArray);
											  }
											  else{
											// set last login time 
											  $Time=date("Y-m-d h:i:s", time());
											  $Update_L ="update users set lastLoginTime='$Time' where usersId='$usersId' ";
											  $stmtL = $con->prepare($Update_L);
											  $resultL=$stmtL->execute();
												//session_start();
												//include('../include/client_info.php');
												//$loginhistory = "insert into loginhistory (usersId,browserDetails,ipaddress,osType,deviceType,location) values('$usersId','$browserDetails','$ipaddress','$osType','$deviceType','$location')";
												//$stmtLH = $con->prepare($loginhistory);
												//$SuccessLH=$stmtLH->execute();
												//if($SuccessLH){
													     $U_query = "select firstName,fatherName,grandFatherName,userName,password,gender,users.usersId,email,mobilePhone,officePhone, 
														dateOfBirth,lastLoginTime,users.status,profilePicture,users.countryId,countryName,users.stateId,stateName,users.zoneId,zoneName,users.woredaId,woredaName,kebelle,rolesName,emailVerification
														from users join usersrole ON users.usersId=usersrole.usersId
														join roles ON roles.rolesId=usersrole.rolesId
														left join woreda ON users.woredaId=woreda.woredaId
														left join zone ON users.zoneId=zone.zoneId
														left join state ON users.stateId=state.stateId
														left join country ON users.countryId=country.countryId
														where users.usersId='$usersId' AND usersrole.isDefault='1' ";
														 $U_stmt = $con->prepare($U_query);
														 $U_success=$U_stmt->execute();
														 $U_rows = $U_stmt->fetchAll(PDO::FETCH_ASSOC);
												         echo json_encode($U_rows);
												   //}
											    }
										}else{
											 $rowsArray=[];
											 array_push($rowsArray, array("code"=>"Unsuccessful","message"=>"Password is not correct"));
											 echo json_encode($rowsArray);
										}
										
									}
						   }
						   elseif($status=='disabled')
							{
							 $rowsArray=[];
							 array_push($rowsArray, array("code"=>"Unsuccessful","message"=>"User access denied, please contact Administrator"));
							 echo json_encode($rowsArray);
	
							} 
						}
					
					else
					{
					  $rowsArray=[];
					  array_push($rowsArray, array("code"=>"Unsuccessful","message"=>"Incorrect Username, please sign up if you are a new user."));
					  echo json_encode($rowsArray);
					}
	  }
		// end of success
			else
			{
			  $rowsArray=[];
			  $rowsArray=array_push($rowsArray, array("code"=>"Unsuccessful","message"=>"User not Registered"));
			  echo json_encode($rowsArray);
			}
	    }
 ?>
