<!-- Modal -->
<div id="addDrug" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content" style="border-radius: 10px;">
	  <div class="modal-header" style="border-radius: 10px;">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			   <h5 class="header green lighter bigger">
					<i class="ace-icon fa fa-plus green"></i>
					Add New Drug
				</h5>
	<div id="signup-box" class="signup-box widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>

					<div class="form-group" style="margin-left:-130px;">
						<label class="control-label col-sm-4" >Generic Name</label>
						<div class="col-sm-8">
								<input type="text"  name="drugsName" placeholder="Generic Name" data-rel="tooltip" class="form-control" required/>
						</div>

					 </div>

					 <div class="form-group" style="margin-left:-130px;">
						<label class="control-label col-sm-4" >Dosage form</label>
						<div class="col-sm-3">
								<input type="text"  name="dosageForm" placeholder="Dosage form" data-rel="tooltip" class="form-control" required/>
						</div>
												     <label style="margin-left:-60px;" class="control-label col-sm-3" >Sub Category</label>
	                      	                    <div class="col-sm-3">

	                      <input type="text"  name="subCategory" placeholder="Sub Category" data-rel="tooltip" class="form-control" required/>
	                    </div>

					 </div>

					 	                 

					<div class="form-group" style="margin-left:-130px;">
						<label class="control-label col-sm-4" >Strength</label>
						<div class="col-sm-3">
								<input type="text"  name="strength" placeholder="Strength" data-rel="tooltip" class="form-control" required/>
						</div>
						<label style="margin-left:-60px;" class="control-label col-sm-3" >Volume</label>
						<div class="col-sm-3">
								<input type="text"  name="volume" placeholder="Volume" data-rel="tooltip" class="form-control" required/>
						</div>

					 </div>

					 <div class="form-group" style="margin-left:-130px;">
						<label class="control-label col-sm-4" >Brand Name</label>
						<div class="col-sm-3">
								<input type="text"  name="brandName" placeholder="Brand Name" data-rel="tooltip" class="form-control" required/>
						</div>
												<label style="margin-left:-60px;" class="control-label col-sm-3" >Unit</label>
						<div class="col-sm-3">
								<input type="text"  name="unit" placeholder="Unit" data-rel="tooltip" class="form-control" required/>
						</div>
					 </div>




	                    <div class="form-group" style="margin-left:-130px;">
	                      <label class="control-label col-sm-4" >Category</label>

	                      	<div class="col-sm-8">
	                      <select name="category" class="form-control" data-placeholder="Choose a Category..." required>
	                        <option value="">Choose Category</option>
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


