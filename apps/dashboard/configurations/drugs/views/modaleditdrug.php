<!-- Modal -->
<div id="editDrug<?php echo $drugsId;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content" style="border-radius: 10px;">
	  <div class="modal-header" style="border-radius: 10px;">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Edit Drug <?php echo $drugsId;?>
				</h5>
	<div id="signup-box" class="signup-box widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>

					<div class="form-group" style="margin-left:-10px; margin-bottom: 50px;">
						<input type="hidden" name="drugsId" value="<?php echo $drugsId;?>">
						<label class="control-label col-sm-3" >Generic Name <?php echo $drugsId;?></label>
						<div class="col-sm-9">
								<input type="text" value="<?php echo $drugsName;?>"  name="drugsName" placeholder="Generic Name" data-rel="tooltip" class="form-control" required/>
						</div>

					 </div>

					 <div class="form-group" style="margin-left:-20px;">
						<label class="control-label col-sm-3" >Dosage form</label>
						<div class="col-sm-4" style="margin-left:-30px;">
								<input type="text" value="<?php echo $dosageForm;?>"  name="dosageForm" placeholder="Dosage form" data-rel="tooltip" class="form-control" required/>
						</div>
												     <label  class="control-label col-sm-3" >Sub Category</label>
	                      	                    <div class="col-sm-3" style="margin-left:-30px;">
	                      <input type="text" value="<?php echo $subCategory;?>" name="subCategory" placeholder="Sub Category" data-rel="tooltip" class="form-control" required/>
	                    </div>

					 </div>

					 	                 

					<div class="form-group" style="margin-left:-20px; margin-top: 100px;">
						<label class="control-label col-sm-3" >Strength</label>
						<div class="col-sm-4" style="margin-left:-30px;">
								<input type="text"  name="strength" value="<?php echo $strength;?>" placeholder="Strength" data-rel="tooltip" class="form-control" required/>
						</div>
						<label class="control-label col-sm-3" >Volume</label>
						<div class="col-sm-3" style="margin-left:-30px;">
								<input type="text" value="<?php echo $volume;?>" name="volume" placeholder="Volume" data-rel="tooltip" class="form-control" required/>
						</div>

					 </div>

					 <div class="form-group" style="margin-left:-20px;  margin-top: 150px;">
						<label class="control-label col-sm-3" >Brand Name</label>
						<div class="col-sm-4" style="margin-left:-30px;">
								<input type="text" value="<?php echo $brandName;?>" name="brandName" placeholder="Brand Name" data-rel="tooltip" class="form-control" required/>
						</div>
					<label  class="control-label col-sm-3" >Unit</label>
						<div class="col-sm-3" style="margin-left:-30px;">
								<input type="text" value="<?php echo $unit;?>" name="unit" placeholder="Unit" data-rel="tooltip" class="form-control" required/>
						</div>
					 </div>

	                    <div class="form-group" style="margin-left:-20px; margin-top: 200px;">
	                      <label class="control-label col-sm-3" >Category</label>

	                      	<div class="col-sm-9">
	                      <select name="category" class="form-control" data-placeholder="Choose a Category..." required>
	                        <option value="<?php echo $category;?>">
	                        	<?php if ($category!='') { ?>
    <div><?php echo $category;?></div>
<?php } else { ?>
    <div>Choose Category</div>
<?php } ?></option>
	                        <option value="BLOOD PRODUCTS AND MEDICINES AFFECTING THE BLOOD">BLOOD PRODUCTS</option>
	                        <option value="DISORDERS AND CONTRACCEPTIVES">DISORDERS AND CONTRACCEPTIVES</option>
	                        <option value="MEDICINES USED IN MUSCULO SKELETAL AND JOINT DISEASES">MEDICINES USED IN MUSCULO SKELETAL</option>
	                        <option value="RESPIRATORY MEDICINES">RESPIRATORY MEDICINES</option>	                        
	                        <option value="CENTRAL NERVOUS SYSTEM MEDICINES">CENTRAL NERVOUS SYSTEM MEDICINES</option>
	                        <option value="OPHTHALMIC AGENTS">OPHTHALMIC AGENTS</option>	                        
	                        <option value="EAR, NOSE AND THROAT PREPARATIONS">EAR, NOSE AND THROAT PREPARATIONS</option>
	                        <option value="ANTIDOTES AND OTHER SUBSTANCES">ANTIDOTES AND OTHER SUBSTANCES</option>

	                        <option value="DERMATOLOGICAL AGENTS">DERMATOLOGICAL AGENTS</option>	                        
	                        <option value="ANTI CANCER MEDICINES AND ADJUVANTS">ANTI CANCER MEDICINES AND ADJUVANTS</option>
	                        <option value="GASTROINTESTINAL MEDICINES">GASTROINTESTINAL MEDICINES</option>	                        
	                        <option value="CARDIOVASCULAR MEDICINES">CARDIOVASCULAR MEDICINES</option>
	                        <option value="LIST OF REGULAR MEDICAL SUPPLIES">LIST OF REGULAR MEDICAL SUPPLIES</option>

	                      </select>
	                    </div>
	                  </div>
	                 


						<div style="margin-top:25px;" class="clearfix col-sm-9 col-sm-offset-2">
<button style="border-radius: 10px;  height: 45px;" type="button" class="width-35 pull-left btn btn-sm btn-danger" data-dismiss="modal"><span class="bigger-130">Close</span></button>
							<button style="border-radius: 10px; height: 45px;" type="submit" name="editDrug" class="width-35 pull-right btn btn-sm btn-success">
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
	<!--   <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div> -->
	</div>

  </div>
</div>


<!-- Modal -->
<div id="deleteDrug<?php echo $drugsId;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			  
				    <h4>
					<center>
					<br><br><i class="ace-icon fa fa-trash red"></i>
					are you sure ?
					</center>
					</h4>
					<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>
					<input type="hidden" name="drugsId" value="<?php echo $drugsId;?>" >
						<div class="clearfix col-sm-9 col-sm-offset-2">
							<button type="submit" name="deleteDrug" class="width-10 pull-right btn btn-sm btn-danger">
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




<!-- Modal -->
<div id="druFormulary<?php echo $drugsId;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content" style="border-radius: 10px;">
	  <div class="modal-header" style="border-radius: 10px;">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Add Formulary
				</h5>
	<div id="signup-box" class="signup-box widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>

					<div class="form-group" style="margin-left:-130px;">
												<input type="hidden" name="drugsId" value="<?php echo $drugsId;?>">
						<label class="control-label col-sm-4" >Indications</label>
						<div class="col-sm-8">
								<input type="text"  name="indications" placeholder="Indications" data-rel="tooltip" class="form-control" required/>
						</div>

					 </div>

					 <div class="form-group" style="margin-left:-130px;">
						<label class="control-label col-sm-4" >Cautions</label>
						<div class="col-sm-3">
								<input type="text"  name="cautions" placeholder="Cautions" data-rel="tooltip" class="form-control" required/>
						</div>
												     <label style="margin-left:-60px;" class="control-label col-sm-3" >Contraindications</label>
	                      	                    <div class="col-sm-3">

	                      <input type="text"  name="contraindications" placeholder="Contraindications" data-rel="tooltip" class="form-control" required/>
	                    </div>

					 </div>

					 	                 

					<div class="form-group" style="margin-left:-130px;">
						<label class="control-label col-sm-4" >Interactions</label>
						<div class="col-sm-3">
								<input type="text"  name="interactions" placeholder="Interactions" data-rel="tooltip" class="form-control" required/>
						</div>
						<label style="margin-left:-60px;" class="control-label col-sm-3" >Side Effects</label>
						<div class="col-sm-3">
								<input type="text"  name="sideEffects" placeholder="Side Effects" data-rel="tooltip" class="form-control" required/>
						</div>

					 </div>

					 <div class="form-group" style="margin-left:-130px;">
						<label class="control-label col-sm-4" >Dose and Administration</label>
						<div class="col-sm-3">
								<input type="text"  name="doseAndAdministration" placeholder="Dose and Administration" data-rel="tooltip" class="form-control" required/>
						</div>
												<label style="margin-left:-60px;" class="control-label col-sm-3" >Storage</label>
						<div class="col-sm-3">
								<input type="text"  name="Storage" placeholder="storage" data-rel="tooltip" class="form-control" required/>
						</div>
					 </div>

						<div style="margin-top:25px;" class="clearfix col-sm-9 col-sm-offset-2">
<button style="border-radius: 10px;  height: 45px;" type="button" class="width-35 pull-left btn btn-sm btn-danger" data-dismiss="modal"><span class="bigger-130">Close</span></button>
							<button style="border-radius: 10px; height: 45px;" type="submit" name="addDrug" class="width-35 pull-right btn btn-sm btn-success">
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
	<!--   <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div> -->
	</div>

  </div>
</div>






