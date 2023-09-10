<?php
?>


<li class="dropdown-modal">
	<a data-toggle="dropdown" class="dropdown-toggle" href="#" style="background-color:#9b59b6; float:right;">
		<i class="ace-icon fa fa-bell icon-animated-bell notification"></i>
		<?php if (true) { ?>
			<!-- <span class="badge"><?php echo 6 ?></span> -->

		<?php } ?>
		<span class="badge badge-important">
			<?php
			$rowsP = 0;
			$Usr_query = "select users.*, prescription.prescriberId,prescription.patientId from users INNER JOIN prescription on prescription.patientId=users.usersId where prescription.isDeleted=0 and prescription.prescriberId='" . $usrUsersId . "' group by users.usersId";
			if (isset($_SESSION['usrUsersId'])) {
				$dispensedById = $_SESSION['usrUsersId'];
				$query = "select count(*) from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join users on prescription.patientId=users.usersId where prescription.prescriberId='" . $dispensedById . "' AND prescription.status='Returned' AND prescribeddrugs.isDeleted=0 AND prescription.isDeleted=0";
				$stmtP = $con->prepare($query);
				$stmtP->execute();
				$rowsP = $stmtP->fetchColumn();
				if ($rowsP > 0)
					echo $rowsP;
			}



			//echo $rowsnotf;
			?>
		</span>
		<? php //}
		?>
	</a>
	<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
		<li class="dropdown-header">

			<a href="?name=hub/patients/my-patients/mypatients&var=myPatients"><i class="ace-icon fa fa-bell icon-animated-bell"> <b style="color:green;">My Patients</b></i></a>
			<?php
			if (isset($_SESSION['usrUsersId'])) {
				$dispensedById = $_SESSION['usrUsersId'];
			}
			echo $rowsP; //if($rowsnotf == 0){ $rowsnotf= "No new";} echo $rowsnotf;
			?> Notifications
		</li>

		<li class="dropdown-content">
			<ul class="dropdown-menu dropdown-navbar navbar-pink">
				<?php ?>
			</ul>
		</li>

		<li class="dropdown-footer">
			<a href="#">
				See all notifications
				<i class="ace-icon fa fa-arrow-right"></i>
			</a>
		</li>

	</ul>

</li>

<style>
	.notification {
		text-decoration: none;
		position: relative;
		display: inline-block;
	}

	/*.notification:hover {
  background: red;
}*/

	.notification .badge {
		position: absolute;
		top: -10px;
		right: -10px;
		padding: 2px 4px;
		border-radius: 50%;
		background-color: red;
		color: white;
	}
</style>