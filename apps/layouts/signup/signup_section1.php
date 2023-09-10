	<?php $rolesId = 2; ?>
	<div id="accordion">
		<div class="panel-collapse collapse" id="collapseOne">
			<section id="signup" class="intro">
				<div class="intro-content">
					<div class="container">
						<div class="col-sm-14">
							<div class="form-wrapper">
								<div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
									<div class="panel panel-skin">
										<div class="panel-heading" id="panel-heading">
											<h3 class="panel-title"><span id="signup_for"> Sign Up </span><small>(It's free!)</small></h3>
										</div>
										<div class="panel-body" style="background-color:white;">
											<form action="homepage/signup/models/saveuserinfo.php" method="post" role="form" class="contactForm lead" id="userInfo" enctype='multipart/form-data'>
												<div style="float:left; width:70%;">
													<?php
													$L_query = "select * from licence where Status='Active' order by licenceId DESC limit 1";
													$L_stmt = $con->prepare($L_query);
													$L_success = $L_stmt->execute();
													$L_rows = $L_stmt->fetchAll();

													foreach ($L_rows as $row) {
														$licenceId = $row['licenceId'];
													}
													?>

													<input type="hidden" id="rolesId" name="rolesId" value="">
													<div class="row">
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Title</label>
																<select name="titleId" id="titleId" class="form-control input-sm" required>
																	<option value="">Select Title</option>
																	<?php
																	$t_query = "select * from title";
																	$t_stmt = $con->prepare($t_query);
																	$t_success = $t_stmt->execute();
																	$t_rows = $t_stmt->fetchAll();
																	foreach ($t_rows as $row) {
																		$titleId = $row['titleId'];
																		$titleName = $row['titleName'];
																	?>
																		<option value="<?php echo $titleId; ?>"><?php echo $titleName; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label style="font-size:10px;">First Name</label>
																<input type="text" name="firstName" id="firstName" class="form-control input-sm" required autocomplete="off" />
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Father Name</label>
																<input type="text" name="fatherName" id="fatherName" class="form-control input-sm" required autocomplete="off" />
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Grandfather Name</label>
																<input type="text" name="grandFatherName" id="grandFatherName" class="form-control input-sm" required autocomplete="off" />
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Email</label>
																<input type="email" name="email" id="email" autocomplete="off" onkeyup="check_email();" class="form-control input-sm" required />
																<?php include('homepage/signup/views/checkemail.php'); ?>
																<span id="message"></span>
																<div class="validation"></div>
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>UserName</label>
																<input type="text" name="userName" id="userName" autocomplete="off" onkeyup="check_username();" class="form-control input-sm" required />
																<?php include('homepage/signup/views/checkusername.php'); ?>
																<span id="message_username"></span>
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3">
															<span class="input-icon input-icon-right">
																<div class="form-group">
																	<label>password</label>
																	<input type="password" name="password" id="password" onkeyup="validate_Passwords('password')" class="form-control input-sm" required autocomplete="off" />

																	<span id="PasswordErr"></span>
																</div>
															</span>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Confirm Password</label>
																<input type="password" name="confirm_password" id="confirm_password" onkeyup="Pwd_match('confirm_password')" class="form-control input-sm" required />
																<span id="confirmErr"></span>
															</div>
														</div>

														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Mobile Phone</label>
																<input type="text" name="mobilePhone" id="mobilePhone" maxlength="10" onkeyup="Validate_phone('mobilePhone')" autocomplete="off" class="form-control input-sm" required />
																<?php include('homepage/signup/views/checkphone.php'); ?>
																<span id="phone-message"></span>
																<span id="phone_error"></span>
															</div>
														</div>

														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Gender</label>
																<select name="gender" id="gender" class="form-control input-sm" required>
																	<option value="">Choose Gender</option>
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																</select>
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Date Of Birth</label>
																<input type="date" name="PatientdateOfBirth" id="PatientdateOfBirth" class="form-control input-sm" required />
																<?php
																$year = date('Y');
																$maxyear = date('Y') - 18;
																$minyear = date('Y') - 100;
																$pminyear = date('Y') - 200;
																$month = date('m');
																$day = date('d');
																?>
																<input type="date" name="dateOfBirth" id="dateOfBirth" class="form-control input-sm" onchange="checkDOB()" max="<?php echo $maxyear . '-' . $month . '-' . $day; ?>" min="<?php echo $minyear . '-' . $month . '-' . $day; ?>" autofocus required title="Age should be 18+" />
																<span id="mydobdate_error" style="display:none;"></span>
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3" id="Education_Level">
															<div class="form-group">
																<label>Education Level</label>
																<select name="educationalLevelId" id="educationalLevelId" class="form-control input-sm" required>
																	<option value="">Choose</option>
																	<?php
																	$El_query = "select educationalLevelId,educationLevelName from educationallevel";
																	$El_stmt = $con->prepare($El_query);
																	$El_success = $El_stmt->execute();
																	$El_rows = $El_stmt->fetchAll();
																	foreach ($El_rows as $row) {
																		$educationalLevelId = $row['educationalLevelId'];
																		$educationLevelName = $row['educationLevelName'];
																	?>
																		<option value="<?php echo $educationalLevelId; ?>"><?php echo $educationLevelName; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3" id="Licence_No">
															<div class="form-group">
																<label>Licence No</label>
																<input type="text" name="licenceNo" id="licenceNo" autocomplete="off" class="form-control input-sm" required />
															</div>
														</div>
													</div>

													<div id="Physician_Pharmacist">
														<div class="row">
															<div class="col-xs-3 col-sm-3 col-md-3">
																<div class="form-group">
																	<label>Licence Exp.Date</label>
																	<input type="date" name="licenceExpirationDate" id="licenceExpirationDate" onchange="checkLicence()" class="form-control input-sm" min="<?php echo date('Y-m-d'); ?>" required />
																	<span id="mydate_error" style="display:none;"></span>
																	<script>

																	</script>
																</div>
															</div>
															<div class="col-xs-3 col-sm-3 col-md-3">
																<div class="form-group" id="Specialization">
																	<label>Specialization</label>
																	<select name="specializationId" id="specialization" class="form-control input-sm" required>
																		<option value="">Choose</option>
																		<?php
																		$El_query = "select specializationId,specializationName from specialization order by specializationName";
																		$El_stmt = $con->prepare($El_query);
																		$El_success = $El_stmt->execute();
																		$El_rows = $El_stmt->fetchAll();
																		foreach ($El_rows as $row) {
																			$specializationId = $row['specializationId'];
																			$specializationName = $row['specializationName'];
																		?>
																			<option value="<?php echo $specializationId; ?>"><?php echo $specializationName; ?></option>
																		<?php } ?>
																	</select>
																</div>
																<div class="form-group" id="Qualification">
																	<label>Qualification</label>
																	<select name="qualification" id="qualification" class="form-control input-sm" required>
																		<option value="">Choose</option>
																		<option value="Senior">Senior</option>
																		<option value="Junior">Junior</option>
																		<option value="Chief">Chief</option>
																		<option value="Expert">Expert</option>
																	</select>
																</div>
															</div>
															<div class="col-xs-3 col-sm-3 col-md-3">
																<div class="form-group">
																	<label>Graduated From</label>
																	<input type="text" name="graduatedFrom" id="graduatedFrom" class="form-control input-sm" required />
																</div>
															</div>
															<div class="col-xs-3 col-sm-3 col-md-3">
																<div class="form-group">
																	<label>In Year</label>
																	<input type="number" name="graduationYear" id="graduationYear" onchange="checkGradYear(<?php echo date('Y'); ?>)" onkeyup="checkGradYear(<?php echo date('Y'); ?>)" class="form-control input-sm" max="<?php echo date('Y'); ?>" required />
																	<span id="mygraddate_error" style="display:none;"></span>
																</div>
															</div>
														</div>
														<div class="row" id="Institution_Name">
															<div class="col-xs-8 col-sm-8 col-md-8">
																<div class="form-group">
																	<label>Institution Name</label>
																	<input type="text" name="HealthInstitutionName" id="HealthInstitutionName" placeholder="Health institution name you are working now" class="form-control input-sm" required />
																</div>
															</div>
														</div>
													</div>
													<?php //} //}
													?>
													<div class="col-xs-6 col-sm-6 col-md-6">
														<span style="font-size:16px;"><input type="checkbox" id="licenceId" name="licenceId" value="<?php echo $licenceId; ?>" required />
															I accept the <a href="#">User Agreement</a></span>
													</div>
												</div>
												<div style="float:right; width:28%; margin-left:2%;">
													<div class="col-sm-16" id="upload_file">
														<div class="panel panel-skin">
															<div class="panel-heading">
																<h3 class="panel-title"><span id="signup_for"> Upload Documents<br><small>(upload documents like temporary degree,licence,certificates e.t.c)</small></span></h3>
															</div>
														</div>
														<div class="wow fadeInRight" data-wow-delay="0.1s">

															<table id="table" width="100%">
																<tbody>
																	<tr class="add_row">
																		<td id="no" width="5%">#</td>
																		<td width="75%"><input class="file" name='file[]' type='file' required /></td>
																		<td width="20%"></td>
																	</tr>
																</tbody>
																<tfoot>
																	<tr>
																		<td colspan="4"><button class="btn btn-success btn-xs" type="button" id="add" title='Add new file' />Add new file</button></td>
																	</tr>

																</tfoot>
															</table>
														</div>

														<?php //}
														?>
													</div>
													<input type="hidden" name="userInfo">
													<br>
													<div align="right" class="col-sm-5 col-sm-5 col-sm-5">
														<button style="font-size:12px;" type="submit" id="SignUp" class='btn btn-skin btn-block btn-lg' onclick='submitUserForm()'>SignUp</button>
													</div>
												</div>

												<?php if (isset($_SESSION['error_signup'])) { ?>
													<br>
													<div class="alert alert-block alert-warning" style="width:100%; margin-left:0%;">
														<button type="button" class="close" data-dismiss="alert">
															<i class="ace-icon fa fa-times"></i>
														</button>
													<?php
													if (isset($_SESSION['error_signup'])) {
														$error_signup = $_SESSION['error_signup'];
														echo '<span style="color:red;font-size:14px;">' . $error_signup . '</span></div>';
														unset($_SESSION['error_signup']);
													}
												}
													?>

													<?php if (isset($_SESSION['success_signup'])) { ?>
														<br>
														<div class="alert alert-block alert-success" style="width:100%; margin-left:0%;">
															<button type="button" class="close" data-dismiss="alert">
																<i class="ace-icon fa fa-times"></i>
															</button>
														<?php
														$login_feedback = $_SESSION['success_signup'];
														echo '<i class="ace-icon fa fa-success green"></i> <span style="color:green;font-size:14px;">' . $login_feedback . '</span></div>';
														unset($_SESSION['success_signup']);
													}

														?>

											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		</section>
	</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#table').on('click', "#add", function(e) {
				$('tbody').append('<tr class="add_row"><td>#</td><td><input name="file[]" type="file"/></td><td class="text-center"><button type="button" class="btn btn-danger btn-xs" id="delete" title="Delete file">Delete</button></td><tr>');
				e.preventDefault();
			});

			$('#table').on('click', "#delete", function(e) {
				if (!confirm("Are you sure you want to delete this file?"))
					return false;
				$(this).closest('tr').remove();
				e.preventDefault();
			});
		});
	</script>

	<script>
		function setPharmacistRole() {
			document.getElementById('rolesId').value = 2;
			document.getElementById('signup_for').innerHTML = "Sign up as Pharmacist";
			document.getElementById("panel-heading").style.backgroundColor = "#337ab7";
			document.getElementById("Specialization").style.display = "none";
			document.getElementById("Institution_Name").style.display = "none";
			document.getElementById("Qualification").style.display = "block";
			document.getElementById("upload_file").style.display = "block";
			document.getElementById("Education_Level").style.display = "block";
			document.getElementById("Licence_No").style.display = "block";
			document.getElementById("Physician_Pharmacist").style.display = "block";
			document.getElementById("PatientdateOfBirth").style.display = "none";
			document.getElementById("dateOfBirth").style.display = "block";
			clearInputs();
		}

		function setPhysicianRole() {
			document.getElementById('rolesId').value = 3;
			document.getElementById('signup_for').innerHTML = "Sign up as Physician";
			document.getElementById("panel-heading").style.backgroundColor = "#f0ad4e";
			document.getElementById("Qualification").style.display = "none";
			document.getElementById("upload_file").style.display = "block";
			document.getElementById("Education_Level").style.display = "block";
			document.getElementById("Licence_No").style.display = "block";
			document.getElementById("Physician_Pharmacist").style.display = "block";
			document.getElementById("Specialization").style.display = "block";
			document.getElementById("Institution_Name").style.display = "block";
			document.getElementById("PatientdateOfBirth").style.display = "none";
			document.getElementById("dateOfBirth").style.display = "block";
			clearInputs();
		}

		function setPatientRole() {
			document.getElementById('rolesId').value = 1;
			document.getElementById('signup_for').innerHTML = "Sign up as Patient";
			document.getElementById("panel-heading").style.backgroundColor = "#5cb85c";
			document.getElementById("upload_file").style.display = "none";
			document.getElementById("Education_Level").style.display = "none";
			document.getElementById("Licence_No").style.display = "none";
			document.getElementById("Physician_Pharmacist").style.display = "none";
			document.getElementById("PatientdateOfBirth").style.display = "block";
			document.getElementById("dateOfBirth").style.display = "none";
			clearInputs();
		}

		function clearInputs() {
			$('input[type="text"]').val('');
			$('input[type="password"]').val('');
			$('input[type="date"]').val('');
			$('input[type="number"]').val('');
			$('input[type="email"]').val('');
			$('span').text('');

			var inputs = document.getElementsByTagName('select');
			for (var i = 0; i < inputs.length; i++) {
				inputs[i].selectedIndex = -1;
			}
		}
	</script>

	<script>
		function checkLicence() {
			var mydate = document.getElementById('licenceExpirationDate'),
				mydateError = document.getElementById('mydate_error');

			mydate.addEventListener('input', function() {
				if (!mydate.value.match(/\d{4}-\d{1,2}-\d{1,2}/)) {
					mydateError.innerHTML = '<i style ="color:red; font-size:14px;">Please specify a valid date in the form 1990-02-22</i>';
					mydateError.style.display = 'inherit';
				} else {
					var value = new Date(mydate.value),
						min = new Date(mydate.min),
						max = new Date(mydate.max);
					if (value < min) {
						mydateError.innerHTML = '<i style ="color:red; font-size:14px;">Licence already expired</i>';
						mydateError.style.display = 'inherit';
						document.getElementById("SignUp").disabled = true;
					} else {
						mydateError.style.display = 'none';
						document.getElementById("SignUp").disabled = false;
					}
				}
			});
		}

		function checkDOB() {
			var mydate = document.getElementById('dateOfBirth'),
				mydateError = document.getElementById('mydobdate_error');

			mydate.addEventListener('input', function() {
				if (!mydate.value.match(/\d{4}-\d{1,2}-\d{1,2}/)) {
					mydateError.innerHTML = '<i style ="color:red; font-size:14px;">Please specify a valid date in the form 1990-02-22</i>';
					mydateError.style.display = 'inherit';
				} else {
					var value = new Date(mydate.value),
						min = new Date(mydate.min),
						max = new Date(mydate.max);
					if (value > max) {
						mydateError.innerHTML = '<i style ="color:red; font-size:14px;">You are under 18</i>';
						mydateError.style.display = 'inherit';
						document.getElementById("SignUp").disabled = true;
					} else if (value < min) {
						mydateError.innerHTML = '<i style ="color:red; font-size:14px;">age should be under 100</i>';
						mydateError.style.display = 'inherit';
						document.getElementById("SignUp").disabled = true;
					} else {
						mydateError.style.display = 'none';
						document.getElementById("SignUp").disabled = false;
					}
				}
			});
		}

		function checkGradYear(max) {
			var mydate = document.getElementById('graduationYear'),
				mydateError = document.getElementById('mygraddate_error');
			mydate.addEventListener('input', function() {

				var value = new Date(mydate.value),
					max = new Date(mydate.max);
				if (value > max) {
					mydateError.innerHTML = '<i style ="color:red; font-size:14px;">Invalid Graduation Year</i>';
					mydateError.style.display = 'inherit';
					document.getElementById("SignUp").disabled = true;
				} else {
					mydateError.style.display = 'none';
					document.getElementById("SignUp").disabled = false;
				}
			});
		}

		function submitUserForm() {
			var licenceId = document.getElementById("licenceId");
			if (licenceId.checked == true) {
				licenceId = document.getElementById('licenceId').value;
			} else {
				licenceId = "";
			}
			var rolesId = document.getElementById('rolesId').value;
			var titleId = document.getElementById('titleId').value;
			var firstName = document.getElementById('firstName').value;
			var fatherName = document.getElementById('fatherName').value;
			var grandFatherName = document.getElementById('grandFatherName').value;
			var gender = document.getElementById('gender').value;
			if (rolesId == 1) {
				var dateOfBirth = document.getElementById('PatientdateOfBirth').value;
			} else {
				var dateOfBirth = document.getElementById('dateOfBirth').value;
			}

			var educationalLevelId = document.getElementById('educationalLevelId').value;
			var graduatedFrom = document.getElementById('graduatedFrom').value;
			var graduationYear = document.getElementById('graduationYear').value;
			var licenceNo = document.getElementById('licenceNo').value;
			var licenceExpirationDate = document.getElementById('licenceExpirationDate').value;

			var file_val = $('.file').val();
			checkLicence();
			if (1 == 1) {
				if (rolesId == '3') {
					var specialization = document.getElementById('specialization').value;
					var HealthInstitutionName = document.getElementById('HealthInstitutionName').value;
					if (titleId != "" && firstName != "" && fatherName != "" && grandFatherName != "" && gender != "" && dateOfBirth != "" && licenceId != "" && educationalLevelId != "" && graduatedFrom != "" && graduationYear != "" && specialization != "" && licenceNo != "" && licenceExpirationDate != "" && HealthInstitutionName != "" && file_val != "") {

						if (file_val == "") {
							alert("Please select at least one file.");
						} else {
							document.getElementById('userInfo').submit();
						}


					} else {
						alert("please fill all the fields");
						document.getElementById('ErrorDisplay').innerHTML = "<br><b style='color:red;'>Please fill all the fields</b>";
					}
				} else if (rolesId == '2') {
					var qualification = document.getElementById('qualification').value;
					if (titleId != "" && firstName != "" && fatherName != "" && grandFatherName != "" && gender != "" && dateOfBirth != "" && licenceId != "" && educationalLevelId != "" && graduatedFrom != "" && graduationYear != "" && qualification != "" && licenceNo != "" && licenceExpirationDate != "" && file_val != "") {
						if (file_val == "") {
							alert("Please select at least one file.");
						} else {
							document.getElementById('userInfo').submit();
						}

					} else {
						alert("please fill all the fields");
						document.getElementById('ErrorDisplay').innerHTML = "<br><b style='color:red;'>Please fill all the fields</b>";
					}
				} else if (rolesId == '1') {
					if (titleId != "" && firstName != "" && fatherName != "" && grandFatherName != "" && gender != "" && dateOfBirth != "" && licenceId != "") {
						document.getElementById('userInfo').submit();
					} else {
						alert("please fill all the fields");
						document.getElementById('ErrorDisplay').innerHTML = "<br><b style='color:red;'>Please fill all the fields</b>";
					}
				}
			} else {
				alert("Licence already expired");
				document.getElementById('ErrorDisplay').innerHTML = "<br><b style='color:red;'>Licence already expired</b>";
			}
		}
	</script>