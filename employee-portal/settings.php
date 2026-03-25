<?php
session_start();
if (!isset($_SESSION['employee_logged_in'])) { header("Location: login.php"); exit; }
include('includes/db.php');

// Enable error reporting (for debugging, remove later)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$empID = $_SESSION['employee_id'];
$msg = $error = "";

$user=$conn->query("SELECT * FROM users WHERE UserID=$empID")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"]=="POST") {
  $name = $conn->real_escape_string($_POST['UserName']);
  $oldPass = $_POST['OldPassword'];
  $newPass = $_POST['NewPassword'];

  $storedPass = $user['Password'];

  if ($newPass) {
    $validOld = false;

    if (!empty($storedPass)) {
      if (strpos($storedPass, '$2y$') === 0) {
        // hashed
        if (password_verify($oldPass, $storedPass)) $validOld = true;
      } else {
        // plain text
        if ($oldPass === $storedPass) {
          $validOld = true;
          // upgrade old plain password to hash
          $newHash = password_hash($oldPass, PASSWORD_DEFAULT);
          $conn->query("UPDATE Users SET Password='$newHash' WHERE UserID=$empID");
          $storedPass = $newHash;
        }
      }
    }

    if ($validOld) {
      $hashed = password_hash($newPass, PASSWORD_DEFAULT);
      $conn->query("UPDATE users SET UserName='$name', Password='$hashed' WHERE UserID=$empID");
      $msg="Profile and password updated!";
    } else {
      $error="Old password is incorrect!";
    }
  } else {
    $conn->query("UPDATE users SET UserName='$name' WHERE UserID=$empID");
    $msg="Profile updated!";
  }

  $user=$conn->query("SELECT * FROM users WHERE UserID=$empID")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Settings - Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style> body{background:#1e293b;color:white;} .content{margin-left:240px;padding:20px;} </style>
</head>
<body>
<?php include('sidebar.php'); ?>

<div class="content">
  <h2>Settings</h2>
  <?php if($msg): ?><div class="alert alert-success"><?= $msg ?></div><?php endif; ?>
  <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
  
  <form method="POST" class="col-md-6">
    <div class="mb-3"><label>Username</label>
      <input type="text" name="UserName" class="form-control" value="<?= htmlspecialchars($user['UserName']) ?>">
    </div>
    <div class="mb-3"><label>Old Password</label>
      <input type="password" name="OldPassword" class="form-control" placeholder="Enter old password">
    </div>
    <div class="mb-3"><label>New Password</label>
      <input type="password" name="NewPassword" class="form-control" placeholder="Leave blank to keep old password">
    </div>
    <button class="btn btn-warning">Save Changes</button>
  </form>
</div>
</body>
</html>
