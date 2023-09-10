<?php
?>

<div class="widget-toolbar no-border" style="width:100%;">
    <ul class="nav nav-tabs" id="myTab">

        <!-- <li id="activeMyPrescription" class="active">
            <a data-toggle="tab" href="#myPrescription" onclick="displayPrescription(<?php echo $_SESSION['pharmacyId']; ?>, <?php echo $_SESSION['usrUsersId']; ?>, <?php echo $_SESSION['rolesId']; ?>)">Prescriptions</a>
        </li> -->
        <li id="activeDispensedMedications" class="active">
            <a data-toggle="tab" href="#dispensedMedications" onclick="displayDispensedMedications(<?php echo $_SESSION['pharmacyId']; ?>, <?php echo $_SESSION['usrUsersId']; ?>, <?php echo $_SESSION['rolesId']; ?>)">Dispensed Medi.</a>
        </li>

        <?php if ($_SESSION['rolesId'] == 4) { ?>
            <li id='activeAddPharmacy'>
                <a data-toggle="tab" href="#myPharmacies">Add Pharmacy</a>
            </li>

            <li id='activeMyPharmacist'>
                <a data-toggle="tab" href="#myPharmacist" onclick="displayPharmacist(<?php echo $usrUsersId; ?>)">Pharmacists</a>
            </li>
        <?php } ?>

        <?php if ($_SESSION['rolesId'] == 4 || $_SESSION['rolesId'] == 2) { ?>
            <li id="activeMyPharmacy">
                <a data-toggle="tab" href="#myPharmacy">Pharmacy List</a>
            </li>
        <?php } ?>

        <?php if ($_SESSION['rolesId'] == 4) { ?>
            <li>
                <a data-toggle="tab" href="#pharmacyLogs" onclick="displayPharmacyLogs(<?php echo $_SESSION['pharmacyId']; ?>, <?php echo $_SESSION['usrUsersId']; ?>)" />Log</a>
            </li>
        <?php } ?>

        <li id="postedPerscriptionsTab">
            <?php

            $Check_P = "select count(*) from uploadedprescriptions INNER JOIN nearbypharmacycache on uploadedprescriptions.uploadedPrescriptionsId=nearbypharmacycache.uploadedPrescriptionsId  where uploadedprescriptions.status = 'Pending' and nearbypharmacycache.released=0 and nearbypharmacycache.pharmacyId='" . $_SESSION['pharmacyId'] . "'";
            $stmtP = $con->prepare($Check_P);
            $stmtP->execute();
            $rowsP = $stmtP->fetchColumn();


            $Check_A = "select count(*) from uploadedprescriptionstatus where pharmacyId='" . $_SESSION['pharmacyId'] . "' and uploadedprescriptionstatus.status='Accepted'";
            $stmtA = $con->prepare($Check_A);
            $stmtA->execute();
            $rowsA = $stmtA->fetchColumn();

            ?>
            <a data-toggle="tab" href="#postedPrescriptions" onclick='displayPostedUploadedPrescriptions("<?php echo $_SESSION['pharmacyId']; ?>", "<?php echo $_SESSION['usrUsersId']; ?>" )' />Posted Prescr. <span id="postedPrescriptionCounter" class="badge badge-warning"><?php echo $rowsP; ?></span></a>
        </li>

        <li>
            <a data-toggle="tab" href="#acceptedPrescriptions" onclick='displayAcceptedPostedPrescriptions("<?php echo $_SESSION['pharmacyId']; ?>", "<?php echo $_SESSION['usrUsersId']; ?>" )' />Accepted Presc. <span id="acceptedPrescriptionCounter" class="badge badge-success"><?php echo $rowsA; ?></span></a>

        </li>

        <li>
            <a data-toggle="tab" href="#dispensedPrescriptions" onclick='displayDispensedPostedPrescriptions("<?php echo $_SESSION['pharmacyId']; ?>" )' />Dispensed Presc. <span class="badge badge-success"></span></a>

        </li>

    </ul>
</div>