<?php
if (isset($_GET['phone'])) {
    include('../../../../constants/databases/dbcon_eprescription.php');
    $mobilePhone = ucfirst(strtolower($_GET['mobilePhone']));
    $count = 0;
    $I_query = "SELECT * from users where mobilePhone='$mobilePhone' AND isDeleted='0' ";
    $I_stmt = $con->prepare($I_query);
    $I_success = $I_stmt->execute();
    $I_rows = $I_stmt->fetchAll();
    foreach ($I_rows as $row) {
        $count = $count + 1;
    }
    if ($count > 0) {
        echo  "Yes";
    } else {
        echo  "No";
    }
} else {
    header("location: ../../../../../../index.php");
}
