<?php

if(isset($_POST['uploadedPrescriptionsId'])){
    include('../../../include/dbcon_eprescription.php');
    
	$uploadedPrescriptionsId = $_POST['uploadedPrescriptionsId'];
    $pharmacyId= $_POST['pharmacyId'];
    $pharmacistId= $_POST['pharmacistId'];
    $actionType= $_POST['actionType'];
    $status=0;
    
     // Transactions Begins
    $con->beginTransaction();

   
    $Check_P = "select count(*) from uploadedprescriptions INNER JOIN nearbypharmacycache on uploadedprescriptions.uploadedPrescriptionsId=nearbypharmacycache.uploadedPrescriptionsId  where uploadedprescriptions.status = 'Pending' and nearbypharmacycache.released=0 and nearbypharmacycache.pharmacyId='".$pharmacyId."'";
                                  $stmtP = $con->prepare($Check_P);
                                  $successP=$stmtP->execute();
                                  $rowsP = $stmtP->fetchColumn(); 


            $Check_A = "select count(*) from uploadedprescriptionstatus where pharmacyId='".$pharmacyId."' and uploadedprescriptionstatus.status='Accepted'";
                                  $stmtA = $con->prepare($Check_A);
                                  $successA=$stmtA->execute();
                                  $rowsA = $stmtA->fetchColumn();


    if($actionType =='release'){

        $update_query ="update nearbypharmacycache set released=1 where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId'";
        $stmtU = $con->prepare($update_query);
        $successPre=$stmtU->execute();

         


                    if ($successPre && $successA && $successP){ 
                        $con->commit();
                                $status1=array();
                                $status1[0]=$pharmacyId;
                                $status1[1]=$pharmacistId;
                                $status1[2]=$rowsP;
                                $status1[3]=$rowsA;
                                echo json_encode($status1);
                     }else {
                        $con->rollback();
                        $status=0;
                         echo $status;
                    }

        
    } else if($actionType =='accept'){
                      
        $distanceFromRequester= $_POST['distanceFromRequester'];

         $update_query ="update nearbypharmacycache set released=1 where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId'";
        $stmtU = $con->prepare($update_query);
        $successUpdate=$stmtU->execute();
        
        $select_query =" select count(*)  from uploadedprescriptionstatus where pharmacyId = '$pharmacyId' and uploadedPrescriptionsId='$uploadedPrescriptionsId'";
        $stmtSel = $con->prepare($select_query);
        $successSel=$stmtSel->execute();
        $cnt=$stmtSel->fetchColumn();
        $successinsert=0;
        if ($cnt==0){
        $insert_query ="INSERT INTO uploadedprescriptionstatus(uploadedPrescriptionsId,pharmacyId,pharmacistId,distanceFromRequester,status) VALUES ('$uploadedPrescriptionsId','$pharmacyId','$pharmacistId','$distanceFromRequester','Accepted')";
        $stmtIns =$con->prepare($insert_query);
        $successinsert=$stmtIns->execute();
       }

               if ($successUpdate &&  $successSel  && $successinsert && $successA && $successP ){ 
                                $con->commit();
                                $status1=array();
                                $status1[0]=$pharmacyId;
                                $status1[1]=$pharmacistId;
                                $status1[2]=$rowsP;
                                $status1[3]=$rowsA;
                                echo json_encode($status1);

                }else {
                                $con->rollback();
                                $status=0;
                                echo $status;
                }

           

    } 
    

    }else{
	header("location: ../index.php");
}
?>
