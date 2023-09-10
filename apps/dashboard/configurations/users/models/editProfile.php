<?php
if (isset($_POST['Change_username'])) {
    $usersId = $_POST['usersId'];
    $userName = $_POST['userName'];
    $userName = ucfirst(strtolower($userName));
    $Check_username_query = "select count(*) from users where userName = '$userName' AND usersId!='$usersId' AND isDeleted=0 ";
    $stmtU = $con->prepare($Check_username_query);
    $stmtU->execute();
    $rowsU = $stmtU->fetchColumn();
    if ($rowsU == 0) {
        $Update_uname = "update users set userName='$userName' where usersId='$usersId'";
        $stmtUpdate = $con->prepare($Update_uname);
        $result = $stmtUpdate->execute();
        if ($result) {
            $_SESSION['Uname'] = $userName;
            $_SESSION['success'] = 'set';
            header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
        }
    } else {
        $_SESSION['error_user'] = 'Username Occupied. try another!';
        header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
    }
}

if (isset($_POST['Change_pass'])) {
    $usersId = $_POST['usersId'];
    $Db_pass = $_POST['Db_pass'];
    $Old_pass = $_POST['Old_pass'];
    $New_pass = $_POST['New_pass'];
    $Confirm_pass = $_POST['Confirm_pass'];
    if ($New_pass == $Confirm_pass) {
        $Old_enc_password = hash_hmac('sha512', $Old_pass, $salt);
        if ($Db_pass == $Old_enc_password) {
            $enc_password = hash_hmac('sha512', $New_pass, $salt);
            $Update_Pword = "update users set password='$enc_password' where usersId='$usersId'";
            $stmtUpdateP = $con->prepare($Update_Pword);
            $resultP = $stmtUpdateP->execute();
            if ($resultP) {
                $_SESSION['success_user'] = 'Password Changed';
                header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
            }
        } else {
            $_SESSION['error_user'] = 'Old Password not Correct';
            header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
        }
    } else {
        $_SESSION['error_user'] = 'Both Passwords do not match';
        header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
    }
}

if (isset($_POST['Change_phone'])) {
    $usersId = $_POST['usersId'];
    $mobilePhone = $_POST['mobilePhone'];
    $Update_phone = "update users set mobilePhone='$mobilePhone' where usersId='$usersId'";
    $stmtUpdate = $con->prepare($Update_phone);
    $result = $stmtUpdate->execute();
    if ($result) {
        $_SESSION['success'] = "set";
        header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
    }
}
if (isset($_POST['Change_DOB'])) {
    $usersId = $_POST['usersId'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $Update_phone = "update users set dateOfBirth='$dateOfBirth' where usersId='$usersId'";
    $stmtUpdate = $con->prepare($Update_phone);
    $result = $stmtUpdate->execute();
    if ($result) {
        $_SESSION['success'] = "set";
        header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
    }
}
if (isset($_POST['change_profile_pic'])) {
    $Image_uploaded = 0;
    $usersId = $_POST['usersId'];
    $userName = $_POST['userName'];
    $Pre_Profile_pic = $_POST['Pre_Profile_pic'];
    if (isset($_FILES['profilePicture'])) {
        if (is_uploaded_file($_FILES['profilePicture']['tmp_name'])) {
            function generateRString($length = 5)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $Random_String = generateRString();
            $filePathO = $_FILES['profilePicture']['name'];
            $fileTypeO = substr($filePathO, strrpos($filePathO, '.') + 1);
            $Image_name = $userName . '_' . $Random_String . '.' . $fileTypeO;
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], '../../images/profile_pic/' . $Image_name)) {
                $Image_uploaded = 1;
            }
        }
    }
    if ($Image_uploaded == 1) {
        // update table 
        $Update_OIM_query = "update users set profilePicture='$Image_name' where usersId='$usersId'";
        $stmtupdate_OIM = $con->prepare($Update_OIM_query);
        $result_OIM = $stmtupdate_OIM->execute();
        if ($result_OIM) { // if table updated delete previous image
            if ($Pre_Profile_pic != "defaultFemale.jpg" and $Pre_Profile_pic != "defaultMale.jpg") {
                unlink("../../images/profile_pic/" . $Pre_Profile_pic); // as image is uploaded delete the image

            }
            $_SESSION['success'] = 'set';
            header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
        }
    }
}

if (isset($_POST['Upload_File'])) {
    $File_uploaded = 0;
    $usersId = $_POST['usersId'];
    $userName = $_POST['userName'];
    $File_For = $_POST['File_For'];
    if ($File_For == 'Pharmacist') {
        $folder = 'pharmacist';
    } else if ($File_For == 'Physician') {
        $folder = 'physician';
    } else if ($File_For == 'PharmacyOwner') {
        $folder = 'pharmacyowner';
    }
    if (isset($_FILES['theFile'])) {
        if (is_uploaded_file($_FILES['theFile']['tmp_name'])) {
            function generateRString($length = 5)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $Random_String = generateRString();
            $filePathO = $_FILES['theFile']['name'];
            $fileTypeO = substr($filePathO, strrpos($filePathO, '.') + 1);
            $fileName = $userName . '_' . $Random_String . '.' . $fileTypeO;
            $fileSize = $_FILES['theFile']['size'];
            if (move_uploaded_file($_FILES['theFile']['tmp_name'], '../../files/providersDocuments/' . $folder . '/' . $fileName)) {
                $File_uploaded = 1;
            }
        }
    }
    if ($File_uploaded == 1) {
        // update table 
        $insertFile = "insert into providersdocuments(File_For,folder,fileName,fileType,fileSize,usersId) values('$File_For','providersDocuments/$folder','$fileName','$fileTypeO','$fileSize','$usrUsersId')";
        $stmtInsertFile = $con->prepare($insertFile);
        $result_File = $stmtInsertFile->execute();
        if ($result_File) {
            $_SESSION['success'] = 'set';
            header("location:?name=configurations/users/profile&var=profile&usersId=$usersId");
        } else {
            unlink('../../files/providersDocuments/' . $folder . '/' . $fileName); // as image is uploaded delete the image
        }
    }
}

if (isset($_POST['requestPharmacistRole'])) {

    $roleRequestId = 0;
    $usersId = $usrUsersId;
    $rolesId = $_POST['rolesId'];
    $educationalLevelId = $_POST['educationalLevelId'];
    $graduatedFrom = $_POST['graduatedFrom'];
    $graduationYear = $_POST['graduationYear'];
    $licenceNo = $_POST['licenceNo'];
    $licenceExpirationDate = $_POST['licenceExpirationDate'];
    $qualification = $_POST['qualification'];
    $con->beginTransaction();
    $Check_R = "select count(*) from rolerequest where usersId = '$usersId' AND rolesId=2";
    $stmtR = $con->prepare($Check_R);
    $stmtR->execute();
    $rowsR = $stmtR->fetchColumn();
    if ($rowsR == 0) {
        $Add_query = "insert into rolerequest (usersId,rolesId) values('$usersId','$rolesId') ";
        $stmtAddC = $con->prepare($Add_query);
        $resultC = $stmtAddC->execute();
        if ($resultC) {
            $RRI_query = "select roleRequestId from rolerequest where usersId='$usrUsersId' AND rolesId='$rolesId' AND status='Pending' order by roleRequestId DESC limit 1";
            $RRI_stmt = $con->prepare($RRI_query);
            $RRI_success = $RRI_stmt->execute();
            $RRI_rows = $RRI_stmt->fetchAll();
            foreach ($RRI_rows as $row) {
                $roleRequestId = $row['roleRequestId'];
            }
            if ($roleRequestId != 0) {
                $AddRR_query = "insert into pharmacistinfo (roleRequestId,usersId,educationalLevelId,graduatedFrom,graduationYear,licenceNo,licenceExpirationDate,qualification) 
              values('$roleRequestId','$usersId','$educationalLevelId','$graduatedFrom','$graduationYear','$licenceNo','$licenceExpirationDate','$qualification') ";
                $stmtAddRR = $con->prepare($AddRR_query);
                $resultRR = $stmtAddRR->execute();
                if ($resultRR) {
                    $con->commit();
                    $_SESSION['success'] = 'set';
                    header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
                } else {
                    $con->rollback();
                    $_SESSION['error_user'] = 'Error requesting role';
                    header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
                }
            }
        }
    } else {
        $con->rollback();
        $_SESSION['error_user'] = 'you have already requested for this role';
        header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
    }
}

if (isset($_POST['requestPhysicianRole'])) {
    $roleRequestId = 0;
    $usersId = $usrUsersId;
    $rolesId = $_POST['rolesId'];
    $educationalLevelId = $_POST['educationalLevelId'];
    $graduatedFrom = $_POST['graduatedFrom'];
    $graduationYear = $_POST['graduationYear'];
    $HealthInstitutionName = $_POST['HealthInstitutionName'];
    $licenceNo = $_POST['licenceNo'];
    $licenceExpirationDate = $_POST['licenceExpirationDate'];
    $specializationId = $_POST['specializationId'];
    $con->beginTransaction();
    $Check_R = "select count(*) from rolerequest where usersId = '$usersId' AND rolesId=3";
    $stmtR = $con->prepare($Check_R);
    $stmtR->execute();
    $rowsR = $stmtR->fetchColumn();
    if ($rowsR == 0) {
        $Add_query = "insert into rolerequest (usersId,rolesId) values('$usersId','$rolesId') ";
        $stmtAddC = $con->prepare($Add_query);
        $resultC = $stmtAddC->execute();
        if ($resultC) {
            $RRI_query = "select roleRequestId from rolerequest where usersId='$usrUsersId' AND rolesId='$rolesId' AND status='Pending' order by roleRequestId DESC limit 1";
            $RRI_stmt = $con->prepare($RRI_query);
            $RRI_success = $RRI_stmt->execute();
            $RRI_rows = $RRI_stmt->fetchAll();
            foreach ($RRI_rows as $row) {
                $roleRequestId = $row['roleRequestId'];
            }
            if ($roleRequestId != 0) {
                $AddRR_query = "insert into physicianinfo (roleRequestId,usersId,educationalLevelId,graduatedFrom,graduationYear,HealthInstitutionName,licenceNo,licenceExpirationDate,specializationId) 
              values('$roleRequestId','$usersId','$educationalLevelId','$graduatedFrom','$graduationYear','$HealthInstitutionName','$licenceNo','$licenceExpirationDate','$specializationId') ";
                $stmtAddRR = $con->prepare($AddRR_query);
                $resultRR = $stmtAddRR->execute();
                if ($resultRR) {
                    $con->commit();
                    $_SESSION['success'] = 'set';
                    header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
                } else {
                    $con->rollback();
                    $_SESSION['error_user'] = 'Error requesting role';
                    header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
                }
            }
        }
    } else {
        $con->rollback();
        $_SESSION['error_user'] = 'you have already requested for this role';
        header("location: index.php?name=profile&var=configurations/users/profile&usersId=$usersId");
    }
}

if (isset($_POST['requestPharmacyOwnerRole'])) {
    $roleRequestId = 0;
    $usersId = $usrUsersId;
    $rolesId = $_POST['rolesId'];
    $pharmacyNameAdd = $_POST['pharmacyNameAdd'];
    $pharmacyTypeAdd = $_POST['pharmacyTypeAdd'];
    $licenceNumberAdd = $_POST['licenceNumberAdd'];
    $registrationNumberAdd = $_POST['registrationNumberAdd'];
    $countryAdd = $_POST['countryAdd'];
    $stateAdd = $_POST['stateAdd'];
    $zoneAdd = $_POST['zoneAdd'];
    $woredaAdd = $_POST['woredaAdd'];
    $kebelleAdd = $_POST['kebelleAdd'];
    $streetNumberAdd = $_POST['streetNumberAdd'];
    $emailAdd = $_POST['emailAdd'];
    $phoneNumberAdd = $_POST['phoneNumberAdd'];
    $openingTimeAdd = $_POST['openingTimeAdd'];
    $closingTimeAdd = $_POST['closingTimeAdd'];
    $latitudeAdd = $_POST['latitudeAdd'];
    $longitudeAdd = $_POST['longitudeAdd'];
    $tinNumberAdd = $_POST['tinNumberAdd'];
    $regById = $_POST['regById'];
    $con->beginTransaction();
    $Check_R = "select count(*) from rolerequest where usersId = '$usersId' AND rolesId=4";
    $stmtR = $con->prepare($Check_R);
    $stmtR->execute();
    $rowsR = $stmtR->fetchColumn();
    if ($rowsR == 0) {
        $Add_query = "insert into rolerequest (usersId,rolesId) values('$usersId','$rolesId') ";
        $stmtAddC = $con->prepare($Add_query);
        $resultC = $stmtAddC->execute();
        if ($resultC) {
            $RRI_query = "select roleRequestId from rolerequest where usersId='$usrUsersId' AND rolesId='$rolesId' AND status='Pending' order by roleRequestId DESC limit 1";
            $RRI_stmt = $con->prepare($RRI_query);
            $RRI_success = $RRI_stmt->execute();
            $RRI_rows = $RRI_stmt->fetchAll();
            foreach ($RRI_rows as $row) {
                $roleRequestId = $row['roleRequestId'];
            }
            if ($roleRequestId != 0) {
                $Add_query = "insert into pharmacy (pharmacyName, pharmacyType, licenceNumber, registrationNumber,countryId, stateId, zoneId, woredaId, kebelle, streetNumber, email, phoneNumber,  tinNumber,longitude,latitude,openingAt,closingAt,registeredById) values('$pharmacyNameAdd', '$pharmacyTypeAdd', '$licenceNumberAdd', '$registrationNumberAdd','$countryAdd',  '$stateAdd', '$zoneAdd', '$woredaAdd', '$kebelleAdd', '$streetNumberAdd', '$emailAdd', '$phoneNumberAdd',  '$tinNumberAdd','$longitudeAdd','$latitudeAdd','$openingTimeAdd','$closingTimeAdd','$regById')";
                $stmtAddRR = $con->prepare($Add_query);
                $resultRR = $stmtAddRR->execute();
                if ($resultRR) {
                    $con->commit();
                    $_SESSION['success'] = 'set';
                    header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
                }
            } else {
                $con->rollback();
                $_SESSION['error_user'] = 'Error requesting role';
                header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
            }
        }
    } else {
        $con->rollback();
        $_SESSION['error_user'] = 'you have already requested for this role';
        header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
    }
}


if (isset($_POST['editAddress'])) {

    $usersId = $_POST['usersId'];
    $countryId = $_POST['countryId'];
    $stateId = $_POST['stateId'];
    $zoneId = $_POST['zoneId'];
    $woredaId = $_POST['woredaId'];
    $kebelle = $_POST['kebelle'];

    // $C_query = "select countryId from country where countryName ='$country'";
    // $C_stmt = $con->prepare($C_query);
    // $C_stmt->execute();
    // $countryId = $C_stmt->fetchColumn();

    // // state 
    // $S_query = "select stateId from state where stateName='$state' ";
    // $S_stmt = $con->prepare($S_query);
    // $S_stmt->execute();
    // $stateId = $S_stmt->fetchColumn();

    // // zone
    // $Z_query = "select zoneId from zone where zoneName='$zone' ";
    // $Z_stmt = $con->prepare($Z_query);
    // $Z_stmt->execute();
    // $zoneId = $Z_stmt->fetchColumn();

    // // Woreda
    // $W_query = "select woredaId from woreda where woredaName='$woreda' ";
    // $W_stmt = $con->prepare($W_query);
    // $W_stmt->execute();
    // $woredaId = $W_stmt->fetchColumn();

    if ($countryId != 0 && $stateId != 0 && $zoneId != 0 && $woredaId != 0) {
        $update_query = "update users set countryId='$countryId',stateId='$stateId',zoneId='$zoneId',woredaId='$woredaId',kebelle='$kebelle' where usersId='$usersId'";
        $stmtA = $con->prepare($update_query);
        $resultA = $stmtA->execute();
        if ($resultA) {
            $_SESSION['success'] = 'set';
            header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
        }
    } else {
        $_SESSION['error_user'] = 'Address not updated. please Try Again!';
        header("location: index.php?name=configurations/users/profile&var=profile&usersId=$usersId");
    }
}
