<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/db.php');

// Fetch counts
$totalProducts = $conn->query("SELECT COUNT(*) as c FROM products")->fetch_assoc()['c'];
$totalTests = $conn->query("SELECT COUNT(*) as c FROM tests")->fetch_assoc()['c'];
$totalServices = $conn->query("SELECT COUNT(*) as c FROM services")->fetch_assoc()['c'];
$totalMessages = $conn->query("SELECT COUNT(*) as c FROM contactmessages")->fetch_assoc()['c'];
$totalGallery = $conn->query("SELECT COUNT(*) as c FROM gallery")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - SRS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #0f172a; color: white; }
    .sidebar {
      background: #1e293b;
      min-height: 100vh;
      padding: 20px;
      position: fixed;
      width: 220px;
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 10px;
      border-radius: 6px;
      text-decoration: none;
      margin-bottom: 8px;
    }
    .sidebar a:hover {
      background: orange;
      color: black;
    }
    .content {
      margin-left: 240px;
      padding: 20px;
    }
    .card {
      background: #1e293b;
      border: none;
      color: white;
    }
  </style>
</head>
<body>
   <?php include('sidebar.php'); ?>

  <!-- Main Content -->
  <div class="content">
    <h2>Welcome, <?= $_SESSION['admin_name'] ?> (<?= $_SESSION['admin_role'] ?>)</h2>
    <p>System Overview</p>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card p-3 text-center shadow">
          <i class="bi bi-box fs-2 text-warning"></i>
          <h4><?= $totalProducts ?></h4>
          <p>Products</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 text-center shadow">
          <i class="bi bi-check2-square fs-2 text-warning"></i>
          <h4><?= $totalTests ?></h4>
          <p>Tests</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 text-center shadow">
          <i class="bi bi-sliders fs-2 text-warning"></i>
          <h4><?= $totalServices ?></h4>
          <p>Services</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 text-center shadow">
          <i class="bi bi-images fs-2 text-warning"></i>
          <h4><?= $totalGallery ?></h4>
          <p>Gallery Images</p>
        </div>  
      </div>
      <div class="col-md-4">
        <div class="card p-3 text-center shadow">
          <i class="bi bi-envelope fs-2 text-warning"></i>
          <h4><?= $totalMessages ?></h4>
          <p>Messages</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
