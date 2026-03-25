<?php
// ===================
// Enable Error Reporting
// ===================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit; 
}
include('includes/db.php');

// ===================
// Validate TestID
// ===================
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No Test ID provided.");
}
$id = $conn->real_escape_string($_GET['id']);

// Fetch the test
$test = $conn->query("SELECT * FROM tests WHERE TestID='$id'")->fetch_assoc();
if (!$test) {
    die("Test not found.");
}

// ===================
// Handle Form Submission
// ===================
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $name   = $conn->real_escape_string($_POST['TestName']);
    $code   = $conn->real_escape_string($_POST['TestCode']);
    $roll   = $conn->real_escape_string($_POST['TestRollNumber']);
    $date   = $conn->real_escape_string($_POST['TestDate']);
    $dept   = intval($_POST['TestingDepartmentID']);
    $result = $conn->real_escape_string($_POST['TestResult']);
    $remarks= $conn->real_escape_string($_POST['Remarks']);
    $tester = intval($_POST['TestedBy']);

    $sql = "UPDATE tests 
            SET TestName='$name',
                TestCode='$code',
                TestRollNumber='$roll',
                TestDate='$date',
                TestingDepartmentID=$dept,
                TestResult='$result',
                Remarks='$remarks',
                TestedBy=$tester
            WHERE TestID='$id'";

    if ($conn->query($sql)) {
        header("Location: tests.php?msg=updated");
        exit;
    } else {
        die("DB Error: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Test - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
  <h2 class="mb-4">Edit Test</h2>

  <form method="POST" class="bg-light text-dark p-4 rounded shadow">
    <div class="mb-3">
      <label>Test Name</label>
      <input type="text" name="TestName" value="<?= htmlspecialchars($test['TestName']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Test Code</label>
      <input type="text" name="TestCode" value="<?= htmlspecialchars($test['TestCode']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Test Roll Number</label>
      <input type="text" name="TestRollNumber" value="<?= htmlspecialchars($test['TestRollNumber']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Test Date</label>
      <input type="date" name="TestDate" value="<?= $test['TestDate'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Department</label>
      <select name="TestingDepartmentID" class="form-control">
        <?php
        $deps = $conn->query("SELECT * FROM TestingDepartments");
        while ($d = $deps->fetch_assoc()):
          $sel = ($d['DepartmentID'] == $test['TestingDepartmentID']) ? "selected" : "";
          echo "<option value='{$d['DepartmentID']}' $sel>{$d['DepartmentName']}</option>";
        endwhile;
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Tester</label>
      <select name="TestedBy" class="form-control">
        <?php
        $users = $conn->query("SELECT * FROM Users");
        while ($u = $users->fetch_assoc()):
          $sel = ($u['UserID'] == $test['TestedBy']) ? "selected" : "";
          echo "<option value='{$u['UserID']}' $sel>{$u['UserName']}</option>";
        endwhile;
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Result</label>
      <select name="TestResult" class="form-control">
        <option value="Pass" <?= $test['TestResult']=="Pass"?"selected":"" ?>>Pass</option>
        <option value="Fail" <?= $test['TestResult']=="Fail"?"selected":"" ?>>Fail</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Remarks</label>
      <textarea name="Remarks" class="form-control"><?= htmlspecialchars($test['Remarks']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-warning">Update Test</button>
    <a href="tests.php" class="btn btn-secondary">Back</a>
  </form>
</div>
</body>
</html>
