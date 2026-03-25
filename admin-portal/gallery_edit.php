<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$id = $_GET['id'];
$gallery = $conn->query("SELECT * FROM gallery WHERE ImageID=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['Title']);
    $desc = $conn->real_escape_string($_POST['Description']);

    $sql = "UPDATE gallery SET Title='$title', Description='$desc' WHERE ImageID=$id";
    if ($conn->query($sql)) { header("Location: gallery.php"); exit; }
}
?>

 

<!DOCTYPE html>
<html>
<head>
  <title>Edit Gallery Image - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Edit Gallery Image</h2>
    <form method="POST">
      <div class="mb-3"><label>Title</label><input type="text" name="Title" class="form-control" value="<?= $gallery['Title'] ?>"></div>
      <div class="mb-3"><label>Description</label><textarea name="Description" class="form-control"><?= $gallery['Description'] ?></textarea></div>
      <button type="submit" class="btn btn-warning">Update</button>
      <a href="gallery.php" class="btn btn-secondary">Back</a>
    </form>
  </div>
</body>
</html>
