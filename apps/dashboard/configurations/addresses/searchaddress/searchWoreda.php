<?php 
include('../dbcon_eprescription.php'); 
$searchTerm = $_GET['term']; 
$fetchedData = array(); 
$query = "select * from woreda where woredaName	 LIKE '%".$searchTerm."%' ORDER BY woredaName ASC";
$stmt = $con->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
      $data['id'] = $row['woredaId']; 
      $data['value'] = $row['woredaName']; 
	  array_push($fetchedData, $data); 
}

echo json_encode($fetchedData); 

?>