<?php if ($canView == "1") {
  $startDate=strtotime('10/27/2019');
  $toDate=strtotime('07/27/2023');
  $startDate=date('Y-m-d', $startDate);
  $toDate=date('Y-m-d', $toDate);
  if ($_SESSION["rolesId"]==4 || ($_SESSION["rolesId"]==2 && $_SESSION['pharmacyId']!=null))
  include("hub/analytics/apis/pharmacist/pharmacistAnalytics.php");
  else 
  include("hub/analytics/apis/admin/adminAnalytics.php");

} ?>