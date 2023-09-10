<?php
include('../../apps/common/email/email-send.php');
include ('../../constants/security/hash.php');
$search = '';
if (isset($_POST['filterMyPatients'])) {
	$search = $_POST['filterMyPatients'];
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

		$Usr_query = "select users.*, prescription.prescriberId,prescription.patientId from users INNER JOIN prescription on prescription.patientId=users.usersId where (" . $columnValues . ") and prescription.isDeleted=0 and prescription.prescriberId='" . $usrUsersId . "' group by users.usersId";
	}
} else {
	$Usr_query = "select users.*, prescription.prescriberId,prescription.patientId from users INNER JOIN prescription on prescription.patientId=users.usersId where prescription.isDeleted=0 and prescription.prescriberId='" . $usrUsersId . "' group by users.usersId";
}
$Usr_stmt = $con->prepare($Usr_query);
$Usr_success = $Usr_stmt->execute();
$rows = $Usr_stmt->fetchAll();
if ($Usr_success) {
}
if ($search == '')
	$search = "All Patients";
?>
<script type="text/javascript">
	if ('ontouchstart' in document.documentElement) document.write("<script src='../../../../js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="../../js/jquery.dataTables.min.js"></script>
<script src="../../js/jquery.dataTables.bootstrap.min.js"></script>
<script src="../../js/ace-extra.min.js"></script>
<link rel="stylesheet" href="../../fontawesome-free-6.4.0-web/css/font-awesome.min.css" />
<script src="hub/common/js/showDetails.js"></script>
<script src="hub/patients/my-patients/js/showPatientMedications.js"></script>

<script type="text/javascript">
	jQuery(function($) {
		$('.show-details-btn').on('click', function(e) {
			e.preventDefault();
			$(this).closest('tr').next().toggleClass('open');
			$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
		});
		$('.show-details-btn-pre1').on('click', function(e) {
			e.preventDefault();
			var $row = $(this).closest('tr').next();
			$row.closest('tr').next().toggleClass('open');
			$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
		});
		$('.show-details-btn-pre2').on('click', function(e) {
			e.preventDefault();
			var $row = $(this).closest('tr').next().next();
			$row.closest('tr').next().toggleClass('open');
			$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
		});

		$('.show-details-btn-medic').on('click', function(e) {
			e.preventDefault();
			var $row = $(this).closest('tr').next().next();
			$row.closest('tr').next().toggleClass('open');
		});
	});

	function nextChar(c) {
		return String.fromCharCode(c.charCodeAt(0) + 1);
	}
</script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<div class="page-content">
	<div class="page-header">
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" action="" method="post">
					<div class="input-group" style="width:30%; float:right;">
						<span class="input-group-addon">
							<i class="ace-icon fa fa-check"></i>
						</span>
						<input type="text" name="filterMyPatients" class="form-control search-query" placeholder="Type any search key " />
						<span class="input-group-btn">
							<input type="submit" value="Search" class="btn btn-purple btn-sm">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							/>
						</span>
					</div>
				</form>
			</div>
		</div>
		<h1>
			<small>
				My Patient Lists ( Search Key: <?php echo $search; ?>)
			</small>

		</h1>
	</div>
	<div class="row">
		<?php include('common/messages/success_message_email.php'); ?>
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<a href='?name=hub/prescriptions/prescribe/addprescription&var=prescriptions' style="float:right; margin:5px;" type="button" class="btn btn-purple btn-sm">
						<span class="ace-icon fa fa-plus icon-on-right bigger-110"></span>
						<?php echo $lang['prescribeButton']; ?>
					</a>
				</div>
				<div class="col-xs-12">
					<table id="simple-table" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">
									<label class="pos-rel">
										S/N
										<span class="lbl"></span>
									</label>
								</th>
								<th class="detail-col">Details</th>
								<th colspan='2'>Full Name</th>
								<th>
									<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
									Age
								</th>
								<th class="hidden-480">Mobile Phone</th>
								<th class="hidden-480">Email Address</th>
								<th> Action&nbsp;</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$i = 0;
							foreach ($rows as $row) {

								// $Usr_query = "select users.* from users INNER JOIN prescription on prescription.patientId=users.usersId where prescription.isDeleted=0 and prescription.prescriberId='" . $usrUsersId . "' group by users.usersId";

								$query = "select count(*) from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join users on users.usersId='" . $row['usersId'] . "' where prescription.patientId='" . $row['patientId'] . "' AND prescription.prescriberId='" . $row['prescriberId'] . "' AND prescription.status='Returned' AND prescribeddrugs.isDeleted=0 AND prescription.isDeleted=0";

								$stmtP = $con->prepare($query);
								$stmtP->execute();
								$rowsP = $stmtP->fetchColumn();
								$i++ ?>
								<tr>
									<td class="center">
										<label class="pos-rel">
											<?php echo $i; ?>
											<span class="lbl"></span>
										</label>
									</td>
									<td class="center">
										<div class="action-buttons">
											<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
												<i class="ace-icon fa fa-angle-double-down"></i>
												<span class="sr-only">Details</span>
											</a>
										</div>
									</td>
									<td colspan='2'><?php echo $row['firstName'] . ' ' . $row['fatherName'] . ' ' . $row['grandFatherName']; ?></td>
									<td>
										<?php
										$now = new DateTime();
										$result = $now->format('Y-m-d H:i:s');
										$birthday = $row['dateOfBirth'];
										$date = date_create_from_format("Y-m-d", $birthday);

										if ($now->diff($date)->format('%y') > 0) {
											echo $now->diff($date)->format('%y years ');
										} else {
											echo $now->diff($date)->format('%m months, %d days');
										} ?>

									</td>

									<td><?php echo $row['mobilePhone']; ?></td>
									<td><?php echo $row['email']; ?></td>

									<td style="width:10%;">
										<div class="hidden-sm hidden-xs  btn-group">
											<button style="border-radius: 4px;" class=" btn btn-xs show-details-btn-pre1 btn-success" title="View List of Medications .." onclick=" showMedication(<?php echo $row['usersId']; ?>);">
												<i class="ace-icon fa fa-eye bigger-110 notification">

													<?php if ($rowsP > 0) { ?>
														<span class="badge"><?php echo $rowsP ?></span>

													<?php } ?>

												</i>
											</button>
											<a style="border-radius: 4px; margin-left: 3px; margin-right: 3px;" href="?name=hub/prescriptions/prescribe/addprescription&var=prescriptions&Id=<?php echo $row['usersId'];?>&hash=<?php echo encryptHash($row['usersId']);?>" role="button" class=" green btn btn-xs  btn-purple">
												<i class='fa fa-file-powerpoint-o teal-color bigger-110'></i>
												<!-- <i class="ace-icon fas fa-file-prescription teal-color bigger-120"></i>  -->
											</a>
										</div>
									</td>
								</tr>

								<tr class="detail-row">
									<td colspan="8">
										<div class="table-detail">
											<div class="row">
												<div class="col-xs-12 col-sm-2">
													<div class="text-center">
														<?php $row['profilePicture'] == '' ? $image = $row['profilePicture'] : $image = 'defaultMale.jpg'; ?>
														<img height="150" class="thumbnail inline no-margin-bottom" alt="" src="../../images/profile_pic/<?php echo $image; ?>" />
														<br />
														<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
															<div class="inline position-relative">
																<a class="user-title-label" href="#">
																	<i class="ace-icon fa fa-circle light-green"></i>
																	&nbsp;
																	<span class="white"><?php echo $row['firstName'] . ' ' . $row['fatherName']; ?></span>
																</a>
															</div>
														</div>
													</div>
												</div>

												<div class="col-xs-12 col-sm-7">
													<div class="space visible-xs"></div>

													<div class="profile-user-info profile-user-info-striped">
														<div class="profile-info-row">
															<div class="profile-info-name"> Username </div>

															<div class="profile-info-value">
																<span><?php echo $row['userName']; ?></span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> Location </div>

															<div class="profile-info-value">
																<i class="fa fa-map-marker light-orange bigger-110"></i>
																<span><?php echo $row['kebelle']; ?></span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Last Visit Day </div>

															<div class="profile-info-value">
																<span><?php echo $row['lastLoginTime']; ?></span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> Allergies </div>

															<div class="profile-info-value">
																<span>alergy info ...</span>
															</div>
														</div>

													</div>
												</div>

												<div class="col-xs-12 col-sm-3">
													<div class="space visible-xs"></div>
													<h4 class="header blue lighter less-margin">Send a message to <?php echo $row['firstName'] . ' ' . $row['fatherName'] . ' ' . $row['grandFatherName']; ?></h4>

													<div class="space-6"></div>

													<form action="" method="post">
														<fieldset>
															<textarea name="bodyContent" class="width-100" resize="none" placeholder="Type something…"></textarea>
														</fieldset>

														<div class="hr hr-dotted"></div>

														<div class="clearfix">
															<label class="pull-left">
																<input type="checkbox" class="ace" />
																<span class="lbl"> Email me a copy</span>
															</label>
															<button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="submit">
																Submit
																<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
															</button>
														</div>
													</form>

													<?php

													if (isset($_POST['bodyContent'])) {

														$bodyContent = $_POST['bodyContent'];

														$email =  $row['email'];
														$cc = $_SESSION['email'];
														$email_send = new EmailSender();
														$returnMessage = $email_send->sendMail($email, $bodyContent, $cc);
														if ($returnMessage == 'Signed up successfully. <br> confirmation link is sent to your email please confirm your email') {

															$_SESSION['emailed'] = 'set';
														}
													}
													?>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<!-------------------------Medication List---------------------------->
								<tr class="detail-row">
									<td colspan="8">
										<div class="row">
											<div class="col-xs-12">
												<!-- PAGE CONTENT BEGINS -->
												<div class="row">
													<div class="col-xs-12">

														<table id="medicationDiv<?php echo $row['usersId']; ?>" class="table  table-bordered table-hover">

															<h8 style="color:green;width:100%; font-size:14px;margin-left:20%;"> Medications History .. </h8>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</td>
	</tr>

<?php } ?>
</tbody>
</table>
</div>
</div>
<?php
$modalTitle = "Prescription Details ..";
include("hub/ui/popupModal.php");
?>
</div>
</div>
</div>


<style>
	.notification {
		text-decoration: none;
		position: relative;
		display: inline-block;
	}

	/*.notification:hover {
  background: red;
}*/

	.notification .badge {
		position: absolute;
		top: -10px;
		right: -10px;
		padding: 2px 4px;
		border-radius: 50%;
		background-color: red;
		color: white;
	}
</style>