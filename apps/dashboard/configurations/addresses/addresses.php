<?php if ($canView == "1") {
?>
	<div class="row">
		<div class="col-xs-12">
			<?php include('common/messages/success_message.php'); ?>
			<?php if (isset($_SESSION['success'])) { ?>
				<div class="alert alert-block alert-success" style="margin-left:40%;">
					<button type="button" class="close" data-dismiss="alert">
						&nbsp; <i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-check green"></i> &nbsp; <?php echo $_SESSION['success']; ?>
				</div>
			<?php
				unset($_SESSION['success']);
			}
			if (isset($_SESSION['error'])) { ?>
				<div class="alert alert-block alert-danger" style="margin-left:40%;">
					<button type="button" class="close" data-dismiss="alert">
						&nbsp; <i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-check red"></i> &nbsp; <?php echo $_SESSION['error']; ?>
				</div>
			<?php
				unset($_SESSION['error']);
			} ?>
			<div class="clearfix">
				<?php
				if ($canAdd == 1) {
				?>
					<div id="addButton" class="pull-left tableTools-container">
						<button style="border-radius: 6px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#add_country"> <i class="ace-icon fa fa-plus"></i>&nbsp;Add New Country</button>
					</div>
				<?php
					include("configurations/addresses/views/modal_add_address.php");
				} ?>

			</div>
			<div class="alert alert-success">
				<div class="clearfix">
					<label class="col-xs-10 col-sm-1 control-label ">Country</label>
					<div class="col-xs-12 col-sm-3">
						<span class="block input-icon input-icon-right">
							<select name="country" class="form-control" data-rel="tooltip" title="Select country...." id="country" onchange="display_states(this.options[this.selectedIndex].value,this.options[this.selectedIndex].text,'state');">
								<option value=""> ... Select Country...</option>
								<?php
								$C_query = "select * from country where isDeleted=0 order by countryName";
								$C_stmt = $con->prepare($C_query);
								$C_success = $C_stmt->execute();
								$C_rows = $C_stmt->fetchAll();
								$id = 0;
								foreach ($C_rows as $row) {
									$countryId = $row['countryId'];
									$countryName = $row['countryName'];
									$id = $id + 1;
								?>
									<option value="<?php echo $countryId; ?>"> <?php echo $countryName; ?></option>
								<?php } ?>
							</select>
							<i class="ace-icon fa fa-map-marker"></i>
							<input type="hidden" name="selected_country" id="selected_country" value="" />
						</span>
					</div>

					<label for="inputInfo" class="col-xs-12 col-sm-1 control-label ">State</label>
					<div class="col-xs-12 col-sm-3">
						<span class="block input-icon input-icon-right">
							<select name="state" class="form-control" data-rel="tooltip" title="Select state...." id="state" onchange="display_zones(this.options[this.selectedIndex].value,this.options[this.selectedIndex].text,'zone');">
								<option value=""> ... Select State...</option>
							</select>
							<i class="ace-icon fa fa-map-marker"></i>
							<input type="hidden" name="selected_state" id="selected_state" value="" />
						</span>
					</div>
					<label for="inputInfo" class="col-xs-12 col-sm-1 control-label ">Zone</label>
					<div class="col-xs-12 col-sm-3">
						<span class="block input-icon input-icon-right">
							<select name="zone" class="form-control" data-rel="tooltip" title="Select zone...." id="zone" onchange="display_woredas(this.options[this.selectedIndex].value,this.options[this.selectedIndex].text,'woreda');">
								<option value=""> ... Select Zone...</option>
							</select>
							<i class="ace-icon fa fa-map-marker"></i>
							<input type="hidden" name="selected_zone" id="selected_zone" value="" />
						</span>
					</div>
				</div>
			</div>
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th id="th1">Country Name</th>
						<th> </th>
					</tr>
				</thead>
				<tbody id="tableBody">
					<?php
					$C_query = "select * from country where isDeleted=0 order by countryName";
					$C_stmt = $con->prepare($C_query);
					$C_success = $C_stmt->execute();
					$C_rows = $C_stmt->fetchAll();

					$id = 0;
					foreach ($C_rows as $row) {
						$countryId = $row['countryId'];
						$countryName = $row['countryName'];
						$id = $id + 1;
					?>
						<tr>
							<td><?php echo $id; ?></td>
							<td><?php echo $countryName; ?></td>
							<td>
								<a href='' data-toggle="modal" data-target="#edit_country<?php echo $countryId; ?>" class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i> </a>
								<a href='' data-toggle="modal" data-target="#deleteCountry<?php echo $countryId; ?>" class='red'>
									<i class='ace-icon fa fa-trash-o bigger-120'></i> </a>
								<?php
								//include("configurations/addresses/views/modal_add_edit_delete_country.php");
								?>

							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php include('configurations/addresses/views/displayaddresses.php'); ?>
	<?php
	if (isset($_POST['addCountry'])) {

		$countryName = $_POST['countryName'];
		$checkCountry = "select count(*) from country where countryName = '$countryName' AND isDeleted='0'";
		$stmtP = $con->prepare($checkCountry);
		$stmtP->execute();
		$rowsP = $stmtP->fetchColumn();
		if ($rowsP == 0) { // count num rows here must be zero

			$Add_query = "insert into country (countryName) values('$countryName')";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {

				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/addresses/addresses&var=addresses");
			}
		} else {
			$_SESSION['error'] = 'Country name already exists. Try another ! ';
			header("location: index.php?name=configurations/addresses/addresses&var=addresses");
		}
	}

	if (isset($_POST['editState'])) {

		$stateName = $_POST['stateName'];
		$countryId = $_POST['countryId'];
		$checkCountry = "select count(*) from state where stateName = '$stateName' AND countryId ='$countryId' AND isDeleted='0'";
		$stmtP = $con->prepare($checkCountry);
		$stmtP->execute();
		$rowsP = $stmtP->fetchColumn();
		if ($rowsP == 0) { // count num rows here must be zero

			$Add_query = "update state set stateName='$stateName' where countryId='$countryId' ";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {

				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/addresses/addresses&var=addresses");
			}
		} else {
			$_SESSION['error'] = 'State name already exists. Try another ! ';
			header("location: index.php?name=configurations/addresses/addresses&var=addresses");
		}
	}

	if (isset($_POST['deleteCountry'])) {
		$countryId = $_POST['countryId'];

		$D_query = "update country set isDeleted='1' where countryId='$countryId' ";
		echo $D_query;
		$stmtD = $con->prepare($D_query);
		$resultC = $stmtD->execute();
		if ($resultC) {

			$_SESSION['success'] = 'set';
			header("location: index.php?name=configurations/addresses/addresses&var=addresses");
		}
	}

	if (isset($_POST['addState'])) {

		$countryId = $_POST['countryId'];
		$stateName = $_POST['stateName'];
		$check = "select count(*) from state where stateName = '$stateName' AND countryId='$countryId' AND isDeleted='0'";
		$stmtP = $con->prepare($check);
		$stmtP->execute();
		$rowsP = $stmtP->fetchColumn();
		if ($rowsP == 0) { // count num rows here must be zero

			$Add_query = "insert into state (countryId,stateName) values('$countryId','$stateName')";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {

				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/addresses/addresses&var=addresses");
			}
		} else {
			$_SESSION['error'] = 'State name already exists. Try another ! ';
			header("location: index.php?name=configurations/addresses/addresses&var=addresses");
		}
	}


	if (isset($_POST['addZone'])) {

		$stateId = $_POST['stateId'];
		$zoneName = $_POST['zoneName'];
		$check = "select count(*) from zone where zoneName = '$zoneName' AND stateId='$stateId' AND isDeleted='0'";
		$stmtP = $con->prepare($check);
		$stmtP->execute();
		$rowsP = $stmtP->fetchColumn();
		if ($rowsP == 0) { // count num rows here must be zero

			$Add_query = "insert into zone (stateId,zoneName) values('$stateId','$zoneName')";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {

				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/addresses/addresses&var=addresses");
			}
		} else {
			$_SESSION['error'] = 'Zone name already exists. Try another ! ';
			header("location: index.php?name=configurations/addresses/addresses&var=addresses");
		}
	}
	if (isset($_POST['addWoreda'])) {

		$zoneId = $_POST['zoneId'];
		$woredaName = $_POST['woredaName'];
		$check = "select count(*) from woreda where woredaName = '$woredaName' AND zoneId='$zoneId' AND isDeleted='0'";
		$stmtP = $con->prepare($check);
		$stmtP->execute();
		$rowsP = $stmtP->fetchColumn();
		if ($rowsP == 0) {
			$Add_query = "insert into woreda (zoneId,woredaName) values('$zoneId','$woredaName')";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {

				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/addresses/addresses&var=addresses");
			}
		} else {
			$_SESSION['error'] = 'Woreda name already exists. Try another ! ';
			header("location: index.php?name=configurations/addresses/addresses&var=addresses");
		}
	}
	?>
<?php } else {
	header("location: index.php");
}
?>