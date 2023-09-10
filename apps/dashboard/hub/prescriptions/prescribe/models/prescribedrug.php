<?php
if(isset($_POST['prescriberUsersId'])){
    include('../../../../../../constants/databases/dbcon_eprescription.php');
    $buttonClickCounter = $_POST['buttonClickCounter'];
    $prescriberUsersId = $_POST['prescriberUsersId'];
    $patientUsersId = $_POST['patientUsersId'];
    $prePrescriptionId = $_POST['prescriptionId'];

    $drugId = $_POST['drugId'];
    $dose = $_POST['dose'];
    $doseUnit = $_POST['doseUnit'];
    $frequency = $_POST['frequency'];
    $route = $_POST['route'];
    $duration = $_POST['duration'];
    $durationUnit = $_POST['durationUnit'];
    $totalQty = $_POST['totalQty'];
    $qtyUnit = $_POST['qtyUnit'];
    $instructions = $_POST['instructions'];
    $additionalInstructions = $_POST['additionalInstructions'];

    $titleId = $_POST['title'];
    $firstName = $_POST['firstName'];
	$fatherName = $_POST['fatherName'];
	$grandFatherName = $_POST['grandFatherName'];
	$mobilePhone = $_POST['mobilePhone'];
    $custodianPhone = $_POST['custodianPhone'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $prescribedDrugsIdFromForm=$_POST['prescribedDrugsId'];
    /* 
    
	$countryId = $_POST['countryId'];
	$stateId = $_POST['stateId'];
	$zoneId = $_POST['zoneId'];
	$woredaId = $_POST['woredaId'];
    $kebelle = $_POST['kebelle'];
     */
    if(!isset($_POST['pharmacyId'])){
        $pharmacyId = 0;
    }

    // Transactions Begins
    $con->beginTransaction();
    $tansactionCommit = 0;
    if($buttonClickCounter == 0 && $prePrescriptionId==0&&$prescribedDrugsIdFromForm==0){
        $insertMPI = 0;
        if($patientUsersId == 0){
            $AddE_query ="insert into users (firstName,fatherName,grandFatherName,titleId,gender,dateOfBirth,mobilePhone, custodianPhone, registeredById) 
                        values('$firstName','$fatherName','$grandFatherName','$titleId','$gender','$dateOfBirth','$mobilePhone', '$custodianPhone','$prescriberUsersId')";
            $stmtaddE = $con->prepare($AddE_query);
            $resultE=$stmtaddE->execute();
            if($resultE){
                $patientId = $con->lastInsertId();
            }
            $patientUsersId = $patientId;
            $insertMPI = 1;
            $tansactionCommit++;
        }else{
            $query1 = "SELECT MPI from patientindex where patientId='$patientUsersId'";
            $stmt1 = $con->prepare($query1);
            $success1=$stmt1->execute();
            $count1 = $stmt1->rowCount();
            if($count1 == 0){
                $insertMPI = 1;
            }
            $tansactionCommit++;
        }

        if($insertMPI == 1){
            
            $query2 = "SELECT max(MPI) as MPI from patientindex FOR UPDATE";
            $stmt2 = $con->prepare($query2);
            $success2=$stmt2->execute();
            $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows2 as $row){
                $maxMPI = $row['MPI'];
            }
            if(!isset($maxMPI)){
                $maxMPI = 91;
            }
            $MPI = $maxMPI + 1;

            $query3 ="insert into patientindex (patientId,MPI) values('$patientUsersId','$MPI')";
            $stmt3 = $con->prepare($query3);
            $result3=$stmt3->execute();
            if($result3){
                $tansactionCommit++;
            }
            
        }else{
            $tansactionCommit++;
        }



        $AddE_query4 ="insert into prescription (patientId,prescriberId) values('$patientUsersId','$prescriberUsersId')";
        $stmtaddE4 = $con->prepare($AddE_query4);
        $resultE4=$stmtaddE4->execute();
        if($resultE4){
            $prescriptionId = $con->lastInsertId();
            $tansactionCommit++;
        }
    }else{
        $prescriptionId = $prePrescriptionId;
        $tansactionCommit = 3;
    }
$AddE_query5="";
if($prescribedDrugsIdFromForm==0)
    $AddE_query5 ="insert into prescribeddrugs (prescriptionId,drugsId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsAdditionalInstructions) 
                      values('$prescriptionId','$drugId','$dose','$doseUnit','$frequency','$route','$duration','$durationUnit','$totalQty','$qtyUnit','$instructions','$additionalInstructions')";
else{
    $prescribedDrugsId=$prescribedDrugsIdFromForm;
    $AddE_query5 = "update prescribeddrugs set prescriptionId='$prescriptionId',drugsId='$drugId',drugsDose='$dose',
    drugsDoseUnit='$doseUnit',drugsFrequency='$frequency',drugsRoute='$route',drugsDuration='$duration',drugsDurationUnit='$durationUnit',totalQty='$totalQty',qtyUnit='$qtyUnit',drugsInstructions='$instructions',drugsAdditionalInstructions='$additionalInstructions' where prescribedDrugsId='$prescribedDrugsIdFromForm'";

}
        $stmtaddE5 = $con->prepare($AddE_query5);
        $resultE5=$stmtaddE5->execute();
        if($resultE5){
            $prescribedDrugsId = $con->lastInsertId();

            $query6 = "SELECT prescribedDrugsId,prescriptionId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsName from prescribeddrugs join drugs on prescribeddrugs.drugsId=drugs.drugsId where prescribedDrugsId='$prescribedDrugsId'";
            $stmt6 = $con->prepare($query6);
            $success6=$stmt6->execute();
            $rows6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows6 as $row){
                $prescribedDrugsId = $row['prescribedDrugsId'];
                $prescriptionId = $row['prescriptionId'];
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
            }

            if($success6){  
                $tansactionCommit++;
                $json = array (
                    "prescribedDrugsId" => $prescribedDrugsId,
                    "prescriptionId" => $prescriptionId,
                    "drugsName" => $drugsName,
                    "drugsDose" => $drugsDose,
                    "drugsDoseUnit" => $drugsDoseUnit,
                    "drugsFrequency" => $drugsFrequency,
                    "drugsRoute" => $drugsRoute,
                    "drugsDuration" => $drugsDuration,
                    "drugsDurationUnit" => $drugsDurationUnit,
                    "totalQty" => $totalQty,
                    "qtyUnit" => $qtyUnit,
                    "instructions" => $instructions
                );
                header('Content-type: application/json');
                $jsonencode = json_encode($json);
            }

            if($tansactionCommit == 4){
                    $con->commit();
                    echo $jsonencode;
            }else{
                $con->rollback();
            }
        }
        
    
  }else{
	header("location: ../../../../../../index.php");
}
?>
