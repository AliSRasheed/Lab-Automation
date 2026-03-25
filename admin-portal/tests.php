<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

// Handle filter
$where = [];
if (!empty($_GET['result'])) $where[] = "t.TestResult='" . $conn->real_escape_string($_GET['result']) . "'";
if (!empty($_GET['dept'])) $where[] = "t.TestingDepartmentID=" . intval($_GET['dept']);
$filter = $where ? "WHERE " . implode(" AND ", $where) : "";

$sql = "SELECT t.*, p.ProductName, d.DepartmentName, u.UserName
        FROM Tests t
        JOIN Products p ON t.ProductID=p.ProductID
        JOIN TestingDepartments d ON t.TestingDepartmentID=d.DepartmentID
        JOIN Users u ON t.TestedBy=u.UserID
        $filter
        ORDER BY t.TestDate DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Testing Management - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background:#0f172a; color:white; }
    .content { margin-left:240px; padding:20px; }
    .table { color:white; }
  </style>
</head>
<body>
<?php include('sidebar.php'); ?>
<div class="content">
  <h2 class="mb-4">Testing Records</h2>
  <a href="test_add.php" class="btn btn-warning mb-3"><i class="bi bi-plus-circle"></i> Add New Test</a>

  <form method="GET" class="mb-3 row">
    <div class="col-md-3">
      <select name="result" class="form-control">
        <option value="">-- Filter by Result --</option>
        <option value="Pass">Pass</option>
        <option value="Fail">Fail</option>
      </select>
    </div>
    <div class="col-md-3">
      <select name="dept" class="form-control">
        <option value="">-- Filter by Department --</option>
        <?php
        $deps = $conn->query("SELECT * FROM testingdepartments");
        while ($d = $deps->fetch_assoc()) {
            echo "<option value='{$d['DepartmentID']}'>{$d['DepartmentName']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="col-md-2">
      <button class="btn btn-info">Apply Filter</button>
    </div>
  </form>

  <table class="table table-striped align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th><th>Product</th><th>Test</th><th>Dept</th>
        <th>Tester</th><th>Date</th><th>Result</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['TestID'] ?></td>
        <td><?= htmlspecialchars($row['ProductName']) ?></td>
        <td><?= htmlspecialchars($row['TestName']) ?></td>
        <td><?= htmlspecialchars($row['DepartmentName']) ?></td>
        <td><?= htmlspecialchars($row['UserName']) ?></td>
        <td><?= $row['TestDate'] ?></td>
        <td>
          <span class="badge <?= $row['TestResult']=="Pass"?"bg-success":"bg-danger" ?>">
            <?= $row['TestResult'] ?>
          </span>
        </td>
        <td>
          <a href="test_edit.php?id=<?= $row['TestID'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
          <a href="test_delete.php?id=<?= $row['TestID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this test?')"><i class="bi bi-trash"></i></a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
