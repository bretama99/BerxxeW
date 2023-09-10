<div id="approvePharmacy<?php echo $pharmacyId;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>		  
			<h5>
			<center>
			<br><br><i class="ace-icon fa fa-check green"></i>
			Approve or Deny <?php echo $pharmacyName;?>
			</center>
			</h5>
			<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
			<fieldset>
			<input type="hidden" name="pharmacyId" value="<?php echo $pharmacyId;?>" >
			<input type="hidden" name="current_status" value="<?php echo $approval;?>" >
			<h5><center>Write some reason<textarea name="Reason" rows="4" cols="70" required></textarea></center></h5>
				<div class="clearfix col-sm-9 col-sm-offset-2">
					<button type="submit" name="approvePharmacy" class="width-10 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Approve</span>
					</button>&nbsp; &nbsp;
					<button type="submit" name="denyPharmacy" class="width-10 pull-left btn btn-sm btn-danger">
						<span class="bigger-110">Deny</span>
					</button>
				</div>
			</fieldset>
			</form>
	  </div>
	</div>
  </div>
</div>