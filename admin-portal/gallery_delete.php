<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

$id = $_GET['id'];
// delete file too
$img = $conn->query("SELECT FilePath FROM gallery WHERE ImageID=$id")->fetch_assoc();
if ($img) {
    $file = "../admin-portal/uploads/" . $img['FilePath'];
    if (file_exists($file)) unlink($file);
}
$conn->query("DELETE FROM gallery WHERE ImageID=$id");
header("Location: gallery.php");
exit;
