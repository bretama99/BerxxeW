<?php
$Check_R = "select count(*) from rolerequest where usersId = '$usersId' ";
$stmtR = $con->prepare($Check_R);
$stmtR->execute();
$rowsR = $stmtR->fetchColumn();
if ($rowsR < 3) { ?>
    <h4 class="header smaller lighter green">Do you want additional role ? request for a new role now</h4>
<?php } ?>
<?php
$countpr = 0;
$Check_Pr = "select status from rolerequest where usersId = '$usersId' AND rolesId=2 ";
$stmtPr = $con->prepare($Check_Pr);
$stmtPr->execute();
$rowsPr = $stmtPr->fetchAll();
foreach ($rowsPr as $row) {
    $Prstatus = $row['status'];
    $countpr = $countpr + 1;
}
if ($countpr == 0 or $Prstatus == 'Denied') { ?>

    <button class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
        <i class="ace-icon fa fa-flask align-top bigger-125"></i>
        Pharmacist
    </button>

<?php } ?>
<?php
$countphy = 0;
$Check_Phy = "select status from rolerequest where usersId = '$usersId' AND rolesId=3 ";
$stmtPhy = $con->prepare($Check_Phy);
$stmtPhy->execute();
$rowsPhy = $stmtPhy->fetchAll();
foreach ($rowsPhy as $row) {
    $Phystatus = $row['status'];
    $countphy = $countphy + 1;
}
if ($countphy == 0 or $Phystatus == 'Denied') { ?>

    <button class="btn btn-warning" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
        <i class="ace-icon fa fa-pencil align-top bigger-125"></i>
        Physician
    </button>

<?php } ?>
<?php
$count = 0;
$Check_PO = "select status from rolerequest where usersId = '$usersId' AND rolesId=4 ";
$stmtPO = $con->prepare($Check_PO);
$stmtPO->execute();
$rowsPO = $stmtPO->fetchAll();
foreach ($rowsPO as $row) {
    $status = $row['status'];
    $count = $count + 1;
}
if ($count == 0 or $status == 'Denied') { ?>
    <button class="btn btn-success" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
        <i class="ace-icon fa fa-home align-top bigger-125"></i>
        Pharmacy Owner
    </button>
<?php } ?>