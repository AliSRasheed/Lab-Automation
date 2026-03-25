<?php
session_start();
include('includes/db.php');

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['Name']);
    $email = $conn->real_escape_string($_POST['Email']);
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $address = $conn->real_escape_string($_POST['Address']);

    // Check duplicate email
    $check = $conn->query("SELECT * FROM customers WHERE Email='$email'");
    if ($check->num_rows > 0) {
        $error = "⚠️ Email already registered.";
    } else {
        $sql = "INSERT INTO customers (Name, Email, Password, Address)
                VALUES ('$name','$email','$password','$address')";
        if ($conn->query($sql)) {
            $success = "✅ Account created successfully! You can login now.";
        } else {
            $error = "❌ DB Error: " . $conn->error;
        }
    }
}
?>

<?php include('includes/header.php'); ?>

<!-- Hero Banner
<div class="hero-signup d-flex align-items-center text-white text-center">
  <div class="container" data-aos="fade-up">
    <h1 class="display-4 fw-bold">Create Your Account</h1>
    <p class="lead">Join us today and enjoy our services</p>
  </div>
</div> -->

<!-- Signup Form Section -->
<section class="py-5 bg-light">
  <div class="container" data-aos="fade-up" style="max-width: 650px;">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-body p-4">
        <h3 class="mb-4 text-center text-warning fw-bold">Sign Up</h3>

        <?php if($success): ?>
          <div class="alert alert-success"><?= $success ?></div>
        <?php elseif($error): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" class="needs-validation">
          <div class="mb-3">
            <label class="form-label fw-semibold">Full Name</label>
            <input type="text" name="Name" class="form-control" placeholder="Enter your full name" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Email Address</label>
            <input type="email" name="Email" class="form-control" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="Password" class="form-control" placeholder="Enter a strong password" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Address</label>
            <textarea name="Address" class="form-control" placeholder="Enter your address" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-warning w-100 py-2 fw-bold">Create Account</button>
        </form>

        <p class="mt-3 text-center">
          Already have an account? 
          <a href="login.php" class="text-decoration-none text-warning fw-bold">Login here</a>
        </p>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>

<style>
  /* Hero Banner */
  .hero-signup {
    height: 50vh;
    background: linear-gradient(to bottom, rgba(125, 165, 240, 0.5), rgba(107, 106, 106, 0.48));
                url('assets/images/hero-signup.jpg') center/cover no-repeat;
    position: relative;
  }
  .hero-signup .container {
    position: relative;
    z-index: 2;
  }

  /* Form Styles */
  .form-control {
    border-radius: 10px;
    padding: 12px;
    border: 1px solid #ddd;
    transition: 0.3s;
  }
  .form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
  }
  .btn-warning {
    border-radius: 10px;
    font-size: 1rem;
  }
</style>
