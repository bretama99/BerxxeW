<?php 
include('../dbcon_eprescription.php'); 
$searchTerm = $_GET['term']; 
$fetchedData = array(); 
$query = "select * from zone where zoneName LIKE '%".$searchTerm."%' ORDER BY zoneName ASC";
$stmt = $con->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
      $data['id'] = $row['zoneId']; 
      $data['value'] = $row['zoneName']; 
	  array_push($fetchedData, $data); 
}

echo json_encode($fetchedData); 

?>