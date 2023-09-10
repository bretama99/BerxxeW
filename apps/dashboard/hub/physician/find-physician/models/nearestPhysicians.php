<?php
ob_start();
function getNearestPhyscians($lat, $lng){
    include('../../constants/databases/dbcon_eprescription.php');
    $query_p = <<<EOF
     SELECT users.*, specialization.specializationName FROM (
        SELECT *, 
            (
                (
                    (
                        acos(
                            sin(( $lat * pi() / 180))
                            *
                            sin(( lastLoginLatitude * pi() / 180)) + cos(( $lat  * pi() /180 ))
                            *
                            cos(( lastLoginLatitude * pi() / 180)) * cos((($lng  - lastLoginLongitude) * pi()/180)))
                    ) * 180/pi()
                ) * 60 * 1.1515 * 1.609344
            )
        as distance FROM `users`
    )  users LEFT JOIN physicianinfo ON users.usersId=physicianinfo.usersId INNER JOIN specialization ON physicianinfo.specializationId= specialization.specializationId LEFT JOIN rolerequest on rolerequest.usersId=users.usersId where rolerequest.isDeleted=0 and rolerequest.status='Approved' and users.status='active' AND users.usersDefaultRolesId=3 group by users.usersId ORDER BY distance ASC LIMIT 50;
EOF;

    $stmt_p = $con->prepare($query_p);
    $stmt_p->execute();
    $rows_p = $stmt_p->fetchAll();
    return $rows_p;
}

function searchPhysicians($lat, $lng, $columnValues){
    include('../../constants/databases/dbcon_eprescription.php');
    $query_p = <<<EOF
     SELECT users.*, specialization.specializationName FROM (
        SELECT *, 
            (
                (
                    (
                        acos(
                            sin(( $lat * pi() / 180))
                            *
                            sin(( lastLoginLatitude * pi() / 180)) + cos(( $lat  * pi() /180 ))
                            *
                            cos(( lastLoginLatitude * pi() / 180)) * cos((($lng  - lastLoginLongitude) * pi()/180)))
                    ) * 180/pi()
                ) * 60 * 1.1515 * 1.609344
            )
        as distance FROM `users`
    )  users INNER JOIN physicianinfo ON users.usersId=physicianinfo.usersId INNER JOIN specialization ON physicianinfo.specializationId= specialization.specializationId  LEFT JOIN rolerequest on rolerequest.usersId=users.usersId where  ($columnValues) and rolerequest.isDeleted=0 and rolerequest.status='Approved' and users.status='active' AND users.usersDefaultRolesId=3 group by users.usersId ORDER BY distance ASC LIMIT 50
EOF;

    $stmt_p = $con->prepare($query_p);
    $stmt_p->execute();
    $rows_p = $stmt_p->fetchAll();
    return $rows_p;
}



?>