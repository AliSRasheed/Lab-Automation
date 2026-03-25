<?php
include('includes/header.php');
include('includes/db.php');

$orderNumber = $_GET['order'] ?? null;
if (!$orderNumber) {
    echo "<div class='container py-5'><h3>Order not found.</h3></div>";
    include('includes/footer.php');
    exit;
}

$sql = "SELECT * FROM orders WHERE OrderNumber = '" . $conn->real_escape_string($orderNumber) . "' LIMIT 1";
$res = $conn->query($sql);
if (!$res || $res->num_rows == 0) {
    echo "<div class='container py-5'><h3>Order not found.</h3></div>";
    include('includes/footer.php');
    exit;
}
$order = $res->fetch_assoc();
?>

<div class="container py-5">
  <h2>Thank you — Order placed!</h2>
  <p>Your order number is <strong><?= htmlspecialchars($order['OrderNumber']) ?></strong>.</p>
  <p>We have sent a confirmation to <strong><?= htmlspecialchars($order['CustomerEmail']) ?></strong> (if email sending configured).</p>

  <h4>Order Summary</h4>
  <?php
  $items = $conn->query("SELECT * FROM OrderItems WHERE OrderID=" . intval($order['OrderID']));
  if ($items && $items->num_rows):
  ?>
  <table class="table table-striped">
    <thead><tr><th>Product</th><th>Qty</th><th>Unit</th><th>Total</th></tr></thead>
    <tbody>
      <?php while($it = $items->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($it['ProductName']) ?></td>
        <td><?= $it['Quantity'] ?></td>
        <td>$<?= number_format($it['UnitPrice'],2) ?></td>
        <td>$<?= number_format($it['Quantity'] * $it['UnitPrice'],2) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
    <tfoot>
      <tr><th colspan="3" class="text-end">Total</th><th>$<?= number_format($order['Total'],2) ?></th></tr>
    </tfoot>
  </table>
  <?php endif; ?>

  <a href="index.php" class="btn btn-primary">Continue Browsing</a>
</div>

<?php include('includes/footer.php'); ?>
