<?php
function numberOfMedicationsWithinFiveKm($lat, $lng, $dist){

  include('../../constants/databases/dbcon_eprescription.php');
  $query = <<<EOF
SELECT  DATE(prescriptionDate) as date, prescribeddrugs.status as status, count(*) as total FROM (
    SELECT pharmacy.*, 
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
    as distance FROM `pharmacy` 
) pharmacy INNER JOIN prescription ON prescription.pharmacyId=pharmacy.pharmacyId INNER JOIN prescribeddrugs ON prescription.pharmacyId=prescribeddrugs.pharmacyId WHERE distance <= $dist GROUP BY DATE(prescriptionDate), prescribeddrugs.status ORDER BY DATE(prescriptionDate) ASC;
EOF;
  $stmt = $con->prepare($query);
  $success = $stmt->execute();
  $resultsMedicationsWithinFiveKm = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<script>
  var dbResultsNumberOfMedicationsWithinFiveKmToPharmacy= <?php echo json_encode($resultsMedicationsWithinFiveKm); ?>;
  var distance=<?php echo $dist;?>;
    const xValuesMedicationsWithinFiveToPharmaciesTime = [...new Set(dbResultsNumberOfMedicationsWithinFiveKmToPharmacy.map(item => item.date))];
    const totalMedicationsWithinFiveKmToPharmacy = [...new Set(dbResultsNumberOfMedicationsWithinFiveKmToPharmacy.map(item => {if (item.status=='Prescribed') return item.total; else return 0;}))];
    const totalMedicationsWithinFiveKmDispensed = [...new Set(dbResultsNumberOfMedicationsWithinFiveKmToPharmacy.map(item => {if (item.status=='Dispensed') return item.total; else return 0;}))];
   
    new Chart("numberOfMedicationsWithinFiveKmTrendChart", {
      type: "line",
      data: {
        labels: xValuesMedicationsWithinFiveToPharmaciesTime,
        datasets: [{
          data: totalMedicationsWithinFiveKmToPharmacy,
          borderColor: "lightblue",
          label: 'Total Prescribed Medications Within '+ distance +'Km',
          fill: false
        }, {
          data: totalMedicationsDispensed,
          borderColor: "lightgreen",
          label: 'Total Dispensed Medications  Within '+ distance +'Km',
          fill: false
        }]
      },
      options: {
        legend: {
          display: true
        },
        title: {
          display: true,
          text: "Total Prescribed Medications (Hub + Direct to Pharmacies) Within "+ distance +"Km"
        },
      }
    });
  

</script>

<?php } ?>