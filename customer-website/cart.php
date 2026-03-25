<?php
session_start();
include('includes/header.php');
include('includes/db.php');

$sessionID = session_id();

// Find cart
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
?>

<div class="container py-5">
  <h2>Your Cart</h2>
  <?php if ($result->num_rows > 0): ?>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Image</th><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $grandTotal=0; while($item=$result->fetch_assoc()): 
        $total = $item['Price'] * $item['Quantity'];
        $grandTotal += $total;
      ?>
      <tr>
        <td><img src="../admin-portal/<?= htmlspecialchars($item['ImagePath']) ?>" width="60"></td>
        <td><?= htmlspecialchars($item['ProductName']) ?></td>
        <td>$<?= number_format($item['Price'],2) ?></td>
        <td><?= $item['Quantity'] ?></td>
        <td>$<?= number_format($total,2) ?></td>
        <td>
          <a href="cart_remove.php?id=<?= $item['CartItemID'] ?>" class="btn btn-sm btn-danger">Remove</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="4" class="text-end">Grand Total:</th>
        <th colspan="2">$<?= number_format($grandTotal,2) ?></th>
      </tr>
    </tfoot>
  </table>
  <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
  <?php else: ?>
    <p>Your cart is empty.</p>
  <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
