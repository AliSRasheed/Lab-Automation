<?php
session_start();
if (!isset($_SESSION['employee_logged_in'])) {
    header("Location: login.php"); exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Employee Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background:#1e293b; color:white; }
    .content { margin-left:240px; padding:20px; }
    .mt-2{
      color: aqua !important;
      font-family: 'Times New Roman', Times, serif;
      font-size: 18px;
    }
  </style>
</head>
<body>
<?php include('sidebar.php'); ?>

<div class="content">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['employee_name']) ?> (<?= htmlspecialchars($_SESSION['employee_role']) ?>)</h2>
  <p class="lead">This is your Employee Dashboard.</p>

  <div class="row text-center mt-4">
    <div class="col-md-3">
      <div class="card bg-dark p-3">
        <i class="bi bi-box fs-1 text-warning"></i>
        <h4 class="mt-2">Products</h4>
        <a href="products.php" class="btn btn-sm btn-warning">View</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-dark p-3">
        <i class="bi bi-clipboard-check fs-1 text-success"></i>
        <h4 class="mt-2">Testing</h4>
        <a href="tests.php" class="btn btn-sm btn-success">View</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-dark p-3">
        <i class="bi bi-search fs-1 text-info"></i>
        <h4 class="mt-2">Advanced Search</h4>
        <a href="search.php" class="btn btn-sm btn-info">Go</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-dark p-3">
        <i class="bi bi-bar-chart fs-1 text-primary"></i>
        <h4 class="mt-2">Reports</h4>
        <a href="reports.php" class="btn btn-sm btn-primary">View</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
