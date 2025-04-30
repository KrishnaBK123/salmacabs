<?php
// Get data from GET
$pickup = $_GET['pickup'] ?? '';
$drop = $_GET['drop'] ?? '';
$date = $_GET['date'] ?? '';
$time = $_GET['time'] ?? '';
$distance = $_GET['distance'] ?? '';
$cab_name = $_GET['cab_name'] ?? '';
$total_fare = $_GET['total_fare'] ?? '';
$ac_type = $_GET['ac_type'] ?? ''; // 'AC' or 'Non-AC'
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

  <!-- CSS Files -->
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/contact.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/favicon.png"/>
</head>

<style>
  .bookingForm {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', sans-serif;
    background: #fdfdfd;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }

  h3 {
    text-align: center;
    color: #333;
    font-size: 26px;
    grid-column: span 2;
  }

  .bookingForm label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #555;
  }

  .bookingForm input,
  .bookingForm select {
    width: 100%;
    padding: 12px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #fff;
    transition: border-color 0.3s;
  }

  .bookingForm input:focus,
  .bookingForm select:focus {
    border-color: #FFD700;
    outline: none;
  }

  .bookingForm input[disabled] {
    background-color: #f0f0f0;
    cursor: not-allowed;
  }

  .bookingForm button {
    grid-column: span 2;
    background-color: #FFD700;
    color: #000;
    padding: 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s;
  }

  .bookingForm button:disabled {
    background-color: #e0e0e0;
    cursor: not-allowed;
    color: #777;
  }

  .bookingForm button:hover:not(:disabled) {
    background-color: #FFC700;
  }

  @media screen and (max-width: 768px) {
    .bookingForm {
      grid-template-columns: 1fr;
    }

    .bookingForm button {
      grid-column: span 1;
    }
  }

  
.book-taxi-btn {
  display: inline-block;
  position: relative;
  background: #FFD500;
  color: #000;
  font-weight: bold;
  align-content: center;
  padding: 12px 30px;
  text-decoration: none;
  clip-path: polygon(10% 0%, 100% 0%, 90% 100%, 0% 100%);
  font-size: 15px;
  text-transform: uppercase;
  margin-left: 20px;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.book-taxi-btn i {
  margin-right: 10px;
}

.book-taxi-btn::before {
  
  position: absolute;
  top: 4px;
  left: 4px;
  width: 100%;

  height: 100%;
  align-content: center;
  background: transparent;
  border: 2px solid #000;
  clip-path: polygon(10% 0%, 100% 0%, 90% 100%, 0% 100%);
  z-index: -1;
}

.book-taxi-btn:hover {
  background: #FFC400;
  color: #111;
}

</style>

<body>

<header>
  <div><br></div>
  <div class="header-top">
    <div class="logo">
      <img src="images/logo 1.png" alt="Ridek Logo">
    </div>
    <div class="contact-info1">
      <div class="contact-item">
        <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
        <div class="contact-text">
          <span class="contact-title">Call Us Now</span>
          <span class="contact-detail">+91 8919699221</span>
        </div>
      </div>
      <div class="contact-item">
        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
        <div class="contact-text">
          <span class="contact-title">Email Now</span>
          <span class="contact-detail">www.salmacabs@gmail.com</span>
        </div>
      </div>
      <div class="contact-item">
        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
        <div class="contact-text">
          <span class="contact-title">Location</span>
          <span class="contact-detail">Bengaluru, Karnataka - 59001</span>
        </div>
      </div>
    </div>
  </div>
  <div class="header-bottom">
          <ul class="nav-menu" id="navMenu">
              <li><a href="index.html">Home</a></li>
              <li><a href="aboutus.html">About Us</a></li>
              <li><a href="index.html#services">Services</a></li>
              <li><a href="contactus.html">Contact Us</a></li>
              <li><a href="mybooking.php">My Booking</a></li>
             
       </ul>
          
          <div class="menu-toggle" id="menuToggle">
              <i class="fas fa-bars"></i>
          </div>

          <a href="bookingform.html" class="book-taxi-btn">
              <i class="fas fa-taxi"></i> BOOK A TAXI
            </a>
            
         
      </div>
</header>

<br><br>
<h3>Complete Your Booking</h3>
<br>

<form id="confirmBookingForm" class="bookingForm" method="POST" action="bookingform.php">
  <!-- Hidden Inputs -->
  <input type="hidden" name="pickup" value="<?= htmlspecialchars($pickup); ?>">
  <input type="hidden" name="drop" value="<?= htmlspecialchars($drop); ?>">
  <input type="hidden" name="date" value="<?= htmlspecialchars($date); ?>">
  <input type="hidden" name="time" value="<?= htmlspecialchars($time); ?>">
  <input type="hidden" name="distance" value="<?= htmlspecialchars($distance); ?>">
  <input type="hidden" name="cab_name" value="<?= htmlspecialchars($cab_name); ?>">
  <input type="hidden" name="price" value="<?= htmlspecialchars($total_fare); ?>">
  <input type="hidden" name="ac_type" value="<?= htmlspecialchars($ac_type); ?>">


  <div>
    <label>Name:</label>
    <input type="text" name="customer_name" required>
  </div>

  <div>
    <label>Phone Number:</label>
    <input type="tel" name="customer_number" pattern="[0-9]{10}" required>
  </div>

  <!-- Display Selected Cab -->
  <div>
    <label>Selected Cab:</label>
    <input type="text" value="<?= htmlspecialchars($cab_name); ?>" disabled>
  </div>

  <div>
    <label>Pickup Location:</label>
    <input type="text" value="<?= htmlspecialchars($pickup); ?>" disabled>
  </div>

  <div>
    <label>Drop Location:</label>
    <input type="text" value="<?= htmlspecialchars($drop); ?>" disabled>
  </div>

  <div>
    <label>Date of Journey:</label>
    <input type="text" value="<?= htmlspecialchars($date); ?>" disabled>
  </div>

  <div>
    <label>Time of Journey:</label>
    <input type="text" value="<?= htmlspecialchars($time); ?>" disabled>
  </div>

  <div>
    <label>Distance:</label>
    <input type="text" value="<?= htmlspecialchars($distance); ?>" disabled>
  </div>

  <div>
    <label>Price:</label>
    <input type="text" value="₹ <?= htmlspecialchars($total_fare); ?>" disabled>
  </div>

  <div>
  <label>Cab Type:</label>
  <input type="text" name="ac_type" value="<?php echo htmlspecialchars($ac_type); ?>" disabled>
</div>

  <button type="submit" id="submitBtn" disabled>Confirm Booking</button>
</form>


<!-- Footer Section -->
<footer class="site-footer">
  <div class="footer-top">
    <div class="footer-column about">
      <img src="images/logo2.png" alt="Salma Cabs Logo" class="footer-logo" />
      <p class="footer-description">
        Reliable, affordable, and always on time. Serving Bengaluru with top-notch cab services tailored to your needs.
      </p>
      <a href="adminlogin.html" class="admin-button">Admin</a>
    </div>

    <div class="footer-column links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="aboutus.html">About Us</a></li>
        <li><a href="index.html#services">Services</a></li>
        <li><a href="contactus.html">Contact Us</a></li>
        <li><a href="mybooking.php">My Booking</a></li>
      </ul>
    </div>

    <div class="footer-column contact">
      <h4>Contact Us</h4>
      <p>📞 +91 8919699221</p>
      <p>📧 www.salmacabs@gmail.com</p>
      <p>📍 BTM 2nd Stage, BTM Layout, Bengaluru, Karnataka, India</p>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Salma Cabs. All rights reserved.</p>
  </div>
</footer>


<script>
  // Mobile menu toggle
  document.getElementById('menuToggle').addEventListener('click', function () {
    document.getElementById('navMenu').classList.toggle('active');
  });

  // Responsive handling
  window.addEventListener('resize', function () {
    if (window.innerWidth > 768) {
      document.getElementById('navMenu').classList.remove('active');
    }
  });

  // Enable submit button only if all required inputs are filled
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('confirmBookingForm');
    const submitBtn = document.getElementById('submitBtn');
    const inputs = form.querySelectorAll('input[required], select[required]');

    function validateForm() {
      let allFilled = true;
      inputs.forEach(input => {
        if (!input.value.trim()) {
          allFilled = false;
        }
      });
      submitBtn.disabled = !allFilled;
    }

    inputs.forEach(input => {
      input.addEventListener('input', validateForm);
      input.addEventListener('change', validateForm);
    });

    validateForm(); // Initial check
  });
</script>

</body>
</html>
