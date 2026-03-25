<?php 
include('includes/header.php'); 
include('includes/db.php');

// Fetch categories for filter dropdown
$cat_sql = "SELECT DISTINCT Category FROM products ORDER BY Category";
$cat_result = $conn->query($cat_sql);
$categories = [];
while ($row = $cat_result->fetch_assoc()) {
    $categories[] = $row['Category'];
}

// Fetch all products initially
$sql = "SELECT * FROM products ORDER BY ManufactureDate DESC";
$result = $conn->query($sql);
?>

<!-- Hero Banner -->
<div class="hero-products d-flex align-items-center text-white text-center">
  <div class="overlay"></div>
  <div class="container position-relative" data-aos="fade-up">
    <h1 class="display-4 fw-bold"> Our Products</h1>
    <p class="lead">Explore our premium catalogue of electrical appliances</p>
  </div>
</div>

<!-- Filters -->
<section class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <div class="card shadow-sm p-3 mb-4 filter-card">
      <div class="row g-3 align-items-center">
        <div class="col-md-4">
          <select id="categoryFilter" class="form-select">
            <option value="">All Categories</option>
            <?php foreach($categories as $cat): ?>
              <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <input type="text" id="searchBox" class="form-control" placeholder="🔍 Search by name or Product ID...">
        </div>
        <div class="col-md-4 text-md-end text-center">
          <span id="productCount" class="badge bg-dark fs-6 px-3 py-2">0 Products</span>
        </div>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4" id="productsGrid">
      <?php while($product = $result->fetch_assoc()): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 product-card-wrap"
             data-category="<?= htmlspecialchars($product['Category']) ?>" 
             data-name="<?= strtolower($product['ProductName']) ?>" 
             data-id="<?= $product['ProductID'] ?>">
          
          <div class="card h-100 shadow-sm product-card border-0 rounded-4" data-aos="zoom-in">
            <div class="position-relative">
              <img 
                src="/project-root/admin-portal/<?= htmlspecialchars($product['ImagePath'] ?: 'uploads/products/default.png') ?>" 
                class="card-img-top rounded-top-4 product-img" 
                alt="<?= htmlspecialchars($product['ProductName']) ?>">
              <span class="badge position-absolute top-0 start-0 m-2 
                <?= $product['Status']=='Under Testing'?'bg-warning text-dark':'bg-success' ?>">
                <?= htmlspecialchars($product['Status']) ?>
              </span>
            </div>

            <div class="card-body text-center">
              <h5 class="card-title fw-bold"><?= htmlspecialchars($product['ProductName']) ?></h5>
              <p class="text-muted small mb-1"><?= htmlspecialchars($product['Category']) ?> | Rev <?= htmlspecialchars($product['Revision']) ?></p>
              <?php if (isset($product['Price'])): ?>
                <p class="fw-bold text-success mb-2" id="pi">$<?= number_format($product['Price'],2) ?></p>
                <p class="price-info">*per 100</p>
              <?php endif; ?>
              <a href="product-details.php?id=<?= $product['ProductID'] ?>" class="btn btn-dark btn-sm px-3">View Details</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<style>
/* Hero section */
.hero-gallery {
  height: 60vh;
  background: url('assets/images/gallery-hero.jpg') center/cover no-repeat;
  position: relative;
}
.hero-gallery .overlay {
  /* background: rgba(0,0,0,0.6); */
  position: absolute;
  inset: 0;
}
.hero-products h1, .hero-products p {
  position: relative;
  z-index: 2;
}

/* Filters */
.filter-card {
  border-radius: 1rem;
  background: #fff;
}

/* Product Cards */
.product-card {
  transition: all 0.3s ease;
}
.product-card:hover {
  transform: translateY(-7px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.product-img {
  height: 200px;
  object-fit: cover;
  margin-top: 10px;
}

.price-info{
  font-size:12px;
  font-weight:700;
}

#pi{
  margin-bottom: -7px !important;
}

/* Responsive tweaks */
@media (max-width: 768px) {
  .hero-products { height: 35vh; }
}


</style>

<?php include('includes/footer.php'); ?>
