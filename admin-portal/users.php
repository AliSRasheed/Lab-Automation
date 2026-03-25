<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$result = $conn->query("SELECT * FROM users ORDER BY UserID DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #0f172a; color: white; }
    .content { margin-left: 240px; padding: 20px; }
    .table { color: white; }
    .btn-orange { background: orange; color: black; border: none; }
    .btn-orange:hover { background: darkorange; }
  </style>
</head>
<body>
  <?php include('sidebar.php'); ?>

  <div class="content">
    <h2 class="mb-4">Employees Management</h2>
    <a href="user_add.php" class="btn btn-orange mb-3"><i class="bi bi-plus-circle"></i> Add Employee</a>

    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($user = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $user['UserID'] ?></td>
              <td><?= htmlspecialchars($user['UserName']) ?></td>
              <td><?= htmlspecialchars($user['Role']) ?></td>
              <td>
                <a href="user_edit.php?id=<?= $user['UserID'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="user_delete.php?id=<?= $user['UserID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this employee?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
