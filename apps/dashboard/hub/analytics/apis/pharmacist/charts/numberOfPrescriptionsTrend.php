<?php
include('../../constants/databases/dbcon_eprescription.php');
$query = "select DATE(prescriptionDate) as date, COUNT(CASE WHEN isReleased = 1 then 1 ELSE NULL END) as totalReleased, COUNT(CASE WHEN prescription.status ='Prescribed' then 1 ELSE NULL END) as totalPrescribed, COUNT(CASE WHEN prescription.status = 'Dispensed' then 1 ELSE NULL END) as totalDispensed FROM prescription INNER JOIN pharmacy on prescription.pharmacyId=pharmacy.pharmacyId  WHERE prescription.pharmacyId='".$_SESSION["pharmacyId"]."' GROUP BY DATE(prescriptionDate) ORDER BY DATE(prescriptionDate) ASC";
$stmt = $con->prepare($query);
$success = $stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<script>
  var dbResults = <?php echo json_encode($results); ?>;
  var pharmacyName = <?php echo json_encode($_SESSION['pharmacyName']); ?>;
  const xValuesPrescriptionToPharmaciesTime = [...new Set(dbResults.map(item => item.date))];
  const totalPrescribedToPharmacy = [...new Set(dbResults.map(item => item.totalPrescribed))];
  const totalPrescriptionsReleased = [...new Set(dbResults.map(item => item.totalReleased))];
  const totalPrescriptionsDispensed = [...new Set(dbResults.map(item => item.totalDispensed))];
  new Chart("numberOfPrescriptionsTrendChart", {
    type: "line",
    data: {
      labels: xValuesPrescriptionToPharmaciesTime,
      datasets: [{
        data: totalPrescribedToPharmacy,
        borderColor: "blue",
        label: 'Total Prescribed',
        fill: false
      }, {
        data: totalPrescriptionsDispensed,
        borderColor: "green",
        label: 'Total Dispensed',
        fill: false
      },{
        data: totalPrescriptionsReleased,
        borderColor: "yellow",
        label: 'Total Released',
        fill: false
      }]
    },
    options: {
      legend: {
        display: true
      },
      title: {
        display: true,
        text: "Total Prescriptions send to "+pharmacyName
      },
    }
  });


</script>