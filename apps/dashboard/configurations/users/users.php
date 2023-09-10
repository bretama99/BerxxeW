<?php  if($canView=="1"){ ?>
        <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="col-sm-14">
                <div class="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="active">
                            <a href="#admin1" aria-controls="admin1" role="tab" data-toggle="tab">
                                <i class="green ace-icon fa fa-user-secret bigger-120"></i>
                                Admin
                            </a>
                        </li>

                        <li >
                            <a href="#pharmacist1" aria-controls="pharmacist1" role="tab" data-toggle="tab">
                                <i class="green ace-icon fa fa-user bigger-120"></i>
                                Pharmacist
                            </a>
                        </li>
                        <li>
                            <a daria-controls="physician1" role="tab" data-toggle="tab" href="#physician1" >
                                <i class="green fa fa-user-md bigger-120" aria-hidden="true"></i>
                                Physician
                            </a>
                        </li>
                        <li>
                            <a aria-controls="pharmacy-owner1" role="tab" data-toggle="tab" href="#pharmacy-owner1">
                                <i class="green ace-icon fa fa-user bigger-120"></i>
                                Pharmacy Owner
                            </a>
                        </li>
                        <li>
                            <a aria-controls="patient1" role="tab" data-toggle="tab" href="#patient1">
                                <i class="gree ace-icon fa fa-user bigger-120"></i>
                                Patient
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="admin1">
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
                    <table id="admin" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
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
                                userName,lastLoginTime,status,profilePicture from title join users ON users.titleId=title.titleId where usersDefaultRolesId=5 order by usersId DESC";
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
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="pharmacist1">
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
                    <table id="pharmacist" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
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
                                userName,lastLoginTime,status,profilePicture from title join users ON users.titleId=title.titleId where usersDefaultRolesId=2 order by usersId DESC";
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
                        </div>


                    <div id="physician1" class="tab-pane fade in">
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
                    <table id="physician" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
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
                                userName,lastLoginTime,status,profilePicture from title join users ON users.titleId=title.titleId where usersDefaultRolesId=3 order by usersId DESC";
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
                        </div>

                        <div id="pharmacy-owner1" class="tab-pane fade in">
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
                    <table id="pharmacy-owner" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
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
                                userName,lastLoginTime,status,profilePicture from title join users ON users.titleId=title.titleId where usersDefaultRolesId=4 order by usersId DESC";
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
                        </div>

                    <div id="patient1" class="tab-pane fade in">
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
                    <table id="patient" class="table table-stripped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
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
                                userName,lastLoginTime,status,profilePicture from title join users ON users.titleId=title.titleId where usersDefaultRolesId=1 order by usersId DESC";
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
                        </div>


                    </div>
                </div>
            </div><!-- /.col -->
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

<?php }
else{
header("location: index.php?name=dashboard/home&var=home");
}
?>


<script type="text/javascript">
    $(document).ready(function(){
   $('#admin').DataTable({
      responsive: true
   });

   $('#pharmacist').DataTable({
      responsive: true
   });
   
      $('#pharmacy-owner').DataTable({
      responsive: true
   });

   $('#physician').DataTable({
      responsive: true
   });   

   $('#patient').DataTable({
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