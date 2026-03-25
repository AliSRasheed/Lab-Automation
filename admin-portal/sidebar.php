


<style>
    .sidebar {
      background: #1e293b;
      min-height: 100vh;
      padding: 20px;
      position: fixed;
      width: 220px;
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 10px;
      border-radius: 6px;
      text-decoration: none;
      margin-bottom: 8px;
    }
    .sidebar a:hover {
      background: orange;
      color: black;
    }
  </style>
  
  <div class="sidebar">
    <h4 class="text-warning mb-4">SRS Admin</h4>
    <a href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="products.php"><i class="bi bi-box"></i> Products</a>
    <a href="orders.php" class="nav-link"><i class="bi bi-receipt"></i> Orders</a>
    <a href="services.php"><i class="bi bi-sliders"></i> Services</a>
    <a href="gallery.php"><i class="bi bi-images"></i> Gallery</a>
    <a href="messages.php"><i class="bi bi-envelope"></i> Messages</a>
  

    <a class="nav-link" href="tests.php"><i class="bi bi-clipboard-check"></i> Testing</a>
    <a class="nav-link" href="reports.php"><i class="bi bi-bar-chart"></i> Reports</a>

<a href="../customer-website/index.php" class="nav-link"><i class="bi bi-globe"></i> Customer Website</a>
<a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right"></i> Logout</a>

  </div>

</div>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to log out? This will end your current session.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="logout.php" class="btn btn-warning">Log Out</a>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>