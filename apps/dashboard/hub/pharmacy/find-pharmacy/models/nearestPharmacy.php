<?php
ob_start();

function getNearestPharmacies($lat, $lng){
    include('../../constants/databases/dbcon_eprescription.php');
    $query_p = <<<EOF
     SELECT pharmacy.*, woreda.woredaName,zone.zoneName, state.stateName FROM (
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
    )  pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  WHERE pharmacy.isDeleted=0 AND
    pharmacy.status='Active' ORDER BY distance ASC LIMIT 50;
EOF;

    $stmt_p = $con->prepare($query_p);
    $stmt_p->execute();
    $rows_p = $stmt_p->fetchAll();
    return $rows_p;
}


function searchPharmacies($lat, $lng, $search){
    include('../../constants/databases/dbcon_eprescription.php');
    $query_p = <<<EOF
     SELECT pharmacy.*, woreda.woredaName,zone.zoneName, state.stateName FROM (
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
    )  pharmacy INNER JOIN woreda on woreda.woredaId=pharmacy.woredaId INNER JOIN zone on zone.zoneId=pharmacy.zoneId INNER JOIN state on state.stateId=pharmacy.stateId  WHERE pharmacy.isDeleted=0 AND
    pharmacy.status='Active' AND (pharmacy.pharmacyType LIKE '$search%'  OR pharmacy.pharmacyName LIKE '$search%'  OR pharmacy.kebelle LIKE '$search%'  OR pharmacy.streetNumber LIKE '$search%'  OR pharmacy.pharmacyType LIKE '$search%'  OR pharmacy.email LIKE '$search%'  OR pharmacy.phoneNumber LIKE '$search%'  OR pharmacy.licenceNumber LIKE '$search%'  OR pharmacy.registrationNumber LIKE '$search%' OR state.stateName LIKE '$search%'  OR zone.ZoneName LIKE '$search%'  or woreda.woredaName LIKE '$search%' ) ORDER BY distance ASC LIMIT 50;
EOF;

    $stmt_p = $con->prepare($query_p);
    $stmt_p->execute();
    $rows_p = $stmt_p->fetchAll();
    return $rows_p;
}



?>