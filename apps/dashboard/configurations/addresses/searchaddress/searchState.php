<?php 
include('../dbcon_eprescription.php'); 
$searchTerm = $_GET['term'];  

$fetchedData = array(); 
$query = "select * from  state where stateName LIKE '%".$searchTerm."%' ORDER BY stateName ASC";
$stmt = $con->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
      $data['id'] = $row['stateId']; 
      $data['value'] = $row['stateName']; 
	  array_push($fetchedData, $data); 
}

echo json_encode($fetchedData); 

?>