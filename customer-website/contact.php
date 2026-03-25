<?php 
include('includes/header.php'); 
include('includes/db.php');

$success = $error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $sql = "INSERT INTO messages (Name, Email, Subject, Message) 
                VALUES ('$name', '$email', '$subject', '$message')";
        if ($conn->query($sql)) {
            $success = "✅ Your message has been sent successfully!";
        } else {
            $error = "❌ Error: " . $conn->error;
        }
    } else {
        $error = "⚠️ All fields are required.";
    }
}
?>

<!-- Hero Banner -->
<div class="hero-contact d-flex align-items-center text-white text-center">
  <div class="container" data-aos="fade-up">
    <h1 class="display-4 fw-bold">Contact Us</h1>
    <p class="lead">We’re here to help and answer your questions.</p>
  </div>
</div>

<!-- Contact Section -->
<section class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
      
      <!-- Contact Form -->
      <div class="col-lg-6">
        <div class="card shadow-lg border-0 h-100">
          <div class="card-body p-4">
            <h3 class="mb-4 text-center text-warning">Send Us a Message</h3>

            <?php if ($success): ?>
              <div class="alert alert-success"><?= $success ?></div>
            <?php elseif ($error): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="" class="needs-validation">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5" placeholder="Write your message..." required></textarea>
              </div>
              <button type="submit" class="btn btn-warning w-100">Send Message</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Map -->
      <div class="col-lg-6">
        <div class="card shadow-lg border-0 h-100">
          <div class="card-body p-0">
            <h3 class="mb-3 text-center text-warning pt-3">Our Location</h3>
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.152375974779!2d67.0347483!3d24.926878499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f90157042d3%3A0x93d609e8bec9a880!2sAptech%20Computer%20Education%20North%20Nazimabad%20Center!5e0!3m2!1sen!2s!4v1757042724287!5m2!1sen!2s" 
              width="100%" height="450" style="border:0; border-radius:0 0 10px 10px;" 
              allowfullscreen="" loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>

<style>
  /* Hero Banner */
  .hero-contact {
    height: 50vh;
    background: url('assets/images/contact-hero.jpg') center center/cover no-repeat;
    position: relative;
  }
  .hero-contact::after {
    content: "";
    position: absolute;
    inset: 0;
    /* background: rgba(0,0,0,0.55); */
        background: linear-gradient(to bottom, rgba(94, 144, 236, 0.5), rgba(242, 242, 242, 0.484));
  }
  .hero-contact .container {
    position: relative;
    z-index: 2;
  }
</style>
