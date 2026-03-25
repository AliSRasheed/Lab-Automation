<?php 
include('includes/header.php'); 
include('includes/db.php');

// Fetch active services
$sql = "SELECT * FROM services WHERE Status = 'Active' ORDER BY CreatedAt DESC";
$result = $conn->query($sql);
?>

<!-- Hero Banner -->
<div class="hero-services d-flex align-items-center text-center">
  <div class="container" data-aos="fade-up">
    <h1 class="display-4 fw-bold text-white">Our Services</h1>
    <p class="lead text-white">Delivering quality and reliability through advanced testing and solutions</p>
  </div>
</div>

<!-- Services Section -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <div class="row g-4">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($service = $result->fetch_assoc()): ?>
          <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 service-card" data-aos="zoom-in">
              <?php if (!empty($service['ImagePath'])): ?>
                <img src="<?= htmlspecialchars($service['ImagePath']) ?>" 
                     class="card-img-top service-img" 
                     alt="<?= htmlspecialchars($service['Title']) ?>">
              <?php endif; ?>
              <div class="card-body text-center">
                <?php if (!empty($service['Icon'])): ?>
                  <i class="bi <?= htmlspecialchars($service['Icon']) ?> fs-1 text-warning mb-3"></i>
                <?php endif; ?>
                <h5 class="card-title"><?= htmlspecialchars($service['Title']) ?></h5>
                <p class="card-text small text-muted"><?= htmlspecialchars($service['Description']) ?></p>
              </div>
              <div class="card-footer text-center small text-secondary">
                Added on <?= date("M d, Y", strtotime($service['CreatedAt'])) ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center text-muted">No services have been added yet.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>

<!-- AOS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>

<style>
  /* Hero Banner */
  .hero-services {
    height: 50vh; /* Half height */
    background: url('assets/images/services-hero.jpg') center center/cover no-repeat;
    position: relative;
  }
  .hero-services::after {
    content: "";
    position: absolute;
    top:0; left:0;
    width:100%; height:100%;
    /* background: rgba(0,0,0,0.5); */
        background: linear-gradient(to bottom, rgba(94, 144, 236, 0.5), rgba(242, 242, 242, 0.484));
  }
  .hero-services h1, 
  .hero-services p {
    position: relative;
    z-index: 2;
    color: #fff;
    text-shadow: 0px 3px 8px rgba(0,0,0,0.8);
  }

  /* Service Cards */
  .service-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 0.375rem 0.375rem 0 0;
  }
  .service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 10px 25px rgba(0,0,0,0.2);
  }
</style>
