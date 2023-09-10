<?php
//shebang at the top of your PHP file, so the system knows where to find PHP.
#!/usr/bin/php
ob_start();
include('../constants/databases/dbcon_eprescription.php');

$dist = 0;
$updateInterval = 0.20; // in muinutes
$waitingDays = 2; // number of days
date_default_timezone_set('Africa/Addis_Ababa');

function getDistanceBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km')
{
    $theta = $longitude1 - $longitude2;
    $distance = sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta));

    $distance = acos($distance);
    $distance = rad2deg($distance);
    $distance = $distance * 60 * 1.1515;

    switch ($unit) {
        case 'Mi':
            break;
        case 'Km':
            $distance = $distance * 1.609344;
    }


    return (round($distance, 2));
}

function getPharmaciesInTheRange($lat, $lng, $dist)
{
    include('../constants/databases/dbcon_eprescription.php');
    $query_p = <<<EOF
    SELECT * FROM (
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
        as distance FROM `pharmacy`
    ) pharmacy
    WHERE distance <= $dist and status='Active';
EOF;
    //LIMIT 15
    $stmt_p = $con->prepare($query_p);
    $stmt_p->execute();
    $rows_p = $stmt_p->fetchAll();

    return $rows_p;
}

//$date1 = new DateTime("now");
//$date2 = new DateTime("tomorrow");

$query = "SELECT  * FROM uploadedprescriptions where status='Pending' and uploadedDate >= NOW() - INTERVAL '$waitingDays' DAY";
$stmt = $con->prepare($query);
$success2 = $stmt->execute();
$rows = $stmt->fetchAll();

// needs optimization
foreach ($rows as $rowsUploaded) {
    $query_uploadedprescriptionstatus = "SELECT  count(*) FROM uploadedprescriptionstatus where status='Accepted' and uploadedPrescriptionsId='" . $rowsUploaded['uploadedPrescriptionsId'] . "'";
    $result_uploadedprescriptionstatus = $con->prepare($query_uploadedprescriptionstatus);
    $result_uploadedprescriptionstatus->execute();
    $numberOfAccepted = $result_uploadedprescriptionstatus->fetchColumn();
    if ($numberOfAccepted < 3) {
        $timeDiff = 0;
        //--------------------selecting the last kilometer --------------
        $query_nearbyPharmacyCache = "SELECT  * FROM nearbypharmacycache where uploadedPrescriptionsId='" . $rowsUploaded['uploadedPrescriptionsId'] . "'  and nearbyPharmacyCacheId=(select max(nearbyPharmacyCacheId) as id from nearbypharmacycache where uploadedPrescriptionsId='" . $rowsUploaded['uploadedPrescriptionsId'] . "')";
        $result_nearbyPharmacyCache = $con->prepare($query_nearbyPharmacyCache);
        $result_nearbyPharmacyCache->execute();
        $rows_cached = $result_nearbyPharmacyCache->fetchAll();


        foreach ($rows_cached as $row_chached) { // returns one row.
            $dist = $row_chached['distance'];
            $addedDate = $row_chached['addedDate'];

            $to_time = strtotime(date("Y-m-d H:i:s"));
            $from_time = strtotime($addedDate);
            $timeDiff = round(abs($to_time - $from_time) / 60, 0);



        }
        $i = 0;

        echo $updateInterval . '_' . $timeDiff . '   ';
        if ($timeDiff >= $updateInterval || $dist == 0) {


            if ($dist == 0) {
                $i = 0;
            } else if ($dist > 0 && $dist <= 2) {
                $i = 1;
            } else if ($dist > 2 && $dist <= 5) {
                $i = 2;
            } else if ($dist > 5 && $dist <= 10) {
                $i = 3;
            } else if ($dist > 10 && $dist <= 20) {
                $i = 4;
            }


            $radius = array(2, 5, 10, 20, 30);
            $rows_p;
            $considered_upper_range_for_each_uploaded_file;

            for ($j = $i; $j < sizeof($radius); $j++) {
                $rows_p = getPharmaciesInTheRange($rowsUploaded['latitude'], $rowsUploaded['longitude'], $radius[$j]);
                $considered_upper_range_for_each_uploaded_file = $radius[$j];
                //echo $considered_upper_range_for_each_uploaded_file.'__'.$rowsUploaded['uploadedPrescriptionsId'].'  ';
                if (sizeof($rows_p) == 0)
                    continue;
                else
                    break;

            }

            if (sizeof($rows_p) == 0) {
                $query_update = "update uploadedprescriptions set status='Not in Range' where uploadedPrescriptionsId='" . $rowsUploaded['uploadedPrescriptionsId'] . "'";
                $stmt_update = $con->prepare($query_update);
                $stmt_update->execute();
            }

            foreach ($rows_p as $row_p) {

                $x = getDistanceBetweenPoints($rowsUploaded['latitude'], $rowsUploaded['longitude'], $row_p['latitude'], $row_p['longitude']);

                $pharmacyId = $row_p['pharmacyId'];
                $uploadedPrescriptionsId = $rowsUploaded['uploadedPrescriptionsId'];


                $cnt = "select count(*) from nearbypharmacycache where uploadedPrescriptionsId='$uploadedPrescriptionsId' and pharmacyId ='" . $pharmacyId . "'";

                $result_cnt = $con->prepare($cnt);
                $success_sel = $result_cnt->execute();
                $numberCnt = $result_cnt->fetchColumn();


                if ($success_sel and $numberCnt == 0 and $x <= $considered_upper_range_for_each_uploaded_file) {

                    $qry_insert_cache = "INSERT INTO nearbypharmacycache (pharmacyId, distance, uploadedPrescriptionsId,released)VALUES('$pharmacyId','$x', '$uploadedPrescriptionsId',0)";

                    $result_nearbyPharmacyCacheInsert = $con->prepare($qry_insert_cache);
                    $result_nearbyPharmacyCacheInsert->execute();
                    $x = 0;
                }


                //echo $row_p["pharmacyName"]."  estimated dist: ".$x." distance".$uploadedPrescriptionsId;

            }


        } // wait for 30 minutes to expire

    } //if less than threes


}

//-----------finally delete multicasted requests if not served with in the waiting day
$query = "delete FROM nearbypharmacycache where addedDate <= NOW() - INTERVAL '" . $waitingDays . "' DAY";
$stmt = $con->prepare($query);
$success1 = $stmt->execute();

/*
1. check if there is posted prescriptions with in the last  day (<=24 hours)
2. check if the posted prescription is accepted by atleast three pharmacies
3. if the prescription is not accepted or accepted by less then three pharmacies:
-> multicast to the pharmacies available with in 2 Km radius, if not available try for the next possible radius 5,10,20, and 30 sequentialy and wait for 30 minutes if and only if pharmacy exists.
-> if not available with in the maxmium range set the uploadedprescriptions status to 'Not in Range' automatically
-> if pharmacies are with in the range but not accepted the request with in 30 minutes, add another pharmacies with in the next required range into the nearest pharmacy.
4. the nearst pharmacy cache will be cleared in every 24 hours automatically
*/

?>