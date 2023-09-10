<div id="add_country" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 10px;">
			<div class="modal-header" style="border-radius: 10px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Add New Country
				</h5>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<div class="form-group">
										<label class="control-label col-sm-4">Country</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<input type="text" name="countryName" placeholder="Country Name" data-rel="tooltip" class="form-control" required />

											</span>
										</div>
									</div>

									<br>
									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button style="margin-left:60px;border-radius: 10px; height: 40px;" type="button" class="width-30 pull-left btn btn-sm btn-danger" data-dismiss="modal"><span class="bigger-130">Close</span></button>

										<button style="border-radius: 10px; height: 40px;" type="submit" name="addCountry" class="width-30 pull-right btn btn-sm btn-success">
											<span class="bigger-130">Save</span>
											<i class="ace-icon fa fa-save icon-on-right"></i>
										</button>
									</div>
									<!-- 	<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="addCountry" class="width-30 pull-right btn btn-sm btn-success">
											<span class="bigger-110">Save</span>
											<i class="ace-icon fa fa-save icon-on-right"></i>
										</button>
									</div> -->
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- 	<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div> -->
		</div>
	</div>
</div>

<div id="add_state" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Add New State
				</h5>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<div class="form-group">
										<label class="control-label col-sm-4">Country</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<select name="countryId" class="form-control" data-rel="tooltip" title="Select country...." id="countryId">
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
												<i class="ace-icon fa fa-map-marker"></i>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">State</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<input type="text" name="stateName" placeholder="State Name" data-rel="tooltip" class="form-control" required />
											</span>
										</div>
									</div>


									<br>
									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button style="margin-left:60px;border-radius: 10px; height: 40px;" type="button" class="width-30 pull-left btn btn-sm btn-danger" data-dismiss="modal"><span class="bigger-130">Close</span></button>

										<button style="border-radius: 10px; height: 40px;" type="submit" name="addState" class="width-30 pull-right btn btn-sm btn-success">
											<span class="bigger-130">Save</span>
											<i class="ace-icon fa fa-save icon-on-right"></i>
										</button>
									</div>

									<!-- 	<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="addState" class="width-30 pull-right btn btn-sm btn-success">
											<span class="bigger-110">Save</span>
											<i class="ace-icon fa fa-save icon-on-right"></i>
										</button>
									</div> -->
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- 		<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div> -->
		</div>

	</div>
</div>

<div id="add_zone" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Add New Zone
				</h5>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<div class="form-group">
										<label class="control-label col-sm-4">Country</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<select name="country" class="form-control" data-rel="tooltip" title="Select country...." id="country" onchange="display_statesm(this.options[this.selectedIndex].value,'statem');">
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
												<i class="ace-icon fa fa-map-marker"></i>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">State</label>
										<div class="col-sm-7">
											<select name="stateId" class="form-control" data-rel="tooltip" title="Select state...." id="statem">
												<option value=""> ... Select State ...</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">Zone</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<input type="text" name="zoneName" placeholder="Zone Name" data-rel="tooltip" class="form-control" required />
											</span>
										</div>
									</div>
									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="addZone" class="width-30 pull-right btn btn-sm btn-success">
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
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="add_woreda" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Add New Woreda
				</h5>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<div class="form-group">
										<label class="control-label col-sm-4">Country</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<select name="country" class="form-control" data-rel="tooltip" title="Select country...." id="country2" onchange="display_statesm2(this.options[this.selectedIndex].value,'statem2');">
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
												<i class="ace-icon fa fa-map-marker"></i>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">State</label>
										<div class="col-sm-7">
											<select name="stateId" class="form-control" data-rel="tooltip" title="Select state...." id="statem2" onchange="display_zonesm(this.options[this.selectedIndex].value,'zonem');">
												<option value=""> ... Select State ...</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">Zone</label>
										<div class="col-sm-7">
											<select name="zoneId" class="form-control" data-rel="tooltip" title="Select Zone...." id="zonem">
												<option value=""> ... Select Zone ...</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-4">Woreda</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<input type="text" name="woredaName" placeholder="Woreda Name" data-rel="tooltip" class="form-control" required />
											</span>
										</div>
									</div>
									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="addWoreda" class="width-30 pull-right btn btn-sm btn-success">
											<span class="bigger-110">Save</span>
											<i class="ace-icon fa fa-save icon-on-right"></i>
										</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div><!-- /.widget-body -->
				</div><!-- /.signup-box -->


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>