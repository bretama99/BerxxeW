<?php
include("hub/analytics/apis/admin/getTotalNumbers.php");
  $totalUsers = getTotalUsers();
  $totalPrescriptions = getTotalPrescriptions();
  $totalPatients = getTotalPatients();
  $totalPharmacies = getTotalPharmacies();
  $totalUsersWithAdditionalRoles = getTotalUsersWithAdditionalRoles();
  $totalUsersWithDefaultRoles = getTotalUsersWithDefaultRoles();
  $totalHubVisitors=getTotalHubVisitors();
  
  
  $totalPhyscian = 0;
  $totalPharmacist = 0;
  $totalPharmacyOwner = 0;
  $totalAllPharmacy = 0;
  ?>

  <script src="../../js/charts/chart.js"></script>

  <?php include("hub/analytics/apis/admin/displayTotalInNumbers.php"); ?>
  <div class="hr hr16 hr-dotted"></div>
  <div class="row">
    <div class="col-xs-12"><canvas id="usersTrendChart" style="width:97%;"></canvas></div>
  </div>
  <div class="hr hr16 hr-dotted"></div>
  <?php include("hub/analytics/apis/admin/displayPharmacyStastistics.php"); ?>
  <div class="hr hr16 hr-dotted"></div>
  <div class="row">
    <div class="col-xs-6"><canvas id="pharmaciesBarHorizontal" style="width:100%;"></canvas></div>
    <div class="col-xs-6"><canvas id="pharmaciesPie" style="width:100%;"></canvas></div>
  </div>

  <div class="row">
    <div class="col-xs-12"><canvas id="pharmaciesTrendChart" style="width:100%;"></canvas></div>
  </div>
  <div class="hr hr16 hr-dotted"></div>
  <?php include("hub/analytics/apis/admin/displayRolesStastistics.php"); ?>
  <div class="hr hr16 hr-dotted"></div>
  <div class="row">
    <div class="col-xs-7"><canvas id="prescriptionsTrendChart" style="width:100%;"></canvas></div>
    <div class="col-xs-5"><canvas id="prescriptionsDoughnut" style="width:100%;"></canvas></div>
  </div>

  <div class="row">
    <div class="col-xs-7"><canvas id="postedPrescriptionsTrendChart" style="width:100%;"></canvas></div>
    <div class="col-xs-5">
    <?php include("hub/analytics/apis/admin/displayTotalSentPrescriptions.php"); ?>
    </div>
  </div>

  <?php include("hub/analytics/apis/admin/charts/usersTrend.php"); ?>
  <?php include("hub/analytics/apis/admin/charts/pharmaciesByRegion.php"); ?>
  <?php include("hub/analytics/apis/admin/charts/prescriptionsTrend.php"); ?>

  <script>
    var totalUsers = <?php echo json_encode($totalUsers); ?>;
    var totalPatients = <?php echo json_encode($totalPatients); ?>;
    var totalPhyscian = <?php echo json_encode($totalPhyscian); ?>;
    var totalPharmacist = <?php echo json_encode($totalPharmacist); ?>;
    var totalAllPharmacy = <?php echo json_encode($totalAllPharmacy); ?>;
    var totalHubVisitors = <?php echo json_encode($totalHubVisitors); ?>;

    var totalPrescriptions = <?php echo json_encode($totalPrescriptions); ?>;
    var totalPharmacies = <?php echo json_encode($totalPharmacies); ?>;

    var totalLimitedAccessUsers = filterParameters(totalUsers, "limitedAccess", "numberOfUsers");
    var totalActiveUsers = filterParameters(totalUsers, "active", "numberOfUsers");
    var totalPendingUsers = filterParameters(totalUsers, "pending", "numberOfUsers");
    var totalDisabledUsers = filterParameters(totalUsers, "disabled", "numberOfUsers");
    let totalNumberOfUsers = parseFloat(totalLimitedAccessUsers) + parseFloat(totalActiveUsers) + parseFloat(totalPendingUsers) + parseFloat(totalDisabledUsers);

    var totalPrescriptionsDispensed = filterParameters(totalPrescriptions, "Dispensed", "total");
    var totalPrescriptionsPrescribed = filterParameters(totalPrescriptions, "Prescribed", "total");
    let totalPrescriptionsInNumbers = parseFloat(totalPrescriptionsDispensed) + parseFloat(totalPrescriptionsPrescribed);
    var totalActivePharmacies = filterParameters(totalPharmacies, "Active", "total");

    function filterParameters(totalArray, filterParams, attribute) {
      var varArray = totalArray.filter(function (el) {
        return el.status == filterParams;
      });
      if (varArray.length >= 1)
        return varArray[0][attribute];
      else return 0;
    }



    $(document).ready(function () {
      $('#totalLimitedAccessUsers').html(totalLimitedAccessUsers);
      $('#totalActiveUsers').html(totalActiveUsers);
      $('#totalPendingUsers').html(totalPendingUsers);
      $('#totalDisabledUsers').html(totalDisabledUsers);
      $('#totalNumberOfUsers').html(totalNumberOfUsers);
      $('#totalPatients').html(totalPatients);
      $('#totalPhyscian').html(totalPhyscian);
      $('#totalPharmacist').html(totalPharmacist);
      $('#totalAllPharmacy').html(totalAllPharmacy);
      $('#totalPrescriptionsInNumbers').html(totalPrescriptionsInNumbers);
      $('#totalActivePharmacies').html(totalActivePharmacies);
      $('#totalHubVisitors').html(totalHubVisitors);
    });

  </script>