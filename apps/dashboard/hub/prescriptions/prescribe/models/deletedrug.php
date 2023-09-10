<?php
if(isset($_POST['prescribedDrugsId'])){
	
	$prescribedDrugsId = $_POST['prescribedDrugsId'];


        include('../../../../../../constants/databases/dbcon_eprescription.php');
		
		$query = "update prescribeddrugs set isDeleted='1' where prescribedDrugsId='$prescribedDrugsId'";
		$stmt = $con->prepare($query);
		$success=$stmt->execute();
        if($success){
            $json = array (
                "prescribedDrugsId" => $prescribedDrugsId
            );
            header('Content-type: application/json');
            $jsonencode = json_encode($json);
                echo $jsonencode;
        }
		
	
}else{
	header("location: ../index.php");
}
?>
