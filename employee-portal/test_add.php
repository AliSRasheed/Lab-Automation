<?php
session_start();
if (!isset($_SESSION['employee_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$empID = $_SESSION['employee_id'];

if ($_SERVER["REQUEST_METHOD"]=="POST") {
  $id = $conn->real_escape_string($_POST['TestID']);
  $pid = $conn->real_escape_string($_POST['ProductID']);
  $name = $conn->real_escape_string($_POST['TestName']);
  $code = $conn->real_escape_string($_POST['TestCode']);
  $roll = $conn->real_escape_string($_POST['TestRollNumber']);
  $date = $conn->real_escape_string($_POST['TestDate']);
  $dept = intval($_POST['TestingDepartmentID']);
  $result = $conn->real_escape_string($_POST['TestResult']);
  $remarks = $conn->real_escape_string($_POST['Remarks']);

  $sql = "INSERT INTO tests VALUES('$id','$pid','$name','$code','$roll','$date',$dept,'$result','$remarks',$empID)";
  $conn->query($sql);
  header("Location: tests.php"); exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Test - Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
  <h2>Add Test Record</h2>
  <form method="POST">
    <div class="mb-3"><label>Test ID</label><input type="text" name="TestID" class="form-control" required></div>
    <div class="mb-3"><label>Product</label>
      <select name="ProductID" class="form-control">
        <?php $p=$conn->query("SELECT * FROM Products"); while($row=$p->fetch_assoc()){echo "<option value='{$row['ProductID']}'>{$row['ProductName']}</option>";} ?>
      </select>
    </div>
    <div class="mb-3"><label>Test Name</label><input type="text" name="TestName" class="form-control"></div>
    <div class="mb-3"><label>Test Code</label><input type="text" name="TestCode" class="form-control"></div>
    <div class="mb-3"><label>Roll Number</label><input type="text" name="TestRollNumber" class="form-control"></div>
    <div class="mb-3"><label>Date</label><input type="date" name="TestDate" class="form-control"></div>
    <div class="mb-3"><label>Department</label>
      <select name="TestingDepartmentID" class="form-control">
        <?php $d=$conn->query("SELECT * FROM testingdepartments"); while($row=$d->fetch_assoc()){echo "<option value='{$row['DepartmentID']}'>{$row['DepartmentName']}</option>";} ?>
      </select>
    </div>
    <div class="mb-3"><label>Result</label>
      <select name="TestResult" class="form-control">
        <option value="Pass">Pass</option><option value="Fail">Fail</option>
      </select>
    </div>
    <div class="mb-3"><label>Remarks</label><textarea name="Remarks" class="form-control"></textarea></div>
    <button class="btn btn-warning">Save</button>
    <a href="tests.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
