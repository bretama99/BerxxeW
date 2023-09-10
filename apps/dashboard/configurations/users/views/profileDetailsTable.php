<?php include('configurations/addresses/common/editMyAddress.php'); ?>
<tr>
    <td>
        <span class="profile-picture">
            <a href="#" data-toggle="modal" data-target="#view_profile_pic<?php echo $usersId; ?>">
                <img width="120px" height="120px" alt="profile picture" src="../../images/profile_pic/<?php echo $profilePicture; ?>" width="100%" height="100%" />
            </a>
        </span>
        <?php include('common/viewprofilepic.php'); ?>
        <br><br>
        <div class="hidden-xs hidden-xs btn-group">
            <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#change_profile_pic">
                &nbsp; &nbsp; <i class="ace-icon fa fa-camera bigger-120"></i> Change Photo
            </button>
        </div>
    </td>
    <td style="color:#0080ff;">
        Full Name <br>
        Gender <br>
        Email <br><?php if ($emailVerification == 0) { ?><br><?php } ?>
        Date Of Birth <br>
        Address

    </td>
    <td>

        <?php echo $Full_name; ?> <br>
        <?php echo $row['gender']; ?> <br>
        <?php echo $email; ?> <br>
        <?php if ($emailVerification == 0) { ?>
            <form method="post" action="">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="usersId" value="<?php echo $usersId; ?>">
                <button type="submit" name="verifyEmail" class="btn btn-minier btn-yellow">Verify Email Address</button>
            </form>
        <?php } ?>
        <?php if ($emailVerification == 1) { ?><br><?php } ?>
        <?php echo $dateOfBirth; ?>
        <br>

        <?php if ($kebelle != ' ') {
            echo $kebelle . '<b>,</b>' . $woredaName . '<b>,</b> ' . $zoneName . '<b>,</b> ' . $stateName . '<b>,</b> ' . $countryName;
        }
        ?>
        <a href="#" data-toggle="modal" data-target="#editAddress">
            <?php ?> &nbsp; <i class=" ace-icon fa fa-pencil bigger-125"></i>
        </a><br>
        <br>
    </td>

    <td style="color:#0080ff;">
        Mobile Phone <br>
        Username <br>
        Last Login Time <br>
        Role <br>
        Status <br>

    </td>
    <td>
        <a href="#" data-toggle="modal" data-target="#edit_mobile_phone">
            <?php echo $mobilePhone; ?> &nbsp; <i class=" ace-icon fa fa-pencil bigger-125"></i>
        </a><br>
        <!--
							 <a href="#" data-toggle="modal" data-target="#edituserName">
							 <?php echo $userName; ?> &nbsp; <i class=" ace-icon fa fa-pencil bigger-125"></i>
							 </a>-->
        <?php echo $userName; ?>
        <br>
        <?php // echo $officePhone;
        ?>
        <?php echo $lastLoginTime; ?><br>
        <?php echo $rolesName; ?><br>
        <?php echo $status; ?><br>
        <br>
        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#change_password">
            <i class="ace-icon fa fa-key bigger-100"></i><b> Change Password</b>
        </button>
    </td>
</tr>