<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['UserName']);
    $role = $conn->real_escape_string($_POST['Role']);
    $conn->query("INSERT INTO users (UserName, Role) VALUES ('$name','$role')");
    header("Location: users.php"); exit;
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Add Employee - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Add Employee</h2>
    <form method="POST">
      <div class="mb-3"><label>Name</label><input type="text" name="UserName" class="form-control" required></div>
      <div class="mb-3">
        <label>Role</label>
        <select name="Role" class="form-control" required>
          <option value="Tester">Tester</option>
          <option value="Supervisor">Supervisor</option>
          <option value="Engineer">Engineer</option>
          <option value="Manager">Manager</option>
        </select>
      </div>
      <button type="submit" class="btn btn-warning">Add</button>
      <a href="users.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
