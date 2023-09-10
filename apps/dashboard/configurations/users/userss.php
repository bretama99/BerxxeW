<?php  if($canView=="1"){ ?>
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		
		<div class="row">
			<div class="col-xs-12">
					<?php include('common/messages/success_message.php');?>
					<?php if(isset($_SESSION['success_user'])){?>
					   <div class="alert alert-block alert-success" style="margin-left:40%;">
							<button type="button" class="close" data-dismiss="alert">
								&nbsp; <i class="ace-icon fa fa-times"></i>
							</button>
							<i class="ace-icon fa fa-check green"></i> &nbsp; <?php echo $_SESSION['success_user'];?>
						</div>
						<?php
								unset($_SESSION['success_user']);
						}?>
					<table id="example" class="table table-stripped table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>#</th>
								<th>Full name</th>
								<th>Gender</th>
								<th>Email</th>
								<th>Mobile Phone</th>
								<th>User Name</th>
								<th>Last Login Time</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							<?php
								$U_query = "select titleName,firstName,fatherName,grandFatherName,gender,usersId,email,mobilePhone, 
								userName,lastLoginTime,status,profilePicture from title join users ON users.titleId=title.titleId order by usersId DESC";
								$U_stmt = $con->prepare($U_query);
								$U_success=$U_stmt->execute();
								$U_rows = $U_stmt->fetchAll();
								$id = 0;
								foreach ($U_rows as $row) {
									$usersId=$row['usersId'];
									$titleName=$row['titleName'];
									$firstName=$row['firstName'];
									$fatherName=$row['fatherName'];
									$grandFatherName=$row['grandFatherName'];
									$status= $row['status'];
									$profilePicture= $row['profilePicture'];
									$Full_name = $titleName.' '.$firstName.' '.$fatherName.' '.$grandFatherName;
									
									?>
							<tr>
								<?php $id = $id + 1;?>
								<td><?php echo $id;?></td>
								 <td>
								<a href="#" data-toggle="modal" data-target="#view_profile_pic<?php echo $usersId; ?>">
								<div style="width:30px; height:30px;" >
								  <img   style="border:2px solid #C9D6E5;border-radius:100%;max-width:110%; max-height:110%;margin-right:0px;margin-left:0;" src="../../images/profile_pic/<?php echo $profilePicture;?> "  />
								</div>
								</a>
								<?php include('common/viewprofilepic.php'); ?>
								</td>
								<td><?php echo $Full_name;?></td>
								<td><?php echo $row['gender'];?></td>
								<td><?php echo $row['email'];?></td>
								<td><?php echo $row['mobilePhone'];?></td>
								<td><?php echo $row['userName'];?></td>
								<td><?php echo $row['lastLoginTime'];?></td>
								<td>
								<?php 
								if($status=='active'){echo '<span class="label label-success arrowed">'.$status.'</span>';}
								else if($status=='limitedAccess'){echo '<span class="label label-warning arrowed">'.$status.'</span>';}
								else if($status=='disabled'){echo '<span class="label label-danger arrowed">'.$status.'</span>';}
								?>
								</td>
								<td>
								    <a href="?name=configurations/users/userdetail&var=users&usersId=<?php echo $usersId;?>" class="green">
											<span class="label label-info arrowed-in-right arrowed"><i class="fa fa-info-circle"></i> Detail</span>
									</a>
								</td>
							</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
		</div>
		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->
<?php }
else{
header("location: index.php?name=dashboard/home&var=home");
}
?>