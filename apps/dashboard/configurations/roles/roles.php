<?php if ($canView == "1") { ?>
	<div class="row">


		<div class="col-xs-12">
		<div class="tabbable">
		<ul class="nav nav-tabs" id="myTab">

						<li class="active">
							<a href="#active" aria-controls="active" role="tab" data-toggle="tab">
								<i class="green ace-icon fa fa-user bigger-120"></i>
								Active Roles
								<span class="badge badge-warning"></span>
							</a>
						</li>

						<li>
							<a data-toggle="tab" href="#trash" aria-controls="trash" role="tab">
								<i class="orange ace-icon fa fa-user bigger-120"></i>
								Trashed
								<span class="badge badge-success"></span>
							</a>
						</li>
					</ul>


		<div class="tab-content">
			<div id="active" class="tab-pane fade in active" role="tabpanel">
				<div class="row">
					<div class="col-xs-12">
			<?php include('common/messages/success_message.php'); ?>
			<?php if (isset($_SESSION['error_roles'])) { ?>
				<div class="alert alert-block alert-danger" style="margin-left:50%;">
					<button type="button" class="close" data-dismiss="alert">
						&nbsp; <i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-check red"></i> &nbsp; <?php echo $_SESSION['error_roles']; ?>
				</div>
			<?php
				unset($_SESSION['error_roles']);
			} ?>

			<div class="clearfix">

				<div class="pull-left tableTools-container">
					<?php
					if ($canAdd == "1") {
					?>
						<a href="index.php?name=configurations/roles/addroles&var=roles">
							<button type="button" class="btn btn-success"> <i class="ace-icon fa fa-plus"></i>&nbsp;Add New Role</button>
						</a>
					<?php } ?>
				</div>
			</div>

			<table id="active1" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Role Name</th>
						<th>Description</th>
						<th>View|Edit</th>
					</tr>
				</thead>

				<tbody>
					<?php

					$R_query = "select * from roles where isDeleted='0'order by rolesId ";
					$R_stmt = $con->prepare($R_query);
					$R_success = $R_stmt->execute();
					$R_rows = $R_stmt->fetchAll();
					$id = 0;
					foreach ($R_rows as $row) {
						$rolesId = $row['rolesId'];
						$rolesName = $row['rolesName'];
						$rolesDrescription = $row['rolesDrescription'];
					?>
						<tr>
							<?php $id = $id + 1; ?>
							<td><?php echo $id; ?></td>
							<td><?php echo $rolesName; ?></td>
							<td><?php echo $rolesDrescription; ?></td>
							<td>
								<a href="index.php?name=configurations/roles/editroles&var=roles&rolesId=<?php echo $rolesId; ?>" class="green">
									<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
								</a>
								<?php
								if ($canDelete == "1" && $rolesName!='Admin' && $rolesName!='Physician' && $rolesName!='Pharmacist'&&$rolesName!='Pharmacy Owner' && $rolesName!='Patient') {
								?>
									<a href='' data-toggle="modal" data-target="#deleteRole<?php echo $rolesId; ?>" class='red'><i class='ace-icon fa fa-trash-o bigger-120'></i> </a>
							</td>
						<?php }
								include("configurations/roles/views/modaldeleterole.php");
						?>
						</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>
		</div>
	</div>

				<div id="trash" class="tab-pane fade in" role="tabpanel">
				<div class="row">
					<div class="col-xs-12">



		<?php include('common/messages/success_message.php'); ?>
			<?php if (isset($_SESSION['error_roles'])) { ?>
				<div class="alert alert-block alert-danger" style="margin-left:50%;">
					<button type="button" class="close" data-dismiss="alert">
						&nbsp; <i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-check red"></i> &nbsp; <?php echo $_SESSION['error_roles']; ?>
				</div>
			<?php
				unset($_SESSION['error_roles']);
			} ?>

			<table id="trash1" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Role Name</th>
						<th>Description</th>
						<th>View|Edit</th>
					</tr>
				</thead>

				<tbody>
					<?php

					$R_query = "select * from roles where isDeleted='1'order by rolesId ";
					$R_stmt = $con->prepare($R_query);
					$R_success = $R_stmt->execute();
					$R_rows = $R_stmt->fetchAll();
					$id = 0;
					foreach ($R_rows as $row) {
						$rolesId = $row['rolesId'];
						$rolesName = $row['rolesName'];
						$rolesDrescription = $row['rolesDrescription'];
					?>
						<tr>
							<?php $id = $id + 1; ?>
							<td><?php echo $id; ?></td>
							<td><?php echo $rolesName; ?></td>
							<td><?php echo $rolesDrescription; ?></td>
							<td>
						
								<?php
								if ($canDelete == "1") {
								?>
									<a href='' data-toggle="modal" data-target="#untrashRole<?php echo $rolesId; ?>" class='red'><i class='ace-icon fa fa-undo bigger-120'></i> </a>
							</td>
						<?php }
								include("configurations/roles/views/modaldeleterole.php");
						?>
						</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

					</div>
						</div>
					</div>
</div>
		</div>
	</div>
	<?php
	if (isset($_POST['deleteRole'])) {
		$rolesId = $_POST['rolesId'];
		$Add_query = "update roles set isDeleted='1' where rolesId='$rolesId' ";
		$stmtAddC = $con->prepare($Add_query);
		$resultC = $stmtAddC->execute();
		if ($resultC) {

			$_SESSION['success'] = 'set';
			header("location: index.php?name=configurations/roles/roles&var=roles");
		}
	}

		if (isset($_POST['untrashRole'])) {
		$rolesId = $_POST['rolesId'];
		$Add_query = "update roles set isDeleted='0' where rolesId='$rolesId' ";
		$stmtAddC = $con->prepare($Add_query);
		$resultC = $stmtAddC->execute();
		if ($resultC) {

			$_SESSION['success'] = 'set';
			header("location: index.php?name=configurations/roles/roles&var=roles");
		}
	}
	?>
<?php } else {
	header("location: index.php?name=dashboard/home&var=home");
}
?>



<script type="text/javascript">
    $(document).ready(function(){
   $('#active1').DataTable({
      responsive: true
   });

   $('#trash1').DataTable({
      responsive: true
   });
   


   $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .responsive.recalc();
   });   
   
});
</script>

<style type="text/css">
    .tab-content {
  padding:10px;
  border-left:1px solid #DDD;
  border-bottom:1px solid #DDD;
  border-right:1px solid #DDD;
}
</style>
