<head>
	<script src="hub/common/js/showMedications.js"></script>
	<script src="hub/common/js/showDetails.js"></script>
	<?php
	include('../../apps/common/email/email-send.php');

	$search = '';
	if (isset($_POST['filterMyPatients']) and $_POST['filterMyPatients'] != '') {

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
			$columnValues = "firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%' and grandFatherName  LIKE '$searchArray[1]%'";
		}

		if ($search != '') {
			$Usr_query = "select users.usersId, users.firstName,users.fatherName,users.grandFatherName, title.titleName, users.email,users.profilePicture, users.mobilePhone, users.kebelle, woreda.woredaName, zone.zoneName from users INNER JOIN prescription on prescription.prescriberId=users.usersId INNER JOIN title on users.titleId=title.titleId LEFT JOIN zone on users.zoneId=zone.zoneId LEFT JOIN woreda on users.woredaId=woreda.woredaId  where (" . $columnValues . ") and prescription.isDeleted=0 and prescription.patientId='" . $usrUsersId . "' group by prescription.prescriberId";
		}
	} else {
		$Usr_query = "select users.usersId, users.firstName,users.fatherName,users.grandFatherName, title.titleName, users.email, users.profilePicture, users.mobilePhone, users.kebelle, woreda.woredaName, zone.zoneName from users INNER JOIN prescription on prescription.prescriberId=users.usersId INNER JOIN title on users.titleId=title.titleId LEFT JOIN zone on users.zoneId=zone.zoneId LEFT JOIN woreda on users.woredaId=woreda.woredaId  where prescription.isDeleted=0 and prescription.patientId='" . $usrUsersId . "'  group by prescription.prescriberId";
	}

	$Usr_stmt = $con->prepare($Usr_query);
	$Usr_success = $Usr_stmt->execute();
	$rows = $Usr_stmt->fetchAll();
	if ($Usr_success) {
	}

	if ($search == '')
		$search = "All Prescriptions";

	?>
	<script type="text/javascript">
		if ('ontouchstart' in document.documentElement) document.write("<script src='../../js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
	</script>
	<script src="../../js/jquery.dataTables.min.js"></script>
	<script src="../../js/jquery.dataTables.bootstrap.min.js"></script>
	<script src="../../js/ace.min.js"></script>

	<link rel="stylesheet" href="../../font-awesome/4.5.0/css/font-awesome.min.css" />
	<script type="text/javascript">
		jQuery(function($) {
			var myTable =
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable({
					bAutoWidth: false,
					"aoColumns": [{
							"bSortable": false
						},
						null, null, null, null, null,
						{
							"bSortable": false
						}
					],
					"aaSorting": [],
					select: {
						style: 'multi'
					}
				});

			$('.show-details-btn').on('click', function(e) {
				e.preventDefault();
				$(this).closest('tr').next().toggleClass('open');
				$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
			});
			//***********
			$('.show-details-btn-pre1').on('click', function(e) {

				e.preventDefault();
				var $row = $(this).closest('tr').next();
				$row.closest('tr').next().toggleClass('open');
				$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
			});
		});
	</script>
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
				My Prescriptions Lists ( Search Key:
				<?php echo $search; ?>)
			</small>
		</h1>
	</div>

	<div class="row">
		<?php include('common/messages/success_message_email.php'); ?>

		<div class="col-xs-12">
			<div class="row">

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
								<th colspan='2'>Physician Name</th>

								<th class="hidden-480">Mobile Phone</th>
								<th class="hidden-480">Email Address</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;
							foreach ($rows as $row) {
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


									<td colspan='2'>
										<?php echo $row['titleName'] . ' ' . $row['firstName'] . ' ' . $row['fatherName'] . ' ' . $row['grandFatherName']; ?>
									</td>

									<td>
										<?php echo $row['mobilePhone']; ?>
									</td>
									<td>
										<?php echo $row['email']; ?>
									</td>

									<td style="width:4%;">
										<div class="hidden-sm hidden-xs  btn-group">


											<button class="btn btn-xs show-details-btn-pre1 btn-success" title="View List of Medications .." onclick="showMedication(<?php echo $usrUsersId; ?> ,<?php echo $row['usersId']; ?>);">
												<i class="ace-icon fa fa-eye bigger-120"></i>
											</button>

										</div>


									</td>
								</tr>

								<tr class="detail-row">
									<td colspan="8">
										<div class="table-detail">
											<div class="row">
												<div class="col-xs-12 col-sm-2">
													<div class="text-center">
														<img height="150" class="thumbnail inline no-margin-bottom" alt="" src="../images/profile_pic/<?php echo $row['profilePicture']; ?>" />
														<br />
														<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
															<div class="inline position-relative">
																<a class="user-title-label" href="#">
																	<i class="ace-icon fa fa-circle light-green"></i>
																	&nbsp;
																	<span class="white">
																		<?php echo $row['firstName'] . ' ' . $row['fatherName']; ?>
																	</span>
																</a>
															</div>
														</div>
													</div>
												</div>

												<div class="col-xs-12 col-sm-7">
													<div class="space visible-xs"></div>

													<div class="profile-user-info profile-user-info-striped">


														<div class="profile-info-row">
															<div class="profile-info-name"> Location </div>

															<div class="profile-info-value">
																<i class="fa fa-map-marker light-orange bigger-110"></i>
																<span>
																	<?php echo $row['kebelle'] . ', ' . $row['woredaName'] . ', ' . $row['zoneName']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> Full Name </div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['titleName'] . ' ' . $row['firstName'] . ' ' . $row['fatherName'] . ' ' . $row['grandFatherName']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> Mobile Address </div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['mobilePhone']; ?>
																</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Email Address </div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['email']; ?>
																</span>
															</div>
														</div>
													</div>
												</div>

												<div class="col-xs-12 col-sm-3">
													<div class="space visible-xs"></div>
													<h4 class="header blue lighter less-margin">Send a message to
														<?php echo $row['firstName'] . ' ' . $row['fatherName'] . ' ' . $row['grandFatherName']; ?>
													</h4>

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

															<span style="color:green;width:100%; font-size:14px;margin-left:20%;">
																My Medication History .. </span>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</td>
	</tr>

	<!---------------------- end of Medications List----------------------------->
<?php } ?>
</tbody>
</table>
</div>
</div>

<div id="modal-table" class="modal fade" tabindex="-1">
	<br><br>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					Prescription Details ..
				</div>
			</div>
			<div class="modal-body no-padding">

				<form name="addPrescriptionForm" method="post" action=" ">
					<table id="otherDetails" class="table table-striped table-bordered table-hover">

					</table>
				</form>
			</div>
			<div class="modal-footer no-margin-top">
				<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>