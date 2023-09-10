<?php
include('../../apps/common/email/email-send.php');
include("hub/physician/find-physician/models/nearestPhysicians.php");
$search = '';
if (isset($_POST['filterPhysicians'])) {
	$search = $_POST['filterPhysicians'];
	ltrim($search);
	rtrim($search);
}
$searchArray = explode(" ", $search);
$cnt = count($searchArray);
if ($cnt = 1) {
	$columnValues = "firstName LIKE '$searchArray[0]%'  OR gender LIKE '$searchArray[0]%'  OR email LIKE '$searchArray[0]%' OR mobilePhone LIKE '$searchArray[0]%' OR specialization.specializationName LIKE '$searchArray[0]%' OR physicianinfo.HealthInstitutionName LIKE '$searchArray[0]%' OR physicianinfo.graduatedFrom LIKE '$searchArray[0]%'";
} else if ($cnt = 2) {
	$columnValues = "firstName LIKE '$searchArray[0]%' AND fatherName  LIKE '$searchArray[1]%'";
} else if ($cnt = 3) {
	$columnValues = "firstName LIKE '$searchArray[0]%' AND fatherName  LIKE '$searchArray[1]%' AND grandFatherName  LIKE '$searchArray[2]%'";
}

if (isset($_SESSION['latitude']) && isset($_SESSION['longitude']) && $search == '') {
	$rows = getNearestPhyscians($_SESSION['latitude'], $_SESSION['longitude']);
} else if (isset($_SESSION['latitude']) && isset($_SESSION['longitude']) && $search != '') {
	$rows = searchPhysicians($_SESSION['latitude'], $_SESSION['longitude'], $columnValues);
} else {

	$Usr_query = "select users.*, specialization.specializationName from users INNER JOIN physicianinfo ON users.usersId=physicianinfo.usersId INNER JOIN specialization ON physicianinfo.specializationId= specialization.specializationId LEFT JOIN rolerequest on rolerequest.usersId=users.usersId where rolerequest.isDeleted=0 and rolerequest.status='Approved' and users.status='active' AND users.usersDefaultRolesId=3 group by users.usersId LIMIT 100";
	$Usr_stmt = $con->prepare($Usr_query);
	$Usr_success = $Usr_stmt->execute();
	$rows = $Usr_stmt->fetchAll();
}

if ($search == '')
	$search = "All Physicians";
?>
<script type="text/javascript">
	if ('ontouchstart' in document.documentElement) document.write("<script src='../../../../js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>

<script src="../../js/jquery.dataTables.min.js"></script>
<script src="../../js/jquery.dataTables.bootstrap.min.js"></script>
<script src="../../js/dataTables.buttons.min.js"></script>
<script src="../../js/buttons.flash.min.js"></script>
<script src="../../js/buttons.html5.min.js"></script>
<script src="../../js/ace-extra.min.js"></script>
<!-- <link rel="stylesheet" href="../../font-awesome/use.fontawesome.com_releases_v5.5.0_css_all.css"/> -->

<link rel="stylesheet" href="../../fontawesome-free-6.4.0-web/css/font-awesome.min.css" />

<script type="text/javascript">
	jQuery(function($) {
		$('.show-details-btn').on('click', function(e) {
			e.preventDefault();
			$(this).closest('tr').next().toggleClass('open');
			$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
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

						<input type="text" name="filterPhysicians" class="form-control search-query" placeholder="Type any search key " />
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
				Lists of Physicians ( Search Key:
				<?php echo $search; ?>)
			</small>
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<?php include('common/messages/success_message_email.php'); ?>

		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
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
								<th colspan='2'>Full Name</th>
								<th class="hidden-480">Mobile Phone</th>
								<th class="hidden-480">Email Address</th>
								<th class="hidden-480">Specialization</th>
								<?php if (isset($_SESSION['latitude'])) { ?>
									<th class="hidden-480">Distance</th>
								<?php } ?>
								<th class="detail-col">Details</th>
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
											<!--<input type="checkbox" class="ace" />-->
											<span class="lbl"></span>
										</label>
									</td>
									<td colspan='2'>
										<?php echo $row['firstName'] . ' ' . $row['fatherName'] . ' ' . $row['grandFatherName']; ?>
									</td>
									<td>
										<?php echo $row['mobilePhone']; ?>
									</td>
									<td>
										<?php echo $row['email']; ?>
									</td>
									<td>
										<?php echo $row['specializationName']; ?>
									</td>
									<?php if (isset($_SESSION['latitude']) && isset($_SESSION['longitude'])) { ?>
										<td colspan='1' style="font-size: 9px;"><b>
												<?php echo round($row['distance'], 1) . " " . $lang['km'] ?>&nbsp;&nbsp;
											</b>
										</td>
									<?php } ?>
									<td class="center">
										<div class="action-buttons">
											<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
												<i class="ace-icon fa fa-angle-double-down"></i>
												<span class="sr-only">Details</span>
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
															<div class="profile-info-name"> Username </div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['userName']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> Location </div>

															<div class="profile-info-value">
																<i class="fa fa-map-marker light-orange bigger-110"></i>
																<span>
																	<?php echo $row['kebelle']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> Date of Birth </div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['dateOfBirth']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> Last Visit Day </div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['lastLoginTime']; ?>
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
														$email = $row['email'];
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


							<?php
								$arrayLng[] = $row['lastLoginLongitude'];
								$arrayLat[] = $row['lastLoginLatitude'];
								$arrayFirstName[] = $row['firstName'];
								$arrayFatherName[] = $row['fatherName'];
								$arrayEmail[] = $row['email'];
								$arrayPhone[] = $row['mobilePhone'];
								$arraySpecializationName[] = $row['specializationName'];
							} ?>

							<tr>
								<td colspan='12'>
									<div id="mapPhysician" style="width:100%;height:400px;"></div>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- /.span -->
			</div><!-- /.row -->


			<?php
			$modalTitle = "Prescription Details ..";
			include("hub/ui/popupModal.php");
			?>

			<script>
				var arrayLat = <?php echo json_encode($arrayLat); ?>;
				var arrayLng = <?php echo json_encode($arrayLng); ?>;

				var arrayFirstName = <?php echo json_encode($arrayFirstName); ?>;
				var arrayFatherName = <?php echo json_encode($arrayFatherName); ?>;
				var arrayEmail = <?php echo json_encode($arrayEmail); ?>;
				var arrayPhone = <?php echo json_encode($arrayPhone); ?>;
				var arraySpecializationName = <?php echo json_encode($arraySpecializationName); ?>;

				function myMap() {
					var mapProp = {
						center: new google.maps.LatLng(arrayLat[0], arrayLng[0]),
						zoom: 8,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						//disableDefaultUI: true
					};
					var map = new google.maps.Map(document.getElementById("mapPhysician"), mapProp);

					for (var i = 0; i < arrayFirstName.length; i++) {
						new google.maps.Marker({
							position: new google.maps.LatLng(arrayLat[i], arrayLng[i]),
							map: map,
							title: 'Name:' + arrayFirstName[i] + ' ' + arrayFatherName[i] + ' (' + arraySpecializationName[i] + ')' + ', Phone:' + arrayPhone[i] + ' , Email:' + arrayEmail[i]
						});

					}

				}
			</script>

			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIA2P9qeYtaXVPJHlGU5CF-mJNE8hpCV0&callback=myMap"></script>



			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->