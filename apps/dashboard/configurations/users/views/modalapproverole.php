<div id="approveRole<?php echo $roleRequestId;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>		  
			<h5>
			<center>
			<br><br><i class="ace-icon fa fa-check green"></i>
			<?php 
		if($status=="Approved"){
				?>
			Deny <?php echo $rolesName;?> role for <?php echo $Full_name;?>

			<?php } 


		if($status=="Denied"){
				?>
			Approve <?php echo $rolesName;?> role for <?php echo $Full_name;?>

			<?php }
					if($status=="Pending"){
				?>
			Approve or Deny <?php echo $rolesName;?> role for <?php echo $Full_name;?>

			<?php }
			?>

			</center>
			</h5>

			<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
			<fieldset>
			<input type="hidden" name="usersId" value="<?php echo $usersId;?>" >
			<input type="hidden" name="roleRequestId" value="<?php echo $roleRequestId;?>" >
			<input type="hidden" name="current_status" value="<?php echo $status;?>" >
			<input type="hidden" name="rolesId" value="<?php echo $rolesId;?>" >
			<h5><center>Write some reason</center></h5>
			<h5><center>
				<textarea name="Reason" rows="4" cols="70" required></textarea>
			</center></h5>

				<div class="clearfix col-sm-9 col-sm-offset-2">
	<?php 
		if($status=="Approved"){
				?>
					<button type="submit" name="denyRole" class="width-10 pull-right btn btn-sm btn-danger">
						<span class="bigger-110">Deny</span>
					</button>
			<?php } 


		if($status=="Denied"){
				?>
						<button type="submit" name="approveRole" class="width-10 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Approve</span>
					</button>&nbsp; &nbsp;

			<?php }
					if($status=="Pending"){
				?>
					<button type="submit" name="approveRole" class="width-10 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Approve</span>
					</button>&nbsp; &nbsp;
					<button type="submit" name="denyRole" class="width-10 pull-left btn btn-sm btn-danger">
						<span class="bigger-110">Deny</span>
					</button>
			<?php }
			?>

				</div>
			</fieldset>
			</form>
	  </div>
	</div>
  </div>
</div>