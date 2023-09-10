<?php
$rolesId = $_SESSION['rolesId'];
$U_query = "select firstName,fatherName,grandFatherName,userName,password,gender,users.usersId,email,mobilePhone,officePhone, 
								dateOfBirth,lastLoginTime,users.status,profilePicture,users.countryId,countryName,users.stateId,stateName,users.zoneId,zoneName,users.woredaId,woredaName,kebelle,rolesName,emailVerification
								from users join usersrole ON users.usersId=usersrole.usersId
                                join roles ON roles.rolesId=usersrole.rolesId
								left join woreda ON users.woredaId=woreda.woredaId
								left join zone ON users.zoneId=zone.zoneId
								left join state ON users.stateId=state.stateId
								left join country ON users.countryId=country.countryId
								where users.usersId='$usersId' AND usersrole.rolesId='$rolesId'";
$U_stmt = $con->prepare($U_query);
$U_success = $U_stmt->execute();
$U_rows = $U_stmt->fetchAll(PDO::FETCH_ASSOC);
$id = 0;
foreach ($U_rows as $row) {
    $usersId = $row['usersId'];
    $profilePicture = $row['profilePicture'];
    $firstName = $row['firstName'];
    $fatherName = $row['fatherName'];
    $grandFatherName = $row['grandFatherName'];
    $email = $row['email'];
    $userName = $row['userName'];
    $password = $row['password'];
    $countryId = $row['countryId'];
    $countryName = $row['countryName'];
    $dateOfBirth = $row['dateOfBirth'];
    $stateId = $row['stateId'];
    $stateName = $row['stateName'];
    $zoneId = $row['zoneId'];
    $zoneName = $row['zoneName'];
    $woredaId = $row['woredaId'];
    $woredaName = $row['woredaName'];
    $kebelle = $row['kebelle'];
    $mobilePhone = $row['mobilePhone'];
    $officePhone = $row['officePhone'];
    $lastLoginTime = $row['lastLoginTime'];
    $status = $row['status'];
    $rolesName = $row['rolesName'];
    $emailVerification = $row['emailVerification'];
    $Full_name = $firstName . ' ' . $fatherName . ' ' . $grandFatherName;
  
}
