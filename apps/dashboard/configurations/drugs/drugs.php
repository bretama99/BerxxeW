<?php if ($canView == "1") { ?>
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
				if ($canAdd == "1") {
				?>
					<div id="addButton" class="pull-left tableTools-container">
						<button style="border-radius: 10px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addDrug"> <i class="ace-icon fa fa-plus"></i>&nbsp;Add New Drug</button>
					</div>

					<div id="" class="pull-left tableTools-container">
						&nbsp; <button style="border-radius: 10px;" type="button" class="btn btn-info" data-toggle="modal" data-target="#importButton"> <i class="ace-icon fa fa-file-o"></i>&nbsp;Import Drugs From Exel</button>
					</div>
				<?php
					include("configurations/drugs/views/modaladddrug.php");
					include("configurations/drugs/views/modalimportdrug.php");
				}
				?>
			</div>
			<table id="example" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Drug Name</th>
						<th>Dosage Form</th>
						<th>Strength</th>
						<th>Volume</th>
						<th>Category</th>
						<th>Sub Category</th>
						<th>Brand Name</th>
						<th>Unit</th>
						<th>Drug Status</th>
						<th>Actions</th>
						<!-- <th width="100px"> </th> -->
					</tr>
				</thead>
				<tbody>
					<?php
					$C_query = "select * from drugs where isDeleted=0 order by drugsId DESC";
					$C_stmt = $con->prepare($C_query);
					$C_success = $C_stmt->execute();
					$C_rows = $C_stmt->fetchAll();
					$id = 0;
					foreach ($C_rows as $row) {
						$drugsId = $row['drugsId'];
						$drugsName = $row['drugsName'];
						$dosageForm = $row['dosageForm'];	
						$strength = $row['strength'];
						$volume = $row['volume'];
						$category = $row['category'];	
						$subCategory = $row['subCategory'];
						$brandName = $row['brandName'];
						$unit = $row['unit'];
						$drugsStatus = $row['drugsStatus'];
						$id = $id + 1;
					?>
						<tr>
							<td><?php echo $id; ?></td>
							<td><?php echo $drugsName; ?></td>
							<td><?php echo $dosageForm; ?></td>
							<td><?php echo $strength; ?></td>
							<td><?php echo $volume; ?></td>
							<td><?php echo $category; ?></td>
							<td><?php echo $subCategory; ?></td>
							<td><?php echo $brandName; ?></td>
							<td><?php echo $unit; ?></td>
							<td>
								<?php
								if ($drugsStatus == '1') {
									echo '<span class="label label-success arrowed">Active</span>';
								} else if ($drugsStatus == '0') {
									echo '<span class="label label-danger arrowed">Inactive</span>';
								}
								?>
							</td>
							<td>
								<?php
								if ($canEdit == "1") {
								?>
									<a href='' data-toggle="modal" data-target="#editDrug<?php echo $drugsId; ?>" class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i> </a>

									<a href='' data-toggle="modal" data-target="#drugFormulary<?php echo $drugsId; ?>" class='green'>
										<i title="Add drug formulary" class='ace-icon fa fa-plus bigger-120'></i> </a>


							</td>
						<?php } ?>
						<?php
						include("configurations/drugs/views/modaleditdrug.php");
						include("configurations/drugs/views/modaladdformulary.php");
						?>
						</tr>
					<?php } ?>


				</tbody>
			</table>
		</div>
	</div>

	<?php
	if (isset($_POST['addDrug'])) {
		$drugsName = $_POST['drugsName'];
		$dosageForm = $_POST['dosageForm'];
		$strength = $_POST['strength'];
		$volume = $_POST['volume'];
		$brandName = $_POST['brandName'];
		$unit = $_POST['unit'];
		$category = $_POST['category'];
		$subCategory = $_POST['subCategory'];

		$checkDrug = "select count(*) from drugs where drugsName = '$drugsName' AND isDeleted='0'";
		$stmtD = $con->prepare($checkDrug);
		$stmtD->execute();
		$rowsD = $stmtD->fetchColumn();
		if ($rowsD == 0) { // count num rows here must be zero

			$Add_query = "insert into drugs (drugsName,dosageForm,strength,volume,brandName,unit,category,subCategory) 
			values('$drugsName','$dosageForm','$strength','$volume','$brandName','$unit','$category','$subCategory')";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {
				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/drugs/drugs&var=drugs");
			}
		} else {
			$_SESSION['error'] = 'Drug name already exists. Try another ! ';
			header("location: index.php?name=configurations/drugs/drugs&var=drugs");
		}
	}

	if (isset($_POST['importDrug'])) {

		require_once('common/spreadsheet/php-excel-reader/excel_reader2.php');
		require_once('common/spreadsheet/SpreadsheetReader.php');
		$allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

		if (in_array($_FILES["file"]["type"], $allowedFileType)) {

			$targetPath = '../../files/' . $_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

			$Reader = new SpreadsheetReader($targetPath);

			$sheetCount = count($Reader->sheets());

			for ($i = 0; $i < $sheetCount; $i++) {
				$Reader->ChangeSheet($i);

				foreach ($Reader as $Row) {

					$drugName = "";
					if (isset($Row[0])) {
						$drugN = $Row[0];
						$drugName = preg_replace("/\r|\n/", " ", $drugN);
					}

					$indications = "";
					if (isset($Row[1])) {
						$indications = $Row[1];
					}

					$cautions = "";
					if (isset($Row[2])) {
						$cautions = $Row[2];
					}

					$drugInteractions = "";
					if (isset($Row[3])) {
						$drugInteractions = $Row[3];
					}

					$contraindications = "";
					if (isset($Row[4])) {
						$contraindications = $Row[4];
					}

					$sideEffects = "";
					if (isset($Row[5])) {
						$sideEffects = $Row[5];
					}

					$doseAndAdministration = "";
					if (isset($Row[6])) {
						$doseAndAdministration = $Row[6];
					}

					$storage = "";
					if (isset($Row[7])) {
						$storage = $Row[7];
					}

					$dosageForm = "";
		            if (isset($Row[8])) {
						$dosageForm = $Row[8];
					}

					$strength = "";
					if (isset($Row[9])) {
						$strength = $Row[9];
					}

					$volume = "";
					if (isset($Row[10])) {
						$volume = $Row[10];
					}
					$brandName = "";
					if (isset($Row[11])) {
						$brandName = $Row[11];
					}
					$unit = "";
					if (isset($Row[12])) {
						$unit = $Row[12];
					}
					$category = "";
					if (isset($Row[13])) {
						$category = $Row[13];
					}

					$subCategory = "";
					if (isset($Row[14])) {
						$subCategory = $Row[14];
					}



					if (!empty($drugName)) {
						// $con->beginTransaction();
						$checkDrug = "select drugsId from drugs where drugsName = '$drugName' AND isDeleted='0'";
						$stmtD = $con->prepare($checkDrug);
						$stmtD->execute();
						$count = $stmtD->rowCount();
						if ($count == 0) { // count num rows here must be zero
							$Add_query = "insert into drugs (drugsName,dosageForm,strength,volume,brandName,unit,category,subCategory) values('$drugName','$dosageForm','$strength','$volume','$brandName','$unit','$category','$subCategory')";
							$stmtAddC = $con->prepare($Add_query);
							$resultC = $stmtAddC->execute();
							//$count1 = $resultC->rowCount();
							if ($resultC) {
								$drugsId = $con->lastInsertId();

								/* $query ="insert into drugformulary (drugsId,indications,cautions,contraindications,drugInteractions,sideEffects,doseAndAdministration,storage) 
										 values('$drugsId','$indications','$cautions','$contraindications','$drugInteractions','$sideEffects','$doseAndAdministration','$storage')";
								$stmt = $con->prepare($query);
								$result=$stmt->execute();
								if($result){
									// $con->commit();
									$_SESSION['success'] = 'set';
									header("location: index.php?name=config/drugs&var=drugs");
								} */
								$query = 'INSERT INTO drugformulary(drugsId,indications,cautions,contraindications,drugInteractions,sideEffects,doseAndAdministration,storage) 
										VALUES(:drugsId,:indications,:cautions,:contraindications,:drugInteractions,:sideEffects,:doseAndAdministration,:storage)';

								$stmt = $con->prepare($query);
								$stmt->bindValue(':drugsId', $drugsId);
								$stmt->bindValue(':indications', $indications);
								$stmt->bindValue(':cautions', $cautions);
								$stmt->bindValue(':contraindications', $contraindications);
								$stmt->bindValue(':drugInteractions', $drugInteractions);
								$stmt->bindValue(':sideEffects', $sideEffects);
								$stmt->bindValue(':doseAndAdministration', $doseAndAdministration);
								$stmt->bindValue(':storage', $storage);
								$result = $stmt->execute();
								if ($result) {
									// $con->commit();
									$_SESSION['success'] = 'set';
									header("location: index.php?name=configurations/drugs/drugs&var=drugs");
								}
							}
						}
					}
				}
			}
		} else {
			$type = "error";
			$message = "Invalid File Type. Upload Excel File.";
		}
		/* $drugsName=$_POST['drugsName'];
	$drugsStrength=$_POST['drugsStrength'];
	$checkDrug= "select count(*) from drugs where drugsName = '$drugsName' AND isDeleted='0'";
	$stmtD = $con->prepare($checkDrug);
	$stmtD->execute();
	$rowsD = $stmtD->fetchColumn(); 
	if($rowsD ==0){ // count num rows here must be zero
				
	 $Add_query ="insert into drugs (drugsName,drugsStrength) values('$drugsName','$drugsStrength')";
		  $stmtAddC = $con->prepare($Add_query);
		  $resultC=$stmtAddC->execute();
		  if($resultC){
						$_SESSION['success'] = 'set';
						header("location: index.php?name=config/drugs&var=drugs");
					}
		}
	else{
		 $_SESSION['error'] = 'Drug name already exists. Try another ! ';
		 header("location: index.php?name=config/drugs&var=drugs");
		} */
	}

	if (isset($_POST['drugFormulary'])) {
		$drugsId = $_POST['drugsId'];
		$doseAndAdministration = $_POST['doseAndAdministration'];
		$contraindications = $_POST['contraindications'];
		$cautions = $_POST['cautions'];
		$interactions = $_POST['interactions'];
		$sideEffects = $_POST['sideEffects'];
		$indications = $_POST['indications'];
		$storage = $_POST['storage'];

		$checkD = "select count(*) from drugformulary where drugsId = '$drugsId'";
		$stmtP = $con->prepare($checkD);
		$stmtP->execute();
		$rowsP = $stmtP->fetchColumn();
		if ($rowsP > 0) { // count num rows here must be zero				
			$Add_query = "update drugformulary set indications='$indications', cautions='$cautions', contraindications='$contraindications', drugInteractions='$interactions', sideEffects='$sideEffects', doseAndAdministration='$doseAndAdministration', storage='$storage' where drugsId='$drugsId'";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {
				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/drugs/drugs&var=drugs");
			}
		}
		else{
			$query="insert into drugformulary (drugsId,indications,cautions,contraindications,
			drugInteractions,sideEffects,doseAndAdministration,storage) 

			values('$drugsId','$indications','$cautions','$contraindications','$interactions','$sideEffects','$doseAndAdministration','$storage')";
			$stmtAddC = $con->prepare($query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {
				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/drugs/drugs&var=drugs");
			}

		}
		
	}


		if (isset($_POST['editDrug'])) {

		$drugsId = $_POST['drugsId'];
		$drugsName = $_POST['drugsName'];
		$dosageForm = $_POST['dosageForm'];
		$strength = $_POST['strength'];
		$volume = $_POST['volume'];
		$brandName = $_POST['brandName'];
		$unit = $_POST['unit'];
		$category = $_POST['category'];
		$subCategory = $_POST['subCategory'];

		$checkD = "select count(*) from drugs where drugsName = '$drugsName' AND drugsId!='$drugsId' AND isDeleted=0";
		$stmtP = $con->prepare($checkD);
		$stmtP->execute();
		$rowsP = $stmtP->fetchColumn();
		if ($rowsP == 0) { // count num rows here must be zero				
			$Add_query = "update drugs set drugsName='$drugsName', dosageForm='$dosageForm', strength='$strength', volume='$volume', brandName='$brandName', unit='$unit', category='$category', subCategory='$subCategory' where drugsId='$drugsId'";
			$stmtAddC = $con->prepare($Add_query);
			$resultC = $stmtAddC->execute();
			if ($resultC) {
				$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/drugs/drugs&var=drugs");
			}
		} else {
			$_SESSION['success'] = 'Drug name already existssss. Try another ! ';
			header("location: index.php?name=configurations/drugs/drugs&var=drugs");
		}
	}

	if (isset($_POST['deleteDrug'])) {
		$drugsId = $_POST['drugsId'];
		$Add_query = "update drugs set isDeleted='1' where drugsId='$drugsId' ";
		$stmtAddC = $con->prepare($Add_query);
		$resultC = $stmtAddC->execute();
		if ($resultC) {
			$_SESSION['success'] = 'set';
			header("location: index.php?name=configurations/drugs/drugs&var=drugs");
		}
	}
	?>
<?php } else {
	header("location: index.php");
}
?>