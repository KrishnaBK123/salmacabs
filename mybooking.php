<?php
session_start(); // Start session to store user info
include 'connect_db.php';

$success = false;
$message = '';

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $mobile = trim($_POST['mobile']);

    if (empty($name) || empty($mobile)) {
        $message = 'Please enter both name and mobile number.';
    } else {
        $stmt = $conn->prepare("SELECT * FROM bookings WHERE customer_name = ? AND customer_number = ?");
        $stmt->bind_param("ss", $name, $mobile);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // ✅ Store user info in session
            $_SESSION['customer_name'] = $name;
            $_SESSION['customer_number'] = $mobile;

            // ✅ Redirect to userhome.php
            header("Location: userhome.php");
            exit();
        } else {
            $message = 'Invalid credentials. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>salma cabs</title>
          
          <meta http-equiv="cache-control" content="no-cache">
          <meta http-equiv="expires" content="0">
          <meta http-equiv="pragma" content="no-cache">
          <link rel="canonical" href="https://www.salmacabs.in/" />
          <meta name="robots" content="index, follow" />
          <title>Best Online Taxi Service in Bangalore Available 24*7 | Online Cab Booking Services</title>
          <meta name="description" content="Salma Cabs provides the best online taxi services in Bangalore for all your transportation needs. With Salma Cabs you will travel safely and hassle-free." />
          <meta name="keywords" content="Airport taxi in Bangalore, cab rental services in bangalore, taxi services, low cost car rental, car hire in bangalore, airport taxi rental, cheap cab for hire, taxi fare in bangalore, airport taxi renta, Airport taxi pickup, Airport taxi dropl" />
          <meta name="keyphrase" content="Taxi for Bangalore airport, airport taxi in Bangalore, cheap taxi for Bangalore airport, best taxi service in Bangalore for airport, best taxi service in Bangalore, best outstation taxi service in Bangalore, affordable outstation taxi service in Bangalore, best taxi service in Bangalore, best cab service in Bangalore" />
          <meta property="og:type" content="business.business">
          <meta property="og:title" content="Most affordable Airport cab services in Bangalore | Salma Cabs">
          <meta property="og:description" content="Book your Airport Taxi Pickup at ₹624/- and Airport Drop at ₹774/-, Best Airport Cab Service in Bangalore,
          Outstation Cabs Bangalore Karnataka, Rs.9/- Per Kms, Get multiple car options with our Taxi Service in Bangalore">
          <!--  -->
      
          <!-- Business Contact Info -->
          <meta property="business:contact_data:street_address" content="BTM 2nd Stage">
          <meta property="business:contact_data:locality" content="BTM Layout, Bengaluru">
          <meta property="business:contact_data:region" content="Karnataka">
          <meta property="business:contact_data:postal_code" content="560076">
          <meta property="business:contact_data:country_name" content="India">
          <meta property="business:contact_data:email" content="salmacabs@gmail.com">
          <meta property="business:contact_data:phone_number" content="+91 8919699221">
          <meta property="business:contact_data:website" content="https://www.salmacabs.in/">
      
       <!-- Performance Optimization -->
        <meta name="theme-color" content="#000000">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
      
          <!-- JavaScript file -->
          <script src="Javascript/index.js"></script> <!-- Link to JavaScript file -->
          
          <!-- Font Awesome for icons -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      
          
          <!-- Favicon -->
          <link rel="icon" type="image/png" href="images/favicon.png">
          <link rel="icon" href="https://www.salmacabs.com/assets/images/mob.png" type="image/png">
          <link rel="apple-touch-icon" href="/apple-touch-icon.png">
          <link rel="manifest" href="/site.webmanifest">
          <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
          <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS -->
  
  <link rel="stylesheet" href="css/mybooking.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .input-field { margin-bottom: 20px; padding: 10px; width: 100%; }
    .login-button { width: 100%; padding: 10px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <div class="logo-container">
        <div class="logo">
          <img src="images/logo 1.png" alt="Ridek Logo">
        </div>
        <div class="logo-tagline">24/7 available</div>
      </div>
    </div>

    <div class="right-panel">
      <div class="login-container">
        <h1 class="login-title">Customer Login</h1>

        <?php if ($message): ?>
          <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST">
          <input type="text" name="name" class="input-field" placeholder="Enter your name" required>
          <input type="text" name="mobile" class="input-field" placeholder="Enter mobile number" required>
          <button type="submit" class="login-button btn btn-primary">Login</button>
        </form>
      </div>

      <div class="footer1">
        <div class="contact-info">
          <div class="website"><i class="fas fa-globe"></i><span>www.salmacabs@gmail.com</span></div>
          <div class="phone"><i class="fas fa-phone"></i><span>+91 8919699221</span></div>
        </div>
        <div class="social-icons">
          <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-icon linkedin"><i class="fab fa-linkedin-in"></i></a>
          <a href="mailto:salmacabs@gmail.com" class="social-icon email"><i class="fas fa-envelope"></i></a>
        </div>
        <div class="copyright">
          © Copyright 2025 Salma Cabs - All Rights Reserved
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    document.getElementById("send-otp-btn").addEventListener("click", async function () {
      const name = document.getElementById("name").value.trim();
      const mobile = document.getElementById("mobile").value.trim();

      if (name === "" || mobile === "") {
        alert("Please enter your name and mobile number.");
        return;
      }

      const formData = new FormData();
      formData.append("name", name);
      formData.append("mobile", mobile);

      try {
        const response = await fetch("mybooking.php", {
          method: "POST",
          body: formData
        });

        const result = await response.json();

        if (result.success) {
          alert("Login successful!");
          window.location.href = "userhome.php";
        } else {
          alert(result.message);
        }
      } catch (err) {
        console.error("Login error:", err);
        alert("Something went wrong.");
      }
    });
  </script>
</body>
</html>
