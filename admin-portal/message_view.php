<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$id = intval($_GET['id']);
$msg = $conn->query("SELECT * FROM messages WHERE MessageID=$id")->fetch_assoc();
?>



<!DOCTYPE html>
<html>
<head>
  <title>View Message - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Message Details</h2>
    <div class="card bg-secondary text-white">
      <div class="card-body">
        <h5><strong>From:</strong> <?= htmlspecialchars($msg['Name']) ?> (<?= htmlspecialchars($msg['Email']) ?>)</h5>
        <h6><strong>Subject:</strong> <?= htmlspecialchars($msg['Subject']) ?></h6>
        <p class="mt-3"><?= nl2br(htmlspecialchars($msg['Message'])) ?></p>
        <p class="text-muted">Sent on <?= $msg['SentAt'] ?></p>
      </div>
    </div>
    <a href="messages.php" class="btn btn-warning mt-3">Back to Inbox</a>
  </div>
</body>
</html>
