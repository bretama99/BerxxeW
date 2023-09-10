<?php
session_start();
if (isset($_POST['prescriptionId'])) {
    include('../../../../../../constants/databases/dbcon_eprescription.php');
    $prescriptionId = $_POST['prescriptionId'];
    $prescribedDrugsId = $_POST['prescribedDrugsId'];
    $noOfOrderedDrugs = $_POST['noOfOrderedDrugs'];
    $pickedBy = $_POST['pickedBy'];
    $trackingNumbers = $_POST['trackingNumbers'];
    $pharmacyId=0;
    if(isset($_SESSION['pharmacyId']))
         $pharmacyId = $_SESSION['pharmacyId'];
    $dispensedById = 0;
    if(isset($_SESSION['pharmacyId']))
        $dispensedById = $_SESSION['usrUsersId'];

    if ($prescribedDrugsId == 0) {
        $update_query = "update prescription set status = 'Dispensed' where prescriptionId = '$prescriptionId'";
        $stmtU = $con->prepare($update_query);
        $successU = $stmtU->execute();
        if ($successU) {
            $update_query = "update prescribeddrugs set status = 'Dispensed' where prescriptionId = '$prescriptionId'";
            $stmtU = $con->prepare($update_query);
            $successU = $stmtU->execute();

            $arraySize = sizeof($trackingNumbers);
            for ($i = 0; $i < $arraySize; $i++) {
                $prescribedDrugId = $trackingNumbers[$i]['prescribedDrugId'];
                $trackingNumber = $trackingNumbers[$i]['trackingNumber'];

                $updateQuery = "update prescribeddrugs set pharmacyId ='$pharmacyId',trackingNumber = '$trackingNumber',pickedBy='$pickedBy',dispensedById='$dispensedById' where prescribedDrugsId = '$prescribedDrugId'";
                $stmtU = $con->prepare($updateQuery);
                $successU = $stmtU->execute();
            }
        }
    } else {
        $update_query = "update prescribeddrugs set status = 'Dispensed', pharmacyId ='$pharmacyId', trackingNumber = '$trackingNumbers', pickedBy='$pickedBy', dispensedById='$dispensedById' where prescribedDrugsId = '$prescribedDrugsId'";
        $stmtU = $con->prepare($update_query);
        $successU = $stmtU->execute();
        $noOfOrderedDrugs = $noOfOrderedDrugs - 1;
        if ($noOfOrderedDrugs == 0) {
            $update_query = "update prescription set status = 'Dispensed' where prescriptionId = '$prescriptionId'";
            $stmtU = $con->prepare($update_query);
            $successU = $stmtU->execute();
        }
    }

    $json = array(
        "prescribedDrugsId" => $prescribedDrugsId,
        "noOfOrderedDrugs" => $noOfOrderedDrugs
    );
    header('Content-type: application/json');
    $jsonencode = json_encode($json);
    echo $jsonencode;
} else {
    header("location: ../index.php");
}
