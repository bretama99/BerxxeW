  <?php
    if (isset($_GET['oncall']))
     $oncall =$_GET['oncall']();

   if (isset($_POST['oncall']))
     $oncall =$_POST['oncall']();
      

    // 1---------------find my prescription ------------------------
//API:   localhost/eprescription/mobileAPI/dashboard/patient.php?oncall=myDoctors&search=valueOfSearch&patienId=valueOfPatientId

// displaying the list of doctors at least with one presctiption to the patients.

function myDoctors (){ 
include('../../../constants/databases/dbcon_eprescription.php');
    $search = $_POST['search'];
    $usrUsersId=$_POST['patientId'];
    $cnt=0;
   
    ltrim($search);
    rtrim($search);

$searchArray = explode(" ", $search);
    $cnt=count($searchArray);
    
    if ($cnt=1){
      $columnValues="firstName LIKE '$searchArray[0]%'  or gender LIKE '$searchArray[0]%'  or email LIKE '$searchArray[0]%' or mobilePhone LIKE '$searchArray[0]%'";
    }else if($cnt=2){
      $columnValues="firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%'";
    }else if($cnt=3){
      $columnValues="firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%' and grandFatherName  LIKE '$searchArray[1]%'";
    }

       
      if($search !=''){
      
      $Usr_query = "select users.usersId, users.firstName,users.fatherName,users.grandFatherName, title.titleName, users.email,users.profilePicture, users.mobilePhone, users.kebelle, woreda.woredaName, zone.zoneName from users INNER JOIN prescription on prescription.prescriberId=users.usersId INNER JOIN title on users.titleId=title.titleId LEFT JOIN zone on users.zoneId=zone.zoneId LEFT JOIN woreda on users.woredaId=woreda.woredaId  where (".$columnValues.") and prescription.isDeleted=0 and prescription.patientId='".$usrUsersId."' group by prescription.prescriberId";
      }

    else {
      $Usr_query = "select users.usersId, users.firstName,users.fatherName,users.grandFatherName, title.titleName, users.email, users.profilePicture, users.mobilePhone, users.kebelle, woreda.woredaName, zone.zoneName from users INNER JOIN prescription on prescription.prescriberId=users.usersId INNER JOIN title on users.titleId=title.titleId LEFT JOIN zone on users.zoneId=zone.zoneId LEFT JOIN woreda on users.woredaId=woreda.woredaId  where prescription.isDeleted=0 and prescription.patientId='".$usrUsersId."'  group by prescription.prescriberId";

      
      }

      
      $Usr_stmt = $con->prepare($Usr_query);
      $Usr_success=$Usr_stmt->execute();
      $rows = $Usr_stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($rows);
        
      
	}


    // 2---------------List of prescriptions by a doctor ------------------------
//API:   localhost/eprescription/mobileAPI/dashboard/patient.php?oncall=listOfPrescriptionsByDoctor&patientId=valueOfPatientId&prescriberId=valueOfPrescriberId

// displaying the list of prescriptions by a selected doctor 


function listOfPrescriptionsByDoctor(){
 include('../../../constants/databases/dbcon_eprescription.php');

  $patientId=$_POST['patientId'];
  $prescriberId=$_POST['prescriberId'];
  
  $Usr_presc = "select * from prescription where prescriberId='".$prescriberId."' and patientId='".$patientId."' and isDeleted=0";
      $presc_stmt = $con->prepare($Usr_presc);
      $presc_success=$presc_stmt->execute();
      $rows_presc = $presc_stmt->fetchAll(PDO::FETCH_ASSOC);
      
      echo json_encode($rows_presc);
    
  }
 

    // 3---------------List of medications per-prescription ------------------------
//API:   localhost/eprescription/mobileAPI/dashboard/patient.php?oncall=listOfMedicationsPerPerscription&prescriptionId=valueOfPrescriptionId

// displaying the list of prescriptions by a selected doctor 


function listOfMedicationsPerPerscription(){
 include('../../../constants/databases/dbcon_eprescription.php');
  $prescriptionId=$_GET['prescriptionId'];
 $Usr_prescDrugs = "select prescribeddrugs.*, drugs.drugsName from prescribeddrugs INNER JOIN drugs on prescribeddrugs.drugsId=drugs.drugsId  where prescribeddrugs.prescriptionId='".$prescriptionId."' and prescribeddrugs.isDeleted=0";
      $prescDrugs_stmt = $con->prepare($Usr_prescDrugs);
      $prescDrugs_success=$prescDrugs_stmt->execute();
      $rows_prescDrugs = $prescDrugs_stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($rows_prescDrugs);
  }

  function displayPatients(){
    include('../../../constants/databases/dbcon_eprescription.php');
       $search = $_POST['search'];
           $cnt=0;
       ltrim($search);
       rtrim($search);
      if ($search !=''){
       $searchArray = explode(" ", $search);
       $cnt=count($searchArray);
       if ($cnt=1){
         $columnValues="firstName LIKE '$searchArray[0]%'  or gender LIKE '$searchArray[0]%'  or email LIKE '$searchArray[0]%' or mobilePhone LIKE '$searchArray[0]%' or MPI LIKE '$searchArray[0]%'";
       }else if($cnt=2){
         $columnValues="firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%'";
       }else if($cnt=3){
         $columnValues="firstName LIKE '$searchArray[0]%' and fatherName  LIKE '$searchArray[1]%' and grandFatherName  LIKE '$searchArray[1]%'";
       }
         $query = "SELECT  usersId,firstName,fatherName,grandFatherName,titleName,mobilePhone,dateOfBirth,MPI from users join title on users.titleId=title.titleId LEFT JOIN patientindex on users.usersId=patientindex.patientId where $columnValues";
       $stmt = $con->prepare($query);
       $success=$stmt->execute();
       $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
       $json = json_encode($rows);
       echo $json;
     }else 
     echo 0;
    }


	?>

	
