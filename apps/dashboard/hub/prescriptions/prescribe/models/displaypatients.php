<?php
if (isset($_POST['firstName'])) {
	$firstName = $_POST['firstName'];
	$fatherName = $_POST['fatherName'];
	$grandFatherName = $_POST['grandFatherName'];
	$mobilePhone = $_POST['mobilePhone'];
	$MPI = $_POST['MPI'];
	$custodianPhone = $_POST['custodianPhone'];

	if (!empty($firstName) || !empty($fatherName) || !empty($grandFatherName) || !empty($mobilePhone)  || !empty($MPI)) {
		include('../../../../../../constants/databases/dbcon_eprescription.php');
		if (empty($patientId)) {
			$columnValues = "firstName LIKE '$firstName%' AND fatherName LIKE '$fatherName%'  AND grandFatherName LIKE '$grandFatherName%' AND MPI LIKE '$MPI%' AND (mobilePhone LIKE '$mobilePhone%' OR custodianPhone LIKE '$mobilePhone%')";
			$query = "SELECT  usersId,firstName,fatherName,grandFatherName,titleName,mobilePhone,custodianPhone,prescriptionId,MPI,prescriptionDate from users join title on users.titleId=title.titleId join prescription on users.usersId=prescription.patientId join patientindex on users.usersId=patientindex.patientId where $columnValues GROUP BY users.usersId ORDER BY prescriptionDate DESC";
		} else {
			$columnValues = "firstName LIKE '$firstName%' AND fatherName LIKE '$fatherName%'  AND grandFatherName LIKE '$grandFatherName%' AND MPI LIKE '$MPI%' AND (mobilePhone LIKE '$mobilePhone%' OR custodianPhone LIKE '$mobilePhone%')";
			$query = "SELECT  usersId,firstName,fatherName,grandFatherName,titleName,mobilePhone,custodianPhone,prescriptionId,MPI,prescriptionDate from users join title on users.titleId=title.titleId join prescription on users.usersId=prescription.patientId join patientindex on users.usersId=patientindex.patientId where $columnValues GROUP BY users.usersId ORDER BY prescriptionDate DESC";
		}
		$stmt = $con->prepare($query);
		$success = $stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$json = json_encode($rows);

		echo $json;
	}
} else {
	header("location: ../index.php");
}
