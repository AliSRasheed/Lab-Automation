<?php
session_start();
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM cartitems WHERE CartItemID=$id");
}

header("Location: cart.php");
exit;
?>
