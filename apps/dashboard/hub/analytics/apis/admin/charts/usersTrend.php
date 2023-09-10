<?php
include('../../constants/databases/dbcon_eprescription.php');

$query = "select DATE(registrationDate) as date, roles.rolesName as defaultRole, count(*) as total  from users INNER JOIN roles ON users.usersDefaultRolesId=roles.rolesId WHERE roles.rolesName !='Admin' GROUP BY users.usersDefaultRolesId, DATE(registrationDate) ORDER BY registrationDate ASC ";
$stmt = $con->prepare($query);
$success = $stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<script src="hub/analytics/js/multipleLine.js"></script>
<script>
  var dbResults = <?php echo json_encode($results); ?>;
  let results = dbResults;

  const xValuesUsers = [...new Set(dbResults.map(item => item.date))];
  const uniqueRoles = [...new Set(dbResults.map(item => item.defaultRole))];
  let preparedData = prepareDataForPlot(xValuesUsers, uniqueRoles, dbResults, 'defaultRole')

  new Chart("usersTrendChart", {
    type: "line",
    data: {
      labels: xValuesUsers,
      datasets: preparedData
    },
    options: {
      legend: {
        display: true
      },
      title: {
        display: true,
        text: "Number of system users"
      },
    }
  });

</script>