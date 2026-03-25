<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['employee_logged_in'])) {
    header("Location: login.php");
    exit;
    // Example login script (employee login)
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['Password'])) {
        $_SESSION['employee_logged_in'] = true;
        $_SESSION['employee_id'] = $user['EmployeeID'];
        $_SESSION['employee_role'] = $user['Role']; // 🔹 Ye line zaroori hai
        header("Location: ../employee-portal/index.php");
        exit;
    }
}

}
?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width:240px; height:100vh; position:fixed;">
  <h4 class="mb-4">Employee Portal</h4>
  <ul class="nav nav-pills flex-column mb-auto">
    <li><a href="index.php" class="nav-link text-white"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
    <li><a href="products.php" class="nav-link text-white"><i class="bi bi-box"></i> Products</a></li>
    <li><a href="tests.php" class="nav-link text-white"><i class="bi bi-clipboard-check"></i> Testing</a></li>
    <li><a href="search.php" class="nav-link text-white"><i class="bi bi-search"></i> Advanced Search</a></li>
    <li><a href="reports.php" class="nav-link text-white"><i class="bi bi-bar-chart"></i> Reports</a></li>
    <li><a href="settings.php" class="nav-link text-white"><i class="bi bi-gear"></i> Settings</a></li>
    <!-- Toggle Links -->
    <li><a href="../customer-website/index.php" class="nav-link text-white"><i class="bi bi-globe"></i> Customer Website</a></li>
    <?php if (isset($_SESSION['employee_role']) && in_array($_SESSION['employee_role'], ['Supervisor', 'Engineer'])): ?>
      <li><a href="../admin-portal/index.php" class="nav-link text-white"><i class="bi bi-shield-lock"></i> Admin Portal</a></li>
    <?php endif; ?>
    <li><a href="logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
  </ul>
</div>