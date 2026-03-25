<?php
session_start();
if (!isset($_SESSION['employee_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$results = [];
if ($_SERVER["REQUEST_METHOD"]=="POST") {
  $productID = $conn->real_escape_string($_POST['ProductID']);
  $testID = $conn->real_escape_string($_POST['TestID']);
  $status = $conn->real_escape_string($_POST['Status']);
  $from = $conn->real_escape_string($_POST['FromDate']);
  $to = $conn->real_escape_string($_POST['ToDate']);

  $sql = "SELECT t.*, p.ProductName, d.DepartmentName, u.UserName
          FROM tests t
          JOIN products p ON t.ProductID=p.ProductID
          JOIN testingdepartments d ON t.TestingDepartmentID=d.DepartmentID
          JOIN users u ON t.TestedBy=u.UserID
          WHERE 1=1";

  if ($productID) $sql .= " AND t.ProductID LIKE '%$productID%'";
  if ($testID) $sql .= " AND t.TestID LIKE '%$testID%'";
  if ($status) $sql .= " AND t.TestResult='$status'";
  if ($from) $sql .= " AND t.TestDate>='$from'";
  if ($to) $sql .= " AND t.TestDate<='$to'";

  $results = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Advanced Search - Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style> body{background:#1e293b;color:white;} .content{margin-left:240px;padding:20px;} .table{color:white;} </style>
</head>
<body>
<?php include('sidebar.php'); ?>

<div class="content">
  <h2>Advanced Search</h2>
  <form method="POST" class="row g-3 mb-4">
    <div class="col-md-3"><input type="text" name="ProductID" placeholder="Product ID" class="form-control"></div>
    <div class="col-md-3"><input type="text" name="TestID" placeholder="Test ID" class="form-control"></div>
    <div class="col-md-2">
      <select name="Status" class="form-control">
        <option value="">Status</option>
        <option value="Pass">Pass</option>
        <option value="Fail">Fail</option>
      </select>
    </div>
    <div class="col-md-2"><input type="date" name="FromDate" class="form-control"></div>
    <div class="col-md-2"><input type="date" name="ToDate" class="form-control"></div>
    <div class="col-md-12"><button class="btn btn-warning">Search</button></div>
  </form>

  <?php if ($results && $results->num_rows > 0): ?>
    <table class="table table-striped">
      <thead class="table-dark"><tr><th>Test ID</th><th>Product</th><th>Department</th><th>Tester</th><th>Date</th><th>Result</th></tr></thead>
      <tbody>
      <?php while($r=$results->fetch_assoc()): ?>
        <tr>
          <td><?= $r['TestID'] ?></td>
          <td><?= htmlspecialchars($r['ProductName']) ?></td>
          <td><?= htmlspecialchars($r['DepartmentName']) ?></td>
          <td><?= htmlspecialchars($r['UserName']) ?></td>
          <td><?= $r['TestDate'] ?></td>
          <td><span class="badge <?= $r['TestResult']=="Pass"?"bg-success":"bg-danger" ?>"><?= $r['TestResult'] ?></span></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
</body>
</html>
