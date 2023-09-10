<?php
$rolesId = $_SESSION['rolesId'];
$Role_query = "select rolesName from roles where rolesId='$rolesId'";
$Role_stmt = $con->prepare($Role_query);
$Role_success = $Role_stmt->execute();
$rows = $Role_stmt->fetchAll();
foreach ($rows as $row)
    $rolesName = $row['rolesName'];


$previousLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$UsrRolesId = $_SESSION['rolesId'];
$U_query = "select usersRoleId,rolesName,usersrole.rolesId,isDefault
                                      from usersrole join roles ON usersrole.rolesId=roles.rolesId 
                                      where usersrole.usersId='$usrUsersId' AND usersrole.rolesId!='$UsrRolesId' ";
$U_stmt = $con->prepare($U_query);
$U_success = $U_stmt->execute();
$result_active_roles = $U_stmt->fetchAll();
$id = 0;
$displayed = 0;
?>
<li class="dropdown-modal" >
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <img class="nav-user-photo" src="../../images/profile_pic/<?php echo $usrProfilePicture; ?>" alt="Profile Photo" />
        <span class="user-info">
            <small>
                <?php echo $usrFullName . '<br>';
                if ($rolesName != 'Patient') {
                    echo '( ' . $rolesName . ' )';
                }
                ?>
            </small>
        </span>
        <i class="ace-icon fa fa-caret-down"></i>
    </a>

    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
        <?php

        foreach ($result_active_roles as $activeRoles) {
            echo '<li>
                    <a href="../common/header/switch_role.php?SwitchRoleId=' . ($activeRoles["rolesId"]) . '&previousLink=' . $previousLink . '">
                        <i class="ace-icon fa fa-refresh "></i>
                    ' . ($activeRoles["rolesName"] !== $previousLink ? 'Switch to - ' . $activeRoles["rolesName"] : '') . '
                    </a>
            </li>';
        }

        ?>

        <li>
            <a href="?name=configurations/users/profile&var=profile">
                <i class="ace-icon fa fa-user"></i>
                Profiles
            </a>
        </li>
        <li>
            <a href="#">
                <i class="ace-icon fa fa-question"></i>
                Help
            </a>
        </li>
        <li>
            <a href="../common/header/logout.php">
                <i class="ace-icon fa fa-power-off"></i>
                Logout
            </a>
        </li>

    </ul>
</li>