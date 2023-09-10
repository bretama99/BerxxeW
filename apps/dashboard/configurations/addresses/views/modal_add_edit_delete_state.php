
<div id="add_country" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 10px;">
			<div class="modal-header" style="border-radius: 10px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					<!-- Add New State -->
				</h5>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<div class="form-group">
										<label class="control-label col-sm-4">State</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<input type="text" name="countryName" placeholder="Country Name" data-rel="tooltip" class="form-control" required />
											</span>
										</div>
									</div>
									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="addCountry" class="width-30 pull-right btn btn-sm btn-success">
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
			<!-- 	<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div> -->
		</div>

	</div>
</div>

<div id="editState<?php echo $stateId; ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Edit State
				</h5>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<div class="form-group">
										<label class="control-label col-sm-4">State</label>
										<div class="col-sm-7">
											<span class="block input-icon input-icon-right">
												<input type="text" name="stateName" value="<?php echo $stateName; ?>" placeholder="State Name" data-rel="tooltip" class="form-control" required />
											</span>
										</div>
									</div>
									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="editState" class="width-30 pull-right btn btn-sm btn-success">
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
			<!-- 		<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div> -->
		</div>

	</div>
</div>

<div id="deleteState<?php echo $stateId?>" class="modal fade" role="dialog">
  <div class="modal-dialog" style="height:10%; width:35%;">

	<!-- Modal content-->
	<div class="modal-content" style="border-radius: 10px;">
	  <div class="modal-header" style="border-radius: 10px;">
		<button type="button" class="close" style="margin-top:-15px; color: black;" data-dismiss="modal">&times;</button>
			  
				    <h4><br><h4 style="margin-left:20px;"><i class="ace-icon fa fa-trash red"></i>
					Are You Sure to Delete the Country ?</h4>
					</h4>
					<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>
					<input type="hidden" name="countryId" value="<?php echo $countryId;?>" >
						<div class="clearfix col-sm-offset-1">
					<button style="border-radius: 6px;" type="submit" name="deleteCountry" class="width-20 pull-right btn btn-sm btn-danger">
								<span class="bigger-110">Yes</span>
								<i class="ace-icon fa fa-trash icon-on-right"></i>
							</button>
							
						</div>
					</fieldset>
				    </form>
	  </div>
	</div>
  </div>
</div>