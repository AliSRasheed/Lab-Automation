
<?php
// if (session_status() === PHP_SESSION_NONE) session_start();
include('db.php');

session_start();

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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SRS Electrical Appliances</title>
  
  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  
  <link rel="icon" type="image/x-icon" href="assets/images/SRS-logo.png">
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    /* Navbar Styles */
    .navbar {
      transition: all 0.3s ease;
      padding: 10px 0;
    }
    .navbar-brand img {
      width: 55px;
      height: auto;
      transition: transform 0.3s;
    }
    .navbar-brand:hover img {
      transform: rotate(-10deg) scale(1.05);
    }
    .navbar-dark .nav-link {
      color: #ddd;
      font-weight: 500;
      padding: 8px 15px;
      transition: all 0.3s ease;
      border-radius: 6px;
    }
    .navbar-dark .nav-link:hover {
      color: #fff;
      background: #1c85be;
    }

    /* Dropdown Hover Effect */
    .dropdown-menu {
      border-radius: 10px;
      overflow: hidden;
      animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Auth Buttons */
    .btn-auth {
      margin-left: 10px;
      border-radius: 8px;
      padding: 6px 14px;
      font-size: 0.9rem;
      transition: 0.3s;
    }
    .btn-auth:hover {
      transform: translateY(-2px);
    }

    /* Sticky Shadow */
    .navbar.scrolled {
      background: #111 !important;
      box-shadow: 0 3px 10px rgba(0,0,0,0.3);
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="assets/images/SRS-logo.png" alt="SRS Logo" class="me-2">
      <span class="fw-bold text-warning">SRS Electrical</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door me-1"></i> Home</a></li>
        
        <li class="nav-item"><a class="nav-link" href="products.php"><i class="bi bi-bag me-1"></i> Products</a></li>
        <li class="nav-item"><a class="nav-link" href="gallery.php"><i class="bi bi-images me-1"></i> Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="services.php"><i class="bi bi-tools me-1"></i> Services</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php"><i class="bi bi-info-circle me-1"></i> About</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php"><i class="bi bi-envelope me-1"></i> Contact</a></li>

       

        <!-- Auth Buttons -->
        <?php if (!isset($_SESSION['customer_logged_in'])): ?>
          <li class="nav-item"><a href="login.php" class="btn btn-sm btn-outline-light btn-auth">Login</a></li>
          <li class="nav-item"><a href="signup.php" class="btn btn-sm btn-warning btn-auth">Signup</a></li>
        <?php endif; ?>
        

        <?php if (isset($_SESSION['customer_logged_in'])): ?>
          <li class="nav-item"><a href="my_orders.php" class="btn btn-sm btn-info btn-auth">My Orders</a></li>
          <li class="nav-item"><a href="logout.php" class="btn btn-sm btn-danger btn-auth">Logout</a></li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

<!-- Space for fixed navbar -->
<div style="height:70px;"></div>

<script>
  // Change navbar style on scroll
  window.addEventListener("scroll", function(){
    const nav = document.querySelector(".navbar");
    nav.classList.toggle("scrolled", window.scrollY > 50);
  });
</script>