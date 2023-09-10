<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta property="og:title" content="eRX Ethiopia ( electronic prescription service )">
	<meta property="og:description" content="prescribe online , find nearest pharmacy & dispense ">
	<meta property="og:image" content="https://erxethiopia.com/images/dummy/intro_image.png">
	<meta property="og:url" content="https://erxethiopia.com">
	<title><?php echo $_SERVER['SERVER_NAME']; ?></title>
	<link rel='icon' href='../images/favicon.ico' type='image/x-icon' />
	<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../font-awesome/css/fontawesome.min.css" rel="stylesheet" type="text/css" />
	<link href="../font-awesome/css/solid.css" rel="stylesheet" type="text/css" />
	<link href="../font-awesome/css/brands.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../css/cubeportfolio.min.css">
	<link href="../css/nivo-lightbox.css" rel="stylesheet" />
	<link href="../css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
	<link href="../css/owl.carousel.css" rel="stylesheet" media="screen" />
	<link href="../css/owl.theme.css" rel="stylesheet" media="screen" />
	<link href="../css/animate.css" rel="stylesheet" />
	<link href="../css/stylehome.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/dropzone.css" />
	<script src="../js/dropzone.js"></script>
	<link id="t-colors" href="../css/color/amethyst.css" rel="stylesheet">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<?php
	?>
	<div id="wrapper">
		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="top-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-md-6">
							<p class="bold text-left">
								<a href="index.php" style="margin-top:0%; color:white; font-size:30px; font-family: Arial Black">eRx&nbsp;<span style="color:#299dcc;">Ethiopia</span></a>
							</p>
						</div>
						<div class="col-sm-6 col-md-6">
							<p class="bold text-right">Monday - Sunday, 24/7</p>
						</div>
					</div>
				</div>
			</div>
			<div class="container navigation">
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="collapse navbar-collapse navbar-left navbar-main-collapse">
					<ul class="nav navbar-nav">
						<li><a href="#intro">Home</a></li>
						<li><a href="#boxes">Service</a></li>
						<li><a href="#Check_Medication">Check Medication</a></li>
						<li><a href="#footer">About Us</a></li>
						<li><a href="https://play.google.com/store/apps/details?id=medcoanalyticts.com.erxethiopia.mobile">Download App</a></li>
					</ul>
				</div>
				<div class="navbar-right">
					<?php

					if (isset($_GET['usersId']) && isset($_GET['randomValue'])) {
						include('./homepage/password/views/reset_password.php');
					} else if (isset($_SESSION['forgot_pass'])) {
						include('./homepage/password/views/forgot_password.php');
					} else {
						include('./homepage/login/views/login.php');
					}
					?>

				</div>
			</div>
		</nav>
	</div>