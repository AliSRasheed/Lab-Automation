<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$id = intval($_GET['id']);
$user = $conn->query("SELECT * FROM users WHERE UserID=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['UserName']);
    $role = $conn->real_escape_string($_POST['Role']);
    $conn->query("UPDATE users SET UserName='$name', Role='$role' WHERE UserID=$id");
    header("Location: users.php"); exit;
}
?>



<!DOCTYPE html>
<html>
<head>
  <title>Edit Employee - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Edit Employee</h2>
    <form method="POST">
      <div class="mb-3"><label>Name</label><input type="text" name="UserName" value="<?= htmlspecialchars($user['UserName']) ?>" class="form-control" required></div>
      <div class="mb-3">
        <label>Role</label>
        <select name="Role" class="form-control" required>
          <option value="Tester" <?= $user['Role']=="Tester"?"selected":"" ?>>Tester</option>
          <option value="Supervisor" <?= $user['Role']=="Supervisor"?"selected":"" ?>>Supervisor</option>
          <option value="Engineer" <?= $user['Role']=="Engineer"?"selected":"" ?>>Engineer</option>
          <option value="Manager" <?= $user['Role']=="Manager"?"selected":"" ?>>Manager</option>
        </select>
      </div>
      <button type="submit" class="btn btn-warning">Update</button>
      <a href="users.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
