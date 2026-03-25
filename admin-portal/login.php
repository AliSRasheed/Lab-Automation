<?php
session_start();
include('includes/db.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = md5($_POST['password']); // later upgrade to password_hash()

    $sql = "SELECT * FROM admins WHERE Username='$username' AND PasswordHash='$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $admin['FullName'];
        $_SESSION['admin_role'] = $admin['Role'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid Username or Password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - SRS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #0f172a;
      color: white;
    }
    .login-box {
      max-width: 400px;
      margin: 100px auto;
      background: #1e293b;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0px 4px 20px rgba(0,0,0,0.4);
    }
    .form-control {
      background: #0f172a;
      border: none;
      color: white;
    }
    .form-control:focus {
      background: #0f172a;
      color: white;
      box-shadow: none;
      border: 1px solid orange;
    }
    .btn-custom {
      background: orange;
      border: none;
      color: black;
      font-weight: bold;
    }
    .btn-custom:hover {
      background: darkorange;
    }
  </style>
</head>
<body>
  <div class="login-box text-center">
    <h3 class="mb-3">Admin Login</h3>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-custom w-100">Login</button>
    </form>
  </div>
</body>
</html>
