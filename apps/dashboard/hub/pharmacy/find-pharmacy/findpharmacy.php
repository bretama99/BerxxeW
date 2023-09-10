<head>
	<title>
		<?php echo $lang['pharmacies']; ?>
	</title>
	<meta name="description" content="Static &amp; Dynamic Tables" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<?php
	include("hub/pharmacy/find-pharmacy/models/nearestPharmacy.php");
	$search = '';
	if (isset($_POST['filterSearch'])) {
		$search = $_POST['filterSearch'];
	}
	ltrim($search);

	if (isset($_SESSION['latitude']) && isset($_SESSION['longitude']) && $search == '') {
		$rows_pharmacy = getNearestPharmacies($_SESSION['latitude'], $_SESSION['longitude']);
	} else if (isset($_SESSION['latitude']) && isset($_SESSION['longitude']) && $search != '') {
		$rows_pharmacy = searchPharmacies($_SESSION['latitude'], $_SESSION['longitude'], $search);
	} else {
		if ($search != '')
			$pharmacy = "select pharmacy.*,woreda.woredaName,zone.zoneName, state.stateName,country.countryName from pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  INNER JOIN country on country.countryId=pharmacy.countryId where pharmacy.isDeleted=0 and (pharmacy.pharmacyType like '$search%'  or pharmacy.pharmacyName like '$search%'  or pharmacy.kebelle like '$search%'  or pharmacy.streetNumber like '$search%'  or pharmacy.pharmacyType like '$search%'  or pharmacy.email like '$search%'  or pharmacy.phoneNumber like '$search%'  or pharmacy.licenceNumber like '$search%'  or pharmacy.registrationNumber like '$search%'  or country.countryName like '$search%'  or state.stateName like '$search%'  or zone.ZoneName like '$search%'  or woreda.woredaName like '$search%' ) limit 50";
		else
			$pharmacy = "select pharmacy.*,woreda.woredaName,zone.zoneName, state.stateName,country.countryName from pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  INNER JOIN country on country.countryId=pharmacy.countryId where pharmacy.isDeleted=0 limit 50";

		$pharmacy_stmt = $con->prepare($pharmacy);
		$pharmacy_success = $pharmacy_stmt->execute();
		$rows_pharmacy = $pharmacy_stmt->fetchAll();
	}
	if ($search == '')
		$search = $lang['allPharmacies'];
	?>
	<script type="text/javascript">
		if ('ontouchstart' in document.documentElement) document.write("<script src='../../js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
	</script>
	<!-- page specific plugin scripts -->
	<script src="../../js/jquery.dataTables.min.js"></script>
	<script src="../../js/jquery.dataTables.bootstrap.min.js"></script>

	<link rel="stylesheet" href="../../font-awesome/4.5.0/css/font-awesome.min.css" />


	<script type="text/javascript">
		jQuery(function($) {
			//initiate dataTables plugin
			var myTable = $('#dynamic-table')
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
		<?php require_once('hub/ui/search/searchbox.php'); ?>


		<h1>
			<small>
				<?php echo $lang['pharmacyLists'] . " (" . $lang["searchKey"] . ": " . $search . ")" ?>
			</small>
		</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<table id="simple-table" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">
									<label class="pos-rel">
										<?php echo $lang['sn']; ?>
										<span class="lbl"></span>
									</label>
								</th>
								<th colspan='3'>
									<?php echo $lang['pharmacyDetails']; ?>
								</th>
								<th colspan='3'>
									<?php echo $lang['locations']; ?>
								</th>
								<th colspan=3><?php echo $lang['addresses']; ?></th>
								<?php if (isset($_SESSION['latitude']) && isset($_SESSION['longitude'])) { ?> <th><?php echo $lang['distance']; ?></th><?php } ?>
								<th><?php echo $lang['closesAt']; ?></th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;
							foreach ($rows_pharmacy as $row) {
								$i++ ?>
								<tr>
									<td class="center">
										<label class="pos-rel">
											<?php echo $i; ?>
											<span class="lbl"></span>
										</label>
									</td>
									<td colspan='3' style="font-size: 12px;">
										<?php echo $row['pharmacyName'] . ', ' . $row['pharmacyType']; ?>
									</td>
									<td colspan='3' style="font-size: 11px;">
										<?php echo $row['streetNumber'] . ', ' . $row['kebelle'] . ', ' . $row['woredaName'] . ', ' . $row['stateName']; ?>
									</td>
									<td colspan='3' style="font-size: 11px;"><b><?php echo $lang['email']; ?>:&nbsp;&nbsp;</b>
										<?php echo $row['email']; ?> &nbsp;&nbsp;&nbsp; <b><?php echo $lang["phone"]; ?>:&nbsp;&nbsp;</b>
										<?php echo $row['phoneNumber']; ?>
									</td>
									<?php if (isset($_SESSION['latitude']) && isset($_SESSION['longitude'])) { ?>
										<td colspan='1' style="font-size: 9px;"><b><?php echo round($row['distance'], 1) . " " . $lang['km'] ?>&nbsp;&nbsp;</b>
										</td>
									<?php } ?>
									<td style="font-size: 9px;">
										<?php
										$newDateTime = date('h:i A', strtotime($row['closingAt']));
										echo $newDateTime
										?>
									</td>
									<td style="width:2%;">
										<div class="hidden-sm hidden-xs  btn-group">
											<button class="btn btn-xs show-details-btn btn-success" title="View Pharmacy Details ..">
												<i class="ace-icon fa fa-angle-double-down"></i>
											</button>
										</div>
									</td>
								</tr>

								<tr class="detail-row">
									<td colspan="11">
										<div class="table-detail">
											<div class="row">
												<div class="col-xs-12 col-sm-2">
													<div class="text-center">
														<img height="150" class="thumbnail inline no-margin-bottom" alt="" src="../../images/pharmacy.png" />
														<br />
														<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
															<div class="inline position-relative">
																<a class="user-title-label" href="#">
																	<i class="ace-icon fa fa-circle light-green"></i>
																	&nbsp;
																	<span class="white">
																		<?php echo $row['pharmacyName']; ?>
																	</span>
																</a>
															</div>
														</div>
													</div>
												</div>

												<div class="col-xs-12 col-sm-10">
													<div class="space visible-xs"></div>

													<div class="profile-user-info profile-user-info-striped">

														<div class="profile-info-row">
															<div class="profile-info-name" style="width:18%;"> Pharmacy Name
															</div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['pharmacyName']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> <?php echo $lang['category']; ?> </div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['pharmacyType']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name">
																<?php echo $lang['kebelle']; ?>
															</div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['kebelle']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name">
																<?php echo $lang['woreda']; ?>
															</div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['woredaName']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name">
																<?php echo $lang['zone/subcity']; ?>
															</div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['zoneName']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name">
																<?php echo $lang['state']; ?>
															</div>

															<div class="profile-info-value">
																<span>
																	<?php echo $row['stateName']; ?>
																</span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name">
																<?php echo $lang['address']; ?>
															</div>

															<div class="profile-info-value">
																<span><b>
																		<?php echo $lang['email']; ?>:
																	</b>
																	<?php echo $row['email']; ?>
																	&nbsp;&nbsp;&nbsp;<b>
																		<?php echo $lang['phone']; ?>:
																	</b>
																	<?php echo $row['phoneNumber']; ?>
																</span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name">
																<?php echo $lang['location']; ?>
															</div>

															<div class="profile-info-value">
																<i class="fa fa-map-marker light-orange bigger-110"></i>
																<span><b>
																		<?php echo $lang['latitude']; ?>:
																	</b> &nbsp;&nbsp;
																	<?php echo $row['latitude']; ?>
																	&nbsp;&nbsp;&nbsp;&nbsp;<b>
																		<?php echo $lang['longitude']; ?>:
																	</b>
																	<?php echo $row['longitude']; ?>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								</tr>

							<?php $arrayMapDiv[] = 'map' . $row['pharmacyId'];
								$arrayLng[] = $row['longitude'];
								$arrayLat[] = $row['latitude'];

								$arrayPharmacyName[] = $row['pharmacyName'];
								$arrayPharmacyType[] = $row['pharmacyType'];
							} ?>
							<tr>
								<td colspan='12'>
									<div id="mapPharmacy" style="width:100%;height:400px;"></div>
								</td>
							</tr>

						</tbody>
					</table>
				</div><!-- /.span -->
			</div><!-- /.row -->
			<script>
				var arrayLat = <?php echo json_encode($arrayLat); ?>;
				var arrayLng = <?php echo json_encode($arrayLng); ?>;

				var arrayPharmacyName = <?php echo json_encode($arrayPharmacyName); ?>;
				var arrayPharmacyType = <?php echo json_encode($arrayPharmacyType); ?>;

				function myMap() {
					var mapProp = {
						center: new google.maps.LatLng(arrayLat[0], arrayLng[0]),
						zoom: 8,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						//disableDefaultUI: true
					};
					var map = new google.maps.Map(document.getElementById("mapPharmacy"), mapProp);

					for (var i = 0; i < arrayPharmacyName.length; i++) {

						new google.maps.Marker({
							position: new google.maps.LatLng(arrayLat[i], arrayLng[i]),
							map: map,
							title: arrayPharmacyName[i] + ', ' + arrayPharmacyType[i],
						});

					}

				}
			</script>

			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIA2P9qeYtaXVPJHlGU5CF-mJNE8hpCV0&callback=myMap"></script>

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->