<?php
include('../../../../../constants/databases/dbcon_eprescription.php');
$stateId = $_GET["stateId"];
$count = 0;
$All_zones = "";
$query = "select * from zone where stateId='$stateId'";
$stmt = $con->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $row) {
	$zoneName = $row['zoneName'];
	$zoneId = $row['zoneId'];
	$zone = $zoneId . '_' . $zoneName;
	$All_zones = $All_zones . ',' . $zone;
	if ($count == 0) {
		$All_zones = $zone;
	}
	$count = $count + 1;
}
echo  $All_zones;
