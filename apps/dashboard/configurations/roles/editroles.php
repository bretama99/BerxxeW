
<style type="text/css">
table ,tr td{
    border:1px solid red
}
tbody {
    display:block;
    height:400px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
thead {
    width: calc( 100% - 17px );/* scrollbar is average 1em/16px width, remove it from thead width */
}
table {
    width:400px;
}

</style>
<?php
if (isset($_GET['rolesId'])){
	$rolesId = $_GET['rolesId'];
}
if (!empty($rolesId)){
	?>
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		
		<div class="row">
			<div class="col-xs-12">
				 <?php include('common/messages/success_message.php');?>
				 <?php if(isset($_SESSION['error_roles'])){?>
					<div class="alert alert-block alert-danger" style="margin-left:50%;">
							<button type="button" class="close" data-dismiss="alert">
								&nbsp; <i class="ace-icon fa fa-times"></i>
							</button>
						<i class="ace-icon fa fa-check red"></i> &nbsp; <?php echo $_SESSION['error_roles'];?>
					</div>
					<?php
							unset($_SESSION['error_roles']);
						}?>
				 <div class="col-xs-12 col-sm-9">
					<div class="widget-box">
						<div class="widget-header">
							<h4 class="widget-title">Edit Roles </h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<form method="post" action="">
									<?php
										
										$R_query = "select * from roles where rolesId='$rolesId'";
										$R_stmt = $con->prepare($R_query);
										$R_success=$R_stmt->execute();
										$R_rows = $R_stmt->fetchAll();
										foreach ($R_rows as $row) {
											$rolesName=$row['rolesName'];
											$rolesDrescription=$row['rolesDrescription'];
										}
									?>

									<label for="form-field-8">Role Name</label>
									<input type="text" name="rolesName" id="form-field-3" value="<?php echo $rolesName;?>" placeholder="Role Name" class="form-control" required/>
									<input type="hidden" name="rolesId" value="<?php echo $rolesId;?>">
									<br>
									<label for="form-field-8">Description</label>
									<textarea name="rolesDrescription" class="form-control" id="form-field-8"><?php echo $rolesDrescription;?></textarea>
									<br>
										<table class="table table-stripped table-bordered" id="nessted_table">
											<thead>
												<tr>
													<th width="7%">No</th>
													<th width="26%">Menus</th>
													<th width="43%">Tasks</th>
													<th width="8%">View</th>
													<th width="8%">Add</th>
													<th width="8%">Edit</th>
													<th width="8%">Delete</th>
													
												</tr>
											</thead>
											<tbody>
											<?php
												
												$m_query = "select * from menus";
												$m_stmt = $con->prepare($m_query);
												$m_success=$m_stmt->execute();
												$m_rows = $m_stmt->fetchAll();
												$id = 0;
												foreach ($m_rows as $rowm) {
													$menusId=$rowm['menusId'];
													$menusTitle=$rowm['menusTitle'];
													$menusVarName=$rowm['menusVarName'];
													$Menu_Can_ViewM=$rowm['canView'];
													if (strpos($Menu_Can_ViewM, $rolesId) !== false){
													  $Menu_Can_View=1;
													 }
													 else{
													  $Menu_Can_View=0;
													 }
												  ?>
												<tr>
													<?php $id = $id + 1;?>
													<td width="7%"><?php  echo $id; ?></td>
													<td clospan="5"><b><input type="checkbox" name="<?php echo $menusVarName;?>" <?php if($Menu_Can_View == 1){echo 'checked="checked"';} ?> value="1"/> &nbsp; <?php  echo $menusTitle;?></b></td>
												</tr>
													<?php
													$t_query = "select * from tasks where menusId='$menusId'";
													$t_stmt = $con->prepare($t_query);
													$t_success=$t_stmt->execute();
													$t_rows = $t_stmt->fetchAll();
													foreach ($t_rows as $rowt) {
														$tasksId=$rowt['tasksId'];
														$tasksName=$rowt['tasksName'];
														$tasksVarName=$rowt['tasksVarName'];
														$Task_Can_ViewT=$rowt['canView'];
														$Task_Can_AddT=$rowt['canAdd'];
														$Task_Can_EditT=$rowt['canEdit'];
														$Task_Can_DeleteT=$rowt['canDelete'];
														
														if (strpos($Task_Can_ViewT, $rolesId) !== false){
														   $Task_Can_View=1;
														 }
														 else{
														   $Task_Can_View=0;
														 }
														 if (strpos($Task_Can_AddT, $rolesId) !== false){
														   $Task_Can_Add=1;
														 }
														 else{
														   $Task_Can_Add=0;
														 }
														 if (strpos($Task_Can_EditT, $rolesId) !== false){
														   $Task_Can_Edit=1;
														 }
														 else{
														   $Task_Can_Edit=0;
														 }
														 if (strpos($Task_Can_DeleteT, $rolesId) !== false){
														   $Task_Can_Delete=1;
														 }
														 else{
														   $Task_Can_Delete=0;
														 }
														
													 ?>
												<tr>
													<td width="7%"></td>
													<td width="26%"></td>
													<td width="43%"><?php echo $tasksName; ?></td>
													<td width="8%"><input type="checkbox" name="<?php echo $tasksVarName.'_V'; ?>" <?php if($Task_Can_View == 1){echo 'checked="checked"';} ?> value="1" /></td>
													<td width="8%"><input type="checkbox" name="<?php echo $tasksVarName.'_A'; ?>" <?php if($Task_Can_Add == 1){echo 'checked="checked"';} ?> value="1" /></td>
													<td width="8%"><input type="checkbox" name="<?php echo $tasksVarName.'_E'; ?>" <?php if($Task_Can_Edit == 1){echo 'checked="checked"';} ?> value="1" /></td>
													<td width="8%"><input type="checkbox" name="<?php echo $tasksVarName.'_D'; ?>" <?php if($Task_Can_Delete == 1){echo 'checked="checked"';} ?> value="1" /></td>
													<?php }?>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
									<?php if($canEdit=="1"){?>
									<button type="submit" name="editRole" class="btn btn-sm btn-success">
										<span class="bigger-110">Save</span><i class="ace-icon fa fa-save icon-on-right"></i>
									</button>
									<?php } ?>
								</form>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.span -->   
			</div>
    </div>
					
			     <?php		
						if (isset($_POST['editRole'])){
							
							$rolesName=$_POST['rolesName'];
							$rolesId=$_POST['rolesId'];
							$rolesDrescription=$_POST['rolesDrescription'];
							$Update_role_success=0;
							$Update_role_task_success=0;
							//$con->beginTransaction();
							$Update_query ="update roles set rolesName='$rolesName', rolesDrescription='$rolesDrescription' where rolesId='$rolesId' ";
							  $stmtUM = $con->prepare($Update_query);
							  $resultUM=$stmtUM->execute();
							  if($resultUM){
							  		$Update_role_success=1;
							  }	
							if($Update_role_success==1){
									$Role_menus_updated = 0;
									$m_query = "select * from menus";
									$m_stmt = $con->prepare($m_query);
									$m_success=$m_stmt->execute();
									$m_rows = $m_stmt->fetchAll();
									foreach ($m_rows as $row) {
										$menusId=$row['menusId'];
										$canViewM=$row['canView'];
										$menusVarName=$row['menusVarName'];
										if (isset($_POST["$menusVarName"])){
												if (strpos($canViewM, $rolesId) !== false){
												  $Menu_CanView=$canViewM;
												 }
												 else{
												  $Menu_CanView=$canViewM.','.$rolesId;
												 }
											}else{
											   $canViewMPosition=strpos($canViewM,$rolesId);
											   if($canViewMPosition==0){
											     $canViewM=str_replace($rolesId,"",$canViewM);
											   }else{
											      $canViewM=str_replace(','.$rolesId,"",$canViewM);
											     }
												  $firstCharacter = substr($canViewM, 0, 1);
													if($firstCharacter==','){
													$canViewM = substr($canViewM, 1);
													}
												
											    $Menu_CanView=$canViewM;
											}
										  $Update_queryMR ="update menus set canView='$Menu_CanView' where menusId='$menusId'";
										  $stmtUMR = $con->prepare($Update_queryMR);
										  $resultUMR=$stmtUMR->execute();
										  if($resultUMR){
												$Role_menus_updated = 1;
											 }
							           }
								if($Role_menus_updated ==1){
								    $t_query = "select * from tasks";
									$t_stmt = $con->prepare($t_query);
									$t_success=$t_stmt->execute();
									$t_rows = $t_stmt->fetchAll();
									foreach ($t_rows as $rowt) {
										$tasksId=$rowt['tasksId'];
										$tasksVarName=$rowt['tasksVarName'];
										$canViewT=$rowt['canView'];
										$canAddT=$rowt['canAdd'];
										$canEditT=$rowt['canEdit'];
										$canDeleteT=$rowt['canDelete'];
										
										$Task_V=$tasksVarName.'_V';
										$Task_A=$tasksVarName.'_A';
										$Task_E=$tasksVarName.'_E';
										$Task_D=$tasksVarName.'_D';
										
										 if (isset($_POST["$Task_V"])){
												if (strpos($canViewT, $rolesId) !== false){
												  $Task_CanView=$canViewT;
												 }
												 else{
													  if($canViewT==""){
													  $Task_CanView=$rolesId;
													  }
													  else{
													   $Task_CanView=$canViewT.','.$rolesId;
													  }
												 }
											}else{
											   $canViewPosition=strpos($canViewT,$rolesId);
											   if($canViewPosition==0){
											     $canViewT=str_replace($rolesId,"",$canViewT);
											   }else{
											      $canViewT=str_replace(','.$rolesId,"",$canViewT);
											     }
											     $firstCharacter = substr($canViewT, 0, 1);
												 if($firstCharacter==','){
												 $canViewT = substr($canViewT, 1);
												 }
											    $Task_CanView=$canViewT;
											} 
										 if (isset($_POST["$Task_A"])){
												if (strpos($canAddT, $rolesId) !== false){
												  $Task_CanAdd=$canAddT;
												 }
												 else{
												     if($canAddT==""){
													  $Task_CanAdd=$rolesId;
													  }
												   else{
													  $Task_CanAdd=$canAddT.','.$rolesId;
													 }
												 }
											}else{
											  $canAddPosition=strpos($canAddT,$rolesId);
											   if($canAddPosition==0){
											     $canAddT=str_replace($rolesId,"",$canAddT);
											   }else{
											      $canAddT=str_replace(','.$rolesId,"",$canAddT);
											     }
											    $firstCharacter = substr($canAddT, 0, 1);
												 if($firstCharacter==','){
												 $canAddT = substr($canAddT, 1);
												 }
											   $Task_CanAdd=$canAddT;
											}
										if (isset($_POST["$Task_E"])){
												if (strpos($canEditT, $rolesId) !== false){
												  $Task_CanEdit=$canEditT;
												 }
												 else{
												  if($canEditT==""){
													  $Task_CanEdit=$rolesId;
													  }
													  else{
													   $Task_CanEdit=$canEditT.','.$rolesId;
													   }
												 }
											}else{
											   $canEditPosition=strpos($canEditT,$rolesId);
											   if($canEditPosition==0){
											     $canEditT=str_replace($rolesId,"",$canEditT);
											   }else{
											      $canEditT=str_replace(','.$rolesId,"",$canEditT);
											     }
											   $firstCharacter = substr($canEditT, 0, 1);
												 if($firstCharacter==','){
												 $canEditT = substr($canEditT, 1);
												 }
											   $Task_CanEdit=$canEditT;
											}
										if (isset($_POST["$Task_D"])){
												if (strpos($canDeleteT, $rolesId) !== false){
												  $Task_CanDelete=$canDeleteT;
												 }
												 else{
												    if($canDeleteT==""){
													  $Task_CanDelete=$rolesId;
													  }
													else{
												     $Task_CanDelete=$canDeleteT.','.$rolesId;
													} 
												 }
											}else{
											   $canDeletePosition=strpos($canDeleteT,$rolesId);
											   if($canDeletePosition==0){
											     $canDeleteT=str_replace($rolesId,"",$canDeleteT);
											   }else{
											      $canDeleteT=str_replace(','.$rolesId,"",$canDeleteT);
											     }
											  $firstCharacter = substr($canDeleteT, 0, 1);
												 if($firstCharacter==','){
												 $canDeleteT = substr($canDeleteT, 1);
												 }
											  $Task_CanDelete=$canDeleteT;
											}
										  
										  $Update_queryRT ="update tasks set canView='$Task_CanView',canAdd='$Task_CanAdd',canEdit='$Task_CanEdit',canDelete='$Task_CanDelete'  where tasksId='$tasksId'";
										  $stmtURT = $con->prepare($Update_queryRT);
										  $resultURT=$stmtURT->execute();
										  if($resultURT ){
										   $Update_role_task_success=1;
										  }
									  }
							      }
							}
							if($Update_role_task_success ==1 ){
									$_SESSION['success'] = 'set';
									  header("location:index.php?name=configurations/roles/roles&var=roles");
								}
						}
														
				?>
	
<?php 
}else {
	  header("location:index.php?name=configurations/roles/roles&var=roles");
   }	  	 
?>