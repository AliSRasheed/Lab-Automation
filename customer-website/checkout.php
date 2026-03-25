<?php
session_start();
include('includes/header.php');
include('includes/db.php');

$sessionID = session_id();



// Fetch cart
$cartRes = $conn->query("SELECT * FROM carts WHERE SessionID='$sessionID' LIMIT 1");
if ($cartRes->num_rows == 0) {
    echo "<div class='container py-5'><h3>Your cart is empty.</h3></div>";
    include('includes/footer.php');
    exit;
}
$cartID = $cartRes->fetch_assoc()['CartID'];

// Fetch cart items
$sql = "SELECT ci.*, p.ProductName, p.Price, p.ImagePath 
        FROM cartitems ci
        JOIN products p ON ci.ProductID = p.ProductID
        WHERE ci.CartID=$cartID";
$result = $conn->query($sql);

$grandTotal = 0;
$items = [];
while($item = $result->fetch_assoc()) {
    $items[] = $item;
    $grandTotal += $item['Price'] * $item['Quantity'];
}
?>

<div class="container py-5">
  <h2>Checkout</h2>
  
  <div class="row">
    <!-- Order Summary -->
    <div class="col-md-6">
      <h4>Order Summary</h4>
      <ul class="list-group mb-3">
        <?php foreach($items as $item): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <strong><?= htmlspecialchars($item['ProductName']) ?></strong><br>
            <small>Quantity: <?= $item['Quantity'] ?></small>
          </div>
          <span>$<?= number_format($item['Price'] * $item['Quantity'],2) ?></span>
        </li>
        <?php endforeach; ?>
        <li class="list-group-item d-flex justify-content-between">
          <strong>Total</strong>
          <strong>$<?= number_format($grandTotal,2) ?></strong>
        </li>
      </ul>
    </div>

    <?php if (!empty($_SESSION['checkout_error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['checkout_error']; unset($_SESSION['checkout_error']); ?>
    </div>
<?php endif; ?>

    <!-- Billing Info -->
    <div class="col-md-6">
      <h4>Billing Information</h4>
      <form method="POST" action="checkout_process.php">
        <div class="mb-3">
          <label>Name</label>
          <input type="text" name="CustomerName" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="CustomerEmail" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Address</label>
          <textarea name="CustomerAddress" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success w-100">Place Order</button>
      </form>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
