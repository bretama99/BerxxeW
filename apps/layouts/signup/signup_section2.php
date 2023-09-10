	<!-- Signup form-->
	<?php
	$User_Registered = 0;
	if (isset($_POST['signUpSection1'])) {
		include('../constants/security/cryptsalt.php');
		include('../constants/databases/dbcon_eprescription.php'); // connecting to database
		$email = ucfirst(strtolower($_POST['email']));
		$rolesId = $_POST['rolesId'];
		$password = $_POST['password'];
		$mobilePhone = $_POST['mobilePhone'];
		$password = hash_hmac('sha512', $password, $salt);
		$userName = ucfirst(strtolower($_POST['userName']));
		$Check_Uname = "select count(*) from users where userName = '$userName' ";
		$stmtUn = $con->prepare($Check_Uname);
		$stmtUn->execute();
		$rowsUn = $stmtUn->fetchColumn();
		if ($rowsUn == 0) { // count num rows here must be zero
			$Check_Uname = "select count(*) from users where email = '$email' ";
			$stmtUn = $con->prepare($Check_Uname);
			$stmtUn->execute();
			$rowsUn = $stmtUn->fetchColumn();
			if ($rowsUn == 0) {
				$AddU_query = "insert into users (email,mobilePhone,userName,password,usersDefaultRolesId,status) 
					  values('$email','$mobilePhone','$userName','$password','$rolesId','limitedAccess')";
				$stmtaddU = $con->prepare($AddU_query);
				$resultU = $stmtaddU->execute();
				if ($resultU) {
					$User_Id_query = "select usersId from users where userName='$userName' AND email='$email' order by usersId DESC limit 1";
					$UI_stmt = $con->prepare($User_Id_query);
					$UI_success = $UI_stmt->execute();
					$UI_rows = $UI_stmt->fetchAll();
					foreach ($UI_rows as $row) {
						$usersId = $row['usersId'];
					}
					if ($usersId != 0) {
						$AddUR_query = "insert into usersrole (usersId,rolesId,isDefault,addedById) 
									values('$usersId',1,1,'$usersId')";
						$stmtAddUR = $con->prepare($AddUR_query);
						$resultUR = $stmtAddUR->execute();
						if ($resultUR) {
							$User_Registered = 1;
							$_SESSION['Temp_Uname'] = $userName;
							$_SESSION['Temp_usrUsersId'] = $usersId;
						}
					}
				} else {
					$_SESSION['active'] = 'signUp';
					$_SESSION['error_signup'] = 'User not registered';
					header("location: index.php");
				}
			} else {
				$_SESSION['active'] = 'signUp';
				$_SESSION['error_signup'] = 'Email is already Used by another person. Try another';
				header("location: index.php");
			}
		} else {
			$_SESSION['active'] = 'signUp';
			$_SESSION['error_signup'] = 'Username is already Used by another person. try another';
			header("location: index.php");
		}
	}
	if (isset($_GET['signUpSection1'])) {
		$User_Registered = 1;
		$rolesId = $_GET['rolesId'];
		$usersId = $_GET['usersId'];
		$userName = $_GET['userName'];
		$email = $_GET['email'];
		$_SESSION['Temp_Uname'] = $userName;
		$_SESSION['Temp_usrUsersId'] = $usersId;
	}
	if ($User_Registered == 1) { ?>
		<div id="accordion" style="padding-top:13%;">
			<div class="panel-collapse collapse-active" id="collapseOne">
				<section id="signup" class="intro">
					<div class="intro-content">
						<div class="container">

							<div class="col-lg-8">
								<div class="form-wrapper">
									<div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">

										<div class="panel panel-skin">
											<div class="panel-heading">
												<h3 class="panel-title"><span id="signup_for"> Step 2 : Fill Your Personal Information to complete Signup</span></h3>
												<span id="ErrorDisplay"></span>
											</div>
											<div class="panel-body">
												<form action="homepage/signup/models/saveuserinfo.php" method="post" role="form" class="contactForm lead" id="userInfo">
													<input type="hidden" id="rolesId" name="rolesId" value="<?php echo $rolesId; ?>">
													<input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
													<input type="hidden" name="email" value="<?php echo $email; ?>">
													<?php
													$L_query = "select * from licence where Status='Active' order by licenceId DESC limit 1";
													$L_stmt = $con->prepare($L_query);
													$L_success = $L_stmt->execute();
													$L_rows = $L_stmt->fetchAll();

													foreach ($L_rows as $row) {
														$licenceId = $row['licenceId'];
													}
													?>
													<div class="row">
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Title</label>
																<select name="titleId" id="titleId" class="form-control input-md" data-placeholder="Choose a Title..." required>
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
														<div class="col-xs-3 col-sm-4 col-md-4">
															<div class="form-group">
																<label>First Name</label>
																<input type="text" name="firstName" id="firstName" class="form-control input-md" placeholder="First Name" required />
															</div>
														</div>
														<div class="col-xs-4 col-sm-4 col-md-4">
															<div class="form-group">
																<label>Father Name</label>
																<input type="text" name="fatherName" id="fatherName" class="form-control input-md" placeholder="Father Name" required />
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-xs-4 col-sm-4 col-md-4">
															<div class="form-group">
																<label>Grandfather Name</label>
																<input type="text" name="grandFatherName" id="grandFatherName" class="form-control input-md" placeholder="Grandfather Name" required />
															</div>
														</div>
														<div class="col-xs-3 col-sm-3 col-md-3">
															<div class="form-group">
																<label>Gender</label>
																<select name="gender" id="gender" class="form-control input-md" data-placeholder="Choose a Title..." required>
																	<option value="">Choose Gender</option>
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																</select>
															</div>
														</div>
														<div class="col-xs-4 col-sm-4 col-md-4">
															<div class="form-group">
																<label>Date Of Birth</label>
																<?php
																$year = date('Y');
																$maxyear = date('Y') - 18;
																$minyear = date('Y') - 75;
																$pminyear = date('Y') - 200;
																$month = date('m');
																$day = date('d');


																?>
																<input type="date" name="dateOfBirth" id="dateOfBirth" class="form-control input-md" onchange="checkDOB()" max="<?php if ($rolesId == 2 or $rolesId == 3) {
																																													echo $maxyear;
																																												} else {
																																													echo $year;
																																												}
																																												echo '-' . $month . '-' . $day; ?>" min="<?php if ($rolesId == 2 or $rolesId == 3) {
																																																								echo $minyear;
																																																							} else {
																																																								echo $pminyear;
																																																							}
																																																							echo '-' . $month . '-' . $day; ?>" autofocus required title="Age should be 18+" />
																<span id="mydobdate_error" style="display:none;"></span>
															</div>
														</div>
													</div>
													<?php if ($rolesId == 2 or $rolesId == 3) { ?>
														<div class="row">
															<div class="col-xs-4 col-sm-4 col-md-4">
																<div class="form-group">
																	<label>Education Level</label>
																	<select name="educationalLevelId" id="educationalLevelId" class="chosen-select form-control" data-placeholder="Choose Educational Level" required>
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
															<div class="col-xs-3 col-sm-3 col-md-3">
																<div class="form-group">
																	<label>Licence No</label>
																	<input type="text" name="licenceNo" id="licenceNo" placeholder="licence No" autocomplete="off" class="form-control" required />
																</div>
															</div>
															<div class="col-xs-4 col-sm-4 col-md-4">
																<div class="form-group">
																	<label>Licence Exp.Date</label>
																	<input type="date" name="licenceExpirationDate" id="licenceExpirationDate" onchange="checkLicence()" placeholder="Expiration Date" class="form-control" min="<?php echo date('Y-m-d'); ?>" required />
																	<span id="mydate_error" style="display:none;"></span>
																	<script>
																	</script>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-xs-4 col-sm-4 col-md-4">
																<?php if ($rolesId == 3) { ?>

																	<div class="form-group">
																		<label>Specialization</label>
																		<select name="specializationId" id="specialization" class="chosen-select form-control" data-placeholder="Choose Specialization" required>
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
																<?php }
																if ($rolesId == 2) { ?>
																	<div class="form-group">
																		<label>Qualification</label>
																		<select name="qualification" id="qualification" class="form-control" data-placeholder="Choose Qualification" required>
																			<option value="">Choose</option>
																			<option value="Senior">Senior</option>
																			<option value="Junior">Junior</option>
																			<option value="Chief">Chief</option>
																			<option value="Expert">Expert</option>
																		</select>
																	</div>
																<?php } ?>
															</div>
															<div class="col-xs-3 col-sm-3 col-md-3">
																<div class="form-group">
																	<label>Graduated From</label>
																	<input type="text" name="graduatedFrom" id="graduatedFrom" placeholder="Write university/College name" class="form-control" required />
																</div>
															</div>
															<div class="col-xs-4 col-sm-4 col-md-4">
																<div class="form-group">
																	<label>In Year</label>
																	<input type="number" name="graduationYear" id="graduationYear" onchange="checkGradYear(<?php echo date('Y'); ?>)" onkeyup="checkGradYear(<?php echo date('Y'); ?>)" placeholder="In Year" class="form-control" max="<?php echo date('Y'); ?>" required />
																	<span id="mygraddate_error" style="display:none;"></span>
																</div>
															</div>
														</div>
														<div class="row">
															<?php if ($rolesId == 3) { ?>
																<div class="col-xs-6 col-sm-6 col-md-6">
																	<div class="form-group">
																		<label>Institution Name</label>
																		<input type="text" name="HealthInstitutionName" id="HealthInstitutionName" placeholder="Health institution name you are working now" class="form-control" required />
																	</div>
																</div>
															<?php } ?>
															<div class="col-xs-6 col-sm-6 col-md-6">
																<div class="form-group">
																	<label>&nbsp;</label>
																</div>
																<input type="hidden" name="userInfo">
															<?php } ?>
															<br>
															<span style="font-size:16px;"><input type="checkbox" id="licenceId" name="licenceId" value="<?php echo $licenceId; ?>" required />
																I accept the <a href="#">User Agreement</a></span>
															<?php
															if ($rolesId == 1) {
															?>
																<button type="submit" id="SignUp" name="userInfo" class='btn btn-skin btn-block btn-lg'>SignUp</button>
															<?php } ?>
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
																// accept & display login feedback
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

							<?php if ($rolesId == 2 or $rolesId == 3) { ?>
								<div class="col-sm-4">
									<div class="panel panel-skin">
										<div class="panel-heading">
											<h3 class="panel-title"><span id="signup_for"> Upload Supportive Documents<br><small>(upload documents like temporary degree,licence,certificates e.t.c)</small></span></h3>
										</div>
									</div>
									<div class="wow fadeInRight" data-wow-delay="0.1s">
										<?php if ($rolesId == 2) { ?>
											<form action="home/uploadpharmacist.php?action=save" class="dropzone" id="dropzoneFrom2">

											</form>
											<br>
											<div align="right">
												<button type="button" id="submit-all2">Uploadd</button>
											</div>
											<div id="preview2">
											</div>
										<?php } else if ($rolesId == 3) {
										?>
											<form action="home/uploadphysician.php?action=save" class="dropzone" id="dropzoneFrom">

											</form>
											<br>

											<div align="right">
												<button type="button" id="submit-all">Upload</button>
											</div>

											<div id="preview">
											</div>
										<?php } ?>
									</div>
									<div align="right">
										<button class='btn btn-skin btn-block btn-lg' onclick='submitUserForm()'>SignUp</button>
									</div>
								<?php } ?>
								</div>

						</div>
					</div>
				</section>
			</div>
		</div>

		<script>
			function checkLicence() {
				var mydate = document.getElementById('licenceExpirationDate'),
					mydateError = document.getElementById('mydate_error');

				mydate.addEventListener('input', function() {
					if (!mydate.value.match(/\d{4}-\d{1,2}-\d{1,2}/)) {
						mydateError.innerHTML = 'Please specify a valid date in the form 1990-02-22';
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
						mydateError.innerHTML = 'Please specify a valid date in the form 1990-02-22';
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
							mydateError.innerHTML = '<i style ="color:red; font-size:14px;">age should be under 75</i>';
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

				var titleId = document.getElementById('titleId').value;
				var firstName = document.getElementById('firstName').value;
				var fatherName = document.getElementById('fatherName').value;
				var grandFatherName = document.getElementById('grandFatherName').value;
				var gender = document.getElementById('gender').value;
				var dateOfBirth = document.getElementById('dateOfBirth').value;
				var educationalLevelId = document.getElementById('educationalLevelId').value;
				var graduatedFrom = document.getElementById('graduatedFrom').value;
				var graduationYear = document.getElementById('graduationYear').value;
				var licenceNo = document.getElementById('licenceNo').value;
				var licenceExpirationDate = document.getElementById('licenceExpirationDate').value;
				var rolesId = document.getElementById('rolesId').value;
				checkLicence();
				if (1 == 1) {
					if (rolesId == '3') {
						var specialization = document.getElementById('specialization').value;
						var HealthInstitutionName = document.getElementById('HealthInstitutionName').value;
						if (titleId != "" && firstName != "" && fatherName != "" && grandFatherName != "" && gender != "" && dateOfBirth != "" && licenceId != "" && educationalLevelId != "" && graduatedFrom != "" && graduationYear != "" && specialization != "" && licenceNo != "" && licenceExpirationDate != "" && HealthInstitutionName != "") {
							document.getElementById('userInfo').submit();
						} else {
							alert("please fill all the fields");
							document.getElementById('ErrorDisplay').innerHTML = "<br><b style='color:red;'>Please fill all the fields</b>";
						}
					} else if (rolesId == '2') {
						var qualification = document.getElementById('qualification').value;
						if (titleId != "" && firstName != "" && fatherName != "" && grandFatherName != "" && gender != "" && dateOfBirth != "" && licenceId != "" && educationalLevelId != "" && graduatedFrom != "" && graduationYear != "" && qualification != "" && licenceNo != "" && licenceExpirationDate != "") {
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



			$(document).ready(function() {

				Dropzone.options.dropzoneFrom2 = {
					autoProcessQueue: false,
					acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
					init: function() {
						var submitButton2 = document.querySelector('#submit-all2');
						myDropzone = this;
						submitButton2.addEventListener("click", function() {
							myDropzone.processQueue();
						});
						this.on("complete", function() {
							if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
								var _this = this;
								_this.removeAllFiles();
							}
							list_image2();
						});
					},
				};

				list_image2();

				function list_image2() {
					$.ajax({
						url: "home/uploadpharmacist.php",
						success: function(data) {
							$('#preview2').html(data);
						}
					});
				}

				$(document).on('click', '.remove_image2', function() {
					var name = $(this).attr('id');
					$.ajax({
						url: "home/uploadpharmacist.php",
						method: "POST",
						data: {
							name: name
						},
						success: function(data) {
							list_image2();
						}
					})
				});


				Dropzone.options.dropzoneFrom3 = {
					autoProcessQueue: false,
					acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
					init: function() {
						var submitButton3 = document.querySelector('#submit-all3');
						myDropzone = this;
						submitButton3.addEventListener("click", function() {
							myDropzone.processQueue();
						});
						this.on("complete", function() {
							if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
								var _this = this;
								_this.removeAllFiles();
							}
							list_image3();
						});
					},
				};

				list_image3();

				function list_image3() {
					$.ajax({
						url: "home/uploadpharmacyowner.php",
						success: function(data) {
							$('#preview3').html(data);
						}
					});
				}

				$(document).on('click', '.remove_image3', function() {
					var name = $(this).attr('id');
					$.ajax({
						url: "home/uploadpharmacyowner.php",
						method: "POST",
						data: {
							name: name
						},
						success: function(data) {
							list_image3();
						}
					})
				});



				//==========================================================================


				Dropzone.options.dropzoneFrom = {
					autoProcessQueue: false,
					acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
					init: function() {
						var submitButton = document.querySelector('#submit-all');
						myDropzone = this;
						submitButton.addEventListener("click", function() {
							myDropzone.processQueue();
						});
						this.on("complete", function() {
							if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
								var _this = this;
								_this.removeAllFiles();
							}
							list_image();
						});
					},
				};

				list_image();

				function list_image() {
					$.ajax({
						url: "home/uploadphysician.php",
						success: function(data) {
							$('#preview').html(data);
						}
					});
				}

				$(document).on('click', '.remove_image', function() {
					var name = $(this).attr('id');
					$.ajax({
						url: "home/uploadphysician.php",
						method: "POST",
						data: {
							name: name
						},
						success: function(data) {
							list_image();
						}
					})
				});

			});
		</script>

	<?php
	} else {
		$_SESSION['error_signup'] = 'User not registered';
		header("location: index.php?not");
	}
	?>