<?php
include('includes/header.php');
include('includes/db.php');

// Validate product ID
if (!isset($_GET['id'])) {
    die("<div class='container py-5'><h3>Invalid Product ID</h3></div>");
}
$productID = $conn->real_escape_string($_GET['id']);

// Fetch product details
$sql = "SELECT * FROM products WHERE ProductID = '$productID' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    die("<div class='container py-5'><h3>Product Not Found</h3></div>");
}
$product = $result->fetch_assoc();

// Fetch extra product images (if you’re using ProductImages table)
$img_sql = "SELECT ImagePath FROM productimages WHERE ProductID = '$productID'";
$img_result = $conn->query($img_sql);
$images = [];
while ($row = $img_result->fetch_assoc()) {
    $images[] = $row['ImagePath'];
}

// Fetch testing history
$test_sql = "
SELECT T.TestID, T.TestName, T.TestDate, T.TestResult, T.Remarks,
       D.DepartmentName, U.UserName, S.Status, S.StatusDate
FROM tests T
JOIN testingdepartments D ON T.TestingDepartmentID = D.DepartmentID
JOIN users U ON T.TestedBy = U.UserID
LEFT JOIN TestingStatus S ON T.TestID = S.TestID
WHERE T.ProductID = '$productID'
ORDER BY T.TestDate DESC";
$test_result = $conn->query($test_sql);
?>

<!-- Hero Banner -->
<div class="hero-product d-flex align-items-center text-white text-center">
  <div class="container" data-aos="fade-up">
    <h1 class="display-4 fw-bold"><?= htmlspecialchars($product['ProductName']) ?></h1>
    <p class="lead"><?= htmlspecialchars($product['Category']) ?> | Reliable & Certified</p>
  </div>
</div>

<!-- Product Details -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
      <!-- Images -->
      <div class="col-md-6">
        <div class="main-image text-center mb-3">
          <img 
            src="../admin-portal/<?= htmlspecialchars($product['ImagePath'] ?: 'uploads/products/default.png') ?>" 
            class="img-fluid rounded shadow" 
            style="max-height:350px; object-fit:cover;"
            alt="<?= htmlspecialchars($product['ProductName']) ?>">
        </div>

        <?php if (count($images) > 0): ?>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <?php foreach ($images as $img): ?>
            <img src="../admin-portal/<?= htmlspecialchars($img) ?>" 
                 class="thumb-img rounded shadow" 
                 style="width:80px; height:80px; object-fit:cover;" 
                 alt="thumb">
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- Info -->
      <div class="col-md-6">
        <h2><?= htmlspecialchars($product['ProductName']) ?></h2>
        <p class="text-muted">Category: <?= htmlspecialchars($product['Category']) ?></p>
        <p class="fw-bold fs-4 text-success">$<?= number_format($product['Price'], 2) ?></p>
        
        <ul class="list-unstyled">
          <li><strong>Revision:</strong> <?= htmlspecialchars($product['Revision']) ?></li>
          <li><strong>Manufacturing No:</strong> <?= htmlspecialchars($product['ManufacturingNumber']) ?></li>
          <li><strong>Manufacture Date:</strong> <?= htmlspecialchars($product['ManufactureDate']) ?></li>
          <li><strong>Status:</strong> <?= htmlspecialchars($product['Status']) ?></li>
        </ul>

        <div class="mt-4">
          <?php if (!empty($product['Datasheet'])): ?>
            <a href="../admin-portal/<?= htmlspecialchars($product['Datasheet']) ?>" class="btn btn-outline-primary me-2" target="_blank">
              <i class="bi bi-file-earmark-pdf"></i> Download Datasheet
            </a>
          <?php endif; ?>
         <form method="POST" action="cart_add.php" class="d-inline">
  <input type="hidden" name="ProductID" value="<?= htmlspecialchars($product['ProductID']) ?>">
  <button type="submit" class="btn btn-warning"><i class="bi bi-cart-plus"></i> Add to Cart</button>
</form>


        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testing History -->
<section class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <h3 class="mb-4 text-center">Testing History</h3>
    <?php if ($test_result->num_rows > 0): ?>
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-dark">
            <tr>
              <th>Test ID</th>
              <th>Test Name</th>
              <th>Date</th>
              <th>Department</th>
              <th>Tester</th>
              <th>Result</th>
              <th>Remarks</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while($test = $test_result->fetch_assoc()): ?>
            <tr>
              <td><?= $test['TestID'] ?></td>
              <td><?= htmlspecialchars($test['TestName']) ?></td>
              <td><?= $test['TestDate'] ?></td>
              <td><?= htmlspecialchars($test['DepartmentName']) ?></td>
              <td><?= htmlspecialchars($test['UserName']) ?></td>
              <td class="<?= $test['TestResult']=='Pass'?'text-success':'text-danger' ?>">
                <?= htmlspecialchars($test['TestResult']) ?>
              </td>
              <td><?= htmlspecialchars($test['Remarks']) ?></td>
              <td><?= htmlspecialchars($test['Status']) ?> (<?= $test['StatusDate'] ?>)</td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted text-center">No tests recorded for this product yet.</p>
    <?php endif; ?>
  </div>
</section>

<?php include('includes/footer.php'); ?>
