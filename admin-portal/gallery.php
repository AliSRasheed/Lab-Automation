<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php"); exit;
}
include('includes/db.php');

$result = $conn->query("SELECT * FROM gallery ORDER BY UploadedAt DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Gallery - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #0f172a; color: white; }
    .content { margin-left: 230px; padding: 20px; }
    .card { background: #1e293b; color: white; border: none; }
    .table { color: white; }
    .btn-orange { background: orange; color: black; border: none; }
    .btn-orange:hover { background: darkorange; }
    img { max-width: 100px; border-radius: 6px; }
    
  </style>
</head>
<body>
  <?php include('sidebar.php'); ?>

  <div class="content">
    <h2 class="mb-4">Gallery Management</h2>
    <a href="gallery_add.php" class="btn btn-orange mb-3"><i class="bi bi-plus-circle"></i> Add New Image</a>

    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Preview</th>
            <th>Title</th>
            <th>Description</th>
            <th>Uploaded</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['ImageID'] ?></td>
              <td><img src="../uploads/<?= $row['FilePath'] ?>" alt=""></td>
              <td><?= htmlspecialchars($row['Title']) ?></td>
              <td><?= htmlspecialchars($row['Description']) ?></td>
              <td><?= $row['UploadedAt'] ?></td>
              <td>
                <a href="gallery_edit.php?id=<?= $row['ImageID'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="gallery_delete.php?id=<?= $row['ImageID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
