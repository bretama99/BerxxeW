<!-- Modal -->
<div id="drugFormulary<?php echo $drugsId;?>" class="modal fade" role="dialog">
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

					<div class="form-group" style="margin-left:-10px; margin-bottom: 50px;">
						<input type="hidden" name="drugsId" value="<?php echo $drugsId;?>">
						<label class="control-label col-sm-5" >Dose and Administration</label>
						<div class="col-sm-7" style="margin-left:-20px;">
								<input type="text"  name="doseAndAdministration" placeholder="Dose and Administration" data-rel="tooltip" class="form-control" required />
						</div>

					 </div>

					 <div class="form-group" style="margin-left:-20px;">
						<label class="control-label col-sm-3" >Contraindications</label>
						<div class="col-sm-4" style="margin-left:-20px;">
								<input type="text"  name="contraindications" placeholder="Contraindications" data-rel="tooltip" class="form-control" required/>
						</div>
							<label  class="control-label col-sm-3" >Cautions</label>
	                    <div class="col-sm-3" style="margin-left:-30px;">
	                      <input type="text" name="cautions" placeholder="Cautions" data-rel="tooltip" class="form-control" required/>
	                    </div>

					 </div>             

					<div class="form-group" style="margin-left:-20px; margin-top: 100px;">
						<label class="control-label col-sm-3" >Interactions</label>
						<div class="col-sm-4" style="margin-left:-30px;">
								<input type="text"  name="interactions" placeholder="Interactions" data-rel="tooltip" class="form-control" required/>
						</div>
						<label class="control-label col-sm-3" style="margin-left:10px;" >Side Effects</label>
						<div class="col-sm-3" style="margin-left:-30px;">
								<input type="text" name="sideEffects" placeholder="Side Effects" data-rel="tooltip" class="form-control" required/>
						</div>

					 </div>

					 <div class="form-group" style="margin-left:-20px;  margin-top: 150px;">
						<label class="control-label col-sm-3" >Indications</label>
						<div class="col-sm-4" style="margin-left:-30px;">
								<input type="text" name="indications" placeholder="Indications" data-rel="tooltip" class="form-control" required/>
						</div>
					<label  class="control-label col-sm-3" style="margin-bottom:30px; margin-left: 10px;">Storage</label>
						<div class="col-sm-3" style="margin-left:-30px;">
								<input type="text" name="storage" placeholder="Storage" data-rel="tooltip" class="form-control" required/>
						</div>
					 </div>


<button style="border-radius: 10px;  height: 45px;" type="button" class="width-35 pull-left btn btn-sm btn-danger" data-dismiss="modal"><span class="bigger-130">Close</span></button>
							<button style="border-radius: 10px; height: 45px;" type="submit" name="drugFormulary" class="width-35 pull-right btn btn-sm btn-success">
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


