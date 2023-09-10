	<!-- Signup form-->

	<div class="intro-content">
		<div class="container">

			<div class="col-lg-4">
				<div class="wow fadeInUp" data-wow-delay="0.2s">
					<!-- <img src="images/dummy/signup_woman.png" style="width:150%; margin-left:-40%; height:65%;" alt="" />-->
				</div>
			</div>

			<div class="col-lg-8">
				<div class="form-wrapper">
					<div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">

						<div class="panel panel-skin">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Sign Up <small>(It's free!)</small></h3>
							</div>
							<div class="panel-body">
								<div id="sendmessage">Your message has been sent. Thank you!</div>
								<div id="errormessage"></div>

								<form action="signup.php" method="post" role="form" class="contactForm lead">
									<div class="row">
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<label>Title</label>
												<select name="titleId" class="form-control input-md" data-placeholder="Choose a Title..." required>
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
												<label>First Name</label>
												<input type="text" name="firstName" class="form-control input-md" placeholder="First Name" required />
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<label>Father Name</label>
												<input type="text" name="fatherName" class="form-control input-md" placeholder="Father Name" required />
											</div>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-3">
											<div class="form-group">
												<label>Grandfather Name</label>
												<input type="text" name="grandFatherName" class="form-control input-md" placeholder="Grandfather Name" required />
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<label>Gender</label>
												<select name="gender" class="form-control input-md" data-placeholder="Choose a Title..." required>
													<option value="">Choose Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											</div>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4">
											<div class="form-group">
												<label>Date Of Birth</label>
												<input type="date" name="dateOfBirth" class="form-control input-md" required />
											</div>
										</div>
										<div class="col-xs-5 col-sm-5 col-md-5">
											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" placeholder="Email" id="email" autocomplete="off" onkeyup="check_email();" class="form-control input-md" required />
												<?php include('homepage/signup/views/checkemail.php'); ?>
												<span id="message"></span>
												<div class="validation"></div>
											</div>
										</div>
									</div>

									<div class="row">

										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<label>Mobile Phone</label>
												<input type="text" name="mobilePhone" id="mobilePhone" onkeyup="Validate_phone('mobilePhone')" autocomplete="off" placeholder="Mobile Phone" class="form-control input-md" required />
												<!-- <span id="phone_error"></span> -->
											</div>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-3">
											<div class="form-group">
												<label>UserName</label>
												<input type="text" name="userName" placeholder="User Name" id="userName" autocomplete="off" onkeyup="check_username();" class="form-control input-md" required />
												<?php include('homepage/signup/views/checkusername.php'); ?>
												<span id="message_username"></span>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<label>password</label>
												<input type="password" name="password" id="password" onkeyup="validate_Passwords('password')" placeholder="password ***" class="form-control input-md" required />
												<span id="PasswordErr"></span>
											</div>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3">
											<div class="form-group">
												<label>Confirm</label>
												<input type="password" name="confirm" id="C_password" onkeyup="Pwd_match('C_password')" onblur="validate_Confirm()" placeholder="confirm password ***" class="form-control input-md" required />
												<span id="confirmErr"></span>
											</div>
										</div>
										<div class="col-xs-8 col-sm-8 col-md-8">
											<div class="form-group">
												<?php
												$L_query = "select * from licence where Status='Active' order by licenceId DESC limit 1";
												$L_stmt = $con->prepare($L_query);
												$L_success = $L_stmt->execute();
												$L_rows = $L_stmt->fetchAll();

												foreach ($L_rows as $row) {
													$licenceId = $row['licenceId'];
												}
												?>
												<input type="checkbox" name="licenceId" value="<?php echo $licenceId; ?>" required />
												I accept the <a href="#">User Agreement</a>
											</div>
										</div>
									</div>
									<input type="submit" name="signUp" value="Submit" class="btn btn-skin btn-block btn-lg">
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

		</div>
	</div>