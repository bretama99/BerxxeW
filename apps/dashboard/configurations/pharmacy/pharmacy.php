<?php if ($canView == "1") { ?>
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="col-sm-14">
				<div class="tabbable">
					<ul class="nav nav-tabs" id="myTab">
						<?php
						$Check_P = "select count(*) from pharmacy where approval = 'Pending' ";
						$stmtP = $con->prepare($Check_P);
						$stmtP->execute();
						$rowsP = $stmtP->fetchColumn();

						$Check_A = "select count(*) from pharmacy where approval = 'Active' ";
						$stmtA = $con->prepare($Check_A);
						$stmtA->execute();
						$rowsA = $stmtA->fetchColumn();

						$Check_D = "select count(*) from pharmacy where approval = 'Disabled' ";
						$stmtD = $con->prepare($Check_D);
						$stmtD->execute();
						$rowsD = $stmtD->fetchColumn();
						?>
						<li class="active">
							<a data-toggle="tab" href="#Pending" aria-controls="Pending" role="tab">
								<i class="orange ace-icon fa fa-home bigger-120"></i>
								Pending
								<span class="badge badge-warning"><?php echo $rowsP; ?></span>
							</a>
						</li>

						<li>
							<a data-toggle="tab" href="#Active" aria-controls="Active" role="tab">
								<i class="green ace-icon fa fa-home bigger-120"></i>
								Active
								<span class="badge badge-success"><?php echo $rowsA; ?></span>
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#Disabled" aria-controls="Disabled" role="tab">
								<i class="red ace-icon fa fa-home bigger-120"></i>
								Disabled
								<span class="badge badge-danger"><?php echo $rowsD; ?></span>
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div id="Pending" class="tab-pane fade in active" role="tabpanel">
							<div class="row">
								<div class="col-xs-12">
									<?php include('common/messages/success_message.php'); ?>
									<table id="pending1" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Pharmacy name</th>
												<th>Pharmacy Type</th>
												<th>Address</th>
												<th>licence Number</th>
												<th>Registration Number</th>
												<th>Added Date</th>
												<th>Approval</th>
												<th></th>
												<th></th>
											</tr>
										</thead>

										<tbody>
											<?php
											$U_query = "select titleName,firstName,fatherName,grandFatherName,pharmacyId,pharmacyName,pharmacyType,pharmacy.registeredById,
													pharmacy.countryId,pharmacy.stateId,pharmacy.zoneId,pharmacy.woredaId,pharmacy.kebelle,latitude,longitude,licenceNumber,registrationNumber,addedDate,pharmacy.approval from 
													pharmacy join users ON pharmacy.registeredById=users.usersId
													join title ON users.titleId=title.titleId where pharmacy.isDeleted='0' AND pharmacy.approval='Pending' order by pharmacyId DESC";
											$U_stmt = $con->prepare($U_query);
											$U_success = $U_stmt->execute();
											$U_rows = $U_stmt->fetchAll();
											$id = 0;
											foreach ($U_rows as $row) {
												$titleName = $row['titleName'];
												$firstName = $row['firstName'];
												$fatherName = $row['fatherName'];
												$grandFatherName = $row['grandFatherName'];
												$pharmacyId = $row['pharmacyId'];
												$pharmacyName = $row['pharmacyName'];
												$pharmacyType = $row['pharmacyType'];
												$countryId = $row['countryId'];
												$stateId = $row['stateId'];
												$zoneId = $row['zoneId'];
												$woredaId = $row['woredaId'];
												$kebelle = $row['kebelle'];
												$registeredById = $row['registeredById'];
												$latitude = $row['latitude'];
												$longitude = $row['longitude'];
												$licenceNumber = $row['licenceNumber'];
												$registrationNumber = $row['registrationNumber'];
												$addedDate = $row['addedDate'];
												$approval = $row['approval'];
												$Full_name = $titleName . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
											?>
												<tr>
													<?php $id = $id + 1; ?>
													<td><?php echo $id; ?></td>
													<td><?php echo $pharmacyName; ?></td>
													<td><?php echo $pharmacyType; ?></td>
													<td>
														<?php
														$C_query = "select * from woreda where woredaId='$woredaId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$woredaName = $row['woredaName'];
															echo $woredaName . '<b>,</b> ';
														}
														$C_query = "select * from zone where zoneId='$zoneId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$zoneName = $row['zoneName'];
															echo $zoneName . '<b>,</b> ';
														}

														$C_query = "select * from state where stateId='$stateId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$stateName = $row['stateName'];
															echo $stateName . '<b>,</b> ';
														}
														$C_query = "select * from country where countryId='$countryId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$countryId = $row['countryId'];
															$countryName = $row['countryName'];
															echo $countryName;
														}
														?>
													</td>
													<td><?php echo $licenceNumber; ?></td>
													<td><?php echo $registrationNumber; ?></td>
													<td><?php echo $addedDate; ?></td>
													<td>
														<?php
														if ($approval == 'Active') {
															echo '<span class="label label-success arrowed">' . $approval . '</span>';
														} else if ($approval == 'Pending') {
															echo '<span class="label label-warning arrowed">' . $approval . '</span>';
														} else if ($approval == 'Disabled') {
															echo '<span class="label label-danger arrowed">' . $approval . '</span>';
														}
														?>
													</td>
													<td>
														<?php
														if ($canEdit == "1") {
														?>
															<a href='' data-toggle="modal" data-target="#approvePharmacy<?php echo $pharmacyId; ?>" class='red'><span class="label label-success arrowed"> Approve Pharmacy <i class="fa fa-question"></i></span> </a>

														<?php }
														include("configurations/pharmacy/views/modalapprovepharmacy.php");
														?>
													</td>
													<td>
														<?php
														if ($canEdit == "1") {
														?>

															<a href='?name=configurations/users/userdetail&var=users&usersId=<?php echo $registeredById; ?>' <?php echo $pharmacyId; ?> class='red'><span class="label label-success arrowed"><i class="ace-icon fa fa-angle-double-right"></i></span> </a>
														<?php } ?>
													</td>
												</tr>

											<?php } ?>
										</tbody>
									</table>

								</div>
							</div>
						</div>
						<div id="Active" class="tab-pane fade in" role="tabpanel">
							<div class="row">
								<div class="col-xs-12">
									<?php include('common/messages/success_message.php'); ?>
									<table id="active1" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Pharmacy name</th>
												<th>Pharmacy Type</th>
												<th>Address</th>
												<th>licence Number</th>
												<th>Registration Number</th>
												<th>Added Date</th>
												<th>approval</th>
												<th></th>
												<th></th>
											</tr>
										</thead>

										<tbody>
											<?php
											$U_query = "select titleName,firstName,fatherName,grandFatherName,pharmacyId,pharmacyName,pharmacyType,pharmacy.registeredById,
													pharmacy.countryId,pharmacy.stateId,pharmacy.zoneId,pharmacy.woredaId,pharmacy.kebelle,latitude,longitude,licenceNumber,registrationNumber,addedDate,pharmacy.approval from 
													pharmacy join users ON pharmacy.registeredById=users.usersId
													join title ON users.titleId=title.titleId where pharmacy.isDeleted='0' AND pharmacy.approval='Active' order by pharmacyId DESC";
											$U_stmt = $con->prepare($U_query);
											$U_success = $U_stmt->execute();
											$U_rows = $U_stmt->fetchAll();
											$id = 0;
											foreach ($U_rows as $row) {
												$titleName = $row['titleName'];
												$firstName = $row['firstName'];
												$fatherName = $row['fatherName'];
												$grandFatherName = $row['grandFatherName'];
												$pharmacyId = $row['pharmacyId'];
												$pharmacyName = $row['pharmacyName'];
												$pharmacyType = $row['pharmacyType'];
												$countryId = $row['countryId'];
												$registeredById = $row['registeredById'];
												$stateId = $row['stateId'];
												$zoneId = $row['zoneId'];
												$woredaId = $row['woredaId'];
												$kebelle = $row['kebelle'];
												$latitude = $row['latitude'];
												$longitude = $row['longitude'];
												$licenceNumber = $row['licenceNumber'];
												$registrationNumber = $row['registrationNumber'];
												$addedDate = $row['addedDate'];
												$approval = $row['approval'];
												$Full_name = $titleName . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
											?>
												<tr>
													<?php $id = $id + 1; ?>
													<td><?php echo $id; ?></td>
													<td><?php echo $pharmacyName; ?></td>
													<td><?php echo $pharmacyType; ?></td>
													<td>
														<?php
														$C_query = "select * from woreda where woredaId='$woredaId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$woredaName = $row['woredaName'];
															echo $woredaName . '<b>,</b> ';
														}
														$C_query = "select * from zone where zoneId='$zoneId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$zoneName = $row['zoneName'];
															echo $zoneName . '<b>,</b> ';
														}

														$C_query = "select * from state where stateId='$stateId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$stateName = $row['stateName'];
															echo $stateName . '<b>,</b> ';
														}
														$C_query = "select * from country where countryId='$countryId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$countryId = $row['countryId'];
															$countryName = $row['countryName'];
															echo $countryName;
														}
														?>
													</td>
													<td><?php echo $licenceNumber; ?></td>
													<td><?php echo $registrationNumber; ?></td>
													<td><?php echo $addedDate; ?></td>
													<td>
														<?php
														if ($approval == 'Active') {
															echo '<span class="label label-success arrowed">' . $approval . '</span>';
														} else if ($approval == 'Pending') {
															echo '<span class="label label-warning arrowed">' . $approval . '</span>';
														} else if ($approval == 'Disabled') {
															echo '<span class="label label-danger arrowed">' . $approval . '</span>';
														}
														?>
													</td>
													<td>
														<?php
														if ($canEdit == "1") {
														?>
															<a href='' data-toggle="modal" data-target="#approvePharmacy<?php echo $pharmacyId; ?>" class='red'><span class="label label-danger arrowed"> Deny Pharmacy <i class="fa fa-question"></i></span> </a>

														<?php }
														include("configurations/pharmacy/views/modalapprovepharmacy.php");
														?>
													</td>
													<td>
														<?php
														if ($canEdit == "1") {
														?>

															<a href='?name=configurations/users/userdetail&var=users&usersId=<?php echo $registeredById; ?>' <?php echo $pharmacyId; ?> class='red'><span class="label label-success arrowed"><i class="ace-icon fa fa-angle-double-right"></i></span> </a>
														<?php } ?>
													</td>
												</tr>

											<?php } ?>
										</tbody>
									</table>

								</div>
							</div>
						</div>
						<div id="Disabled" class="tab-pane fade in" role="tabpanel">
							<div class="row">
								<div class="col-xs-12">
									<?php include('common/messages/success_message.php'); ?>
									<table id="disabled1" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>S/N</th>
												<th>Pharmacy name</th>
												<th>Pharmacy Type</th>
												<th>Address</th>
												<th>licence Number</th>
												<th>Registration Number</th>
												<th>Added Date</th>
												<th>approval</th>
												<th></th>
												<th></th>
											</tr>
										</thead>

										<tbody>
											<?php
											$U_query = "select titleName,firstName,fatherName,grandFatherName,pharmacyId,pharmacyName,pharmacyType,pharmacy.registeredById,
													pharmacy.countryId,pharmacy.stateId,pharmacy.zoneId,pharmacy.woredaId,pharmacy.kebelle,latitude,longitude,licenceNumber,registrationNumber,addedDate,pharmacy.approval from 
													pharmacy join users ON pharmacy.registeredById=users.usersId
													join title ON users.titleId=title.titleId where pharmacy.isDeleted='0' AND pharmacy.approval='Disabled' order by pharmacyId DESC";
											$U_stmt = $con->prepare($U_query);
											$U_success = $U_stmt->execute();
											$U_rows = $U_stmt->fetchAll();
											$id = 0;
											foreach ($U_rows as $row) {
												$titleName = $row['titleName'];
												$firstName = $row['firstName'];
												$fatherName = $row['fatherName'];
												$grandFatherName = $row['grandFatherName'];
												$pharmacyId = $row['pharmacyId'];
												$pharmacyName = $row['pharmacyName'];
												$pharmacyType = $row['pharmacyType'];
												$countryId = $row['countryId'];
												$stateId = $row['stateId'];
												$zoneId = $row['zoneId'];
												$woredaId = $row['woredaId'];
												$kebelle = $row['kebelle'];
												$latitude = $row['latitude'];
												$longitude = $row['longitude'];
												$licenceNumber = $row['licenceNumber'];
												$registeredById = $row['registeredById'];
												$registrationNumber = $row['registrationNumber'];
												$addedDate = $row['addedDate'];
												$approval = $row['approval'];
												$Full_name = $titleName . ' ' . $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
											?>
												<tr>
													<?php $id = $id + 1; ?>
													<td><?php echo $id; ?></td>
													<td><?php echo $pharmacyName; ?></td>
													<td><?php echo $pharmacyType; ?></td>
													<td>
														<?php
														$C_query = "select * from woreda where woredaId='$woredaId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$woredaName = $row['woredaName'];
															echo $woredaName . '<b>,</b> ';
														}
														$C_query = "select * from zone where zoneId='$zoneId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$zoneName = $row['zoneName'];
															echo $zoneName . '<b>,</b> ';
														}

														$C_query = "select * from state where stateId='$stateId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$stateName = $row['stateName'];
															echo $stateName . '<b>,</b> ';
														}
														$C_query = "select * from country where countryId='$countryId'";
														$C_stmt = $con->prepare($C_query);
														$C_success = $C_stmt->execute();
														$C_rows = $C_stmt->fetchAll();
														foreach ($C_rows as $row) {
															$countryId = $row['countryId'];
															$countryName = $row['countryName'];
															echo $countryName;
														}
														?>
													</td>
													<td><?php echo $licenceNumber; ?></td>
													<td><?php echo $registrationNumber; ?></td>
													<td><?php echo $addedDate; ?></td>
													<td>
														<?php
														if ($approval == 'Active') {
															echo '<span class="label label-success arrowed">' . $approval . '</span>';
														} else if ($approval == 'Pending') {
															echo '<span class="label label-warning arrowed">' . $approval . '</span>';
														} else if ($approval == 'Disabled') {
															echo '<span class="label label-danger arrowed">' . $approval . '</span>';
														}
														?>
													</td>
													<td>
														<?php
														if ($canEdit == "1") {
														?>
															<a href='' data-toggle="modal" data-target="#approvePharmacy<?php echo $pharmacyId; ?>" class='red'><span class="label label-success arrowed"> Approve Pharmacy <i class="fa fa-question"></i></span> </a>
														<?php }
														include("configurations/pharmacy/views/modalapprovepharmacy.php");
														?>
													</td>
													<td>
														<?php
														if ($canEdit == "1") {
														?>

															<a href='?name=configurations/users/userdetail&var=users&usersId=<?php echo $registeredById; ?>' <?php echo $pharmacyId; ?> class='red'><span class="label label-success arrowed"><i class="ace-icon fa fa-angle-double-right"></i></span> </a>
														<?php } ?>
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
	if (isset($_POST['approvePharmacy'])) {
		$pharmacyId = $_POST['pharmacyId'];
		$Reason = $_POST['Reason'];
		$current_status = $_POST['current_status'];


		$e_query = "select registeredById from pharmacy where pharmacyId='$pharmacyId'";
		$U_stmt = $con->prepare($e_query);
		$U_success = $U_stmt->execute();
		$U_rows = $U_stmt->fetchAll();
		foreach ($U_rows as $row) {
			$usersId = $row['registeredById'];
		}

		$R_query = "update pharmacy set status = 'Active', approval='Active',approvedById='$usrUsersId' where pharmacyId='$pharmacyId'";
		$stmtUS = $con->prepare($R_query);
		$resultS = $stmtUS->execute();
		if ($resultS) {
			$Add_query = "insert into pharmacyapprovallog (pharmacyId,fromStatus,toStatus,changedBy,Reason) 
				  values('$pharmacyId','$current_status','Active','$usrUsersId','$Reason')";
			$stmtAddC = $con->prepare($Add_query);
			$resultH = $stmtAddC->execute();
			if ($resultH) {
				$Add_query = "insert into pharmacymanagement (usersId,pharmacyId,status) 
				  values('$usersId','$pharmacyId','Active')";
				$stmtAddC = $con->prepare($Add_query);
				$resultY = $stmtAddC->execute();
				if ($resultY) {
					$_SESSION['success'] = 'set';
					header("location: index.php?name=configurations/pharmacy/pharmacy&var=pharmacy");
				}
			}
		}
	}
	if (isset($_POST['denyPharmacy'])) {
		$pharmacyId = $_POST['pharmacyId'];
		$Reason = $_POST['Reason'];
		$current_status = $_POST['current_status'];
		$R_query = "update pharmacy set approval='Disabled',approvedById='$usrUsersId' where pharmacyId='$pharmacyId'";
		$stmtUS = $con->prepare($R_query);
		$resultS = $stmtUS->execute();
		if ($resultS) {
			$Add_query = "insert into pharmacyapprovallog (pharmacyId,fromStatus,toStatus,changedBy,Reason) 
					  values('$pharmacyId','$current_status','Disabled','$usrUsersId','$Reason')";
			$stmtAddC = $con->prepare($Add_query);
			$resultH = $stmtAddC->execute();
			if ($resultH) {
				$Add_query = "insert into pharmacymanagement (usersId,pharmacyId,status) 
					  values('$usrUsersId','$pharmacyId','Disabled')";
				$stmtAddC = $con->prepare($Add_query);
				$resultY = $stmtAddC->execute();
				if ($resultY) {
					$_SESSION['success'] = 'set';
					header("location: index.php?name=configurations/pharmacy/pharmacy&var=pharmacy");
				}
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
		$('#active1').DataTable({
			responsive: true
		});

		$('#pending1').DataTable({
			responsive: true
		});

		$('#disabled1').DataTable({
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