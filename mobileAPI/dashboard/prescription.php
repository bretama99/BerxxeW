  <?php



    if (isset($_GET['oncall']))
     $oncall =$_GET['oncall']();

   if (isset($_POST['oncall']))
     $oncall =$_POST['oncall']();
      
     

//1. -------------------searching patients for prescription by a doctor. -----------------------  
// POST
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
    if ($json=='[]')
      echo json_encode("no_result_found");
    else
    echo $json;
  }else echo 0;
  
}


// 2-----registering a patient by a doctor for immediate prescriptions.
// POST

function addPatientByDoctor(){

  include('../../../constants/databases/dbcon_eprescription.php');

  $titleId = $_POST['titleId'];
  $firstName = $_POST['firstName'];
  $fatherName = $_POST['fatherName'];
  $grandFatherName = $_POST['grandFatherName'];
  $mobilePhone = $_POST['mobilePhone'];
  $dateOfBirth = $_POST['dateOfBirth'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $prescriberUsersId = $_POST['prescriberUsersId'];

  $AddE_query ="insert into users (firstName,fatherName,grandFatherName,titleId,gender,dateOfBirth,mobilePhone, email,registeredById) 
                        values('$firstName','$fatherName','$grandFatherName','$titleId','$gender','$dateOfBirth','$mobilePhone','$email','$prescriberUsersId')";
            $stmtaddE = $con->prepare($AddE_query);
            $resultE=$stmtaddE->execute();
            $patient_id = $con->lastInsertId();

            if ($resultE)
              echo json_encode($patient_id);
            else echo json_encode(0);
}

// 3-----Write prescription by a doctor...

function writePrescription(){

  include('../../../constants/databases/dbcon_eprescription.php');
  $patientUsersId = $_POST['patientUsersId'];
  $prescriberUsersId = $_POST['prescriberUsersId'];
  $chiefCompliant=$_POST['chiefCompliant'];
  $diagnosis=$_POST['diagnosis'];
  $pharmacyId=$_POST['pharmacyId'];// 0 means to hub or to all pharmcies

  $drugId = explode(",",$_POST['drugId']);
  $dose = explode(",",$_POST['dose']);
  $doseUnit = explode(",",$_POST['doseUnit']);
  $frequency = explode(",",$_POST['frequency']);
  $route = explode(",",$_POST['route']);
  $duration = explode(",",$_POST['duration']);
  $durationUnit = explode(",",$_POST['durationUnit']);
  $totalQty = explode(",",$_POST['totalQty']);
  $qtyUnit = explode(",",$_POST['qtyUnit']);
  $instructions = explode(",",$_POST['instructions']);
  $additionalInstructions = explode(",",$_POST['additionalInstructions']);

  $numDrugs=count($drugId);

  
   // Transactions Begins
  $con->beginTransaction();


  $query1 = "SELECT MPI from patientindex where patientId='$patientUsersId'";
          $stmt1 = $con->prepare($query1);
          $success1=$stmt1->execute();
          $count1 = $stmt1->rowCount();
          if($count1 == 0){
             
          $query2 = "SELECT max(MPI) as MPI from patientindex FOR UPDATE";
          $stmt2 = $con->prepare($query2);
          $success2=$stmt2->execute();
          $rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
          foreach($rows2 as $row){
              $maxMPI = $row['MPI'];
          }
          $maxMPI+=1;
          $query3 ="insert into patientindex (patientId,MPI) values('$patientUsersId','$maxMPI')";
          $stmt3 = $con->prepare($query3);
          $result3=$stmt3->execute();

          }

      $AddE_query4 ="insert into prescription (patientId,prescriberId, chiefCompliant,diagnosis, pharmacyId,status) values('$patientUsersId','$prescriberUsersId','$chiefCompliant','$diagnosis','$pharmacyId','Prescribed')";
      $stmtaddE4 = $con->prepare($AddE_query4);
      $resultE4=$stmtaddE4->execute();
       
       if($resultE4)
          $prescriptionId = $con->lastInsertId();
       
      for ($i=0;$i< $numDrugs;$i++){
      $AddE_query5 ="insert into prescribeddrugs (prescriptionId,drugsId,drugsDose,drugsDoseUnit,drugsFrequency,drugsRoute,drugsDuration,drugsDurationUnit,totalQty,qtyUnit,drugsInstructions,drugsAdditionalInstructions,status,pharmacyId) 
                    values('$prescriptionId','$drugId[$i]','$dose[$i]','$doseUnit[$i]','$frequency[$i]','$route[$i]','$duration[$i]','$durationUnit[$i]','$totalQty[$i]','$qtyUnit[$i]','$instructions[$i]','$additionalInstructions[$i]','Prescribed','$pharmacyId')";
      $stmtaddE5 = $con->prepare($AddE_query5);
      $resultE5=$stmtaddE5->execute();
        }


        if($success1 && ($count1 > 0 || $success2 && $result3) && $resultE4 && $resultE5 ){
                  $con->commit();
                  $x = ["1",$prescriptionId];
                  echo json_encode($x);
          }else{
              $con->rollback();
              echo json_encode(0);
          }
}




 

	?>

	
