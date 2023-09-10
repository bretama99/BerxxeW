<?php
function uploadedPrescriptionsServedByAPharmacyWithinFiveKm($lat, $lng, $dist, $pharmacyId){
  include('../../constants/databases/dbcon_eprescription.php');
  $query = <<<EOF
    SELECT  DATE(uploadedprescriptions.uploadedDate) as date, uploadedprescriptionstatus.status as status, count(*) as total FROM (
        SELECT *, 
            (
                (
                    (
                        acos(
                            sin(( $lat * pi() / 180))
                            *
                            sin(( latitude * pi() / 180)) + cos(( $lat  * pi() /180 ))
                            *
                            cos(( latitude * pi() / 180)) * cos((($lng  - longitude) * pi()/180)))
                    ) * 180/pi()
                ) * 60 * 1.1515 * 1.609344
            )
        as distance FROM `uploadedprescriptions` 
    ) uploadedprescriptions INNER JOIN uploadedprescriptionstatus ON uploadedprescriptions.uploadedPrescriptionsId=uploadedprescriptionstatus.uploadedPrescriptionsId  WHERE distance <= $dist and uploadedprescriptionstatus.pharmacyId=$pharmacyId GROUP BY uploadedprescriptionstatus.status, DATE(uploadedDate) ORDER BY DATE(uploadedDate) ASC ;
EOF;
$stmt = $con->prepare($query);
$success = $stmt->execute();
$resultsUploadedPrescriptionsToPharmacy = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<script src="hub/analytics/js/multipleLine.js"></script>
<script>
var pharmacyNameServing = <?php echo json_encode($_SESSION['pharmacyName']); ?>;
var distanceServing = <?php echo json_encode($dist); ?>;
var statusOfUploadedPrescriptionsFromDB = <?php echo json_encode($resultsUploadedPrescriptionsToPharmacy); ?>;
let postedPrescriptionsResultsByPharmacy = statusOfUploadedPrescriptionsFromDB;

const xValuesUploadedPrescriptions = [...new Set(postedPrescriptionsResultsByPharmacy.map(item => item.date))];
const yValuesUploadedPrescriptionsStatus = [...new Set(postedPrescriptionsResultsByPharmacy.map(item => item.status))];
let preparedDataOfPostedPrescriptionsServedByPharmacy=  prepareDataForPlot(xValuesUploadedPrescriptions, yValuesUploadedPrescriptionsStatus, statusOfUploadedPrescriptionsFromDB,'status')

  new Chart("postedPrescriptionsServedByaPharmacyTrendChart", {
    type: "line",
    data: {
      labels: xValuesUploadedPrescriptions,
      datasets: preparedDataOfPostedPrescriptionsServedByPharmacy
    },
    options: {
      legend: {
        display: true
      },
      title: {
        display: true,
        text: "Total Posted Prescriptions Served by a "+pharmacyNameServing+"  within "+distanceServing+ "Km"
      },
    }
  });


</script>

<?php }?>