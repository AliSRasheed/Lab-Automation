<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Orders - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="content p-4">
  <h2>Orders</h2>
  <a href="index.php" class="btn btn-secondary mb-3">⬅ Back to Dashboard</a>
  <a href="export_orders.php" class="btn btn-sm btn-info mb-3">Export CSV</a>
  
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th>Order #</th><th>Customer</th><th>Email</th><th>Total</th><th>Status</th><th>Date</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM orders ORDER BY CreatedAt DESC";
    $res = $conn->query($sql);
    while($o = $res->fetch_assoc()):
    ?>
      <tr>
        <td><?= htmlspecialchars($o['OrderNumber']) ?></td>
        <td><?= htmlspecialchars($o['CustomerName']) ?></td>
        <td><?= htmlspecialchars($o['CustomerEmail']) ?></td>
        <td>$<?= number_format($o['Total'],2) ?></td>
        <td><?= htmlspecialchars($o['Status']) ?></td>
        <td><?= $o['CreatedAt'] ?></td>
        <td>
          <a href="order_view.php?id=<?= $o['OrderID'] ?>" class="btn btn-sm btn-warning">View</a>
          <a href="invoice.php?order=<?= urlencode($o['OrderNumber']) ?>" class="btn btn-sm btn-outline-primary">Invoice</a>
          <a href="order_update_status.php?id=<?= $o['OrderID'] ?>&status=Completed" class="btn btn-sm btn-success">Mark Completed</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
