<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/db.php');

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['ProductID']);
    $name = $conn->real_escape_string($_POST['ProductName']);
    $category = $conn->real_escape_string($_POST['Category']);
    $revision = $conn->real_escape_string($_POST['Revision']);
    $manNo = $conn->real_escape_string($_POST['ManufacturingNumber']);
    $date = $conn->real_escape_string($_POST['ManufactureDate']);
    $status = $conn->real_escape_string($_POST['Status']);
    $price = floatval($_POST['Price']);
    $imagePath = null;

    // Handle image upload
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] == 0) {
        $targetDir = "./uploads/products/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $filename = rand(11111,99999) . "_" . basename($_FILES["Image"]["name"]);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES["Image"]["tmp_name"], $targetFile)) {
            $imagePath = "uploads/products/" . $filename; // save relative path
        } else {
            $error = "Image upload failed.";
        }
    }

    if (!$error) {
        $sql = "INSERT INTO products 
                (ProductID, ProductName, Category, Revision, ManufacturingNumber, ManufactureDate, Status, Price, ImagePath)
                VALUES ('$id','$name','$category','$revision','$manNo','$date','$status','$price','$imagePath')";

        if ($conn->query($sql)) {
            $success = "Product added successfully.";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Add Product</h2>
    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3"><label>ID</label><input type="text" name="ProductID" class="form-control" required></div>
      <div class="mb-3"><label>Name</label><input type="text" name="ProductName" class="form-control" required></div>
      <div class="mb-3"><label>Category</label><input type="text" name="Category" class="form-control" required></div>
      <div class="mb-3"><label>Revision</label><input type="text" name="Revision" class="form-control" required></div>
      <div class="mb-3"><label>Manufacture #</label><input type="text" name="ManufacturingNumber" class="form-control" required></div>
      <div class="mb-3"><label>Date</label><input type="date" name="ManufactureDate" class="form-control" required></div>
      <div class="mb-3">
        <label>Status</label>
        <select name="Status" class="form-control">
          <option>Under Testing</option>
          <option>Available</option>
          <option>Discontinued</option>
        </select>
      </div>
      <div class="mb-3">
        <label>Price ($)</label>
        <input type="number" step="0.01" name="Price" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Image</label>
        <input type="file" name="Image" class="form-control" accept="image/*">
      </div>

      <button type="submit" class="btn btn-warning">Save</button>
      <a href="products.php" class="btn btn-secondary">Back</a>
    </form>
  </div>
</body>
</html>
