<?php
session_start();
if(isset($_POST['prescriptionId'])){
    include('../../../../../../constants/databases/dbcon_eprescription.php');
    
    if(isset($_SESSION['pharmacyId'])){
        $pharmacyId = $_SESSION['pharmacyId'];
    }else{
        $pharmacyId = 0;
    }

    $prescriptionId = $_POST['prescriptionId'];
    $prescribedDrugsId = $_POST['prescribedDrugsId'];
    $noOfOrderedDrugs = $_POST['noOfOrderedDrugs'];
    $comment = $_POST['comment'];    
    if($prescribedDrugsId == 0){
        $update_query ="update prescription set status = 'Returned', comment='$comment' where prescriptionId = '$prescriptionId'";
        $stmtU = $con->prepare($update_query);
        $successU=$stmtU->execute();
        if($successU){
            $update_query ="update prescribeddrugs set status = 'Returned' where prescriptionId = '$prescriptionId'";
            $stmtU = $con->prepare($update_query);
            $successU=$stmtU->execute();
            
            $query = "SELECT prescribedDrugsId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsName,drugs.drugsId,drugsAdditionalInstructions from prescription join prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId join drugs on prescribeddrugs.drugsId=drugs.drugsId where prescription.status='Returned' AND prescribeddrugs.isDeleted=0 AND $prescriptionId = prescription.prescriptionId";

                $stmt = $con->prepare($query);
                $success = $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {
                    $drugsId = $row['drugsId'];
                    $prescribedDrugsId1 = $row['prescribedDrugsId'];
                    $drugsDose = $row['drugsDose'];
                    $drugsDoseUnit = $row['drugsDoseUnit'];
                    $drugsFrequency = $row['drugsFrequency'];
                    $drugsRoute = $row['drugsRoute'];
                    $drugsDuration = $row['drugsDuration'];
                    $drugsDurationUnit = $row['drugsDurationUnit'];
                    $totalQty = $row['totalQty'];
                    $qtyUnit = $row['qtyUnit'];
                    $instructions = $row['drugsInstructions'];
                    $drugsName = $row['drugsName'];
                    $additionalInstructions = $row['drugsAdditionalInstructions'];

            $Add_query = "insert into returnprescriptionhistory (prescriptionId,status,prescribedDrugsId,drugsId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsAdditionalInstructions) values('$prescriptionId','Returned','$prescribedDrugsId1','$drugsId','$drugsDose','$drugsDoseUnit','$drugsFrequency','$drugsRoute','$drugsDuration','$drugsDurationUnit','$totalQty','$qtyUnit','$instructions','$additionalInstructions')";
                    $stmtAddC = $con->prepare($Add_query);
                    $resultC = $stmtAddC->execute();
                }


            // $arraySize = sizeof($trackingNumbers);
            // for($i=0; $i < $arraySize; $i++){
            //     $prescribedDrugId = $trackingNumbers[$i]['prescribedDrugId'];
            //     $trackingNumber = $trackingNumbers[$i]['trackingNumber'];

            //     $updateQuery ="update prescribeddrugs set pharmacyId ='$pharmacyId',trackingNumber = '$trackingNumber',pickedBy='$pickedBy' where prescribedDrugsId = '$prescribedDrugId'";
            //     $stmtU = $con->prepare($updateQuery);
            //     $successU=$stmtU->execute();
            // }



    

        }
    }
    else{
        $update_query ="update prescribeddrugs set status = 'Dispensed', pharmacyId ='$pharmacyId', trackingNumber = '$trackingNumbers', pickedBy='$pickedBy' where prescribedDrugsId = '$prescribedDrugsId'";
        $stmtU = $con->prepare($update_query);
        $successU=$stmtU->execute();
        $noOfOrderedDrugs = $noOfOrderedDrugs - 1;
        if($noOfOrderedDrugs == 0){
            $update_query ="update prescription set status = 'Dispensed' where prescriptionId = '$prescriptionId'";
            $stmtU = $con->prepare($update_query);
            $successU=$stmtU->execute();
        }
    }
         
        
    $json = array (
        "prescribedDrugsId" => $prescribedDrugsId,
        "noOfOrderedDrugs" => $noOfOrderedDrugs
    );
    header('Content-type: application/json');
    $jsonencode = json_encode($json);
        echo $jsonencode;
    
}else{
    header("location: ../index.php");
}
?>
