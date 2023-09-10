<?php
include('../../constants/databases/dbcon_eprescription.php');

$query = "select DATE(addedDate) as date, state.stateName, count(*) as total  from pharmacy INNER JOIN state ON pharmacy.stateId=state.stateId  GROUP BY pharmacy.stateId, DATE(addedDate) ORDER BY addedDate ASC ";
$stmt = $con->prepare($query);
$success = $stmt->execute();
$resultsPharmacies = $stmt->fetchAll(PDO::FETCH_ASSOC);


$queryBar = "select  state.stateName, count(*) as total  from pharmacy INNER JOIN state ON pharmacy.stateId=state.stateId  GROUP BY pharmacy.stateId";
$stmtBar = $con->prepare($queryBar);
$successBar = $stmtBar->execute();
$resultsBar = $stmtBar->fetchAll(PDO::FETCH_ASSOC);

?>

<script src="hub/analytics/js/multipleLine.js"></script>
<script>
  var pharmaciesByRegionFromDBBar = <?php echo json_encode($resultsBar); ?>;
  let pharmaciesByRegionResultsBar = pharmaciesByRegionFromDBBar;
  var xValuesBar = [...new Set(pharmaciesByRegionFromDBBar.map(item => item.stateName))];
  var yValuesBar = [...new Set(pharmaciesByRegionFromDBBar.map(item => item.total))];
  
let barColorsPharmacies=[]
let totalPharmaciesRegistered=0;
 for (i=0; i< yValuesBar.length;i++ ){
  barColorsPharmacies[i]=getRandomColor();
   totalPharmaciesRegistered+=yValuesBar[i];
 }
 
 yValuesPie= yValuesBar.map(x => (Math.round(((x/totalPharmaciesRegistered)*100*100)/100)));

  new Chart("pharmaciesBarHorizontal", {
    type: "horizontalBar",
    data: {
      labels: xValuesBar,
      datasets: [{
        backgroundColor: barColorsPharmacies,
        data: yValuesBar
      }]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: "Total Number of Pharmacies by region"
      },
      /*scales: {
        xAxes: [{ ticks: { min: 10, max: 60 } }]
      }*/
    }
  });

  new Chart("pharmaciesPie", {
    type: "pie",
    data: {
      labels: xValuesBar,
      datasets: [{
        backgroundColor: barColorsPharmacies,
        data: yValuesPie
      }]
    },
    options: {
      title: {
        display: true,
        text: "Percentage of Pharmacies Registered By Region (%)"
      }
    }
  });
  
var pharmaciesByRegionFromDB = <?php echo json_encode($resultsPharmacies); ?>;
let pharmaciesByRegionResults = pharmaciesByRegionFromDB;
const xValuesPharmaciesByRegion = [...new Set(pharmaciesByRegionFromDB.map(item => item.date))];
const yValuesPharmaciesByRegion = [...new Set(pharmaciesByRegionFromDB.map(item => item.stateName))];
let preparedDataPharmaciesByRegions=  prepareDataForPlot(xValuesPharmaciesByRegion, yValuesPharmaciesByRegion, pharmaciesByRegionFromDB,'stateName')

  new Chart("pharmaciesTrendChart", {
    type: "line",
    data: {
      labels: xValuesPharmaciesByRegion,
      datasets: preparedDataPharmaciesByRegions
    },
    options: {
      legend: {
        display: true
      },
      title: {
        display: true,
        text: "Number of Pharmacies Region Wise "
      },
    }
  });


</script>