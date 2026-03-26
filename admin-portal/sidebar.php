
<style>
  :root {
    --navy:       #0f172a;
    --panel:      #1e293b;
    --panel-lt:   #263348;
    --orange:     #f97316;
    --orange-dim: rgba(249,115,22,.12);
    --border:     rgba(255,255,255,.07);
    --text:       #f1f5f9;
    --muted:      #94a3b8;
    --dim:        #64748b;
    --sidebar-w:  230px;
  }

  .sidebar a.active {
    background: rgba(249,115,22,.12);
    color: #f97316;
    border: 0.5px solid rgba(249,115,22,.25);
  }
  .sidebar {
    background: var(--panel);
    min-height: 100vh;
    position: fixed;
    width: var(--sidebar-w);
    top: 0; left: 0;
    display: flex;
    flex-direction: column;
    border-right: 0.5px solid var(--border);
    z-index: 200;
  }
  .sidebar-logo {
    padding: 20px;
    border-bottom: 0.5px solid var(--border);
    display: flex; align-items: center; gap: 10px;
  }
  .logo-icon {
    width: 32px; height: 32px;
    background: var(--orange); border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 600; color: #fff;
  }
  .logo-text { font-size: 15px; font-weight: 600; color: var(--text); }
  .logo-sub  { font-size: 11px; color: var(--dim); }

  .nav-section { padding: 14px 12px; flex: 1; }
  .nav-lbl {
    font-size: 10px; font-weight: 600; letter-spacing: .08em;
    text-transform: uppercase; color: var(--dim);
    padding: 0 8px; margin: 0 0 6px; display: block;
  }
  .sidebar a, .sidebar button.nav-item {
    display: flex; align-items: center; gap: 10px;
    padding: 8px 10px; border-radius: 7px;
    color: var(--muted); font-size: 13px;
    text-decoration: none; margin-bottom: 2px;
    background: transparent; border: none; width: 100%; text-align: left;
    cursor: pointer; transition: background .15s, color .15s;
  }
  .sidebar a:hover, .sidebar button.nav-item:hover {
    background: rgba(255,255,255,.05); color: var(--text);
  }
  .sidebar a.active {
    background: var(--orange-dim); color: var(--orange);
    border: 0.5px solid rgba(249,115,22,.25);
  }
  .nav-divider { height: 0.5px; background: var(--border); margin: 10px 8px; }
  .nav-badge {
    margin-left: auto;
    background: var(--orange); color: #fff;
    font-size: 10px; padding: 1px 6px; border-radius: 10px;
  }
  .sidebar-footer {
    padding: 12px;
    border-top: 0.5px solid var(--border);
  }
  .sidebar-footer a {
    color: var(--dim) !important;
  }
  .sidebar-footer a:hover {
    background: rgba(239,68,68,.1) !important;
    color: #f87171 !important;
  }
</style>

<div class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">S</div>
    <div>
      <div class="logo-text">SRS</div>
      <div class="logo-sub">Admin Panel</div>
    </div>
  </div>

  <div class="nav-section">
    <div class="nav-lbl">Main</div>
    <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="products.php" class="<?= basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : '' ?>">
      <i class="bi bi-box"></i> Products
    </a>
    <a href="orders.php" class="<?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>">
      <i class="bi bi-receipt"></i> Orders
    </a>
    <a href="services.php" class="<?= basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : '' ?>">
      <i class="bi bi-sliders"></i> Services
    </a>

    <div class="nav-divider"></div>
    <div class="nav-lbl">Content</div>
    <a href="gallery.php" class="<?= basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : '' ?>">
      <i class="bi bi-images"></i> Gallery
    </a>
    <a href="messages.php" class="<?= basename($_SERVER['PHP_SELF']) == 'messages.php' ? 'active' : '' ?>">
      <i class="bi bi-envelope"></i> Messages
    </a>
    <a href="tests.php" class="<?= basename($_SERVER['PHP_SELF']) == 'tests.php' ? 'active' : '' ?>">
      <i class="bi bi-clipboard-check"></i> Testing
    </a>
    <a href="reports.php" class="<?= basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : '' ?>">
      <i class="bi bi-bar-chart"></i> Reports
    </a>

    <div class="nav-divider"></div>
    <a href="../customer-website/index.php">
      <i class="bi bi-globe"></i> Customer Website
    </a>
  </div>

  <div class="sidebar-footer">
    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
      <i class="bi bi-box-arrow-right"></i> Log Out
    </a>
  </div>
</div>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white" style="border: 0.5px solid rgba(255,255,255,.1)">
      <div class="modal-header" style="border-color: rgba(255,255,255,.1)">
        <h5 class="modal-title">Confirm Logout</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" style="color: #94a3b8">
        Are you sure you want to log out? This will end your current session.
      </div>
      <div class="modal-footer" style="border-color: rgba(255,255,255,.1)">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="logout.php" class="btn btn-warning">Log Out</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<div class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">S</div>
    <div>
      <div class="logo-text">SRS</div>
      <div class="logo-sub">Admin Panel</div>
    </div>
  </div>

  <div class="nav-section">
    <div class="nav-lbl">Main</div>
    <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="products.php"><i class="bi bi-box"></i> Products</a>
    <a href="orders.php"><i class="bi bi-receipt"></i> Orders</a>
    <a href="services.php"><i class="bi bi-sliders"></i> Services</a>

    <div class="nav-divider"></div>
    <div class="nav-lbl">Content</div>
    <a href="gallery.php"><i class="bi bi-images"></i> Gallery</a>
    <a href="messages.php">
      <i class="bi bi-envelope"></i> Messages
      <?php
        // Optionally show unread badge
        // if ($totalMessages > 0) echo "<span class='nav-badge'>$totalMessages</span>";
      ?>
    </a>
    <a href="tests.php"><i class="bi bi-clipboard-check"></i> Testing</a>
    <a href="reports.php"><i class="bi bi-bar-chart"></i> Reports</a>

    <div class="nav-divider"></div>
    <a href="../customer-website/index.php"><i class="bi bi-globe"></i> Customer Website</a>
  </div>

  <div class="sidebar-footer">
    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
      <i class="bi bi-box-arrow-right"></i> Log Out
    </a>
  </div>
</div>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white" style="border: 0.5px solid rgba(255,255,255,.1)">
      <div class="modal-header" style="border-color: rgba(255,255,255,.1)">
        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" style="color: #94a3b8">
        Are you sure you want to log out? This will end your current session.
      </div>
      <div class="modal-footer" style="border-color: rgba(255,255,255,.1)">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="logout.php" class="btn btn-warning">Log Out</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>