<?php
// if (session_status() === PHP_SESSION_NONE) session_start();
include('db.php');
$user_role = null;

if (isset($_SESSION['customer_logged_in'])) {
    $user_id = $_SESSION['customer_id'];
    $sql = "SELECT Role FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user_role = $result->fetch_assoc()['Role'];
    }
    $stmt->close();

    $sql = "SELECT Role FROM admins WHERE AdminID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user_role = $result->fetch_assoc()['Role'];
    }
    $stmt->close();
}


?>

<footer class="bg-dark text-white pt-5 pb-3">
  <div class="container">
    <div class="row">
      <!-- About -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-bold mb-3">SRS Electrical Appliances</h5>
        <p class="small">
          Leading manufacturer and tester of electrical equipment, delivering quality and safety worldwide.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-2 mb-4">
        <h6 class="fw-bold mb-3">Quick Links</h6>
        <ul class="list-unstyled footer-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="about.php">About Us</a></li>
        </ul>
      </div>

      <!-- Services -->
      <div class="col-md-2 mb-4">
        <h6 class="fw-bold mb-3">Services</h6>
        <ul class="list-unstyled footer-links">
          <li><a href="#">Manufacturing</a></li>
          <li><a href="#">Testing</a></li>
          <li><a href="#">Certification</a></li>

        <?php if (!isset($_SESSION['customer_logged_in'])): ?>
          <li class="nav-item"><a href="../admin-portal/index.php" class="nav-link"><i class="bi bi-shield-lock"></i> Admin Panel</a></li>
        <?php endif; ?>

        <!-- Employee Panels -->
        <?php if (!isset($_SESSION['customer_logged_in'])): ?>
          <li class="nav-item"><a href="../employee-portal/index.php" class="nav-link"><i class="bi bi-people"></i> Employee Portal</a></li>
        <?php endif; ?>
 
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="col-md-4 mb-4">
        <h6 class="fw-bold mb-3">Newsletter</h6>
        <form class="newsletter-form">
          <div class="input-group">
            <input type="email" class="form-control" placeholder="Enter your email">
            <button class="btn btn-warning" type="submit">Subscribe</button>
          </div>
        </form>
        <div class="mt-3 social-icons">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-twitter"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <!-- Bottom -->
    <div class="text-center mt-4 border-top border-secondary pt-3">
      <small>
        &copy; <?php echo date("Y"); ?> SRS Electrical Appliances. All rights reserved. | Trademark of SRS Group
      </small>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });
</script>
<script src="assets/js/script.js"></script>
</body>
</html>
<style>
  a {
    color: rgb(255 193 7);
    text-decoration: none;
    list-style: none;
}
</style>