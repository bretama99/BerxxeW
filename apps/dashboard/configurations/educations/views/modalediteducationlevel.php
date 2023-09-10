<div id="editEducationLevel<?php echo $educationalLevelId?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content" style="border-radius: 10px;">
	  <div class="modal-header" style="border-radius: 10px;">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-pencil green"></i>
					Edit Education Level
				</h5>
	<div id="signup-box" class="signup-box widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>
					<input type="hidden" name="educationalLevelId" value="<?php echo $educationalLevelId;?>" >
					<div class="form-group">
						<label class="control-label col-sm-4" >Education Level Name</label>
						<div class="col-sm-7">
						  <span class="block input-icon input-icon-right">
								<input type="text"  name="educationLevelName" value="<?php echo $educationLevelName;?>" placeholder="Education Level Name" data-rel="tooltip" class="form-control" required/>
								
							</span>
						</div>
					 </div>
					 <br><br><br>
						<div class="clearfix col-sm-9 col-sm-offset-2">
									<button style="border-radius: 10px; height: 45px;" type="button" class="width-35 pull-left btn btn-sm btn-danger" data-dismiss="modal"><span class="bigger-130">Close</span></button>

							<button style="border-radius: 10px; height: 45px;" type="submit" name="editeducationLevel" class="width-35 pull-right btn btn-sm btn-success">
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
	  <!-- div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div> -->
	</div>
  </div>
</div>

<div id="deleteEducationLevel<?php echo $educationalLevelId?>" class="modal fade" role="dialog">
  <div class="modal-dialog" style="height:10%; width:35%;">
<h1><?php 
$eduPharmacy = "select * from pharmacistinfo where educationalLevelId='$educationalLevelId' AND isDeleted=0";
$eduPhysician = "select * from physicianinfo where educationalLevelId='$educationalLevelId' AND isDeleted=0";

	$stmtPharmacy = $con->prepare($eduPharmacy);
	$stmtPharmacy->execute();
	$rowsPharmacy = $stmtPharmacy->fetchColumn(); 

	$stmtPhysician = $con->prepare($eduPhysician);
	$stmtPhysician->execute();
	$rowshysician = $stmtPhysician->fetchColumn(); 
?></h1>
	<!-- Modal content-->
	<div class="modal-content" style="border-radius: 10px;">
	  <div class="modal-header" style="border-radius: 10px;">
		<button type="button" class="close" style="margin-top:-15px; color: black;" data-dismiss="modal">&times;</button>
			  
				    <h4>
<?php 	if($rowsPharmacy ==0 && $rowshysician==0) {
					echo '<br><h4 style="margin-left:20px;"><i class="ace-icon fa fa-trash red"></i>
					Are You Sure to Delete the Education level ?</h4>';}
					?>
					</h4>

					<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>
					<input type="hidden" name="educationalLevelId" value="<?php echo $educationalLevelId;?>" >
						<div class="clearfix col-sm-offset-1">
							<?php 	if($rowsPharmacy >0 || $rowshysician>0) {
					
echo '<h4 style="color:red;">Education Level Already Used! You cannot Delete!</h4>';
}
							else{
			echo '<button style="border-radius: 6px;" type="submit" name="deleteEducationLevel" class="width-20 pull-right btn btn-sm btn-danger">
								<span class="bigger-110">Yes</span>
								<i class="ace-icon fa fa-trash icon-on-right"></i>
							</button>';
							}?>
							
						</div>
					</fieldset>
				    </form>
	  </div>
	</div>
  </div>
</div>