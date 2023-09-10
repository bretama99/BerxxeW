<?php
if(isset($_GET['email'])){
	include('../../../../constants/databases/dbcon_eprescription.php'); 
	$email=ucfirst(strtolower($_GET['email']));
	$count = 0;
	$usersId=0;
	$I_query = "SELECT * from users where email='$email' AND isDeleted='0' ";
	$I_stmt = $con->prepare($I_query);
	$I_success=$I_stmt->execute();
	$I_rows = $I_stmt->fetchAll();
	foreach ($I_rows as $row) {
		$count = $count + 1;
		$usersId=$row['usersId'];
	}
	if($count>0){
	 echo  $usersId;
    }
	else{
	 echo  "No";
	}
}
else{
	header("location: ../../../index.php");
}
?>