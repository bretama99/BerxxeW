<div id="change_profile_pic" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header blue lighter bigger">
					<i class="ace-icon fa fa-user"></i>
					Change Profile Picture
				</h4>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
									<input type="hidden" name="userName" value="<?php echo $userName; ?>">
									<input type="hidden" name="Pre_Profile_pic" value="<?php echo $profilePicture; ?>">
									<label class="block clearfix col-sm-20 col-sm-offset-0">
										<input multiple="" name="profilePicture" type="file" id="id-input-file-3" required />
									</label>

									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="change_profile_pic" class="width-65 pull-right btn btn-sm btn-success">
											<i class="ace-icon fa fa-camera"></i>
											<span class="bigger-110"> Change</span>
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

<div id="upload_file" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header blue lighter bigger">
					<i class="ace-icon fa fa-user"></i>
					Upload Supportive Document
				</h4>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
									<input type="hidden" name="userName" value="<?php echo $userName; ?>">
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1">For Role</label>
										<div class="col-sm-10">
											<select name="File_For" required />
											<option value="">Choose</option>
											<option value="Pharmacist">Pharmacist</option>
											<option value="Physician">Physician</option>
											<option value="PharmacyOwner">Pharmacy Owner</option>
											</select><br>
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-8">
											<input multiple="" name="theFile" type="file" id="id-input-file-2" required />
										</div>
									</div>
									<div class="clearfix col-sm-6 col-sm-offset-2">
										<button type="submit" name="Upload_File" class="width-65 pull-right btn btn-sm btn-success">
											<i class="ace-icon fa fa-camera"></i>
											<span class="bigger-110"> Upload </span>
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


<div id="edituserName" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header blue lighter bigger">
					<i class="ace-icon fa fa-user green"></i>
					Change Username
				</h4>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
									<div class="form-group">
										<label class="control-label col-sm-4" for="email">Username</label>
										<div class="col-sm-8">
											<span class="block input-icon input-icon-right">
												<input type="text" name="userName" placeholder="Username" value="<?php echo $userName; ?>" class="form-control" required />
												<i class="ace-icon fa fa-user"></i>
											</span>
										</div>
									</div>

									<div class="clearfix col-sm-9 col-sm-offset-2">

										<button type="submit" name="Change_username" class="width-65 pull-right btn btn-sm btn-success">
											<i class="ace-icon fa fa-check-square-o"></i>
											<span class="bigger-110"> Change</span>
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
<div id="edit_mobile_phone" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header blue lighter bigger">
					<i class="ace-icon fa fa-phone bigger-120 pink"></i>
					Change Phone Number
				</h4>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
									<div class="form-group">
										<label class="control-label col-sm-4" for="email">Mobile Phone No</label>
										<div class="col-sm-8">
											<span class="block input-icon input-icon-right">
												<input type="text" name="mobilePhone" placeholder="Phone Number" id="mobilePhone" value="<?php echo $mobilePhone; ?>" autocomplete="off" onkeyup="Validate_phone('mobilePhone')" class="form-control" required />
												<i class="ace-icon fa fa-phone bigger-120"></i> &nbsp; &nbsp; <span id="phone_error"></span><br>
											</span>
										</div>
									</div>

									<div class="clearfix col-sm-9 col-sm-offset-2">

										<button type="submit" id="changePhone" name="Change_phone" class="width-65 pull-right btn btn-sm btn-success">
											<i class="ace-icon fa fa-check-square-o"></i>
											<span class="bigger-110"> Change</span>
										</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="editdateOfBirth" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header blue lighter bigger">
					<i class="ace-icon fa fa-phone bigger-120 pink"></i>
					Change Date of Birth
				</h4>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
								<fieldset>
									<input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
									<div class="form-group">
										<label class="control-label col-sm-4" for="email">Date of Birth</label>
										<div class="col-sm-8">
											<span class="block input-icon input-icon-right">
												<input type="date" name="dateOfBirth" placeholder="Date Of Birth" value="<?php echo $dateOfBirth; ?>" class="form-control" required />
											</span>
										</div>
									</div>

									<div class="clearfix col-sm-9 col-sm-offset-2">
										<button type="submit" name="Change_DOB" class="width-65 pull-right btn btn-sm btn-success">
											<i class="ace-icon fa fa-check-square-o"></i>
											<span class="bigger-110"> Change</span>
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

<div id="change_password" class="modal fade" role="dialog">
	<div class="modal-dialog" id="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header blue lighter bigger">
					<i class="ace-icon fa fa-key red"></i>
					Change Password
				</h4>
				<div id="signup-box" class="signup-box widget-box no-border">
					<div class="widget-body">
						<div class="widget-main">
							<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="" onsubmit="return validate_form()">
								<fieldset>
									<input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
									<input type="hidden" name="Db_pass" value="<?php echo $password; ?>">
									<div class="form-group">
										<label class="control-label col-sm-3" for="email">Old Password</label>
										<div class="col-sm-6">
											<span class="block input-icon input-icon-right">
												<input type="password" name="Old_pass" id="old_password" placeholder="Old Password" class="form-control" required />
												<i class="ace-icon fa fa-key"></i>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3" for="email">New Password</label>
										<div class="col-sm-6">
											<span class="block input-icon input-icon-right">
												<input type="password" name="New_pass" id="password" onkeyup="validate_Passwords('password')" placeholder="New Password" class="form-control" required />
												<i class="ace-icon fa fa-key"></i>
											</span>
										</div>
										<span id="PasswordErr"></span>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3" for="email">Confirm Password</label>
										<div class="col-sm-6">
											<span class="block input-icon input-icon-right">
												<input type="password" name="Confirm_pass" id="C_password" onkeyup="Pwd_match('C_password')" onblur="validate_Confirm()" placeholder="Confirm Password" class="form-control" required />
												<i class="ace-icon fa fa-key"></i>
											</span>
										</div>
										<span id="confirmErr"></span>
									</div>
									<div class="clearfix col-sm-9">
										<button type="submit" name="Change_pass" onclick="validate_form()" class="width-65 pull-right btn btn-sm btn-success">
											<i class="ace-icon fa fa-check-square-o"></i>
											<span class="bigger-110"> Change</span>
										</button>
										<span id="FormErr"></span>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>