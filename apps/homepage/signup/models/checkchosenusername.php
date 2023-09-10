<?php
if(isset($_GET['userName'])){
	include('../../../../constants/databases/dbcon_eprescription.php'); 
	$userName=ucfirst(strtolower($_GET['userName']));
	$count = 0;
	$I_query = "SELECT * from users where userName='$userName' AND isDeleted='0' ";
	$I_stmt = $con->prepare($I_query);
	$I_success=$I_stmt->execute();
	$I_rows = $I_stmt->fetchAll();
	foreach ($I_rows as $row) {
		$count = $count + 1;
	}
	if($count>0){
	echo  "Yes";
    }
	else{
	echo  "No";
	}
}
else{
	header("location: ../../../../../../index.php");
}
?>
