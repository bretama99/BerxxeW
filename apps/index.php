<?php
ob_start();
include('./settings/client/client_info.php');
session_start();
if (isset($_SESSION['Uname'])) 
{
  header("location:dashboard?name=hub/analytics/analytics&var=analytics");
}
include('../constants/databases/dbcon_eprescription.php'); 
include('./layouts/header.php'); 

if(isset($_POST['signUpSection1']) OR isset($_GET['signUpSection1'])){
 include('./layouts/signup/signup_section2.php');
 include('./layouts/signup/intro_section.php');
}
else{
include('./layouts/intro/intro_section.php');
include('./layouts/signup/signup_section1.php');
}
include('./checkmedication/checkmedication.php');
?>
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
<?php
include('./layouts/footer.php'); 
 /*
 }
 else{
  header("location: index_mobile.php");
 }
 */
?>