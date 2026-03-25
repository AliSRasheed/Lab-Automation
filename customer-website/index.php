<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include('includes/header.php'); ?>

  
<section class="hero-video">
  <video autoplay muted loop playsinline class="bg-video">
    <source src="assets/video/index.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <div class="overlay"></div>

  <div class="hero-content">
    <h1> SRS Electrical Appliances</h1>
    <p>Experience the world with our carefully crafted tours, offering unforgettable memories and seamless travel experiences</p>
    <a href="contact.php" class="cta-button pulse-animation">Contact Us</a>
  </div>
</section>


<!-- About Section -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="assets/images/company.jpg" class="img-fluid rounded shadow" alt="Our Company">
      </div>
      <div class="col-md-6">
        <h2>About SRS Electrical Appliances</h2>
        <p>We are a leading manufacturer of high-performance electrical products, serving industries worldwide. With decades of expertise and state-of-the-art testing facilities, we ensure every product meets the highest standards of safety and quality.</p>
        <p>Our mission is to deliver reliable and innovative solutions, from manufacturing to testing and certification, empowering our partners to achieve excellence.</p>
      </div>
    </div>
  </div>
</section>

<!-- Products Preview Section -->
<section class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <h2 class="text-center mb-4">Our Products</h2>
    <div class="row g-4">
      <div class="col-md-3">
        <div class="card h-100 shadow-sm product-card">
          <img src="assets/images/switchgear.jpg" class="card-img-top" alt="Switchgear">
          <div class="card-body text-center">
            <h5 class="card-title">Switchgear</h5>
            <a href="products.php?cat=switchgear" class="btn btn-outline-dark">View More</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 shadow-sm product-card">
          <img src="assets/images/capacitors.jpg" class="card-img-top" alt="Capacitors">
          <div class="card-body text-center">
            <h5 class="card-title">Capacitors</h5>
            <a href="products.php?cat=capacitors" class="btn btn-outline-dark">View More</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 shadow-sm product-card">
          <img src="assets/images/fuses1.jpg" class="card-img-top" alt="Fuses">
          <div class="card-body text-center">
            <h5 class="card-title">Fuses</h5>
            <a href="products.php?cat=fuses" class="btn btn-outline-dark">View More</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card h-100 shadow-sm product-card">
          <img src="assets/images/resistors.jpg" class="card-img-top" alt="Resistors">
          <div class="card-body text-center">
            <h5 class="card-title">Resistors</h5>
            <a href="products.php?cat=resistors" class="btn btn-outline-dark">View More</a>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-4">
      <a href="products.php" class="btn btn-primary">View All Products</a>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container text-center" data-aos="fade-up">
    <h3 class="mb-3">Our Gallery</h3>
    <p class="text-muted">Explore moments from our journey — products, people, and innovation.</p>
    <a href="gallery.php" class="btn btn-warning mt-3">View Full Gallery</a>
  </div>
</section>


<!-- Services Section -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <h2 class="text-center mb-4">Our Services</h2>
    <div class="row text-center g-4">
      <div class="col-md-4">
        <i class="bi bi-gear-fill display-4 text-primary"></i>
        <h5 class="mt-3">Manufacturing</h5>
        <p>Precision-engineered electrical appliances for industrial use.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-shield-check display-4 text-success"></i>
        <h5 class="mt-3">Testing & Certification</h5>
        <p>Rigorous testing processes to ensure quality and compliance.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-people-fill display-4 text-warning"></i>
        <h5 class="mt-3">Partnerships</h5>
        <p>Collaborating with industries and research centers worldwide.</p>
      </div>
    </div>
  </div>
</section>

<!-- CEO Section -->
<section class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <div class="row align-items-center">
      <div class="col-md-4">
        <img src="assets/images/ceo.jpg" class="img-fluid rounded-circle shadow-lg" alt="CEO">
      </div>
      <div class="col-md-8">
        <h2>Message from Our CEO</h2>
        <p>“At SRS Electrical Appliances, our vision is to redefine reliability and safety in the electrical industry. We take pride in our dedicated team and innovative practices that keep us ahead in a rapidly evolving market.”</p>
        <p class="fw-bold">- John Doe, CEO</p>
      </div>
    </div>
  </div>
</section>

<!-- Company Gallery Section -->
<section class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <h2 class="text-center mb-4">Our Company in Pictures</h2>
    <p class="text-center text-muted mb-5">Take a look at our facilities, people, and products in action.</p>
    <div class="row g-4">
      <div class="col-md-4"><img src="assets/images/factory Floor.jpg" class="img-fluid rounded shadow gallery-img" alt="Factory Floor" data-bs-toggle="modal" data-bs-target="#lightboxModal" data-img="assets/images/gallery1.jpg"></div>
      <div class="col-md-4"><img src="assets/images/testing equipement.jpg" class="img-fluid rounded shadow gallery-img" alt="Testing Equipment" data-bs-toggle="modal" data-bs-target="#lightboxModal" data-img="assets/images/gallery2.jpg"></div>
      <div class="col-md-4"><img src="assets/images/team work.jpg" class="img-fluid rounded shadow gallery-img" alt="Team at Work" data-bs-toggle="modal" data-bs-target="#lightboxModal" data-img="assets/images/gallery3.jpg"></div>
      <div class="col-md-4"><img src="assets/images/ceo Speech.jpg" class="img-fluid rounded shadow gallery-img" alt="CEO Speech" data-bs-toggle="modal" data-bs-target="#lightboxModal" data-img="assets/images/gallery4.jpg"></div>
      <div class="col-md-4"><img src="assets/images/product showcase.jpg" class="img-fluid rounded shadow gallery-img" alt="Product Showcase" data-bs-toggle="modal" data-bs-target="#lightboxModal" data-img="assets/images/gallery5.jpg"></div>
      <div class="col-md-4"><img src="assets/images/quality assurance.jpg" class="img-fluid rounded shadow gallery-img" alt="Quality Assurance" data-bs-toggle="modal" data-bs-target="#lightboxModal" data-img="assets/images/gallery6.jpg"></div>
    </div>
  </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body text-center">
        <img src="" id="lightboxImage" class="img-fluid rounded" alt="Expanded Image">
      </div>
    </div>
  </div>
</div>

<!-- Contact Section -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row">
      <div class="col-md-6">
        <form action="contact_process.php" method="POST" class="p-4 shadow-sm bg-white rounded">
          <div class="mb-3"><label class="form-label">Your Name</label><input type="text" class="form-control" name="name" required></div>
          <div class="mb-3"><label class="form-label">Your Email</label><input type="email" class="form-control" name="email" required></div>
          <div class="mb-3"><label class="form-label">Your Message</label><textarea class="form-control" name="message" rows="4" required></textarea></div>
          <button type="submit" class="btn btn-primary w-100">Send Message</button>
        </form>
      </div>
      <div class="col-md-6 mt-4 mt-md-0">
        <div class="ratio ratio-16x9 shadow-sm rounded">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.152375974779!2d67.0347483!3d24.926878499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f90157042d3%3A0x93d609e8bec9a880!2sAptech%20Computer%20Education%20North%20Nazimabad%20Center!5e0!3m2!1sen!2s!4v1757042724287!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once './includes/footer.php'; ?>
<style>
  .row {
    display: flex
;
    flex-wrap: wrap;
    gap: 0px;
}

.hero-video {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    display: flex
;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-top: -11px;
}
</style>