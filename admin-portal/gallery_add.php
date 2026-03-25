<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['Title']);
    $desc = $conn->real_escape_string($_POST['Description']);

    if (isset($_FILES['Image']) && $_FILES['Image']['error'] == 0) {
$targetDir = "../admin-portal/uploads/";
if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

$filename = time() . "_" . basename($_FILES["Image"]["name"]);
$targetFile = $targetDir . $filename;

if (move_uploaded_file($_FILES["Image"]["tmp_name"], $targetFile)) {
    $sql = "INSERT INTO gallery (Title, Description, FilePath) VALUES ('$title','$desc','$filename')";


            if ($conn->query($sql)) $success = "Image uploaded successfully.";
            else $error = "DB Error: " . $conn->error;
        } else {
            $error = "Upload failed.";
        }
    } else {
        $error = "Please select an image.";
    }
}
?>

 

<!DOCTYPE html>
<html>
<head>
  <title>Add Gallery Image - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Add Gallery Image</h2>
    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3"><label>Title</label><input type="text" name="Title" class="form-control" required></div>
      <div class="mb-3"><label>Description</label><textarea name="Description" class="form-control"></textarea></div>
      <div class="mb-3"><label>Image</label><input type="file" name="Image" class="form-control" accept="image/*" required></div>
      <button type="submit" class="btn btn-warning">Upload</button>
      <a href="gallery.php" class="btn btn-secondary">Back</a>
    </form>
  </div>
</body>
</html>
