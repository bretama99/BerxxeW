<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>
		<?php echo $_SERVER['SERVER_NAME']; ?>
	</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<link rel="stylesheet" href="../../css/summernote-lite.css" />
	<!-- <link rel="stylesheet" href="../css/bootstrap.no-icons.min.css" /> -->
	<link rel='icon' href='../../images/favicon.ico' type='image/x-icon' />
	<link rel="stylesheet" href="../../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../css/jquery-gauge.css" />
	<link rel="stylesheet" href="../../css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" href="../../css/font-awesome.min.css" />
	<link rel="stylesheet" href="../../css/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="../../css/chosen.min.css" />
	<link rel="stylesheet" href="../../css/jquery.gritter.min.css" />
	<link rel="stylesheet" href="../../css/ace.min.css" />
	<link rel="stylesheet" href="../../css/style.css" />
	<link rel="stylesheet" href="../../css/dropzone.css" />
	<link rel="stylesheet" href="../../css/dashboard.css" />
	<script src="../../js/jquery-1.12.4.js"></script>
	<script src="../../js/jquery-1.10.2.min.js"></script>
	<script src="../../js/chosen.jquery.min.js"></script>
	<script src="../../js/jquery-gauge.min.js"></script>
	<script src="../../js/dropzone.js"></script>

	<script src="../../js/jquery.minNew.js"></script>
	<script type="text/javascript">
		var jQuery_New = jQuery.noConflict();
	</script>
	<script src="../../js/jquery-ui.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
	<script type="text/javascript">
		$(function() {
			$(".chzn-select").chosen();
		});
	</script>
</head>
<?php

include('../../constants/databases/dbcon_eprescription.php');
$errflag = false;
$errmsg_arr = array();
?>

<body class="no-skin">
	<div class="Nav_bar">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">#</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-header pull-left">
					<a href="index.php?name=hub/hub&var=analytics" class="navbar-brand">
						<small>
							eRx Ethiopia&nbsp;&nbsp;&nbsp;
						</small>
					</a>
					<?php include('layouts/languages.php') ?>
				</div>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<?php include('common/headers/views/getUserInfo.php') ?>
						<?php include('common/headers/views/myPharmacies.php') ?>
						<?php include('common/headers/views/userProfile.php') ?>
						<?php include('common/headers/views/notifications.php') ?>

					</ul>
				</div>
			</div>
		</div>
	</div>

	<?php include('common/headers/views/accessPrivileges.php') ?>
	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>