<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/db.php');

$id = $_GET['id'];
$service = $conn->query("SELECT * FROM services WHERE ServiceID=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['Title']);
    $desc = $conn->real_escape_string($_POST['Description']);
    $icon = $conn->real_escape_string($_POST['Icon']);

    $sql = "UPDATE Services SET Title='$title', Description='$desc', Icon='$icon' WHERE ServiceID=$id";
    if ($conn->query($sql)) {
        header("Location: services.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Service - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Edit Service</h2>
    <form method="POST">
      <div class="mb-3"><label>Title</label><input type="text" name="Title" class="form-control" value="<?= $service['Title'] ?>"></div>
      <div class="mb-3"><label>Description</label><textarea name="Description" class="form-control"><?= $service['Description'] ?></textarea></div>
      <div class="mb-3"><label>Icon</label><input type="text" name="Icon" class="form-control" value="<?= $service['Icon'] ?>"></div>
      <button type="submit" class="btn btn-warning">Update</button>
      <a href="services.php" class="btn btn-secondary">Back</a>
    </form>
  </div>
</body>
</html>
