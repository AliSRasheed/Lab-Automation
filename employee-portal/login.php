<?php
session_start();
include('includes/db.php');

// Show errors while debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE UserName='$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $storedPass = $user['Password'];
        $loginOk = false;

        if (!empty($storedPass)) {
            if (strpos($storedPass, '$2y$') === 0) {
                // bcrypt hashed
                if (password_verify($password, $storedPass)) {
                    $loginOk = true;
                }
            } else {
                // plain text fallback
                if ($password === $storedPass) {
                    $loginOk = true;
                    // upgrade to hashed password
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $conn->query("UPDATE Users SET Password='$newHash' WHERE UserID={$user['UserID']}");
                }
            }
        }

        if ($loginOk) {
            $_SESSION['employee_logged_in'] = true;
            $_SESSION['employee_id'] = $user['UserID'];
            $_SESSION['employee_name'] = $user['UserName'];
            $_SESSION['employee_role'] = $user['Role']; // ✅ fixed
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Employee Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white d-flex align-items-center justify-content-center" style="height:100vh;">
<div class="card p-4 shadow-lg" style="min-width:350px;">
  <h3 class="mb-3 text-center">Employee Login</h3>
  <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
  <form method="POST">
    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required></div>
    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
    <button class="btn btn-warning w-100">Login</button>
  </form>
</div>
</body>
</html>
