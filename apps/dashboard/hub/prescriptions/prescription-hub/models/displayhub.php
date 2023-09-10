<?php
if (isset($_POST['firstName'])) {
	$firstName = $_POST['firstName'];
	$fatherName = $_POST['fatherName'];
	$grandFatherName = $_POST['grandFatherName'];
	$mobilePhone = $_POST['mobilePhone'];
	if (!empty($firstName) || !empty($fatherName) || !empty($grandFatherName) || !empty($mobilePhone)) {
		$columnValues = "firstName LIKE '$firstName%' AND fatherName LIKE '$fatherName%'  AND grandFatherName LIKE '$grandFatherName%' AND mobilePhone LIKE '$mobilePhone%'";

		include('../../../../../../constants/databases/dbcon_eprescription.php');

		$query = "SELECT  usersId,firstName,fatherName,grandFatherName,titleName,mobilePhone,prescriptionId,prescriptionDate from users join title on users.titleId=title.titleId join prescription on users.usersId=prescription.patientId where prescription.status='Prescribed' AND prescription.pharmacyId=0 AND $columnValues ORDER BY prescriptionDate DESC";
		$stmt = $con->prepare($query);
		$success = $stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$json = json_encode($rows);

		echo $json;
	}
} else {
	header("location: ../index.php");
}
