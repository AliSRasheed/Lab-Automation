<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE ProductID='$id'")->fetch_assoc();
if (!$product) die("Product not found.");

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['ProductName']);
    $category = $conn->real_escape_string($_POST['Category']);
    $revision = $conn->real_escape_string($_POST['Revision']);
    $manNo = $conn->real_escape_string($_POST['ManufacturingNumber']);
    $date = $conn->real_escape_string($_POST['ManufactureDate']);
    $status = $conn->real_escape_string($_POST['Status']);
    $price = floatval($_POST['Price']);
    $imagePath = $product['ImagePath']; // keep old image if not replaced

    // Handle new image upload
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] == 0) {
        $targetDir = "/uploads/products/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $filename = time() . "_" . basename($_FILES["Image"]["name"]);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES["Image"]["tmp_name"], $targetFile)) {
            $imagePath = "uploads/products/" . $filename;
        } else {
            $error = "Image upload failed.";
        }
    }

    if (!$error) {
        $sql = "UPDATE products 
                SET ProductName='$name', Category='$category', Revision='$revision', 
                    ManufacturingNumber='$manNo', ManufactureDate='$date', 
                    Status='$status', Price='$price', ImagePath='$imagePath'
                WHERE ProductID='$id'";

        if ($conn->query($sql)) {
            $success = "Product updated successfully.";
            $product = $conn->query("SELECT * FROM Products WHERE ProductID='$id'")->fetch_assoc();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2>Edit Product</h2>
    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3"><label>ID</label><input type="text" value="<?= $product['ProductID'] ?>" class="form-control" disabled></div>
      <div class="mb-3"><label>Name</label><input type="text" name="ProductName" value="<?= htmlspecialchars($product['ProductName']) ?>" class="form-control" required></div>
      <div class="mb-3"><label>Category</label><input type="text" name="Category" value="<?= htmlspecialchars($product['Category']) ?>" class="form-control" required></div>
      <div class="mb-3"><label>Revision</label><input type="text" name="Revision" value="<?= htmlspecialchars($product['Revision']) ?>" class="form-control" required></div>
      <div class="mb-3"><label>Manufacture #</label><input type="text" name="ManufacturingNumber" value="<?= htmlspecialchars($product['ManufacturingNumber']) ?>" class="form-control" required></div>
      <div class="mb-3"><label>Date</label><input type="date" name="ManufactureDate" value="<?= $product['ManufactureDate'] ?>" class="form-control" required></div>
      <div class="mb-3">
        <label>Status</label>
        <select name="Status" class="form-control">
          <option <?= $product['Status']=="Under Testing"?"selected":"" ?>>Under Testing</option>
          <option <?= $product['Status']=="Available"?"selected":"" ?>>Available</option>
          <option <?= $product['Status']=="Discontinued"?"selected":"" ?>>Discontinued</option>
        </select>
      </div>
      <div class="mb-3"><label>Price ($)</label>
        <input type="number" step="0.01" name="Price" class="form-control" value="<?= $product['Price'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Image</label>
        <input type="file" name="Image" class="form-control" accept="image/*">
        <?php if ($product['ImagePath']): ?>
          <img src="<?= $product['ImagePath'] ?>" class="mt-2" style="max-width:150px; height:auto; border-radius:5px;">
        <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-warning">Update</button>
      <a href="products.php" class="btn btn-secondary">Back</a>
    </form>
  </div>
</body>
</html>
