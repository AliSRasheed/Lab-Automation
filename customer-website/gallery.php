<?php
include('includes/header.php');
include('includes/db.php');

// Fetch categories for filter dropdown
$cat_sql = "SELECT DISTINCT Category FROM gallery ORDER BY Category";
$cat_result = $conn->query($cat_sql);
$categories = [];


// Fetch all gallery items
$sql = "SELECT * FROM gallery ORDER BY UploadedAt DESC";
$result = $conn->query($sql);
?>

<!-- Hero Banner -->
<div class="hero-gallery d-flex align-items-center text-center">
  <div class="container" data-aos="fade-up">
    <h1 class="display-4 fw-bold">Our Gallery</h1>
    <p class="lead text-white">Take a look at our company, our people, and our products</p>
  </div>
</div>

<!-- Filters -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <div class="row mb-4">
      <div class="col-md-4">
        <select id="categoryFilter" class="form-select">
          <option value="">All Categories</option>
          <?php foreach($categories as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <input type="text" id="searchBox" class="form-control" placeholder="Search by title...">
      </div>
      <div class="col-md-4 text-end">
        <span id="galleryCount" class="fw-bold"></span>
      </div>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-4" id="galleryGrid">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($img = $result->fetch_assoc()): ?>
          <?php if (!empty($img['FilePath'])): ?>
            <div class="col-md-3 gallery-card-wrap"
                 data-category="<?= htmlspecialchars($img['Category'] ?? '') ?>"
                 data-title="<?= strtolower($img['Title']) ?>">
              <div class="card h-100 shadow-sm gallery-card" data-aos="zoom-in">
                <a href="../admin-portal/uploads/<?= htmlspecialchars($img['FilePath']) ?>" 
                   data-lightbox="company-gallery" 
                   data-title="<?= htmlspecialchars($img['Title'] ?: 'Gallery Image') ?>">
                  <img src="../admin-portal/uploads/<?= htmlspecialchars($img['FilePath']) ?>" 
                       class="card-img-top w-100 gallery-img" 
                       alt="<?= htmlspecialchars($img['Title'] ?: 'gallery') ?>">
                </a>
                <div class="card-body text-center">
                  <h5 class="card-title"><?= htmlspecialchars($img['Title'] ?: 'Untitled') ?></h5>
                  <p class="text-muted small"><?= htmlspecialchars($img['Category'] ?? 'Uncategorized') ?></p>
                </div>
                <div class="card-footer text-center small text-secondary">
                  Uploaded: <?= date("M d, Y", strtotime($img['UploadedAt'])) ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center text-muted">No gallery images uploaded yet.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>

<!-- Lightbox & AOS Scripts -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<script>
  AOS.init({
    duration: 800,
    once: true
  });

  // Filter + Search
  const searchBox = document.getElementById("searchBox");
  const categoryFilter = document.getElementById("categoryFilter");
  const galleryItems = document.querySelectorAll("#galleryGrid .gallery-card-wrap");
  const galleryCount = document.getElementById("galleryCount");

  function filterGallery() {
    let searchVal = searchBox.value.toLowerCase();
    let catVal = categoryFilter.value.toLowerCase();
    let visible = 0;

    galleryItems.forEach(item => {
      let matchesSearch = item.dataset.title.includes(searchVal);
      let matchesCat = catVal === "" || item.dataset.category.toLowerCase() === catVal;

      if (matchesSearch && matchesCat) {
        item.style.display = "block";
        visible++;
      } else {
        item.style.display = "none";
      }
    });

    galleryCount.textContent = visible + " images found";
  }

  searchBox.addEventListener("input", filterGallery);
  categoryFilter.addEventListener("change", filterGallery);
  filterGallery();
</script>

<style>
  /* Hero Banner */
  .hero-gallery {
    height: 50vh; /* Half height */
    background: url('assets/images/gallery-hero.jpg') center center/cover no-repeat;
    position: relative;
  }
  .hero-gallery::after {
    content: "";
    position: absolute;
    top:0; left:0;
    width:100%; height:100%;
    /* background: rgba(0,0,0,0.5); */
    background: linear-gradient(to bottom, rgba(125, 165, 240, 0.5), rgba(112, 111, 111, 0.48));
  }
  .hero-gallery h1, 
  .hero-gallery p {
    position: relative;
    z-index: 10;
    color: #ffffffff;
    background-color: rgba(255,255,255,0.2);
    backdrop-filter: blur(4px);
    text-shadow: 0px 3px 8px rgba(0, 0, 0, 0.8);
  }

  .display-4 {
    text-shadow: 0px 3px 8px rgba(249, 249, 249, 0.8);
    color: rgb(208, 137, 224) !important;
    font-family: Arial, Helvetica, sans-serif;
  }
  .lead {
    text-shadow: 0px 3px 8px rgba(0, 0, 0, 0.8);
    color: rgb(100, 10, 10) !important;
  }

  /* Gallery Cards (same as product cards) */
  .gallery-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 0.375rem 0.375rem 0 0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .gallery-img:hover {
    transform: scale(1.05);
    box-shadow: 0px 8px 20px rgba(0,0,0,0.4);
  }
</style>
