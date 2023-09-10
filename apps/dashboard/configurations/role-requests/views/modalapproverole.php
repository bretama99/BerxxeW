<div id="approveRole<?php echo $roleRequestId;?>" class="modal fade" role="dialog" >
  <div class="modal-dialog" style="height:60%; width:35%;">
	<!-- Modal content-->
	<div class="modal-content" style="border-radius: 10px;">
	  <div class="modal-header" style="border-radius: 10px;">
		<button type="button" class="close" style="margin-top:-15px; color: black;" data-dismiss="modal">&times;</button>		  
			<h5>
			<center>
			<i class="ace-icon fa fa-check green"></i>
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
			<h4 style="margin-left:5px; margin-top: -2;"><b>Reason</b></h4>
			<h5><center>
				<textarea style="margin-top:-7px; width:100%;" name="Reason" rows="3" cols="65" required></textarea>
			</center></h5>
<br>
				<div class="clearfix col-sm-9 col-sm-offset-2" style="margin-bottom:10px;">
	<?php 
		if($status=="Approved"){
				?>
					<button type="submit" style="border-radius: 10px; height: 45px;" name="denyRole" class="width-35 pull-right btn btn-sm btn-danger mt-10">
						<span class="bigger-110">Deny</span>
					</button>
			<?php } 


		if($status=="Denied"){
				?>
						<button style="border-radius: 10px; height: 45px;" type="submit" name="approveRole" class="width-35 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Approve</span>
					</button>&nbsp; &nbsp;

			<?php }
					if($status=="Pending"){
				?>
					<button style="border-radius: 10px; height: 45px;" type="submit" name="approveRole" class="width-35 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Approve</span>
					</button>&nbsp; &nbsp;
					<button style="border-radius: 10px; height: 45px;" type="submit" name="denyRole" class="width-35 pull-left btn btn-sm btn-danger">
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