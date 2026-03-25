<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

if (!isset($_GET['id'])) { header("Location: orders.php"); exit; }
$id = intval($_GET['id']);

$order = $conn->query("SELECT * FROM orders WHERE OrderID=$id")->fetch_assoc();
if (!$order) { echo "Order not found"; exit; }

$items = $conn->query("SELECT * FROM orderitems WHERE OrderID=$id");
?>
<!DOCTYPE html>
<html><head>
  <title>Order <?= htmlspecialchars($order['OrderNumber']) ?> - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-dark text-white">

<div class="content p-4">
  <h2>Order <?= htmlspecialchars($order['OrderNumber']) ?></h2>
  <p><strong>Customer:</strong> <?= htmlspecialchars($order['CustomerName']) ?> — <?= htmlspecialchars($order['CustomerEmail']) ?></p>
  <p><strong>Address:</strong> <?= nl2br(htmlspecialchars($order['CustomerAddress'])) ?></p>
  <p><strong>Total:</strong> $<?= number_format($order['Total'],2) ?></p>
  <p><strong>Status:</strong> <?= htmlspecialchars($order['Status']) ?></p>

  <h4>Items</h4>
  <table class="table table-striped table-dark">
    <thead><tr><th>Product</th><th>Qty</th><th>Unit</th><th>Line Total</th></tr></thead>
    <tbody>
      <?php while($it = $items->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($it['ProductName']) ?> <?php if ($it['ProductID']): ?><small class="text-muted">(<?= $it['ProductID'] ?>)</small><?php endif; ?></td>
        <td><?= $it['Quantity'] ?></td>
        <td>$<?= number_format($it['UnitPrice'],2) ?></td>
        <td>$<?= number_format($it['Quantity']*$it['UnitPrice'],2) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <form method="POST" action="order_update_status.php" class="mb-3">
    <input type="hidden" name="order_id" value="<?= $order['OrderID'] ?>">
    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        <option <?= $order['Status']=='Pending'?'selected':'' ?>>Pending</option>
        <option <?= $order['Status']=='Processing'?'selected':'' ?>>Processing</option>
        <option <?= $order['Status']=='Completed'?'selected':'' ?>>Completed</option>
        <option <?= $order['Status']=='Cancelled'?'selected':'' ?>>Cancelled</option>
      </select>
    </div>
    <button class="btn btn-primary">Update Status</button>
    <a href="orders.php" class="btn btn-secondary">Back</a>
  </form>
</div>
</body></html>
