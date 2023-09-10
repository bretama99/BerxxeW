<?php
include('../common/email/email-send.php');
if ($canView == "1") { ?>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="col-sm-14">
				<div class="tabbable">
					<ul class="nav nav-tabs" id="myTab">
						<?php
						$Check_P = "select count(*) from 
	                      rolerequest join users ON rolerequest.usersId=users.usersId
	                      join roles ON roles.rolesId=rolerequest.rolesId 
	                      join title ON users.titleId=title.titleId where rolerequest.status='Pending' AND rolerequest.isDeleted=0";
						// $Check_P = "select count(*) from rolerequest where status = 'Pending' AND isDeleted=0 ";
						$stmtP = $con->prepare($Check_P);
						$stmtP->execute();
						$rowsP = $stmtP->fetchColumn();
						$Check_A = "select count(*) from 
	rolerequest join users ON rolerequest.usersId=users.usersId
	join roles ON roles.rolesId=rolerequest.rolesId 
	join title ON users.titleId=title.titleId where rolerequest.status='Approved' AND rolerequest.isDeleted=0";
						// $Check_A = "select count(*) from rolerequest where status = 'Approved' ";
						$stmtA = $con->prepare($Check_A);
						$stmtA->execute();
						$rowsA = $stmtA->fetchColumn();

						$Check_D = "select count(*) from 
	rolerequest join users ON rolerequest.usersId=users.usersId
	join roles ON roles.rolesId=rolerequest.rolesId 
	join title ON users.titleId=title.titleId where rolerequest.status='Denied' AND rolerequest.isDeleted=0";
						// $Check_D = "select count(*) from rolerequest where status = 'Denied' ";
						$stmtD = $con->prepare($Check_D);
						$stmtD->execute();
						$rowsD = $stmtD->fetchColumn();
						?>
						<li class="active">
							<a data-toggle="tab" href="#Pending" aria-controls="Pending" role="tab">
								<i class="orange ace-icon fa fa-user bigger-120"></i>
								Pending
								<span class="badge badge-warning">
									<?php echo $rowsP; ?>
								</span>
							</a>
						</li>

						<li>
							<a data-toggle="tab" href="#Approved" aria-controls="Approved" role="tab">
								<i class="green ace-icon fa fa-user bigger-120"></i>
								Approved
								<span class="badge badge-success">
									<?php echo $rowsA; ?>
								</span>
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#Denied" aria-controls="Denied" role="tab">
								<i class="red ace-icon fa fa-user bigger-120"></i>
								Denied
								<span class="badge badge-danger">
									<?php echo $rowsD; ?>
								</span>
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div id="Pending" class="tab-pane fade in active" role="tabpanel">
							<div class="row">
								<div class="col-xs-12">
									<?php include('common/messages/success_message.php'); ?>
									<table id="pending" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Profile Pic </th>
												<th>Full name</th>
												<th>Gender</th>
												<th>Requested for</th>
												<th>Requested Date</th>
												<th>Status</th>
												<th>Action </th>
											</tr>
										</thead>

										<tbody>
											<?php
											$U_query = "select titleName,firstName,fatherName,grandFatherName,gender,users.usersId,profilePicture,roleRequestId,rolesName,rolerequest.status,rolerequest.rolesId,requestDate from 
	                                                       rolerequest join users ON rolerequest.usersId=users.usersId
	                                                       join roles ON roles.rolesId=rolerequest.rolesId 
	                                                       join title ON users.titleId=title.titleId where rolerequest.status='Pending' order by requestDate DESC";
											$U_stmt = $con->prepare($U_query);
											$U_success = $U_stmt->execute();
											$U_rows = $U_stmt->fetchAll();
											$id = 0;
											foreach ($U_rows as $row) {
												$usersId = $row['usersId'];
												$titleName = $row['titleName'];
												$firstName = $row['firstName'];
												$fatherName = $row['fatherName'];
												$grandFatherName = $row['grandFatherName'];
												$status = $row['status'];
												$rolesId = $row['rolesId'];
												$gender = $row['gender'];
												$roleRequestId = $row['roleRequestId'];
												$rolesName = $row['rolesName'];
												$requestDate = $row['requestDate'];
												$User_profilePicture = $row['profilePicture'];
												$Full_name = $titleName . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
											?>
												<tr>
													<?php $id = $id + 1; ?>
													<td>
														<?php echo $id; ?>
													</td>
													<td>
														<div style="width:30px; height:30px;">
															<img style="border:2px solid #C9D6E5;border-radius:100%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;" src="../../images/profile_pic/<?php echo $User_profilePicture; ?> " />
														</div>
													</td>
													<td>
														<?php echo $Full_name; ?>
													</td>
													<td>
														<?php echo $gender; ?>
													</td>
													<td>
														<?php echo $rolesName; ?>
													</td>
													<td>
														<?php echo $requestDate; ?>
													</td>
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

														<a href="?name=configurations/users/userdetail&var=users&usersId=<?php echo $usersId; ?>" class="green">
															<span class="label label-info arrowed-in-right arrowed"><i class="fa fa-info-circle"></i>Details</span>
														</a>
														<?php
														if ($canEdit == "1") {
														?>
															<a href='' data-toggle="modal" data-target="#approveRole<?php echo $roleRequestId; ?>" class='red'><span class="label label-success arrowed">Approve<i class="fa fa-question"></i></span> </a>
														<?php }
														include("configurations/role-requests/views/modalapproverole.php");
														?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div id="Approved" class="tab-pane fade in" role="tabpanel">
							<div class="row">
								<div class="col-xs-12">
									<?php include('common/messages/success_message.php'); ?>
									<table id="approved" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Profile Pic</th>
												<th>Full name</th>
												<th>Gender</th>
												<th>Requested for</th>
												<th>Requested Date</th>
												<th>Status</th>
												<th>Action </th>
											</tr>
										</thead>

										<tbody>
											<?php
											$U_query = "select titleName,firstName,fatherName,grandFatherName,gender,users.usersId,profilePicture,roleRequestId,rolesName,rolerequest.status,rolerequest.rolesId,requestDate from 
	                                                         rolerequest join users ON rolerequest.usersId=users.usersId
	                                                         join roles ON roles.rolesId=rolerequest.rolesId 
	                                                         join title ON users.titleId=title.titleId where rolerequest.status='Approved' order by requestDate DESC";
											$U_stmt = $con->prepare($U_query);
											$U_success = $U_stmt->execute();
											$U_rows = $U_stmt->fetchAll();
											$id = 0;
											foreach ($U_rows as $row) {
												$usersId = $row['usersId'];
												$titleName = $row['titleName'];
												$firstName = $row['firstName'];
												$fatherName = $row['fatherName'];
												$grandFatherName = $row['grandFatherName'];
												$status = $row['status'];
												$rolesId = $row['rolesId'];
												$gender = $row['gender'];
												$roleRequestId = $row['roleRequestId'];
												$rolesName = $row['rolesName'];
												$requestDate = $row['requestDate'];
												$User_profilePicture = $row['profilePicture'];
												$Full_name = $titleName . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
											?>
												<tr>
													<?php $id = $id + 1; ?>
													<td>
														<?php echo $id; ?>
													</td>
													<td>
														<div style="width:30px; height:30px;">
															<img style="border:2px solid #C9D6E5;border-radius:100%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;" src="../../images/profile_pic/<?php echo $User_profilePicture; ?> " />
														</div>
													</td>
													<td>
														<?php echo $Full_name; ?>
													</td>
													<td>
														<?php echo $gender; ?>
													</td>
													<td>
														<?php echo $rolesName; ?>
													</td>
													<td>
														<?php echo $requestDate; ?>
													</td>
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
														<a href="?name=configurations/users/userdetail&var=users&usersId=<?php echo $usersId; ?>" class="green">
															<span class="label label-info arrowed-in-right arrowed"><i class="fa fa-info-circle"></i>Details</span>
														</a>
														<?php
														if ($canEdit == "1") {
														?>
															<a href='' data-toggle="modal" data-target="#approveRole<?php echo $roleRequestId; ?>" class='red'><span class="label label-danger arrowed">Deny<i class="fa fa-question"></i></span> </a>
														<?php }
														include("configurations/role-requests/views/modalapproverole.php");
														?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div id="Denied" class="tab-pane fade in" role="tabpanel">
							<div class="row">
								<div class="col-xs-12">
									<?php include('common/messages/success_message.php'); ?>
									<table id="denied" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Profile Pic</th>
												<th>Full name</th>
												<th>Gender</th>
												<th>Requested for</th>
												<th>Requested Date</th>
												<th>Status</th>
												<th>Action </th>
											</tr>
										</thead>

										<tbody>
											<?php
											$U_query = "select titleName,firstName,fatherName,grandFatherName,gender,email,users.usersId,profilePicture,roleRequestId,rolesName,rolerequest.status,rolerequest.rolesId,requestDate from 
	                                                      rolerequest join users ON rolerequest.usersId=users.usersId
	                                                      join roles ON roles.rolesId=rolerequest.rolesId 
	                                                      join title ON users.titleId=title.titleId where rolerequest.status='Denied' order by requestDate DESC";
											$U_stmt = $con->prepare($U_query);
											$U_success = $U_stmt->execute();
											$U_rows = $U_stmt->fetchAll();
											$id = 0;
											foreach ($U_rows as $row) {
												$usersId = $row['usersId'];
												$email = $row['email'];
												$titleName = $row['titleName'];
												$firstName = $row['firstName'];
												$fatherName = $row['fatherName'];
												$grandFatherName = $row['grandFatherName'];
												$status = $row['status'];
												$rolesId = $row['rolesId'];
												$gender = $row['gender'];
												$roleRequestId = $row['roleRequestId'];
												$rolesName = $row['rolesName'];
												$requestDate = $row['requestDate'];
												$User_profilePicture = $row['profilePicture'];
												$Full_name = $titleName . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
											?>
												<tr>
													<?php $id = $id + 1; ?>
													<td>
														<?php echo $id; ?>
													</td>
													<td>
														<div style="width:30px; height:30px;">
															<img style="border:2px solid #C9D6E5;border-radius:100%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;" src="../../images/profile_pic/<?php echo $User_profilePicture; ?> " />
														</div>
													</td>
													<td>
														<?php echo $Full_name; ?>
													</td>
													<td>
														<?php echo $gender; ?>
													</td>
													<td>
														<?php echo $rolesName; ?>
													</td>
													<td>
														<?php echo $requestDate; ?>
													</td>
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
														<a href="?name=configurations/users/userdetail&var=users&usersId=<?php echo $usersId; ?>" class="green">
															<span class="label label-info arrowed-in-right arrowed"><i class="fa fa-info-circle"></i> See Detail</span>
														</a>
														<?php
														if ($canEdit == "1") {
														?>
															<a href='' data-toggle="modal" data-target="#approveRole<?php echo $roleRequestId; ?>" class='red'><span class="label label-success arrowed"> Approve
																	Request <i class="fa fa-question"></i></span> </a>
														<?php }
														include("configurations/role-requests/views/modalapproverole.php");
														?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.col -->

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
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
							$bodyContent .= '<p><b>You Have Been Approved By Our System as a ' . $rolesName . '. You Can Login And Access Your Page</b><br><br>
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
	}
	if (isset($_POST['denyRole'])) {
		$usersId = $_POST['usersId'];
		$Reason = $_POST['Reason'];
		$roleRequestId = $_POST['roleRequestId'];
		$current_status = $_POST['current_status'];
		$Update_query = "update rolerequest set status='Denied',approvedById='$usrUsersId',Reason='$Reason' where usersId='$usersId' AND roleRequestId='$roleRequestId'";
		$stmtUpdateC = $con->prepare($Update_query);
		$resultC = $stmtUpdateC->execute();
		if ($resultC) {
			$Add_query = "insert into approvallog (roleRequestId,rolesId,usersId,fromStatus,toStatus,changedBy,Reason) 
values('$roleRequestId','$rolesId','$usersId','$current_status','Denied','$usrUsersId','$Reason')";
			$stmtAddC = $con->prepare($Add_query);
			$resultH = $stmtAddC->execute();
			if ($resultH) {
				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/role-requests/rolerequests&var=roleRequests");
			}
		}
	}
	?>
<?php } else {
	header("location: index.php");
}

?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#pending').DataTable({
			responsive: true
		});

		$('#approved').DataTable({
			responsive: true
		});

		$('#denaid').DataTable({
			responsive: true
		});



		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			$($.fn.dataTable.tables(true)).DataTable()
				.columns.adjust()
				.responsive.recalc();
		});

	});
</script>

<style type="text/css">
	.tab-content {
		padding: 10px;
		border-left: 1px solid #DDD;
		border-bottom: 1px solid #DDD;
		border-right: 1px solid #DDD;
	}
</style>