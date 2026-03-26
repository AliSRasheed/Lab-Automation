<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/db.php');

$totalProducts = $conn->query("SELECT COUNT(*) as c FROM products")->fetch_assoc()['c'];
$totalTests    = $conn->query("SELECT COUNT(*) as c FROM tests")->fetch_assoc()['c'];
$totalServices = $conn->query("SELECT COUNT(*) as c FROM services")->fetch_assoc()['c'];
$totalMessages = $conn->query("SELECT COUNT(*) as c FROM contactmessages")->fetch_assoc()['c'];
$totalGallery  = $conn->query("SELECT COUNT(*) as c FROM gallery")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - SRS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
    *, *::before, *::after { box-sizing: border-box; }
    body { background: var(--navy); color: var(--text); font-family: sans-serif; margin: 0; }

    /* ── SIDEBAR ── */

    .logo-icon {
      width: 32px; height: 32px;
      background: var(--orange); border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      font-size: 15px; font-weight: 600; color: #fff;
    }
    .logo-text  { font-size: 15px; font-weight: 600; }
    .logo-sub   { font-size: 11px; color: var(--dim); }

    .nav-section { padding: 14px 12px; flex: 1; }
    .nav-lbl {
      font-size: 10px; font-weight: 600; letter-spacing: .08em;
      text-transform: uppercase; color: var(--dim);
      padding: 0 8px; margin: 0 0 6px;
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

    /* ── TOPBAR ── */
    .topbar {
      position: fixed;
      top: 0; left: var(--sidebar-w); right: 0;
      height: 56px;
      background: var(--panel);
      border-bottom: 0.5px solid var(--border);
      display: flex; align-items: center;
      justify-content: space-between;
      padding: 0 24px; z-index: 100;
    }
    .page-title  { font-size: 16px; font-weight: 600; }
    .page-sub    { font-size: 12px; color: var(--dim); }
    .admin-pill  {
      display: flex; align-items: center; gap: 8px;
      background: var(--panel-lt);
      border: 0.5px solid var(--border);
      border-radius: 20px; padding: 5px 12px 5px 6px;
    }
    .admin-avatar {
      width: 26px; height: 26px; border-radius: 50%;
      background: var(--orange);
      display: flex; align-items: center; justify-content: center;
      font-size: 11px; font-weight: 600; color: #fff;
    }
    .admin-name  { font-size: 12px; }
    .admin-role  {
      font-size: 10px; color: var(--dim);
      border-left: 0.5px solid var(--border);
      padding-left: 8px; margin-left: 4px;
    }

    /* ── CONTENT ── */
    .content {
      margin-left: var(--sidebar-w);
      padding: 78px 24px 24px;
    }
    .section-title {
      font-size: 11px; font-weight: 600; letter-spacing: .06em;
      text-transform: uppercase; color: var(--muted);
      margin-bottom: 14px;
    }

    /* ── STAT CARDS ── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 12px; margin-bottom: 24px;
    }
    .stat-card {
      background: var(--panel);
      border: 0.5px solid var(--border);
      border-radius: 10px;
      padding: 16px 14px 14px;
      position: relative; overflow: hidden;
      transition: border-color .2s, background .2s;
    }
    .stat-card:hover {
      border-color: rgba(249,115,22,.35);
      background: var(--panel-lt);
    }
    .stat-card::before {
      content: '';
      position: absolute; top: 0; left: 0; right: 0; height: 2px;
      background: var(--orange); opacity: 0;
      transition: opacity .2s;
    }
    .stat-card:hover::before { opacity: 1; }
    .stat-icon {
      width: 34px; height: 34px;
      background: var(--orange-dim);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 12px; font-size: 16px;
    }
    .stat-num   { font-size: 28px; font-weight: 600; line-height: 1; margin-bottom: 4px; }
    .stat-label { font-size: 12px; color: var(--dim); }

    /* ── BOTTOM PANELS ── */
    .bottom-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .panel-card {
      background: var(--panel);
      border: 0.5px solid var(--border);
      border-radius: 10px;
      padding: 16px 18px;
    }
    .panel-card-title {
      font-size: 11px; font-weight: 600; letter-spacing: .06em;
      text-transform: uppercase; color: var(--muted);
      margin-bottom: 14px;
    }
    .list-item {
      display: flex; align-items: center; gap: 10px;
      padding: 9px 0;
      border-bottom: 0.5px solid var(--border);
      font-size: 13px; color: var(--muted);
    }
    .list-item:last-child { border-bottom: none; }
    .list-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .list-dot.orange { background: var(--orange); }
    .list-dot.gray   { background: var(--dim); }
    .list-meta { margin-left: auto; font-size: 11px; color: var(--dim); }

    .shortcut-item {
      display: flex; align-items: center; gap: 10px;
      padding: 9px 10px; border-radius: 7px;
      cursor: pointer; transition: background .15s;
      margin-bottom: 2px; text-decoration: none;
    }
    .shortcut-item:hover { background: rgba(255,255,255,.04); }
    .shortcut-icon {
      width: 28px; height: 28px; background: var(--orange-dim);
      border-radius: 6px;
      display: flex; align-items: center; justify-content: center;
      font-size: 13px; flex-shrink: 0;
    }
    .shortcut-label { font-size: 13px; color: var(--muted); flex: 1; }
    .shortcut-arrow { font-size: 12px; color: var(--dim); }
  </style>
</head>
<body>

  <?php include('sidebar.php'); ?>

  <!-- Topbar -->
  <div class="topbar">
    <div>
      <div class="page-title">Dashboard</div>
      <div class="page-sub">System overview</div>
    </div>
    <div class="admin-pill">
      <div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_name'], 0, 1)) ?></div>
      <span class="admin-name"><?= htmlspecialchars($_SESSION['admin_name']) ?></span>
      <span class="admin-role"><?= htmlspecialchars($_SESSION['admin_role']) ?></span>
    </div>
  </div>

  <!-- Content -->
  <div class="content">
    <div class="section-title">Overview</div>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-box text-warning"></i></div>
        <div class="stat-num"><?= $totalProducts ?></div>
        <div class="stat-label">Products</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-check2-square text-warning"></i></div>
        <div class="stat-num"><?= $totalTests ?></div>
        <div class="stat-label">Tests</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-sliders text-warning"></i></div>
        <div class="stat-num"><?= $totalServices ?></div>
        <div class="stat-label">Services</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-images text-warning"></i></div>
        <div class="stat-num"><?= $totalGallery ?></div>
        <div class="stat-label">Gallery Images</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-envelope text-warning"></i></div>
        <div class="stat-num"><?= $totalMessages ?></div>
        <div class="stat-label">Messages</div>
      </div>
    </div>

    <div class="bottom-row">
      <div class="panel-card">
        <div class="panel-card-title">Recent Activity</div>
        <div class="list-item"><span class="list-dot orange"></span> New message received <span class="list-meta">just now</span></div>
        <div class="list-item"><span class="list-dot gray"></span> Product updated <span class="list-meta">1h ago</span></div>
        <div class="list-item"><span class="list-dot gray"></span> Gallery image added <span class="list-meta">3h ago</span></div>
        <div class="list-item"><span class="list-dot gray"></span> Service config changed <span class="list-meta">Yesterday</span></div>
      </div>
      <div class="panel-card">
        <div class="panel-card-title">Quick Actions</div>
        <a href="products.php" class="shortcut-item">
          <div class="shortcut-icon"><i class="bi bi-plus text-warning"></i></div>
          <span class="shortcut-label">Add new product</span>
          <span class="shortcut-arrow">→</span>
        </a>
        <a href="gallery.php" class="shortcut-item">
          <div class="shortcut-icon"><i class="bi bi-image text-warning"></i></div>
          <span class="shortcut-label">Upload gallery image</span>
          <span class="shortcut-arrow">→</span>
        </a>
        <a href="messages.php" class="shortcut-item">
          <div class="shortcut-icon"><i class="bi bi-envelope text-warning"></i></div>
          <span class="shortcut-label">View all messages</span>
          <span class="shortcut-arrow">→</span>
        </a>
        <a href="reports.php" class="shortcut-item">
          <div class="shortcut-icon"><i class="bi bi-bar-chart text-warning"></i></div>
          <span class="shortcut-label">View reports</span>
          <span class="shortcut-arrow">→</span>
        </a>
      </div>
    </div>
  </div>

</body>
</html>