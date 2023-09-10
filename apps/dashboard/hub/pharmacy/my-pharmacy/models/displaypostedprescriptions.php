  <?php
  include('../../../../../../constants/databases/dbcon_eprescription.php');
       if (isset($_GET['pharmacyId'])) {
       	$pharmacyId=$_GET['pharmacyId'];
        $actionType=$_GET['actionType'];
               if ($actionType=='Posted'){
                $U_query = "select titleName,firstName,fatherName,grandFatherName,gender,users.usersId,users.email,mobilePhone, profilePicture, uploadedprescriptions.uploadedPrescriptionsId, imageName,comment,uploadedDate, nearbypharmacycache.distance,  nearbypharmacycache.pharmacyId, nearbypharmacycache.addedDate from uploadedprescriptions 
                INNER JOIN users ON uploadedprescriptions.usersId=users.usersId
                INNER JOIN nearbypharmacycache on uploadedprescriptions.uploadedPrescriptionsId=nearbypharmacycache.uploadedPrescriptionsId 
                INNER JOIN pharmacy on nearbypharmacycache.pharmacyId=pharmacy.pharmacyId
                JOIN title ON users.titleId=title.titleId where nearbypharmacycache.pharmacyId='".$pharmacyId."' and nearbypharmacycache.released=0   order by nearbypharmacycache.addedDate DESC LIMIT 30 ";
                $U_stmt = $con->prepare($U_query);
                $U_success=$U_stmt->execute();
                $U_rows = $U_stmt->fetchAll();
                 echo json_encode($U_rows);
               } else if ($actionType=='Accepted'){ 
                $U_query = "select titleName,firstName,fatherName,grandFatherName,gender,users.usersId,users.email,mobilePhone, profilePicture, uploadedprescriptions.uploadedPrescriptionsId, imageName, comment, actionDate, distanceFromRequester as distance, pharmacy.pharmacyId from uploadedprescriptions 
                INNER JOIN users ON uploadedprescriptions.usersId=users.usersId
                INNER JOIN uploadedprescriptionstatus on uploadedprescriptions.uploadedPrescriptionsId=uploadedprescriptionstatus.uploadedPrescriptionsId 
                INNER JOIN pharmacy on uploadedprescriptionstatus.pharmacyId=pharmacy.pharmacyId
                JOIN title ON users.titleId=title.titleId where uploadedprescriptionstatus.pharmacyId='".$pharmacyId."'  and uploadedprescriptionstatus.status='Accepted' order by uploadedprescriptionstatus.actionDate DESC LIMIT 30 ";
                $U_stmt = $con->prepare($U_query);
                $U_success=$U_stmt->execute();
                $U_rows = $U_stmt->fetchAll();
                 echo json_encode($U_rows);

                 
        	
	             }else if ($actionType=='Dispensed'){ 

                $U_query = "select titleName,firstName,fatherName,grandFatherName,gender,users.usersId,users.email,mobilePhone, profilePicture, uploadedprescriptions.uploadedPrescriptionsId, imageName, comment, actionDate, distanceFromRequester as distance, pharmacy.pharmacyId from uploadedprescriptions 
                INNER JOIN users ON uploadedprescriptions.usersId=users.usersId
                INNER JOIN uploadedprescriptionstatus on uploadedprescriptions.uploadedPrescriptionsId=uploadedprescriptionstatus.uploadedPrescriptionsId 
                INNER JOIN pharmacy on uploadedprescriptionstatus.pharmacyId=pharmacy.pharmacyId
                JOIN title ON users.titleId=title.titleId where uploadedprescriptionstatus.pharmacyId='".$pharmacyId."'  and uploadedprescriptionstatus.status='Dispensed' order by uploadedprescriptionstatus.actionDate DESC LIMIT 30 ";
                $U_stmt = $con->prepare($U_query);
                $U_success=$U_stmt->execute();
                $U_rows = $U_stmt->fetchAll();
                 echo json_encode($U_rows);

               }
   }

	?>

	
