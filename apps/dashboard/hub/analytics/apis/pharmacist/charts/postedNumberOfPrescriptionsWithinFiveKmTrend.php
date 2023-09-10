<?php
function postedNumberOfPrescriptionsWithinFiveKm($lat, $lng, $dist){
  include('../../constants/databases/dbcon_eprescription.php');
  $query = <<<EOF
    SELECT  DATE(uploadedDate) as date, count(*) as total FROM (
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
    ) uploadedprescriptions  WHERE distance <= $dist GROUP BY DATE(uploadedDate) ORDER BY DATE(uploadedDate) ASC;
    
EOF;
  $stmt = $con->prepare($query);
  $success = $stmt->execute();
  $resultsPostedPrescriptionsWithinFiveKm = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<script>
  var dbResultsPostedNumberOfPrescriptionsWithinFiveKmToPharmacy= <?php echo json_encode($resultsPostedPrescriptionsWithinFiveKm); ?>;
  var distancePosted=<?php echo $dist;?>;
    const xValuesPostedPerscriptionsWithinFiveKmToPharmaciesTime = [...new Set(dbResultsPostedNumberOfPrescriptionsWithinFiveKmToPharmacy.map(item => item.date))];
    const totalPostedPerscriptionsWithinFiveKmToPharmacy = [...new Set(dbResultsPostedNumberOfPrescriptionsWithinFiveKmToPharmacy.map(item => item.total))];
    new Chart("numberOfPostedPrescriptionsWithinFiveKmTrendChart", {
      type: "line",
      data: {
        labels: xValuesPostedPerscriptionsWithinFiveKmToPharmaciesTime,
        datasets: [{
          data: totalPostedPerscriptionsWithinFiveKmToPharmacy,
          borderColor: "lightgreen",
          label: 'Total Posted Prescriptions Within '+ distancePosted +'Km',
          fill: true
        },]
      },
      options: {
        legend: {
          display: true
        },
        title: {
          display: true,
          text: "Total Posted Prescriptions Within "+ distancePosted +"Km"
        },
      }
    });
  
</script>

<?php } ?>