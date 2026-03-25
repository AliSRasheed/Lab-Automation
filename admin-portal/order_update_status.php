<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$orderID = isset($_POST['order_id']) ? intval($_POST['order_id']) : (isset($_GET['id']) ? intval($_GET['id']) : 0);
$status  = isset($_POST['status']) ? $_POST['status'] : (isset($_GET['status']) ? $_GET['status'] : '');

$allowed = ['Pending','Processing','Completed','Cancelled']; // only allow valid statuses

if ($orderID && in_array($status, $allowed)) {
    $stmt = $conn->prepare("UPDATE orders SET Status=? WHERE OrderID=?");
    $stmt->bind_param("si", $status, $orderID);
    $stmt->execute();
}

header("Location: orders.php");
exit;
