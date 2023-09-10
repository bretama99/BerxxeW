<?php
include('../../constants/databases/dbcon_eprescription.php');

$query = "select DATE(prescriptionDate) as date, COUNT(CASE WHEN pharmacyId = 0 then 1 ELSE NULL END)  as totalToHub, COUNT(CASE WHEN pharmacyId >0 then 1 ELSE NULL END) as totalToPharmacies  from prescription GROUP BY DATE(prescriptionDate) ORDER BY prescriptionDate ASC ";
$stmt = $con->prepare($query);
$success = $stmt->execute();
$resultsPrescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "select DATE(uploadedDate) as date, count(*) as total  from uploadedprescriptions  ORDER BY uploadedDate ASC";
$stmt = $con->prepare($query);
$success = $stmt->execute();
$resultsPostedPrescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<script>
  var dbResultsPrescriptions = <?php echo json_encode($resultsPrescriptions); ?>;
  const xPrescriptionValuesTime = [...new Set(dbResultsPrescriptions.map(item => item.date))];
  const totalToHub = [...new Set(dbResultsPrescriptions.map(item => item.totalToHub))];
  const totalToPharmacies = [...new Set(dbResultsPrescriptions.map(item => item.totalToPharmacies))];
  const totalSentToHub=totalToHub.reduce((partialSum, a) => partialSum + a, 0);
  const totalSentToPharmacies=totalToPharmacies.reduce((partialSum, a) => partialSum + a, 0);

  var dbResultsPostedPrescriptions = <?php echo json_encode($resultsPostedPrescriptions); ?>;
  const xPostedPrescriptionValuesTime = [...new Set(dbResultsPostedPrescriptions.map(item => item.date))];
  const totalPosted = [...new Set(dbResultsPostedPrescriptions.map(item => item.total))];
  const totalPostedPrescriptions=totalPosted.reduce((partialSum, a) => partialSum + a, 0);

 var  totalSentPrescriptions= parseFloat(totalSentToHub) + parseFloat(totalSentToPharmacies) + parseFloat(totalPostedPrescriptions);
  new Chart("prescriptionsTrendChart", {
    type: "line",
    data: {
      labels: xPrescriptionValuesTime,
      datasets: [{
        data: totalToHub,
        borderColor: "blue",
        label: 'Sent to Hub',
        fill: false
      }, {
        data: totalToPharmacies,
        borderColor: "green",
        label: 'Sent to Specific Pharmacies',
        fill: false
      }]
    },
    options: {
      legend: {
        display: true
      },
      title: {
        display: true,
        text: "Number of Prescriptions Sent to the eRxHub"
      },
    }
  });


  var xValuesPostedPrescriptions = ["Hub", "Specific Pharmacy", "Posted"];
  var yValuesPostedPrescriptions = [ Math.round((totalSentToHub/totalSentPrescriptions)*100*100)/100,  Math.round((totalSentToPharmacies/totalSentPrescriptions)*10000)/100,  Math.round((totalPostedPrescriptions/totalSentPrescriptions)*10000)/100];
  var barColorsPostedPrescriptions = ["green", "blue", "red"];

  new Chart("prescriptionsDoughnut", {
    type: "doughnut",
    data: {
      labels: xValuesPostedPrescriptions,
      datasets: [{
        backgroundColor: barColorsPostedPrescriptions,
        data: yValuesPostedPrescriptions
      }]
    },
    options: {
      title: {
        display: true,
        text: "Total Prescriptions Sent (%)"
      }
    }
  });

  new Chart("postedPrescriptionsTrendChart", {
    type: "line",
    data: {
      labels: xPostedPrescriptionValuesTime,
      datasets: [{
        data: totalPosted,
        borderColor: "red",
        label: 'Posted prescriptions',
        fill: true
      }]
    },
    options: {
      legend: {
        display: true
      },
      title: {
        display: true,
        text: "Number of Posted/Uploaded Prescriptions"
      },
    }
  });

  $(document).ready(function () {
      $('#totalPostedPrescriptions').html(totalPostedPrescriptions);
      $('#totalSentToHub').html(totalSentToHub);
      $('#totalSentToPharmacies').html(totalSentToPharmacies);
      $('#totalSentPresctiptions').html(totalSentPrescriptions);


    });
</script>

