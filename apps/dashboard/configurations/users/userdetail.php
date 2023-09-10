<?php
include('../common/email/email-send.php');
if ($canView == "1") {
	if (isset($_GET['usersId'])) {
		$usersId = $_GET['usersId'];
	}
	if (!empty($usersId)) {
?>
		<div class="row">
			<div class="col-xs-12">
				<?php include('common/messages/success_message.php'); ?>
				<?php if (isset($_SESSION['success'])) { ?>
					<div class="alert alert-block alert-success" style="margin-left:40%;">
						<button type="button" class="close" data-dismiss="alert">
							&nbsp; <i class="ace-icon fa fa-times"></i>
						</button>
						<i class="ace-icon fa fa-check green"></i> &nbsp; <?php echo $_SESSION['success_user']; ?>
					</div>
				<?php
					unset($_SESSION['success_user']);
				} ?>

				<table id="example" class="table table-stripped table-bordered table-hover">
					<thead>
						<tr>


						</tr>
					</thead>

					<tbody>
						<?php
						$U_query = "select titleName,firstName,fatherName,grandFatherName,gender,usersId,email,mobilePhone,officePhone, 
								dateOfBirth,lastLoginTime,users.status,profilePicture,countryId,stateId,zoneId,woredaId,kebelle,rolesName
								from title join users ON users.titleId=title.titleId join roles ON roles.rolesId=users.usersDefaultRolesId
								where users.usersId='$usersId'";
						$U_stmt = $con->prepare($U_query);
						$U_success = $U_stmt->execute();
						$U_rows = $U_stmt->fetchAll();
						$id = 0;
						foreach ($U_rows as $row) {
							$usersId = $row['usersId'];
							$titleName = $row['titleName'];
							$profilePicture = $row['profilePicture'];
							$firstName = $row['firstName'];
							$fatherName = $row['fatherName'];
							$grandFatherName = $row['grandFatherName'];
							$countryId = $row['countryId'];
							$stateId = $row['stateId'];
							$zoneId = $row['zoneId'];
							$email = $row['email'];
							$woredaId = $row['woredaId'];
							$kebelle = $row['kebelle'];
							$mobilePhone = $row['mobilePhone'];
							$officePhone = $row['officePhone'];
							$lastLoginTime = $row['lastLoginTime'];
							$status = $row['status'];
							$rolesName = $row['rolesName'];
							$Full_name = $titleName . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
						?>
							<tr>
								<td>
									<span class="profile-picture">
										<a href="#" data-toggle="modal" data-target="#view_profile_pic<?php echo $usersId; ?>">
											<img width="120px" height="120px" alt="profile picture" src="../../images/profile_pic/<?php echo $profilePicture; ?>" width="100%" height="100%" />
										</a>
									</span>
									<?php include('common/viewprofilepic.php'); ?>
									<br><br>

								</td>
								<td style="color:#0080ff;">
									Full Name <br>
									Gender <br>
									Email <br>
									Date Of Birth <br>
									Address
								</td>
								<td>

									<?php echo $Full_name; ?> <br>
									<?php echo $row['gender']; ?> <br>
									<?php echo $row['email']; ?> <br>
									<?php echo $row['dateOfBirth']; ?> <br>
									<?php echo $row['kebelle'] . '<b>,</b>'; ?>
									<?php
									$C_query = "select * from woreda where woredaId='$woredaId'";
									$C_stmt = $con->prepare($C_query);
									$C_success = $C_stmt->execute();
									$C_rows = $C_stmt->fetchAll();
									$id = 0;
									foreach ($C_rows as $row) {
										$woredaName = $row['woredaName'];
										$id = $id + 1;
										echo $woredaName . '<b>,</b> ';
									}
									$C_query = "select * from zone where zoneId='$zoneId'";
									$C_stmt = $con->prepare($C_query);
									$C_success = $C_stmt->execute();
									$C_rows = $C_stmt->fetchAll();
									$id = 0;
									foreach ($C_rows as $row) {
										$zoneName = $row['zoneName'];
										$id = $id + 1;
										echo $zoneName . '<b>,</b> ';
									}

									$C_query = "select * from state where stateId='$stateId'";
									$C_stmt = $con->prepare($C_query);
									$C_success = $C_stmt->execute();
									$C_rows = $C_stmt->fetchAll();
									$id = 0;
									foreach ($C_rows as $row) {
										$stateName = $row['stateName'];
										$id = $id + 1;
										echo $stateName . '<b>,</b> ';
									}
									$C_query = "select * from country where countryId='$countryId'";
									$C_stmt = $con->prepare($C_query);
									$C_success = $C_stmt->execute();
									$C_rows = $C_stmt->fetchAll();
									$id = 0;
									foreach ($C_rows as $row) {
										$countryId = $row['countryId'];
										$countryName = $row['countryName'];
										$id = $id + 1;
										echo $countryName;
									}
									?>
								</td>

								<td style="color:#0080ff;">
									Mobile Phone <br>
									Office Phone <br>
									Last Login Time <br>
									Role <br>
									Status <br>

								</td>
								<td>
									<?php echo $mobilePhone; ?><br>
									<?php echo $officePhone; ?><br>
									<?php echo $lastLoginTime; ?><br>
									<?php echo $rolesName; ?><br>
									<?php echo $status; ?><br>
									<br>

								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php
				$Check_R = "select count(*) from rolerequest where usersId = '$usersId' ";
				$stmtR = $con->prepare($Check_R);
				$stmtR->execute();
				$rowsR = $stmtR->fetchColumn();
				if ($rowsR > 0) {
				?>
					<div class="table-header">
						Role Requests
					</div>
					<table id="example" class="table table-stripped table-bordered table-hover">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Requested for</th>
								<th>Requested Date</th>
								<th>Status</th>
								<th> </th>
							</tr>
						</thead>

						<tbody>
							<?php
							$U_query = "select roleRequestId,rolesName,rolerequest.status,rolerequest.rolesId,requestDate from 
								rolerequest join roles ON roles.rolesId=rolerequest.rolesId where rolerequest.usersId='$usersId'";
							$U_stmt = $con->prepare($U_query);
							$U_success = $U_stmt->execute();
							$U_rows = $U_stmt->fetchAll();
							$id = 0;
							foreach ($U_rows as $row) {

								$status = $row['status'];
								$rolesId = $row['rolesId'];
								$rolesName = $row['rolesName'];
								$requestDate = $row['requestDate'];
								$roleRequestId = $row['roleRequestId'];
							?>
								<tr>
									<?php $id = $id + 1; ?>
									<td><?php echo $id; ?></td>
									<td><?php echo $rolesName; ?></td>
									<td><?php echo $requestDate; ?></td>
									<td>
										<?php
										if ($status == 'Approved') {
											echo '<span class="label label-success arrowed">' . $status . '</span>';
										} else if ($status == 'Pending') {
											echo '<span class="label label-warning arrowed">' . $status . '</span>';
										} else if ($status == 'Denied') {
											echo '<span class="label label-danger arrowed">' . $status . '</span>';
										}
										?>
									</td>
									<td>
										<?php
										if ($canEdit == "1" && $status == 'Denied' || $status == 'Pending') {
										?>
											<a href='' data-toggle="modal" data-target="#approveRole<?php echo $roleRequestId; ?>" class='red'><span class="label label-success arrowed">Approve<i class="fa fa-question"></i></span> </a>
										<?php } else { ?>
											<a href='' data-toggle="modal" data-target="#approveRole<?php echo $roleRequestId; ?>" class='red'><span class="label label-danger arrowed">Deny <i class="fa fa-question"></i></span> </a>
										<?php }
										include("configurations/users/views/modalapproverole.php");
										?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } ?>
				<?php
				$I_query = "select * from pharmacistinfo where usersId='$usersId' ";
				$I_stmt = $con->prepare($I_query);
				$I_success = $I_stmt->execute();
				$I_rows = $I_stmt->fetchAll();
				foreach ($I_rows as $rowi) {
					$educationalLevelId = $rowi['educationalLevelId'];
					$graduatedFrom = $rowi['graduatedFrom'];
					$graduationYear = $rowi['graduationYear'];
					$licenceNo = $rowi['licenceNo'];
					$licenceExpirationDate = $rowi['licenceExpirationDate'];
					$qualification = $rowi['qualification'];

					echo '<div class="widget-box col-sm-12" id="widget-box-12">
							<div class="widget-body">
							<div class="widget-main alert alert-info">';
					echo 'Graduated from ' . $graduatedFrom . ' In ' . $graduationYear . '<br>';
					echo 'Pharmacist licence Number ' . $licenceNo . '<br>';
					echo 'licence Expiration Date is ' . $licenceExpirationDate . '<br>';
					echo 'Qualification is ' . $qualification . '<br>';
					echo ' </div>
							  </div>
							</div>';
				}

				$PI_query = "select educationalLevelId,graduatedFrom,graduationYear,licenceNo,licenceExpirationDate,specializationName,HealthInstitutionName
					from physicianinfo join specialization ON physicianinfo.specializationId=specialization.specializationId where usersId='$usersId' ";
				$PI_stmt = $con->prepare($PI_query);
				$PI_success = $PI_stmt->execute();
				$PI_rows = $PI_stmt->fetchAll();
				foreach ($PI_rows as $rowi) {
					$educationalLevelId = $rowi['educationalLevelId'];
					$graduatedFrom = $rowi['graduatedFrom'];
					$graduationYear = $rowi['graduationYear'];
					$licenceNo = $rowi['licenceNo'];
					$licenceExpirationDate = $rowi['licenceExpirationDate'];
					$specializationName = $rowi['specializationName'];
					$HealthInstitutionName = $rowi['HealthInstitutionName'];
					echo '<div class="widget-box col-sm-12" id="widget-box-12">
							<div class="widget-body">
							<div class="widget-main alert alert-info">';
					echo 'Graduated from ' . $graduatedFrom . ' In ' . $graduationYear . '<br>';
					echo 'Physician licence Number ' . $licenceNo . '<br>';
					echo 'licence Expiration Date is ' . $licenceExpirationDate . '<br>';
					echo 'Works In ' . $HealthInstitutionName . ' specialized by ' . $specializationName . '<br>';
					echo ' </div>
							  </div>
							</div>';
				}
				?>
				<?php
				$Check_D = "select count(*) from providersdocuments where usersId = '$usersId' ";
				$stmtD = $con->prepare($Check_D);
				$stmtD->execute();
				$rowsD = $stmtD->fetchColumn();
				if ($rowsD > 0) {
				?>
					<div class="table-header col-xs-12">
						Provided Supportive Documents
					</div>
					<table id="example" class="table table-stripped table-bordered table-hover">
						<thead>
							<tr>
								<th>S/N</th>
								<th>File Name</th>
								<th>File For</th>
								<th>File Size</th>
								<th>Uploaded Date</th>
								<th>Download</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$U_query = "select * from providersdocuments where usersId='$usersId' order by File_For";
							$U_stmt = $con->prepare($U_query);
							$U_success = $U_stmt->execute();
							$U_rows = $U_stmt->fetchAll();
							$id = 0;
							foreach ($U_rows as $row) {
								$folder = $row['folder'];
								$fileName = $row['fileName'];
								$fileType = $row['fileType'];
								$File_For = $row['File_For'];
								$fileSize = $row['fileSize'];
								$fileDescription = $row['fileDescription'];
								$uploadedDate = $row['uploadedDate'];
								$other = $row['other'];
							?>
								<tr>
									<?php $id = $id + 1; ?>
									<td><?php echo $id; ?></td>
									<td><?php echo $fileName; ?></td>
									<td><?php echo $File_For; ?></td>
									<td><?php echo $fileSize; ?></td>
									<td><?php echo $uploadedDate; ?></td>
									<td>
										<a href="configurations/users/views/download.php?folder=<?php echo $folder; ?>&download_file=<?php echo $fileName; ?>"> <span class="label label-success arrowed "><i class="fa fa-cloud-download"></i> Download</span> </a>
										<a href="configurations/users/views/view.php?folder=<?php echo $folder; ?>&download_file=<?php echo $fileName; ?>"> <span class="label label-success arrowed "><i class="fa fa-view"></i> View</span> </a>
									</td>

								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } ?>
				<?php
				$Check_L = "select count(*) from approvallog where usersId = '$usersId' ";
				$stmtL = $con->prepare($Check_L);
				$stmtL->execute();
				$rowsL = $stmtL->fetchColumn();
				if ($rowsL > 0) {
				?>
					<div class="table-header">
						Role Requests Approval History
					</div>
					<table id="example" class="table table-stripped table-bordered table-hover">
						<thead>
							<tr>
								<th>S/N</th>
								<th>Requested Role</th>
								<th>Requested Date</th>
								<th>Approval Date</th>
								<th>Action By</th>
								<th>Changed From</th>
								<th>Changed To</th>
								<th>Reason</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$U_query = "select titleName,firstName,fatherName,grandFatherName,requestDate,rolesName,fromStatus,toStatus,changeDate,approvallog.Reason from 
								approvallog  join roles ON roles.rolesId=approvallog.rolesId 
								join rolerequest ON approvallog.roleRequestId=rolerequest.roleRequestId
								join users ON approvallog.changedBy=users.usersId
								join title ON users.titleId=title.titleId 
								where approvallog.usersId='$usersId' order by approvalLogId DESC";
							$U_stmt = $con->prepare($U_query);
							$U_success = $U_stmt->execute();
							$U_rows = $U_stmt->fetchAll();
							$id = 0;
							foreach ($U_rows as $row) {

								$titleName = $row['titleName'];
								$firstName = $row['firstName'];
								$fatherName = $row['fatherName'];
								$grandFatherName = $row['grandFatherName'];
								$Full_name = $titleName . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
								$fromStatus = $row['fromStatus'];
								$toStatus = $row['toStatus'];
								$changeDate = $row['changeDate'];
								$rolesName = $row['rolesName'];
								$requestDate = $row['requestDate'];
								$Reason = $row['Reason'];
							?>
								<tr>
									<?php $id = $id + 1; ?>
									<td><?php echo $id; ?></td>
									<td><?php echo $rolesName; ?></td>
									<td><?php echo $requestDate; ?></td>
									<td><?php echo $changeDate; ?></td>
									<td><?php echo $Full_name; ?></td>
									<td>
										<?php
										if ($fromStatus == 'Approved') {
											echo '<span class="label label-success arrowed">' . $fromStatus . '</span>';
										} else if ($fromStatus == 'Pending') {
											echo '<span class="label label-warning arrowed">' . $fromStatus . '</span>';
										} else if ($fromStatus == 'Denied') {
											echo '<span class="label label-danger arrowed">' . $fromStatus . '</span>';
										}
										?>
									</td>
									<td>
										<?php
										if ($toStatus == 'Approved') {
											echo '<span class="label label-success arrowed">' . $toStatus . '</span>';
										} else if ($toStatus == 'Pending') {
											echo '<span class="label label-warning arrowed">' . $toStatus . '</span>';
										} else if ($toStatus == 'Denied') {
											echo '<span class="label label-danger arrowed">' . $toStatus . '</span>';
										}
										?>
									</td>
									<td><?php echo $Reason; ?></td>
								<?php } ?>
						</tbody>
					</table>
				<?php } ?>
			</div>
		</div>
		<?php
		if (isset($_POST['approveRole'])) {
			$usersId = $_POST['usersId'];
			$rolesId = $_POST['rolesId'];
			$roleRequestId = $_POST['roleRequestId'];
			$current_status = $_POST['current_status'];
			$Reason = $_POST['Reason'];
			$R_query = "update rolerequest set status='Approved',approvedById='$usrUsersId',Reason='$Reason' where usersId='$usersId' AND roleRequestId='$roleRequestId'";
			$stmtUS = $con->prepare($R_query);
			$resultS = $stmtUS->execute();
			if ($resultS) {
				$S_query = "update users set status='active' where usersId='$usersId' ";
				$stmtUSS = $con->prepare($S_query);
				$resultSS = $stmtUSS->execute();
				if ($resultS) {
					$AddUR_query = "insert into usersrole (usersId,rolesId,isDefault,addedById) 
						   values('$usersId','$rolesId',1,'$usrUsersId')";
					$stmtAddUR = $con->prepare($AddUR_query);
					$resultUR = $stmtAddUR->execute();
					if ($resultUR) {
						$D_query = "update usersrole set isDefault=0 where usersId='$usersId' AND rolesId!='$rolesId' ";
						$stmtD = $con->prepare($D_query);
						$resultD = $stmtD->execute();
						if ($resultD) {
							$Add_query = "insert into approvallog (roleRequestId,rolesId,usersId,fromStatus,toStatus,changedBy,Reason) 
									  values('$roleRequestId','$rolesId','$usersId','$current_status','Approved','$usrUsersId','$Reason')";
							$stmtAddC = $con->prepare($Add_query);
							$resultH = $stmtAddC->execute();
							if ($resultH) {

								$serverName = $_SERVER['SERVER_NAME'];
								if ($serverName == 'localhost' || $serverName == '127.0.0.1') {
									$serverName = $serverName . '/eprescription';
								}

								$e_query = "select email from users where usersId='$usersId'";
								$U_stmt = $con->prepare($e_query);
								$U_success = $U_stmt->execute();
								$U_rows = $U_stmt->fetchAll();
								foreach ($U_rows as $row) {
									$email = $row['email'];
								}

								$e_query = "select rolesName from roles where rolesId='$rolesId'";
								$U_stmt = $con->prepare($e_query);
								$U_success = $U_stmt->execute();
								$U_rows = $U_stmt->fetchAll();
								foreach ($U_rows as $row) {
									$rolesName = $row['rolesName'];
								}

								$bodyContent = '<h3>e-Prescription  Approval Message</h3>';
								$bodyContent = '<h3><b>eRx Ethiopia</b> Approval</h3>';
								$bodyContent .= '<p><b>You Have Been Approved By Our System as a ' . $rolesName . '. You Can Have Access to Your Page</b><br><br>
										<span>
										Thank You <br> Medco Technology Solutions </span></p>';

								$email_send = new EmailSender();
								$email_send->sendMail($email, $bodyContent);

								if (!$email_send) {
									$message = 'Email sending failed ';
									$Error = $mail->ErrorInfo;
									$Error_message = $message . $Error;
									$_SESSION['error_user'] = $Error_message;
									header("location: index.php?name=configurations/role-requests/rolerequests&var=roleRequests");
								} else {
									$_SESSION['success'] = 'set';
									header("location: index.php?name=configurations/role-requests/rolerequests&var=roleRequests");
								}
							}
						}
					}
				}
			}
		} elseif (isset($_POST['denyRole'])) {
			$usersId = $_POST['usersId'];
			$Reason = $_POST['Reason'];
			$roleRequestId = $_POST['roleRequestId'];
			$current_status = $_POST['current_status'];
			$Update_query = "update users set status='limitedAccess' where usersId='$usersId'";
			$stmtUpdateC = $con->prepare($Update_query);
			$resultC = $stmtUpdateC->execute();
			if ($resultC) {
				$S_query = "update rolerequest set status='Denied',approvedById='$usrUsersId',Reason='$Reason' where usersId='$usersId' AND roleRequestId='$roleRequestId'";
				$stmtUSS = $con->prepare($S_query);
				$resultSS = $stmtUSS->execute();
				if ($resultSS) {
					$Add_query = "insert into approvallog (roleRequestId,rolesId,usersId,fromStatus,toStatus,changedBy,Reason) 
						    values('$roleRequestId','$rolesId','$usersId','$current_status','Denied','$usrUsersId','$Reason')";
					$stmtAddC = $con->prepare($Add_query);
					$resultH = $stmtAddC->execute();
					if ($resultH) {
						$_SESSION['success'] = 'set';
						header("location: index.php?name=configurations/users/userdetail&var=users&usersId=$usersId");
					}
				}
			}
		}
		?>
<?php } else {
		header("location: index.php?name=configurations/users/users&var=users");
	}
} else {
	header("location: index.php");
}
?>