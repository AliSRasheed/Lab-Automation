<?php
// admin-portal/invoice.php
session_start();
include('includes/db.php');

// (Optional) Admin authentication check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['order'])) {
    http_response_code(400);
    echo "<div class='container py-5'><h3>Missing order number.</h3></div>";
    exit;
}
$orderNo = $conn->real_escape_string($_GET['order']);
$download = isset($_GET['download']);

// Fetch order
$ordRes = $conn->query("SELECT * FROM orders WHERE OrderNumber='$orderNo' LIMIT 1");
if (!$ordRes || $ordRes->num_rows === 0) {
    echo "<div class='container py-5'><h3>Order not found.</h3></div>";
    exit;
}
$order = $ordRes->fetch_assoc();

// Fetch order items
$oid = intval($order['OrderID']);
$itRes = $conn->query("SELECT ProductName, Quantity, UnitPrice FROM OrderItems WHERE OrderID=$oid");
$items = [];
$calcTotal = 0.0;
while ($r = $itRes->fetch_assoc()) {
    $items[] = $r;
    $calcTotal += floatval($r['UnitPrice']) * intval($r['Quantity']);
}

// Invoice variables
$companyName  = "SRS Electrical Appliances";
$companyAddr  = "Industrial Area, Karachi, Pakistan";
$companyEmail = "support@srs.example";
$companyPhone = "+92-xxx-xxxxxxx";

$invDate = date('Y-m-d', strtotime($order['CreatedAt']));
$subtotal = $calcTotal;
$taxRate  = 0.00;
$tax      = $subtotal * $taxRate;
$grand    = $subtotal + $tax;

$logoPath = "/assets/images/SRS-logo.png";
$logoDataUri = '';
if (file_exists($logoPath)) {
    $logoDataUri = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
}

// Build invoice HTML
ob_start();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Invoice <?= htmlspecialchars($orderNo) ?></title>
  <style>
    body{font-family: DejaVu Sans, Arial; color:#111}
    .wrap{max-width:800px;margin:0 auto;padding:20px}
    .header{display:flex;align-items:center;gap:20px}
    .header img{height:60px}
    .meta{display:flex;justify-content:space-between;margin:20px 0}
    .box{border:1px solid #eee;padding:10px;border-radius:6px}
    table{width:100%;border-collapse:collapse;margin-top:10px}
    th,td{border:1px solid #e6e6e6;padding:8px;text-align:left}
    th{background:#f8f8f8}
    .text-right{ text-align:right }
  </style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <?php if ($logoDataUri): ?><img src="<?= $logoDataUri ?>" alt="logo"><?php endif; ?>
    <div>
      <div style="font-size:18px;font-weight:700"><?= htmlspecialchars($companyName) ?></div>
      <div style="color:#666"><?= htmlspecialchars($companyAddr) ?></div>
      <div style="color:#666"><?= htmlspecialchars($companyEmail) ?> · <?= htmlspecialchars($companyPhone) ?></div>
    </div>
    <div style="margin-left:auto;text-align:right">
      <div style="font-weight:700">INVOICE</div>
      <div>#<?= htmlspecialchars($orderNo) ?></div>
      <div><?= htmlspecialchars($invDate) ?></div>
    </div>
  </div>

  <div class="meta">
    <div class="box">
      <strong>Bill To</strong><br>
      <?= htmlspecialchars($order['CustomerName']) ?><br>
      <?= nl2br(htmlspecialchars($order['CustomerAddress'])) ?><br>
      <small><?= htmlspecialchars($order['CustomerEmail']) ?></small>
    </div>
    <div class="box">
      <strong>Order Info</strong><br>
      Status: <?= htmlspecialchars($order['Status']) ?><br>
      Customer ID: <?= $order['CustomerID'] ? intval($order['CustomerID']) : 'Guest' ?><br>
      Session: <?= htmlspecialchars(substr($order['SessionID'],0,16)) ?>…
    </div>
  </div>

  <table>
    <thead><tr><th>Item</th><th>Unit</th><th>Qty</th><th class="text-right">Line Total</th></tr></thead>
    <tbody>
      <?php foreach ($items as $it): $line = $it['Quantity'] * $it['UnitPrice']; ?>
      <tr>
        <td><?= htmlspecialchars($it['ProductName']) ?></td>
        <td>$<?= number_format($it['UnitPrice'],2) ?></td>
        <td><?= intval($it['Quantity']) ?></td>
        <td class="text-right">$<?= number_format($line,2) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <table style="width:100%;margin-top:10px">
    <tr><td style="width:80%" class="text-right">Subtotal:</td><td class="text-right">$<?= number_format($subtotal,2) ?></td></tr>
    <tr><td class="text-right">Tax:</td><td class="text-right">$<?= number_format($tax,2) ?></td></tr>
    <tr><td class="text-right"><strong>Total:</strong></td><td class="text-right"><strong>$<?= number_format($grand,2) ?></strong></td></tr>
    <tr><td class="text-right muted">Recorded DB Total:</td><td class="text-right muted">$<?= number_format($order['Total'],2) ?></td></tr>
  </table>

  <?php if (!$download): ?>
    <div style="margin-top:18px; text-align:right">
      <a href="invoice.php?order=<?= urlencode($orderNo) ?>&download=1" style="display:inline-block;padding:8px 14px;background:#0d6efd;color:#fff;border-radius:6px;text-decoration:none">Download PDF</a>
      <a href="orders.php" style="margin-left:8px;display:inline-block;padding:8px 14px;border-radius:6px;border:1px solid #0d6efd;color:#0d6efd;text-decoration:none">Back to Orders</a>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
<?php
$html = ob_get_clean();

// If download requested, generate PDF
if ($download) {
    require_once '../vendor/autoload.php'; // fixed path (admin-portal/vendor)

    $options = new Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf\Dompdf($options);
    $dompdf->loadHtml($html, 'UTF-8');
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('Invoice_'.$orderNo.'.pdf', ['Attachment' => true]);
    exit;
}

// Otherwise show HTML
echo $html;
