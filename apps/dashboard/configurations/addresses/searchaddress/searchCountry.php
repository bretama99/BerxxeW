<?php 
include('../dbcon_eprescription.php'); 
$searchTerm = $_GET['term']; 
$fetchedData = array(); 
$query = "select * from country where countryName LIKE '%".$searchTerm."%' ORDER BY countryName ASC";
$stmt = $con->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
      $data['id'] = $row['countryId']; 
      $data['value'] = $row['countryName']; 
	  array_push($fetchedData, $data); 
}

echo json_encode($fetchedData); 

?>