<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/db.php');


$result = $conn->query("SELECT * FROM services ORDER BY CreatedAt DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Services - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #0f172a; color: white; }
    .content { margin-left: 240px; padding: 20px; }
    .card { background: #1e293b; color: white; border: none; }
    .table { color: white; }
    .btn-orange { background: orange; color: black; border: none; }
    .btn-orange:hover { background: darkorange; }
  </style>
</head>
<body>
  <?php include('sidebar.php'); ?>

  <div class="content">
    <h2 class="mb-4">Services Management</h2>
    <a href="service_add.php" class="btn btn-orange mb-3"><i class="bi bi-plus-circle"></i> Add New Service</a>

    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Icon</th>
            <th>Title</th>
            <th>Description</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['ServiceID'] ?></td>
              <td><i class="bi <?= $row['Icon'] ?> fs-3 text-warning"></i></td>
              <td><?= htmlspecialchars($row['Title']) ?></td>
              <td><?= htmlspecialchars($row['Description']) ?></td>
              <td><?= $row['CreatedAt'] ?></td>
              <td>
                <a href="service_edit.php?id=<?= $row['ServiceID'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="service_delete.php?id=<?= $row['ServiceID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
