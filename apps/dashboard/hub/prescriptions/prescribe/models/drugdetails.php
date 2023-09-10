<?php
if(isset($_POST['drugsId'])){
	
	$drugsId = $_POST['drugsId'];
	
    include('../../../../../../constants/databases/dbcon_eprescription.php'); 

    $query = "SELECT  drugsName,drugInteractions,sideEffects from drugs join drugformulary on drugs.drugsId=drugformulary.drugsId where drugs.drugsId='$drugsId'";
    $stmt = $con->prepare($query);
    $success=$stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        $drugsName = $row['drugsName'];
        $drugInteractions = $row['drugInteractions'];
        $sideEffects = $row['sideEffects'];
    }

    $json = array (
        "drugsName" => $drugsName,
        "drugInteractions" => $drugInteractions,
        "sideEffects" => $sideEffects
    );
    header('Content-type: application/json');
    $jsonencode = json_encode($json);
    echo $jsonencode; 
	
}else{
	header("location: ../index.php");
}
?>
