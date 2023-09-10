<?php
$numberOfPharmacy = 0;
if ($_SESSION['rolesId'] == 4) {
    $select_pharmacy = "select pharmacy.pharmacyName, pharmacy.pharmacyType, pharmacy.pharmacyId from pharmacy where registeredById='$usrUsersId' and (status='Active' or status='Disabled')";
    $select_stmt = $con->prepare($select_pharmacy);
    $resultPharmacy1 = $select_stmt->execute();
    $resultPharmacy = $select_stmt->fetchAll();

    $sql = "select count(*) from pharmacy where registeredById='$usrUsersId' and  (status='Active' or status='Disabled')";
    $result = $con->prepare($sql);
    $result->execute();
    $numberOfPharmacy = $result->fetchColumn();
} else if ($_SESSION['rolesId'] == 2) {
    $select_pharmacy = "select pharmacy.pharmacyName, pharmacy.pharmacyId, pharmacy.pharmacyType from pharmacy INNER JOIN pharmacyusers on pharmacy.pharmacyId=pharmacyusers.pharmacyId where pharmacyusers.usersId='$usrUsersId' and (pharmacy.status='Active' and pharmacyusers.status='Active') ";
    $select_stmt = $con->prepare($select_pharmacy);
    $resultPharmacy1 = $select_stmt->execute();
    $resultPharmacy = $select_stmt->fetchAll();

    $sql = "select count(*) from pharmacy INNER JOIN pharmacyusers on pharmacy.pharmacyId=pharmacyusers.pharmacyId where pharmacyusers.usersId='$usrUsersId' and pharmacyusers.status='Active' and (pharmacy.status='Active')";
    $result = $con->prepare($sql);
    $result->execute();
    $numberOfPharmacy = $result->fetchColumn();
}

if ($numberOfPharmacy >= 1 and !isset($_SESSION['pharmacyId'])) {
    $resultPharmacy1 = $resultPharmacy;
    foreach ($resultPharmacy1 as $resultValue) {
        $_SESSION['pharmacyId'] = $resultValue['pharmacyId'];
        $_SESSION['pharmacyName'] = $resultValue['pharmacyName'];
        $_SESSION['pharmacyType'] = $resultValue['pharmacyType'];
    }
}

if ($_SESSION['rolesId'] == 4 || $_SESSION['rolesId'] == 2) { ?>
    <li class="dropdown-modal">
        <a data-toggle="dropdown" href="#" class="dropdown-toggle" style="background-color:#9b59b6;">
            <img class="nav-user-photo" src="../../images/pharmacy.png" title="select pharmacy">
            <span class="user-info" id="selectedPharmacyDisplay">
                <small title="Your are currently @ <?php if (isset($_SESSION["pharmacyName"]))
                                                        echo $_SESSION["pharmacyName"]; ?>,  <?php if (isset($_SESSION["pharmacyType"]))
                                                                                                    echo $_SESSION["pharmacyType"]; ?> "><br>
                    <?php if (isset($_SESSION['pharmacyName']))
                        echo $_SESSION['pharmacyName']; ?>,&nbsp;
                    <?php if (isset($_SESSION['pharmacyName']))
                        echo $_SESSION['pharmacyType']; ?>
                    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                </small>
            </span>

            <i class="ace-icon fa fa-caret-down"></i>
        </a>

        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
            <?php
            $previousLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            foreach ($resultPharmacy as $rowPharmacy) { ?>
                <li>
                    <a href="../common/header/switch_role.php?pharmacyId=<?php echo $rowPharmacy['pharmacyId']; ?>&pharmacyName=<?php echo $rowPharmacy['pharmacyName']; ?>&pharmacyType=<?php echo $rowPharmacy['pharmacyType']; ?>&previousLink=<?php echo $previousLink; ?>">
                        <i class="ace-icon fa fa-refresh "></i>
                        <?php echo $rowPharmacy['pharmacyName']; ?>, &nbsp;
                        <?php echo $rowPharmacy['pharmacyType']; ?>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </li>
<?php } ?>