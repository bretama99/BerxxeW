<?php
ob_start();
session_start();
if (isset($_SESSION['Uname'])) {
	include('./layouts/header_logged.php');
	include('./layouts/sidebar.php'); ?>
	<div class="main-content">
		<div class="main-content-inner">

			<div class="breadcrumbs ace-save-state" id="breadcrumbs">
				<ul class="breadcrumb">
					<?php $url = $_SERVER['REQUEST_URI'];
					if (!isset($_GET['var'])) {
						header('location:?name=hub/analytics/analytics&var=analytics');
					}
					$taskvar = $_GET['var'];
					$Mquery = "select menusId from tasks where tasksVarName='$taskvar'";
					$Mstmt = $con->prepare($Mquery);
					$Msuccess = $Mstmt->execute();
					$Mrows = $Mstmt->fetchAll();
					foreach ($Mrows as $row) {
						$menusId = $row['menusId'];
					}

					$MTquery = "select menusVarName from menus where menusId='$menusId'";
					$MTstmt = $con->prepare($MTquery);
					$MTsuccess = $MTstmt->execute();
					$MTrows = $MTstmt->fetchAll();
					foreach ($MTrows as $row) {
						$menusVarName = $row['menusVarName'];
					}
					?>
					<li>
						<?php echo $lang[$menusVarName]; ?>
					</li>
					<li>
						<?php echo $lang[$taskvar]; ?>
					</li>

				</ul>
			</div>

			<div class="page-content">

				<div class="col-xs-12">

					<?php
					if (isset($_GET['name'])) {
						include($_GET['name'] . '.php');
					}

					?>

				</div>
			</div>
		</div>
	</div>

	<?php include('./layouts/footer_logged.php'); ?>
<?php
} else {
	header('location:../index.php');
}
?>