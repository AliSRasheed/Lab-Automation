<?php
session_start();
if (!isset($_SESSION['employee_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$id = $conn->real_escape_string($_GET['id']);
$product = $conn->query("SELECT * FROM products WHERE ProductID='$id'")->fetch_assoc();
$tests = $conn->query("SELECT t.*, u.UserName, d.DepartmentName
                       FROM tests t
                       JOIN users u ON t.TestedBy=u.UserID
                       JOIN testingdepartments d ON t.TestingDepartmentID=d.DepartmentID
                       WHERE t.ProductID='$id' ORDER BY TestDate DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Product Details - Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#1e293b; color:white; }
    .content { margin-left:240px; padding:20px; }
    .table { color:white; }
  </style>
</head>
<body>
<?php include('sidebar.php'); ?>

<div class="content">
  <h2>Product Details</h2>
  <div class="card bg-dark p-3 mb-4">
    <h4><?= htmlspecialchars($product['ProductName']) ?> (<?= $product['ProductID'] ?>)</h4>
    <p><strong>Category:</strong> <?= htmlspecialchars($product['Category']) ?></p>
    <p><strong>Revision:</strong> <?= $product['Revision'] ?> | <strong>Manufacture Date:</strong> <?= $product['ManufactureDate'] ?></p>
    <p><strong>Status:</strong> <?= $product['Status'] ?></p>
  </div>

  <h4>Testing History</h4>
  <table class="table table-striped align-middle">
    <thead class="table-dark">
      <tr><th>ID</th><th>Name</th><th>Department</th><th>Tester</th><th>Date</th><th>Result</th><th>Remarks</th></tr>
    </thead>
    <tbody>
      <?php while($t=$tests->fetch_assoc()): ?>
      <tr>
        <td><?= $t['TestID'] ?></td>
        <td><?= htmlspecialchars($t['TestName']) ?></td>
        <td><?= htmlspecialchars($t['DepartmentName']) ?></td>
        <td><?= htmlspecialchars($t['UserName']) ?></td>
        <td><?= $t['TestDate'] ?></td>
        <td><span class="badge <?= $t['TestResult']=="Pass"?"bg-success":"bg-danger" ?>"><?= $t['TestResult'] ?></span></td>
        <td><?= htmlspecialchars($t['Remarks']) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
