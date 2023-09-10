<?php
include('../../../../../constants/databases/dbcon_eprescription.php');
$zoneId = $_GET["zoneId"];
$count = 0;
$All_woredas = "";
$query = "select * from woreda where zoneId='$zoneId'";
$stmt = $con->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
	$woredaName = $row['woredaName'];
	$woredaId = $row['woredaId'];
	$woreda = $woredaId . '_' . $woredaName;
	$All_woredas = $All_woredas . ',' . $woreda;
	if ($count == 0) {
		$All_woredas = $woreda;
	}
	$count = $count + 1;
}
echo  $All_woredas;
