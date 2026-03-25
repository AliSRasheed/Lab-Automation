<?php
session_start();
include('includes/db.php');

// Identify session cart
$sessionID = session_id();

// Get or create cart
$cartRes = $conn->query("SELECT * FROM carts WHERE SessionID='$sessionID' LIMIT 1");
if ($cartRes->num_rows == 0) {
    $conn->query("INSERT INTO carts (SessionID) VALUES ('$sessionID')");
    $cartID = $conn->insert_id;
} else {
    $cartID = $cartRes->fetch_assoc()['CartID'];
}

// Add product
if (isset($_POST['ProductID'])) {
    $productID = $conn->real_escape_string($_POST['ProductID']);

    // Check if product already in cart
    $exists = $conn->query("SELECT * FROM cartitems WHERE CartID=$cartID AND ProductID='$productID'");
    if ($exists->num_rows > 0) {
        $conn->query("UPDATE cartitems SET Quantity = Quantity + 1 WHERE CartID=$cartID AND ProductID='$productID'");
    } else {
        $conn->query("INSERT INTO cartitems (CartID, ProductID, Quantity) VALUES ($cartID, '$productID', 1)");
    }
}

// Redirect to cart page
header("Location: cart.php");
exit;
?>
