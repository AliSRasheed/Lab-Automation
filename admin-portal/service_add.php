<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/db.php');

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['Title']);
    $desc = $conn->real_escape_string($_POST['Description']);
    $icon = $conn->real_escape_string($_POST['Icon']);

    $sql = "INSERT INTO services (Title, Description, Icon) VALUES ('$title','$desc','$icon')";
    if ($conn->query($sql)) {
        $success = "Service added successfully.";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

 <?php include('sidebar.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Service - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Add Service</h2>
    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

    <form method="POST">
      <div class="mb-3"><label>Title</label><input type="text" name="Title" class="form-control" required></div>
      <div class="mb-3"><label>Description</label><textarea name="Description" class="form-control" required></textarea></div>
      <div class="mb-3"><label>Icon (Bootstrap Icon Class, e.g. bi-tools)</label>
        <input type="text" name="Icon" class="form-control" value="bi-gear">
      </div>
      <button type="submit" class="btn btn-warning">Save</button>
      <a href="services.php" class="btn btn-secondary">Back</a>
    </form>
  </div>
</body>
</html>
