<?php
if(isset($_POST['drugName'])){
	

    include('../../../../../../constants/databases/dbcon_eprescription.php');
    
    $drugsName = $_POST['drugName'];
    $query = "SELECT drugsId,drugsName from drugs where drugsName LIKE '$drugsName%'";
    $stmt = $con->prepare($query);
    $success=$stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    /* $arraySize = sizeof($rows);
    for($i=0; $i < $arraySize; $i++){
        $rows[$i]['firstName'] = $enc->decrypt($rows[$i]['firstName']);
        $rows[$i]['fatherName'] = $enc->decrypt($rows[$i]['fatherName']);
        $rows[$i]['grandFatherName'] = $enc->decrypt($rows[$i]['grandFatherName']);
        $rows[$i]['mobilePhone'] = $enc->decrypt($rows[$i]['mobilePhone']);
    } */
    $json = json_encode($rows);

    echo $json;
		
	
}else{
    header("location: ../../../../../../index.php");
}
?>
