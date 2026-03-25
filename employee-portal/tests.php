<?php
session_start();
if (!isset($_SESSION['employee_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$empID = $_SESSION['employee_id'];
$sql = "SELECT t.*, p.ProductName, d.DepartmentName
        FROM tests t
        JOIN products p ON t.ProductID=p.ProductID
        JOIN testingdepartments d ON t.TestingDepartmentID=d.DepartmentID
        WHERE t.TestedBy=$empID
        ORDER BY TestDate DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Tests - Employee</title>
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
  <h2 class="mb-4">My Testing Records</h2>
  <a href="test_add.php" class="btn btn-warning mb-3">Add New Test</a>

  <table class="table table-striped align-middle">
    <thead class="table-dark">
      <tr><th>ID</th><th>Product</th><th>Department</th><th>Date</th><th>Result</th><th>Remarks</th></tr>
    </thead>
    <tbody>
      <?php while($row=$result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['TestID'] ?></td>
        <td><?= htmlspecialchars($row['ProductName']) ?></td>
        <td><?= htmlspecialchars($row['DepartmentName']) ?></td>
        <td><?= $row['TestDate'] ?></td>
        <td><span class="badge <?= $row['TestResult']=="Pass"?"bg-success":"bg-danger" ?>"><?= $row['TestResult'] ?></span></td>
        <td><?= htmlspecialchars($row['Remarks']) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
