<div id="deleteRole<?php echo $rolesId ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<h1><?php
			$rolemenus = "select * from rolemenus where rolesId='$rolesId' AND isDeleted=0";
			$usersrole = "select * from usersrole where rolesId='$rolesId' AND isDeleted=0";
			// $roletasks = "select * from roletasks where rolesId='$rolesId' AND isDeleted=0";
			$rolerequest = "select * from rolerequest where rolesId='$rolesId' AND isDeleted=0";

			$stmtrolemenus = $con->prepare($rolemenus);
			$stmtrolemenus->execute();
			$rowsrolemenus = $stmtrolemenus->fetchColumn();

			$stmtusersrole = $con->prepare($usersrole);
			$stmtusersrole->execute();
			$rowsusersrole = $stmtusersrole->fetchColumn();

			// $stmtroletasks = $con->prepare($roletasks);
			// $stmtroletasks->execute();
			// $rowsroletasks = $stmtroletasks->fetchColumn();

			$stmtrolerequest = $con->prepare($rolerequest);
			$stmtrolerequest->execute();
			$rowsrolerequest = $stmtrolerequest->fetchColumn();
			?></h1>
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4>
					<center>
						<br>
						<?php if ($rowsrolemenus == 0 && $rowsusersrole == 0 &&  $rowsrolerequest == 0) {
							echo '<br>	<i class="ace-icon fa fa-trash red"></i>
					Are You Sure to Delete the Role ?';
						}
						?>
					</center>
				</h4>
				<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>
						<input type="hidden" name="rolesId" value="<?php echo $rolesId; ?>">
						<div class="clearfix col-sm-9 col-sm-offset-2">
							<?php if ($rowsrolemenus > 0 || $rowsusersrole > 0 ||  $rowsrolerequest > 0) {
								echo '<h4 style="color:red">Role Already Used! You cannot Delete!</h4>';
							} else {
								echo
								'<button type="submit" name="deleteRole" class="width-10 pull-right btn btn-sm btn-danger">
								<span class="bigger-110">Yes</span>
								<i class="ace-icon fa fa-trash icon-on-right"></i>
							</button>';
							}
							?>

						</div>
					</fieldset>
				</form>


			</div>
		</div>

	</div>
</div>




<div id="untrashRole<?php echo $rolesId ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<h1><?php
			$rolemenus = "select * from rolemenus where rolesId='$rolesId' AND isDeleted=0";
			$usersrole = "select * from usersrole where rolesId='$rolesId' AND isDeleted=0";
			$roletasks = "select * from roletasks where rolesId='$rolesId' AND isDeleted=0";
			$rolerequest = "select * from rolerequest where rolesId='$rolesId' AND isDeleted=0";

			$stmtrolemenus = $con->prepare($rolemenus);
			$stmtrolemenus->execute();
			$rowsrolemenus = $stmtrolemenus->fetchColumn();

			$stmtusersrole = $con->prepare($usersrole);
			$stmtusersrole->execute();
			$rowsusersrole = $stmtusersrole->fetchColumn();

			// $stmtroletasks = $con->prepare($roletasks);
			// $stmtroletasks->execute();
			// $rowsroletasks = $stmtroletasks->fetchColumn();

			$stmtrolerequest = $con->prepare($rolerequest);
			$stmtrolerequest->execute();
			$rowsrolerequest = $stmtrolerequest->fetchColumn();
			?></h1>
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4>
					<center>
						<i class="ace-icon fa fa-trash red"></i>
					Are You Sure to Activate the Role ?
					</center>
				</h4>
				<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data" action="">
					<fieldset>
						<input type="hidden" name="rolesId" value="<?php echo $rolesId; ?>">
						<div class="clearfix col-sm-9 col-sm-offset-2">
						<button type="submit" name="untrashRole" class="width-10 pull-right btn btn-sm btn-danger">
								<span class="bigger-110">Yes</span>
								<i class="ace-icon fa fa-trash icon-on-right"></i>
							</button>

						</div>
					</fieldset>
				</form>


			</div>
		</div>

	</div>
</div>