<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/db.php');

$id = $_GET['id'];
$conn->query("DELETE FROM services WHERE ServiceID=$id");
header("Location: services.php");
exit;