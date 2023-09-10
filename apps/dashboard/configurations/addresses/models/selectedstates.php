<?php
include('../../../../../constants/databases/dbcon_eprescription.php');   
$countryId = $_GET["countryId"];
$count = 0;
$All_states = "";
$query = "select * from state where countryId='$countryId'";
$stmt = $con->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
    $stateName=$row['stateName'];
	$stateId=$row['stateId'];
	$state = $stateId.'_'.$stateName;
	$All_states = $All_states.','.$state;
	if($count == 0){
		$All_states = $state;
	}
	$count = $count + 1;
}
echo  $All_states;
?>