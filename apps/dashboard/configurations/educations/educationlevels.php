<?php  if($canView=="1"){ ?>
<div class="row">
	<div class="col-xs-12">
		
			<?php include('common/messages/success_message.php'); ?>
			<?php if(isset($_SESSION['success'])){?>
			   <div class="alert alert-block alert-success" style="margin-left:40%;">
					<button type="button" class="close" data-dismiss="alert">
						&nbsp; <i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-check green"></i> &nbsp; <?php echo $_SESSION['success'];?>
				</div>
				<?php
						unset($_SESSION['success']);
			      }	
				if(isset($_SESSION['error'])){?>
			   <div class="alert alert-block alert-danger" style="margin-left:40%;">
					<button type="button" class="close" data-dismiss="alert">
						&nbsp; <i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-check red"></i> &nbsp; <?php echo $_SESSION['error'];?>
				</div>
				<?php
						unset($_SESSION['error']);
				}?>
		<div class="clearfix">
		
			<?php 
			 if($canAdd=="1"){
			?>
        <div id="addButton" class="pull-left tableTools-container">		
	    	<button style="border-radius: 6px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addEducationLevel"> <i class="ace-icon fa fa-plus"></i>&nbsp;Add New Education Level</button>
		</div>
			<?php 
include("configurations/educations/views/modaladdeducationlevel.php");			
			}?>
		
	   </div>
    <table id="example" class="table table-striped table-bordered table-hover">
    <thead>
		<tr>
			<th>#</th>
			<th>Education Level Name</th>
			<th>Action</th>
		</tr>
	 </thead>
	 <tbody>
	    <?php
			$C_query = "select * from educationallevel where isDeleted=0 order by educationLevelName";

			$C_stmt = $con->prepare($C_query);
			$C_success=$C_stmt->execute();
			$C_rows = $C_stmt->fetchAll();
			$id = 0;
			foreach ($C_rows as $row) {
				$educationalLevelId=$row['educationalLevelId'];

				$educationLevelName=$row['educationLevelName'];
				$id = $id+1;
				?>
		<tr>
	     <td><?php echo $id;?></td>
	     <td><?php echo $educationLevelName;?></td>
	     <td>
		 <?php 
		if($canEdit=="1"){
				?>
		 <a href='' data-toggle="modal" data-target="#editEducationLevel<?php echo $educationalLevelId;?>" class='green'><i class='ace-icon fa fa-pencil-square-o bigger-120'></i> </a>
			<?php }
		if($canDelete=="1"){
			?>

		 <a href='' data-toggle="modal" data-target="#deleteEducationLevel<?php 

		 echo $educationalLevelId;?>"class='red'>
		 <i class='ace-icon fa fa-trash-o bigger-120'></i> </a> 
		 </td>
		<?php }?>
		 <?php 
						include("configurations/educations/views/modalediteducationlevel.php");
		 ?>
	   </tr>
	  <?php }?>

	 </tbody>
    </table>
</div>
</div>
						
<?php
 if (isset($_POST['addeducationLevel'])){
	$educationLevelName=$_POST['educationLevelName'];
	$checkEL= "select count(*) from educationallevel where educationLevelName = '$educationLevelName' AND isDeleted='0'";
	$stmtP = $con->prepare($checkEL);
	$stmtP->execute();
	$rowsP = $stmtP->fetchColumn(); 
	if($rowsP ==0){ // count num rows here must be zero
				
	 $Add_query ="insert into educationallevel (educationLevelName,addedById) values('$educationLevelName','$usrUsersId')";
		  $stmtAddC = $con->prepare($Add_query);
		  $resultC=$stmtAddC->execute();
		  if($resultC){

						$_SESSION['success'] = 'set';
header("location: index.php?name=configurations/educations/educationlevels&var=educationLevels");					
					
					}
		}
	else{
		 $_SESSION['error'] = 'Education level name already exists. Try another ! ';
header("location: index.php?name=configurations/educations/educationlevels&var=educationLevels");
		}

}

if (isset($_POST['editeducationLevel'])){
	$educationalLevelId=$_POST['educationalLevelId'];
	echo $educationalLevelId;
    print($educationalLevelId);
	$educationLevelName=$_POST['educationLevelName'];
	$checkEL= "select count(*) from educationallevel where educationLevelName = '$educationLevelName' AND educationalLevelId!='$educationalLevelId' AND isDeleted='0'";
	$stmtP = $con->prepare($checkEL);
	$stmtP->execute();
	$rowsP = $stmtP->fetchColumn(); 
	if($rowsP ==0){ // count num rows here must be zero
				
	 $Add_query ="update educationallevel set educationLevelName='$educationLevelName' where educationalLevelId='$educationalLevelId'";
		  $stmtAddC = $con->prepare($Add_query);
		  $resultC=$stmtAddC->execute();
		  if($resultC){

						$_SESSION['success'] = 'set';
				header("location: index.php?name=configurations/educations/educationlevels&var=educationLevels");
					
					}
		}
	else{
		 $_SESSION['error'] = 'Education level name already exists. Try another ! ';
			header("location: index.php?name=configurations/educations/educationlevels&var=educationLevels");
		}

}


if (isset($_POST['deleteEducationLevel'])){
	$educationalLevelId=$_POST['educationalLevelId'];	

	 $D_query ="update educationallevel set isDeleted='1' where educationalLevelId='$educationalLevelId' ";
	  echo $D_query;
		  $stmtD = $con->prepare($D_query);
		  $resultC=$stmtD->execute();
		  if($resultC){

						$_SESSION['success'] = 'set';
						header("location: index.php?name=configurations/educations/educationlevels&var=educationLevels");							
					}
		}
?>
<?php }
else{
	header("location: index.php");
}
?>