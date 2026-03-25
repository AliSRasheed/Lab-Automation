<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$result = $conn->query("SELECT * FROM messages ORDER BY SentAt DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Messages - Admin</title>
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
    <h2 class="mb-4">Messages Inbox</h2>
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>From</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($msg = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $msg['MessageID'] ?></td>
              <td><?= htmlspecialchars($msg['Name']) ?></td>
              <td><?= htmlspecialchars($msg['Email']) ?></td>
              <td><?= htmlspecialchars($msg['Subject']) ?></td>
              <td><?= $msg['SentAt'] ?></td>
              <td>
                <a href="message_view.php?id=<?= $msg['MessageID'] ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                <a href="message_delete.php?id=<?= $msg['MessageID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this message?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
