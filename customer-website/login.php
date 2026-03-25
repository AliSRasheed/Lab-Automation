<?php
session_start();
include('includes/db.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conn->real_escape_string($_POST['Email']);
    $password = $_POST['Password'];

    $sql = "SELECT * FROM customers WHERE Email='$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Password'])) {
            $_SESSION['customer_logged_in'] = true;
            $_SESSION['customer_id'] = $user['CustomerID'];
            $_SESSION['customer_name'] = $user['Name'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with this email.";
    }
}
include('includes/header.php');



?>



<!-- Login Form Section -->
<section class="py-5">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow border-0">
          <div class="card-body p-4">
            <h3 class="mb-4 text-center">Login</h3>

            <?php if($error): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="Email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="Password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-warning w-100">Login</button>
              <div class="text-center mt-3">
                <a href="signup.php">Don’t have an account? Sign up</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>


<style>
  /* ---------- Hero Banner ---------- */
.hero-contact {
  background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
              url('../images/hero-login.jpg') center/cover no-repeat;
  height: 50vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* ---------- Form Card ---------- */
.card {
  border-radius: 15px;
  overflow: hidden;
}

.card-body {
  padding: 2rem;
}

.card h3 {
  font-weight: 700;
  color: #333;
}

/* ---------- Buttons ---------- */
.btn-warning {
  background-color: #ffc107;
  border: none;
  font-weight: 600;
  padding: 10px;
  border-radius: 10px;
  transition: 0.3s ease-in-out;
}

.btn-warning:hover {
  background-color: #e0a800;
  transform: translateY(-2px);
}

/* ---------- Links ---------- */
a {
  text-decoration: none;
  color: #ffc107;
  font-weight: 500;
  transition: 0.2s;
}

a:hover {
  color: #e0a800;
}

/* ---------- Alerts ---------- */
.alert {
  border-radius: 10px;
  font-size: 0.9rem;
}

/* ---------- Form Inputs ---------- */
.form-control {
  border-radius: 10px;
  padding: 10px;
  border: 1px solid #ddd;
  transition: 0.3s;
}

.form-control:focus {
  border-color: #ffc107;
  box-shadow: 0 0 0 0.25rem rgba(255,193,7,.25);
}

</style>