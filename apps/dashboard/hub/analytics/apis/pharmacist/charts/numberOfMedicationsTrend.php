<?php
include('../../constants/databases/dbcon_eprescription.php');
$query = "select DATE(prescriptionDate) as date, COUNT(CASE WHEN released = 1 then 1 ELSE NULL END) as totalReleased, COUNT(CASE WHEN prescribeddrugs.status ='Prescribed' then 1 ELSE NULL END) as totalPrescribed, COUNT(CASE WHEN prescribeddrugs.status = 'Dispensed' then 1 ELSE NULL END) as totalDispensed FROM prescription INNER JOIN prescribeddrugs on prescription.prescriptionId=prescribeddrugs.prescriptionId INNER JOIN  pharmacy on prescription.pharmacyId=pharmacy.pharmacyId  WHERE prescription.pharmacyId='".$_SESSION["pharmacyId"]."' GROUP BY DATE(prescriptionDate) ORDER BY DATE(prescriptionDate) ASC";
	
$stmt = $con->prepare($query);
$success = $stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<script>
  var dbResultsNumberOfMedicationsToPharmacy = <?php echo json_encode($results); ?>;
  var pharmacyNameMed = <?php echo json_encode($_SESSION['pharmacyName']); ?>;

  const xValuesMedicationsToPharmaciesTime = [...new Set(dbResultsNumberOfMedicationsToPharmacy.map(item => item.date))];
  const totalMedicationsToPharmacy = [...new Set(dbResultsNumberOfMedicationsToPharmacy.map(item => item.totalPrescribed))];
  const totalMedicationsReleased = [...new Set(dbResultsNumberOfMedicationsToPharmacy.map(item => item.totalReleased))];
  const totalMedicationsDispensed = [...new Set(dbResultsNumberOfMedicationsToPharmacy.map(item => item.totalDispensed))];
  new Chart("numberOfMedicationsTrendChart", {
    type: "line",
    data: {
      labels: xValuesMedicationsToPharmaciesTime,
      datasets: [{
        data: totalMedicationsToPharmacy,
        borderColor: "blue",
        label: 'Total Prescribed Medications',
        fill: false
      }, {
        data: totalMedicationsDispensed,
        borderColor: "green",
        label: 'Total Dispensed Medications',
        fill: false
      },{
        data: totalMedicationsReleased,
        borderColor: "yellow",
        label: 'Total Released Medications',
        fill: false
      }]
    },
    options: {
      legend: {
        display: true
      },
      title: {
        display: true,
        text: "Total prescribed medications send to "+ pharmacyNameMed
      },
    }
  });


</script>