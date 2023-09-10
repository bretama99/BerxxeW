<?php
ob_start();
include('./settings/client/client_info.php');
// if($deviceType=='Computer'){
session_start();
if (isset($_SESSION['Uname'])) {
    header("location: home");
}
include('../constants/databases/dbcon_eprescription.php'); // connecting to database
if (isset($_GET['usersId']) && isset($_GET['randomValue'])) {
    $usersId = $_GET['usersId'];
    $randomValue = $_GET['randomValue'];
    $Check_confirm_query = "select usersId from passwordreset where usersId ='$usersId' AND randomValue='$randomValue' AND resetStatus=0 ";
    $stmtC = $con->prepare($Check_confirm_query);
    $success = $stmtC->execute();
    $rowsCount = $stmtC->fetchColumn();
    if ($rowsCount > 0) {

        include('./layouts/header.php');  // connecting to database

?>


        <?php

        if (isset($_POST['signUpSection1'])) {
            include('./layouts/signup/signup_section2.php');
            include('./layouts/signup/intro_section.php');
        } else {
            include('./layouts/intro/intro_section.php');
            include('./layouts/signup/signup_section1.php');
        }
        include('./checkmedication/checkmedication.php');
        ?>
        <!-- Section: boxes -->
        <section id="boxes" class="home-section paddingtop-100">

            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-md-3">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box text-center">

                                <i class="fa fa-user-md fa-3x circled bg-skin"></i>
                                <h4 class="h-bold">Prescribe Online</h4>
                                <p>
                                    If you are physician you can prescribe medication online
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box text-center">

                                <i class="fa fa-search fa-3x circled bg-skin"></i>
                                <h4 class="h-bold">Find Pharmacy</h4>
                                <p>
                                    Find nearest pharmacy location to dispense your medication
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box text-center">
                                <i class="fa fa-check fa-3x circled bg-skin"></i>
                                <h4 class="h-bold">Dispense Medication</h4>
                                <p>
                                    If you are pharmacist dispense medications from the hub
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box text-center">

                                <i class="fa fa-file fa-3x circled bg-skin"></i>
                                <h4 class="h-bold">Get Medication Report</h4>
                                <p>
                                    Get automatically generated and well organized medication reports
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /Section: boxes -->
        <script>
            function setPharmacistRole() {
                document.getElementById('rolesId').value = 2;
                document.getElementById('signup_for').innerHTML = "Sign up as Pharmacist";
            }

            function setPhysicianRole() {
                document.getElementById('rolesId').value = 3;
                document.getElementById('signup_for').innerHTML = "Sign up as Physician";
            }

            function setPatientRole() {
                document.getElementById('rolesId').value = 1;
                document.getElementById('signup_for').innerHTML = "Sign up as Patient";
            }
        </script>
        <?php
        include('./layouts/footer.php');
        /*
 }
 else{
  header("location: index_mobile.php");
 }
 */
        ?>

        <?php
        if (isset($_POST['change_password'])) {
            $Pword = $_POST['Pword'];
            $CPword = $_POST['CPword'];
            if ($Pword == $CPword) {

                include('include/cryptsalt.php');
                $enc_new_password = hash_hmac('sha512', $Pword, $salt);
                $update_query = "update users set password = '$enc_new_password' where usersId = '$usersId'";
                $stmtU = $con->prepare($update_query);
                $successU = $stmtU->execute();
                if ($successU) {
                    $delete_query = "update passwordreset set resetStatus=1 where usersId='$usersId' AND randomValue='$randomValue'";
                    $stmtD = $con->prepare($delete_query);
                    $successD = $stmtD->execute();
                    if ($successD) {
                        $_SESSION['active'] = 'login';
                        $_SESSION['success_user'] = "password changed successfully, Login using new password";
                        header("location: index.php");
                    }
                }
            } else {
                $_SESSION['error_user'] = "Both passwords are not equal";
                header("location: change_password.php?usersId=$usersId&randomValue=$randomValue");
            }
        }
        ?>

<?php
    } else {
        $_SESSION['error_user'] = "link has been expired, search and send new confirmation";
        header("location:forgot_password.php?forgotPassword");
    }
} else {
    header("location:index.php");
}

?>