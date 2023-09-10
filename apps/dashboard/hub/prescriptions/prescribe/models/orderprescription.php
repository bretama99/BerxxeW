<?php
if(isset($_POST['orderPrescriptionId']) && isset($_POST['pharmacyId']) ){
    
    $orderPrescriptionId = $_POST['orderPrescriptionId'];
    $chiefCompliant = $_POST['chiefCompliant'];
    $diagnosisDetail = $_POST['diagnosisDetail'];
    $pharmacyId = $_POST['pharmacyId'];
    
    include('../../../../../../constants/databases/dbcon_eprescription.php');

    $pquery ="update prescription set chiefCompliant='$chiefCompliant',diagnosis='$diagnosisDetail',pharmacyId='$pharmacyId',status='Prescribed' where prescriptionId='$orderPrescriptionId'";
    $pstmt = $con->prepare($pquery);
    $resultP=$pstmt->execute();

    $dquery ="update prescribeddrugs set status='Prescribed' where prescriptionId='$orderPrescriptionId'";
    $stmtd = $con->prepare($dquery);
    $resultd=$stmtd->execute();

    $query = "SELECT titleName,firstName,fatherName,grandFatherName,mobilePhone, custodianPhone from users join title on users.titleId=title.titleId join prescription on users.usersId=prescription.patientId where prescriptionId='$orderPrescriptionId'";
    $stmt = $con->prepare($query);
    $success=$stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        $title = $row['titleName'];
        $firstName = $row['firstName'];
        $fatherName = $row['fatherName'];
        $grandFatherName = $row['grandFatherName'];
        $mobilePhone = $row['mobilePhone'];
        $custodianPhone = $row['custodianPhone'];
    }
        

    $json = array (
        "prescriptionId" => $orderPrescriptionId,
        "title" => $title,
        "firstName" => $firstName,
        "fatherName" => $fatherName,
        "grandFatherName" => $grandFatherName,
        "mobilePhone" => $mobilePhone,
        "custodianPhone" => $custodianPhone
    );
    header('Content-type: application/json');
    $jsonencode = json_encode($json);
        echo $jsonencode;

}else{
	header("location: ../../../../../../index.php");
}
