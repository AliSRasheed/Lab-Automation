<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=orders_export_' . date('Ymd_His') . '.csv');

$out = fopen('php://output', 'w');
fputcsv($out, ['OrderNumber','CustomerName','CustomerEmail','Total','Status','CreatedAt']);

$res = $conn->query("SELECT * FROM orders ORDER BY CreatedAt DESC");
while($r = $res->fetch_assoc()){
    fputcsv($out, [$r['OrderNumber'], $r['CustomerName'], $r['CustomerEmail'], $r['Total'], $r['Status'], $r['CreatedAt']]);
}
fclose($out);
exit;
