<?php
session_start();
include('../../../../../constants/databases/dbcon_eprescription.php');
$folder_name = '../../../../../files/providersDocuments/pharmacyowner/';

if (!empty($_FILES)) {
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        function generateRString($length = 5)
        {
            $characters = '0123456789abcdefghijklmnopqrst';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $Random_String = generateRString();
        $Uname = $_SESSION['Uname'];
        $usersId = $_SESSION['usrUsersId'];
        $filePathO = $_FILES['file']['name'];
        $fileTypeO = substr($filePathO, strrpos($filePathO, '.') + 1);
        $fileName = $Uname . '_' . $Random_String . '.' . $fileTypeO;
        $fileSize = $_FILES['file']['size'];
        if (move_uploaded_file($_FILES['file']['tmp_name'], '../../../../../files/providersDocuments/pharmacyowner/' . $fileName)) {
            echo "true";
        }
    }
}

if (!empty($_GET["action"]) && $_GET["action"] == "save") {
    $insertFile = "insert into providersdocuments(File_For,folder,fileName,fileType,fileSize,usersId) values('PharmacyOwner','pharmacyowner','$fileName','$fileTypeO','$fileSize','$usersId')";
    $stmtInsertFile = $con->prepare($insertFile);
    $result_File = $stmtInsertFile->execute();
    if ($result_File) {
        //$_SESSION['success'] ='set';
        header("location:?name=configurations/users/profile&var=profile&userId=$usersId");
    } else {
        unlink("upload/" . $fileName); // as image is uploaded delete the image
    }
}

if (isset($_POST["name"])) {
    $folder_name = "../../../../../files/providersDocuments/pharmacyowner/";
    include('../../../../../constants/databases/dbcon_eprescription.php');
    $name = $_POST["name"];
    $filename = $folder_name . $_POST["name"];
    unlink($filename);

    $DeleteFile = " delete from providersdocuments where fileName='$name' AND File_For='PharmacyOwner'";
    $stmtDeleteFile = $con->prepare($DeleteFile);
    $result_File = $stmtDeleteFile->execute();
    if ($result_File) {
        echo "removed";
    }
}

$result = array();
$output = '<div class="row">';

$usersId = $_SESSION['usrUsersId'];
$U_query = "select * from providersdocuments where usersId='$usersId' AND File_For='PharmacyOwner'";
$U_stmt = $con->prepare($U_query);
$U_success = $U_stmt->execute();
$U_rows = $U_stmt->fetchAll();
$id = 0;
foreach ($U_rows as $row) {
    $file = $row['fileName'];
    $folder_name = "../../files/providersDocuments/pharmacyowner/";
    if ('.' !=  $file && '..' != $file) {
        $output .= '
		   <div class="col-md-3">
			<img src="' . $folder_name . $file . '" class="img-thumbnail" width="175" height="100" style="height:100px;" />
			<center><button type="button" class="btn btn-minier btn-danger remove_image3" id="' . $file . '">Remove</button></center>
		   </div>
		   ';
    }
}
$output .= '</div>';
echo $output;
