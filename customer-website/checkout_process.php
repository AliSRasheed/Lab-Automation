<?php
session_start();
include('includes/db.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Ensure POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: checkout.php");
    exit;
}

// Sanitize input
$name    = $conn->real_escape_string($_POST['CustomerName'] ?? '');
$email   = $conn->real_escape_string($_POST['CustomerEmail'] ?? '');
$address = $conn->real_escape_string($_POST['CustomerAddress'] ?? '');

if (!$name || !$email || !$address) {
    $_SESSION['checkout_error'] = "Please fill all fields.";
    header("Location: checkout.php");
    exit;
}

// Get session + customer info
$sessionID  = session_id();
$customerID = $_SESSION['customer_id'] ?? null;   // logged in user ID (if available)

// Debug check (TEMPORARY, remove later)
// echo "DEBUG: CustomerID = " . var_export($customerID, true); exit;

// Find cart
$cartRes = $conn->query("SELECT * FROM carts WHERE SessionID='$sessionID' LIMIT 1");
if (!$cartRes || $cartRes->num_rows == 0) {
    $_SESSION['checkout_error'] = "Your cart is empty.";
    header("Location: cart.php");
    exit;
}
$cart   = $cartRes->fetch_assoc();
$cartID = intval($cart['CartID']);

// Fetch cart items
$sql = "SELECT ci.ProductID, ci.Quantity, p.ProductName, p.Price
        FROM cartitems ci
        JOIN products p ON ci.ProductID = p.ProductID
        WHERE ci.CartID = $cartID";
$rs = $conn->query($sql);

if (!$rs || $rs->num_rows == 0) {
    $_SESSION['checkout_error'] = "Your cart is empty.";
    header("Location: cart.php");
    exit;
}

$total = 0;
$items = [];
while ($r = $rs->fetch_assoc()) {
    $qty  = intval($r['Quantity']);
    $unit = floatval($r['Price']);
    $line = $qty * $unit;
    $total += $line;

    $items[] = [
        'ProductID'   => $r['ProductID'],
        'ProductName' => $r['ProductName'],
        'Quantity'    => $qty,
        'UnitPrice'   => $unit
    ];
}

// Generate unique order number
$orderNumber = 'ORD' . date('YmdHis') . rand(100,999);

// Insert order
$customerID_sql = $customerID ? intval($customerID) : "NULL";
$ins = "INSERT INTO orders 
        (OrderNumber, CustomerID, SessionID, CustomerName, CustomerEmail, CustomerAddress, Total, Status)
        VALUES ('$orderNumber', $customerID_sql, '$sessionID', '$name', '$email', '$address', $total, 'Pending')";

if (!$conn->query($ins)) {
    die("Order insert failed: " . $conn->error);
}
$orderID = $conn->insert_id;

// Insert order items
foreach ($items as $it) {
    $pid   = $conn->real_escape_string($it['ProductID']);
    $pname = $conn->real_escape_string($it['ProductName']);
    $qty   = intval($it['Quantity']);
    $price = floatval($it['UnitPrice']);

    $sqlItem = "INSERT INTO orderitems (OrderID, ProductID, ProductName, Quantity, UnitPrice)
                VALUES ($orderID, '$pid', '$pname', $qty, $price)";
    if (!$conn->query($sqlItem)) {
        die("Order item insert failed: " . $conn->error);
    }
}

// Clear cart
$conn->query("DELETE FROM cartitems WHERE CartID = $cartID");
$conn->query("DELETE FROM carts WHERE CartID = $cartID");

// Redirect to success page
header("Location: order_success.php?order=" . urlencode($orderNumber));
exit;
?>
