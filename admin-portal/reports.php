<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

// Pass vs Fail
$res = $conn->query("SELECT TestResult, COUNT(*) as cnt FROM tests GROUP BY TestResult");
$results = [];
while($r=$res->fetch_assoc()) $results[$r['TestResult']]=$r['cnt'];

// By Department
$dep = $conn->query("SELECT d.DepartmentName, COUNT(*) as cnt 
                     FROM tests t JOIN TestingDepartments d ON t.TestingDepartmentID=d.DepartmentID
                     GROUP BY d.DepartmentName");
$departments = [];
$depCounts = [];
while($d=$dep->fetch_assoc()){ $departments[]=$d['DepartmentName']; $depCounts[]=$d['cnt']; }

// Tests over Time (per month)
$time = $conn->query("SELECT DATE_FORMAT(TestDate,'%Y-%m') as month, COUNT(*) as cnt
                      FROM tests GROUP BY month ORDER BY month");
$months=[]; $monthCounts=[];
while($t=$time->fetch_assoc()){ $months[]=$t['month']; $monthCounts[]=$t['cnt']; }

// By Tester
$testers = $conn->query("SELECT u.UserName, COUNT(*) as cnt
                         FROM tests t JOIN Users u ON t.TestedBy=u.UserID
                         GROUP BY u.UserName");
$testerNames=[]; $testerCounts=[];
while($tt=$testers->fetch_assoc()){ $testerNames[]=$tt['UserName']; $testerCounts[]=$tt['cnt']; }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reports - Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#0f172a; color:white; }
    .chart-container { background:#1e293b; border-radius:10px; padding:20px; margin-bottom:20px; }
    .btn-back { margin-bottom:20px; }
  </style>
</head>
<body>
<div class="container py-5">
  <a href="index.php" class="btn btn-warning btn-back">&larr; Back to Dashboard</a>
  <h2 class="mb-4">Reports Dashboard</h2>
  
  <div class="row">
    <div class="col-md-6 chart-container">
      <h5>Pass vs Fail</h5>
      <canvas id="resultChart"></canvas>
    </div>
    <div class="col-md-6 chart-container">
      <h5>Tests by Department</h5>
      <canvas id="deptChart"></canvas>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-6 chart-container">
      <h5>Tests Over Time</h5>
      <canvas id="timeChart"></canvas>
    </div>
    <div class="col-md-6 chart-container">
      <h5>Tests by Tester</h5>
      <canvas id="testerChart"></canvas>
    </div>
  </div>
</div>

<script>
new Chart(document.getElementById('resultChart'),{
  type:'pie',
  data:{
    labels:['Pass','Fail'],
    datasets:[{ data:[<?= $results['Pass']??0 ?>,<?= $results['Fail']??0 ?>],
      backgroundColor:['green','red'] }]
  }
});

new Chart(document.getElementById('deptChart'),{
  type:'bar',
  data:{
    labels:<?= json_encode($departments) ?>,
    datasets:[{ label:'Tests per Dept', data:<?= json_encode($depCounts) ?>,
      backgroundColor:'orange' }]
  },
  options:{ scales:{ y:{ beginAtZero:true } } }
});

new Chart(document.getElementById('timeChart'),{
  type:'line',
  data:{
    labels:<?= json_encode($months) ?>,
    datasets:[{ label:'Tests per Month', data:<?= json_encode($monthCounts) ?>,
      borderColor:'cyan', backgroundColor:'rgba(0,255,255,0.2)', fill:true }]
  },
  options:{ scales:{ y:{ beginAtZero:true } } }
});

new Chart(document.getElementById('testerChart'),{
  type:'doughnut',
  data:{
    labels:<?= json_encode($testerNames) ?>,
    datasets:[{ data:<?= json_encode($testerCounts) ?>,
      backgroundColor:['#f87171','#60a5fa','#34d399','#fbbf24','#a78bfa'] }]
  }
});
</script>
</body>
</html>
