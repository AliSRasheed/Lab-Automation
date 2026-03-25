<?php
include('includes/header.php');
include('includes/db.php');

// Fetch Gallery Images
$sql = "SELECT * FROM gallery ORDER BY UploadedAt DESC";
$result = $conn->query($sql);
?>

<!-- Hero Banner -->
<div class="hero-about d-flex align-items-center text-white text-center">
  <div class="container" data-aos="fade-up">
    <h1 class="display-4 fw-bold">About Us</h1>
    <p class="lead">Innovation, Quality & Reliability in Electrical Appliances</p>
  </div>
</div>

<!-- Company Intro -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <div class="row align-items-center g-5">
      <div class="col-md-6">
        <img src="assets/images/company.jpg" class="img-fluid rounded shadow" alt="Our Company">
      </div>
      <div class="col-md-6">
        <h2 class="fw-bold text-warning mb-3">Who We Are</h2>
        <p>
          <strong>SRS Electrical Appliances</strong> is a leading provider of high-quality electrical products, 
          specializing in switchgear, fuses, resistors, capacitors, and more. With cutting-edge 
          testing labs and decades of expertise, we ensure every product meets international 
          safety and performance standards.
        </p>
        <p>
          Our mission is to innovate in electrical engineering, provide reliable solutions to 
          industries worldwide, and deliver products that engineers and businesses can trust.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- CEO Section -->
<section class="py-5 bg-light">
  <div class="container text-center" data-aos="fade-up">
    <h3 class="mb-4 fw-bold text-warning">Message from Our CEO</h3>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg border-0">
          <img src="assets/images/ceo.jpg" class="card-img-top" alt="CEO">
          <div class="card-body">
            <h5 class="card-title fw-bold">Mr. Ahmed Raza</h5>
            <p class="text-muted">Founder & CEO</p>
            <p class="card-text">
              "At <strong>SRS</strong>, we believe in building a safer, more efficient world through 
              innovation in electrical appliances. Our people and our technology 
              make us stand out in delivering reliability to our partners."
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Company Timeline -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <h3 class="text-center mb-5 fw-bold text-warning">Our Journey</h3>
    <div class="timeline">
      <div class="timeline-item" data-aos="fade-right">
        <h5 class="fw-bold text-dark">2010</h5>
        <p>Founded as a small workshop producing switchgear components.</p>
      </div>
      <div class="timeline-item" data-aos="fade-left">
        <h5 class="fw-bold text-dark">2015</h5>
        <p>Expanded operations with advanced testing labs for industrial equipment.</p>
      </div>
      <div class="timeline-item" data-aos="fade-right">
        <h5 class="fw-bold text-dark">2020</h5>
        <p>Launched a global distribution network, reaching partners in 10+ countries.</p>
      </div>
      <div class="timeline-item" data-aos="fade-left">
        <h5 class="fw-bold text-dark">2025</h5>
        <p>Introduced AI-powered testing automation and digital platforms for clients.</p>
      </div>
    </div>
  </div>
</section>

<!-- Dynamic Gallery -->
<section class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <h3 class="text-center mb-4 fw-bold text-warning">Company Gallery</h3>
    <div class="row g-3">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($img = $result->fetch_assoc()): ?>
          <?php if (!empty($img['FilePath'])): ?>
            <div class="col-md-4">
              <a href="../admin-portal/uploads/<?= htmlspecialchars($img['FilePath']) ?>" 
                 data-lightbox="company-gallery" 
                 data-title="<?= htmlspecialchars($img['Title'] ?: 'gallery Image') ?>">
                <img src="../admin-portal/uploads/<?= htmlspecialchars($img['FilePath']) ?>" 
                     class="img-fluid rounded shadow-sm gallery-img" 
                     alt="<?= htmlspecialchars($img['Title'] ?: 'gallery') ?>">
              </a>
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

<!-- Extra CSS for Timeline -->
<style>
.hero-about {
  height: 50vh;
  background: url('assets/images/about-hero.jpg') center center/cover no-repeat;
  position: relative;
}
.hero-about::after {
  content: "";
  position: absolute;
  inset: 0;
   background: linear-gradient(to bottom, rgba(125, 165, 240, 0.5), rgba(138, 136, 136, 0.48));
.hero-about .container {
  position: relative;
  z-index: 2;
}

/* Timeline */
.timeline {
  position: relative;
  padding: 1rem 0;
  border-left: 3px solid #ffc107;
}
.timeline-item {
  position: relative;
  padding-left: 20px;
  margin-bottom: 30px;
}
.timeline-item::before {
  content: "";
  position: absolute;
  left: -9px;
  top: 5px;
  width: 15px;
  height: 15px;
  background: #ffc107;
  border-radius: 50%;
}
.gallery-img {
  height: 250px;
  object-fit: cover;
}

.gallery-img {
  width: 100%;
  height: 250px;         /* fix height for all images */
  object-fit: cover;     /* crop/fit image nicely */
  border-radius: 8px;
  transition: transform 0.3s ease;
}

.gallery-img:hover {
  transform: scale(1.05);
}

</style>
