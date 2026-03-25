<?php
session_start();
if (!isset($_SESSION['employee_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$empID = $_SESSION['employee_id'];

$totalTests = $conn->query("SELECT COUNT(*) AS c FROM tests WHERE TestedBy=$empID")->fetch_assoc()['c'];
$passed = $conn->query("SELECT COUNT(*) AS c FROM tests WHERE TestedBy=$empID AND TestResult='Pass'")->fetch_assoc()['c'];
$failed = $conn->query("SELECT COUNT(*) AS c FROM tests WHERE TestedBy=$empID AND TestResult='Fail'")->fetch_assoc()['c'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reports - Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style> body{background:#1e293b;color:white;} .content{margin-left:240px;padding:20px;} </style>
</head>
<body>
<?php include('sidebar.php'); ?>

<div class="content">
  <h2>My Reports</h2>
  <div class="row text-center mb-4">
    <div class="col-md-4"><div class="card bg-dark p-3"><h4><?= $totalTests ?></h4><p>Total Tests</p></div></div>
    <div class="col-md-4"><div class="card bg-success p-3"><h4><?= $passed ?></h4><p>Passed</p></div></div>
    <div class="col-md-4"><div class="card bg-danger p-3"><h4><?= $failed ?></h4><p>Failed</p></div></div>
  </div>

  <canvas id="testChart" height="120"></canvas>
  <script>
    const ctx = document.getElementById('testChart').getContext('2d');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Pass','Fail'],
        datasets: [{ data: [<?= $passed ?>, <?= $failed ?>], backgroundColor:['#22c55e','#ef4444'] }]
      },
      options: { responsive:true, plugins:{ legend:{ labels:{ color:'white' } } } }
    });
  </script>
</div>
</body>
</html>
