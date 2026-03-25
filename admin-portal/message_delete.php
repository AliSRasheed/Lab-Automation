<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$id = intval($_GET['id']);
$conn->query("DELETE FROM messages WHERE MessageID=$id");
header("Location: messages.php");
exit;
