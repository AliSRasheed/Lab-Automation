<?php
session_start();
include('includes/header.php');
include('includes/db.php');

if (!isset($_SESSION['customer_logged_in'])) {
    header("Location: login.php");
    exit;
}

$customerID = intval($_SESSION['customer_id']);
$sql = "SELECT * FROM orders WHERE CustomerID=$customerID ORDER BY CreatedAt DESC";
$result = $conn->query($sql);
?>

<div class="container py-5">
  <h2 class="mb-4">My Orders</h2>
  <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
          <tr>
            <th>Order #</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th>Invoice</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['OrderNumber']) ?></td>
              <td><?= $row['CreatedAt'] ?></td>
              <td>$<?= number_format($row['Total'],2) ?></td>
              <td>
                <span class="badge bg-<?= $row['Status']=="Pending"?"warning":($row['Status']=="Completed"?"success":"secondary") ?>">
                  <?= htmlspecialchars($row['Status']) ?>
                </span>
              </td>
              <td><a href="invoice.php?order=<?= urlencode($row['OrderNumber']) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-file-earmark-pdf"></i> PDF</a></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p class="text-muted">You haven’t placed any orders yet.</p>
  <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
