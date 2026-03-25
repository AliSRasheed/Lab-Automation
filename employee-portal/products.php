<?php
session_start();
if (!isset($_SESSION['employee_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM products WHERE ProductName LIKE '%$search%' OR Category LIKE '%$search%' ORDER BY ManufactureDate DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Products - Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background:#1e293b; color:white; }
    .content { margin-left:240px; padding:20px; }
    .table { color:white; }
  </style>
</head>
<body>
<?php include('sidebar.php'); ?>

<div class="content">
  <h2 class="mb-4">Products</h2>
  <form method="GET" class="mb-3">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">
      <button class="btn btn-warning">Search</button>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th><th>Name</th><th>Category</th><th>Status</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row=$result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['ProductID'] ?></td>
          <td><?= htmlspecialchars($row['ProductName']) ?></td>
          <td><?= htmlspecialchars($row['Category']) ?></td>
          <td><?= htmlspecialchars($row['Status']) ?></td>
          <td><a href="product_details.php?id=<?= $row['ProductID'] ?>" class="btn btn-sm btn-info">View</a></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
