<?php
session_start();
if (isset($_POST['prescriptionId'])) {
    include('../../../../../../constants/databases/dbcon_eprescription.php');

    $status = 1;

    $prescriptionId = $_POST['prescriptionId'];
    $prescribedDrugsId = $_POST['prescribedDrugsId'];
    $pickedBy = $_POST['pickedBy'];
    $trackingNumber = $_POST['trackingNumber'];
    $pharmacyId = $_POST['pharmacyId'];
    $dispenseAll = $_POST['dispenseAll'];
    $dispensedById = $_SESSION['usrUsersId'];
    $arraySize = count($trackingNumber);
    for ($i = 0; $i < $arraySize; $i++) {
        if ($pharmacyId == '' || $trackingNumber[$i] == '') {
            $status = 0;
        }
    }
    if ($status == 1) {
        // Transactions Begins
        $con->beginTransaction();
        if ($dispenseAll[0] == 1) {
            $update_query = "update prescription set  status = 'Dispensed' where prescriptionId = '$prescriptionId[0]' and status='Prescribed'";
            $stmtU = $con->prepare($update_query);
            $successPre = $stmtU->execute();
            if ($successPre) {
                for ($i = 0; $i < $arraySize; $i++) {
                    $updateQuery = "update prescribeddrugs set pharmacyId='$pharmacyId', status = 'Dispensed',pickedBy='$pickedBy[0]', trackingNumber = '$trackingNumber[$i]', dispensedById='$dispensedById' where prescribedDrugsId = '$prescribedDrugsId[$i]' and status='Prescribed'";
                    $stmtU = $con->prepare($updateQuery);
                    $successPreD = $stmtU->execute();
                }
            }
        } else if ($dispenseAll[0] == 0) {
            $updateQuery = "update prescribeddrugs set status = 'Dispensed', pharmacyId ='$pharmacyId', pickedBy='$pickedBy[0]', dispensedById='$dispensedById', trackingNumber = '$trackingNumber[0]' where prescribedDrugsId = '$prescribedDrugsId[0]'";
            $stmtU = $con->prepare($updateQuery);
            $successPreD = $stmtU->execute();

            if ($successPreD) {

                $sql = "select count(*) from prescribeddrugs where prescriptionId='$prescriptionId[0]' and status='Prescribed'";
                $result = $con->prepare($sql);
                $result->execute();
                $number_of_rows = $result->fetchColumn();
                if ($number_of_rows == 0) {
                    $update_query = "update prescription set status = 'Dispensed' where prescriptionId = '$prescriptionId[0]' and status='Prescribed'";
                    $stmtU = $con->prepare($update_query);
                    $successU = $stmtU->execute();
                }
            }
        }
        if ($successPreD and ($number_of_rows > 0 || $successU)) {
            $con->commit();
            $status = 1;
        } else {
            $con->rollback();
            $status = 0;
        }
    }
    echo $status;
} else {
    header("location: ../index.php");
}
