<?php include('configurations/addresses/views/displayaddressesforprofile.php'); ?>
<div id="editAddress" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Edit Address
				</h5>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
									<div class="form-group">
										<label class="control-label col-sm-4">Country</label>
										<div class="col-sm-7">
											<select name="countryId" class="form-control" data-rel="tooltip" title="Select country...." id="countrym" onchange="display_states_pro(this.options[this.selectedIndex].value,'statem');">
												<option value=""> ... Select Country...</option>
												<?php
												$C_query = "select * from country where isDeleted=0 order by countryName";
												$C_stmt = $con->prepare($C_query);
												$C_success = $C_stmt->execute();
												$C_rows = $C_stmt->fetchAll();
												$id = 0;
												foreach ($C_rows as $row) {
													$countryId = $row['countryId'];
													$countryName = $row['countryName'];
													$id = $id + 1;
												?>
													<option value="<?php echo $countryId; ?>"> <?php echo $countryName; ?></option>
												<?php } ?>
											</select>

										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">State</label>
										<div class="col-sm-7">
											<select name="stateId" class="select form-control" data-rel="tooltip" title="Select state...." id="statem" onchange="display_zones_pro(this.options[this.selectedIndex].value,'zonem');">
												<option value=""> ... Select State...</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">Zone</label>
										<div class="col-sm-7">
											<select name="zoneId" class="form-control" data-rel="tooltip" title="Select zone...." id="zonem" onchange="display_woredas_pro(this.options[this.selectedIndex].value,'woredam');">
												<option value=""> ... Select Zone...</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">Woreda</label>
										<div class="col-sm-7">
											<select id="woredam" name="woredaId" class="form-control" data-rel="tooltip" title="Select woreda....">
												<option value=""> ... Select woreda...</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">Kebelle</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<input type="text" id="kebelle" name="kebelle" placeholder="Kebelle Name" data-rel="tooltip" class="form-control" required />
											</span>
										</div>
									</div>
									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="editAddress" class="width-30 pull-right btn btn-sm btn-success">
											<span class="bigger-110">Save</span>
											<i class="ace-icon fa fa-save icon-on-right"></i>
										</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>