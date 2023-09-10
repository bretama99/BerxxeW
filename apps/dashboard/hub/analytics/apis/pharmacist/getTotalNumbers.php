<?php
 function getTotalPrescriptionsSentToPharmacy($pharmacyId){
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select prescription.status, count(*) as total FROM prescription INNER JOIN pharmacy on prescription.pharmacyId=pharmacy.pharmacyId  WHERE prescription.pharmacyId='.$pharmacyId.' GROUP BY prescription.status, prescription.isReleased";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
 }

 function getTotalMedicationsSentToPharmacy($pharmacyId){
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select prescribeddrugs.status, count(*) as total FROM prescription INNER JOIN prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId INNER JOIN  pharmacy on prescription.pharmacyId=pharmacy.pharmacyId  WHERE prescription.pharmacyId='.$pharmacyId.' GROUP BY prescribeddrugs.status, prescribeddrugs.released";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
 }

 function getTotalMedicationsDispensedFromHubByPharmacy($pharmacyId){
	include('../../constants/databases/dbcon_eprescription.php');
	$query = "select prescribeddrugs.status, count(*) as total FROM prescription INNER JOIN prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId INNER JOIN  pharmacy on prescribeddrugs.pharmacyId=pharmacy.pharmacyId  WHERE prescribeddrugs.pharmacyId='.$pharmacyId.' and prescribeddrugs.status='Dispensed'";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
 }

 /*function prescribedMedicationsWithFiveKm($lat, $lng, $dist=5){
	include('../../constants/databases/dbcon_eprescription.php');
    $query = <<<EOF
    SELECT prescribeddrugs.status as status, count(*) as total FROM (
        SELECT pharmacy.*, 
            (
                (
                    (
                        acos(
                            sin(( $lat * pi() / 180))
                            *
                            sin(( latitude * pi() / 180)) + cos(( $lat  * pi() /180 ))
                            *
                            cos(( latitude * pi() / 180)) * cos((($lng  - longitude) * pi()/180)))
                    ) * 180/pi()
                ) * 60 * 1.1515 * 1.609344
            )
        as distance FROM `pharmacy` 
    ) pharmacy INNER JOIN prescription ON prescription.pharmacyId=pharmacy.pharmacyId INNER JOIN prescribeddrugs ON prescription.pharmacyId=prescribeddrugs.pharmacyId WHERE distance <= $dist and prescribeddrugs.status="Prescribed";
EOF;
$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
 }
*/
 function dispensedMedicationsWithFiveKm($lat,$lng,$dist=5){
	include('../../constants/databases/dbcon_eprescription.php');
    $query = <<<EOF
    SELECT prescribeddrugs.status as status, count(*) as total FROM (
        SELECT pharmacy.*, 
            (
                (
                    (
                        acos(
                            sin(( $lat * pi() / 180))
                            *
                            sin(( latitude * pi() / 180)) + cos(( $lat  * pi() /180 ))
                            *
                            cos(( latitude * pi() / 180)) * cos((($lng  - longitude) * pi()/180)))
                    ) * 180/pi()
                ) * 60 * 1.1515 * 1.609344
            )
        as distance FROM `pharmacy` 
    ) pharmacy INNER JOIN prescribeddrugs on pharmacy.pharmacyId=prescribeddrugs.pharmacyId WHERE distance <= $dist and prescribeddrugs.status="Dispensed";
EOF;
$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
 }

 function postedPrescriptionsWithFiveKm($lat,$lng,$dist=5){
	include('../../constants/databases/dbcon_eprescription.php');
    $query = <<<EOF
    SELECT  status, count(*) as total FROM (
        SELECT *, 
            (
                (
                    (
                        acos(
                            sin(( $lat * pi() / 180))
                            *
                            sin(( latitude * pi() / 180)) + cos(( $lat  * pi() /180 ))
                            *
                            cos(( latitude * pi() / 180)) * cos((($lng  - longitude) * pi()/180)))
                    ) * 180/pi()
                ) * 60 * 1.1515 * 1.609344
            )
        as distance FROM `uploadedprescriptions` 
    ) uploadedprescriptions  WHERE distance <= $dist;
EOF;
$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
 }


 function getPharmacyInfo($pharmacyId){
    include('../../constants/databases/dbcon_eprescription.php');
    $query = "select * from pharmacy where pharmacyId='".$pharmacyId."'";
	$stmt = $con->prepare($query);
	$success=$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows[0];
 }

?>