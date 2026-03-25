<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/db.php');

$result = $conn->query("SELECT * FROM products ORDER BY ManufactureDate DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products - Admin</title>
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
  <?php include('sidebar.php'); ?> <!-- reuse sidebar -->

  <div class="content">
    <h2 class="mb-4">Products Management</h2>
    <a href="product_add.php" class="btn btn-orange mb-3"><i class="bi bi-plus-circle"></i> Add New Product</a>

    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Revision</th>
            <th>Manufacture #</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['ProductID'] ?></td>
              <td><?= htmlspecialchars($row['ProductName']) ?></td>
              <td><?= $row['Category'] ?></td>
              <td><?= $row['Revision'] ?></td>
              <td><?= $row['ManufacturingNumber'] ?></td>
              <td><?= $row['ManufactureDate'] ?></td>
              <td><?= $row['Status'] ?></td>
              <td>
                <a href="product_edit.php?id=<?= $row['ProductID'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="product_delete.php?id=<?= $row['ProductID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
