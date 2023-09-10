<?php
include("hub/analytics/apis/pharmacist/getTotalNumbers.php");
  $totalPrescriptionsSentToaPharmacy= getTotalPrescriptionsSentToPharmacy($_SESSION['pharmacyId']);
  $totalMedicationsSentToaPharmacy = getTotalMedicationsSentToPharmacy($_SESSION['pharmacyId']);
  $totalDispensedFromHubByPharmacy = getTotalMedicationsDispensedFromHubByPharmacy($_SESSION['pharmacyId']);
  $pharmacyInfo=getPharmacyInfo($_SESSION['pharmacyId']);
  $pharmacyId=$_SESSION['pharmacyId'];
  $lat=$pharmacyInfo['latitude'];
  $lng=$pharmacyInfo['longitude'];
  // from pharmacy registration
  //$totalDispensedMedicationsWithFiveKm = dispensedMedicationsWithFiveKm($lat,$lng,$dist=5);
  //$totalPostedPrescriptionsWithFiveKm = postedPrescriptionsWithFiveKm($lat,$lng,$dist=5);
  ?>

  <script src="../../js/charts/chart.js"></script>
  <div class="hr hr16 hr-dotted"></div>
  <div class="row">
    <div class="col-xs-12"><canvas id="numberOfPrescriptionsTrendChart" style="width:97%;"></canvas></div>
  </div>
  <div class="hr hr16 hr-dotted"></div>
  <div class="row">
    <div class="col-xs-12"><canvas id="numberOfMedicationsTrendChart" style="width:97%;"></canvas></div>
  </div>
  <div class="hr hr16 hr-dotted"></div>
  <div class="row">
    <div class="col-xs-12"><canvas id="numberOfMedicationsWithinFiveKmTrendChart" style="width:97%;"></canvas></div>
  </div>

  <div class="hr hr16 hr-dotted"></div>
  <div class="row">
    <div class="col-xs-6"><canvas id="numberOfPostedPrescriptionsWithinFiveKmTrendChart" style="width:97%;"></canvas></div>
    <div class="col-xs-6"><canvas id="postedPrescriptionsServedByaPharmacyTrendChart" style="width:97%;"></canvas></div>
  </div>

  <?php include("hub/analytics/apis/pharmacist/charts/numberOfPrescriptionsTrend.php"); ?>
  <?php include("hub/analytics/apis/pharmacist/charts/numberOfMedicationsTrend.php"); ?>
  <?php include("hub/analytics/apis/pharmacist/charts/numberOfMedicationsWithinFiveKmTrend.php");  
  numberOfMedicationsWithinFiveKm($lat, $lng, 5);
  ?>
  <?php include("hub/analytics/apis/pharmacist/charts/postedNumberOfPrescriptionsWithinFiveKmTrend.php");  
  postedNumberOfPrescriptionsWithinFiveKm($lat, $lng, 5);
  ?>
  <?php include("hub/analytics/apis/pharmacist/charts/uploadedPrescriptionsServedByAPharmacy.php");  
  uploadedPrescriptionsServedByAPharmacyWithinFiveKm($lat, $lng, 50, $pharmacyId);
  ?>
  <script>
    /*
    var totalPrescriptionsSentToaPharmacy = <?php echo json_encode($totalPrescriptionsSentToaPharmacy); ?>;
    var totalMedicationsSentToaPharmacy = <?php echo json_encode($totalMedicationsSentToaPharmacy); ?>;
    var totalDispensedFromHubByPharmacy = <?php echo json_encode($totalDispensedFromHubByPharmacy); ?>;
    var totalPrescribedMedicationsWithFiveKm = <?php echo json_encode($totalPrescribedMedicationsWithFiveKm); ?>;
    var totalDispensedMedicationsWithFiveKm = <?php echo json_encode($totalDispensedMedicationsWithFiveKm); ?>;
    var totalPostedPrescriptionsWithFiveKm = <?php echo json_encode($totalPostedPrescriptionsWithFiveKm); ?>;

    function filterParameters(totalArray, filterParams, attribute) {
      var varArray = totalArray.filter(function (el) {
        return el.status == filterParams;
      });
      if (varArray.length >= 1)
        return varArray[0][attribute];
      else return 0;
    }

    $(document).ready(function () {

     // $('#totalPrescriptionsSentToaPharmacy').html(totalPrescriptionsSentToaPharmacy);
    });
*/
  </script>
  