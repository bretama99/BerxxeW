<!-- Modal -->
<div id="importButton" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content" style="border-radius: 10px;">
	  <div class="modal-header" style="border-radius: 10px;">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Import Drugs from Exel
				</h5>
	<div id="signup-box" class="signup-box widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>
					<div class="form-group">
						<label class="control-label col-sm-3" >Browse file</label>
						<div class="col-sm-8">
								<input type="file"  name="file" accept=".xls,.xlsx" data-rel="tooltip" class="form-control" required/>
						</div>
					 </div>
						<div class="clearfix col-sm-9 col-sm-offset-2" style="margin-top: 10px;">
												<button style="border-radius: 10px;  height: 45px;" type="button" class="width-35 pull-left btn btn-sm btn-danger" data-dismiss="modal"><span class="bigger-130">Close</span></button>
							<button style="border-radius: 10px;  height: 45px;" type="submit" name="importDrug" class="width-35 pull-right btn btn-sm btn-success">
								<span class="bigger-130">Save</span>
								<i class="ace-icon fa fa-save icon-on-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.signup-box -->
		
		
	  </div>
<!-- 	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div> -->
	</div>

  </div>
</div>


