<?php
session_start();
include 'connect_db.php'; // Include your DB connection file

// Check if user is logged in
if (!isset($_SESSION['customer_number'])) {
    header("Location: mybooking.php");
    exit(); 
}

$userPhone = $_SESSION['customer_number'];
$userName = $_SESSION['customer_name'];

// Fetch bookings
function getBookings($conn, $userPhone, $status, $userName) {
    $query = "SELECT * FROM bookings 
              WHERE LOWER(customer_number) = ? 
              AND LOWER(customer_name) = ? 
              AND status = ?";
    $stmt = $conn->prepare($query);

    $lowerPhone = strtolower($userPhone);
    $lowerName = strtolower($userName);

    $stmt->bind_param("sss", $lowerPhone, $lowerName, $status);
    $stmt->execute();
    return $stmt->get_result();
}

$upcomingBookings = getBookings($conn, $userPhone, 'Confirmed', $userName);
$cancelledBookings = getBookings($conn, $userPhone, 'Cancelled', $userName);
$completedBookings = getBookings($conn, $userPhone, 'Completed', $userName);
$enquiryBookings = getBookings($conn, $userPhone, 'Enquiry', $userName);

// Render each booking
function renderBookings($result) {
  if ($result->num_rows === 0) return "<p>No bookings found.</p>";
  
  // Start HTML for the booking container
  $html = "<div class='booking-container'>";

  // Loop through the results
  while ($row = $result->fetch_assoc()) {
      $status = strtolower($row['status']);
      $statusColor = match ($status) {
          'confirmed' => '#28a745',
          'cancelled' => '#dc3545',
          'completed' => '#007bff',
          'enquiry' => '#fd7e14',
          default => 'gray',
      };

      // Booking Card Structure
      $html .= "<div class='booking-card'>
          <div class='booking-header' style='background-color: $statusColor; color: white;'>
              <span class='status'>{$row['status']}</span>
          </div>
          <div class='booking-details'>
              <div class='detail'>
                  <strong>📍 Pickup:</strong> {$row['pickup']}
              </div>
              <div class='detail'>
                  <strong> 📍 Drop Location:</strong> {$row['drop_location']}
              </div>
              <div class='detail'>
                  <strong>🗓️ Journey Date & Time:</strong> 🕒{$row['journey_date']} {$row['journey_time']}
              </div>
              <div class='detail'>
                  <strong>🚗 Cab:</strong> {$row['cab_name']}
              </div>
              <div class='detail'>
                  <strong>💰 Price:</strong> ₹{$row['price']}
              </div>
              <div class='detail'>
                  <strong> ❄️ AC-Type:</strong> {$row['ac_type']}
              </div>
          </div>
          <div class='booking-actions'>
              <!-- Action button for confirmed bookings -->
              ".($status === 'confirmed' ? "<button onclick='cancelBooking(\"{$row['id']}\")' class='cancel-btn'>Cancel Ride</button>" : "")."
          </div>
      </div>";
  }

  $html .= "</div>";  // End booking container
  return $html;
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .header {
      background-color: #222;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
    }

    .brand {
      display: flex;
      align-items: center;
    }

    .logo {
      height: 50px;
      margin-right: 10px;
    }

    .availability {
      font-size: 0.9rem;
      color: #ccc;
    }

    .profile-info {
      display: flex;
      align-items: center;
    }

    .profile-icon {
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .user-details {
      display: flex;
      color : black;
      
      flex-direction: column;
      font-size: 0.9rem;
    }

    .nav-tabs {
      background-color: #eee;
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 1rem;
    }

    .nav-tabs-left {
      display: flex;
      gap: 10px;
    }

    .tab {
      background: none;
      border: none;
      padding: 0.5rem 1rem;
      cursor: pointer;
      font-size: 1rem;
    }

    .tab.active {
      background-color: #222;
      color: white;
      border-radius: 4px;
    }

    .nav-tabs-right .nav-icon-btn {
      margin-left: 1rem;
      
      font-size: 1.2rem;
      text-decoration: none;
    }

    .main-content {
      padding: 1rem;
    }

    /* Booking Container Styles */
    .booking-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .booking-card {
      width: calc(33.33% - 20px);
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 15px;
      display: flex;
      flex-direction: column;
    }

    .booking-header {
      padding: 10px;
      border-radius: 6px 6px 0 0;
      text-align: center;
    }

    .booking-details {
      flex-grow: 1;
      margin-top: 10px;
    }

    .detail {
      margin-bottom: 10px;
      font-size: 0.9rem;
      color:black;
    }

    .booking-actions {
      margin-top: 10px;
      text-align: center;
    }

    .cancel-btn {
      background-color: #dc3545;
      color: white;
      padding: 7px 12px;
      font-style: bold;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .booking-card {
        width: calc(50% - 20px);  /* 2 cards per row on medium screens */
      }
    }

    @media (max-width: 480px) {
      .booking-card {
        width: 100%;  /* 1 card per row on small screens */
      }
    }
  </style>
</head>
<body>

  <header class="header">
    <div class="brand">
      <img src="images/logo2.png" alt="Salma Cabs Logo" class="logo">
    </div>
    
    <div class="profile-info">
      <img src="images/profile.jpg" alt="Profile" class="profile-icon" />
      <div class="user-details">
        <span class="user-name"><?php echo htmlspecialchars($userName); ?></span>
        <span class="user-phone"><?php echo htmlspecialchars($userPhone); ?></span>
      </div>
    </div>
  </header>

  <nav class="nav-tabs">
    <div class="nav-tabs-left">
      <button class="tab active" data-tab="upcoming">Upcoming</button>
      <button class="tab" data-tab="cancelled">Cancelled</button>
      <button class="tab" data-tab="completed">Completed</button>
      
    </div>
    <div class="nav-tabs-right">
      <a href="tel:+917204840186" class="nav-icon-btn" title="Call">
        <i class="fas fa-phone"></i>
      </a>
      <a href="index.html" class="nav-icon-btn" title="Logout">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </div>
  </nav>

  <main class="main-content" id="mainContent">
    <div id="upcoming">
      <?php echo renderBookings($upcomingBookings); ?>
    </div>
    <div id="cancelled" style="display:none;">
      <?php echo renderBookings($cancelledBookings); ?>
    </div>
    <div id="completed" style="display:none;">
      <?php echo renderBookings($completedBookings); ?>
    </div>
    <div id="enquiry" style="display:none;">
      <?php echo renderBookings($enquiryBookings); ?>
    </div>
  </main>

  <script>
    const tabs = document.querySelectorAll(".tab");
    const contentSections = {
      upcoming: document.getElementById("upcoming"),
      cancelled: document.getElementById("cancelled"),
      completed: document.getElementById("completed"),
      enquiry: document.getElementById("enquiry")
    };

    tabs.forEach(tab => {
      tab.addEventListener("click", () => {
        tabs.forEach(t => t.classList.remove("active"));
        tab.classList.add("active");

        const selected = tab.getAttribute("data-tab");
        for (const key in contentSections) {
          contentSections[key].style.display = key === selected ? "block" : "none";
        }
      });
    });
  </script>
  <script>
  function cancelBooking(bookingId) {
    if (confirm("Are you sure you want to cancel this booking?")) {
      fetch('cancel_booking.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'booking_id=' + bookingId
      })
      .then(res => res.text())
      .then(response => {
        alert(response);
        location.reload();  // Refresh the page to show updated status
      })
      .catch(error => {
        alert("Error cancelling booking.");
      });
    }
  }
</script>

</body>
</html>




</body>
</html>


<style>
  :root {
  --primary-color: #ffd200;
  --secondary-color: #111;
  --text-color: #fff;
  --text-secondary: #777;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', sans-serif;
}

body {
  background: var(--secondary-color);
  color: var(--text-color);
}

.header {
  background: var(--secondary-color);
  color: var(--text-color);
  padding: 1.2rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #222;
}

.logo {
width: 100px;
height: 100px;
object-fit: contain;
margin-right: 0.5rem;
}


.brand h1 {
  font-size: 32px;
  font-weight: 800;
}

.availability {
  color: var(--primary-color);
  font-size: 14px;
}

.profile-info {
  display: flex;
  align-items: center;
  gap: 1rem;
  align-self: flex-end;
}

.profile-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
}

.user-details {
  display: flex;

  flex-direction: column;
}

.user-name {
  font-weight: 600;
  color:white;
}

.user-phone {
  color: white;
  font-size: 14px;
}

.nav-tabs {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: var(--secondary-color);
  padding: 0.5rem 2rem;
  border-bottom: 1px solid var(--text-secondary);
}

.nav-tabs-left {
  display: flex;
  gap: 1.5rem;
}

.tab {
  background: none;
  border: none;
  color: var(--text-color);
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
  position: relative;
}

.tab.active,
.tab:hover {
  color: var(--primary-color);
}

.tab.active::after {
  content: "";
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 100%;
  height: 3px;
  background: var(--primary-color);
}

.nav-tabs-right {
  display: flex;
  gap: 1rem;
}

.nav-icon-btn {
  background: none;
  border: none;
  color: var(--text-color);
  font-size: 20px;
  cursor: pointer;
  padding: 0.5rem;
  transition: color 0.3s;
}

.nav-icon-btn:hover {
  color: var(--primary-color);
}

.main-content {
  padding: 2rem;
  text-align: center;
}

.no-bookings {
  color: var(--text-secondary);
  font-size: 20px;
}

@media (max-width: 768px) {
  .header {
   
    align-items:center;
    gap: 1rem;
  }

  .nav-tabs {
    flex-direction: column;
    
    gap: 0.5rem;
  }

  .nav-tabs-left {
    
    gap: 1rem;
  }

  .nav-tabs-right {
    align-self: flex-end;
    margin-top: 0.5rem;
  }
}
</style>
