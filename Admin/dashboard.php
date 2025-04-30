<?php
include '../connect_db.php';

// Get all bookings
$bookings = [];
$sql = "SELECT * FROM bookings ORDER BY booking_time DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

// Count metrics
$totalRides = count($bookings); // Total number of rides
$totalEarnings = 0;   // Variable to store the total earnings (count of completed rides or actual earnings)
$activeDrivers = 0;  // Static placeholder (you can query this if needed)
$pendingRequests = 0; // Count confirmed rides as pending requests

foreach ($bookings as $b) {
    // Count confirmed rides as pending requests
    if (strtolower($b['status']) === 'confirmed') {
        $pendingRequests++;
    }

    // Count completed rides as total earnings (could be money or just completed rides count)
    if (strtolower($b['status']) === 'completed') {
        $totalEarnings++; // Increment for each completed ride. This can be updated to sum actual earnings from the price column
    }
}

// Optional: Get the total earnings as the sum of completed ride prices (if `price` is available in the bookings table)
$totalEarningsAmount = 0;
$earningsSql = "SELECT price FROM bookings WHERE status = 'completed'";
$earningsResult = $conn->query($earningsSql);
if ($earningsResult && $earningsResult->num_rows > 0) {
    while ($row = $earningsResult->fetch_assoc()) {
        $totalEarningsAmount += (float) $row['price']; // Summing up the prices of completed rides
    }
}

// Optional: You can replace $totalEarnings with $totalEarningsAmount for actual earnings calculation
$totalEarnings = $totalEarningsAmount;
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
    
<head>
    <!-- <meta http-equiv="refresh" content="5;url=dashboard.php" /> > -->
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="dashboard.css">

    <meta property="og:type" content="website" />
</head>
<body>
   

<!-- Sidebar -->
<!-- Sidebar -->
<div class="sidebar">
    <div class="logo-container">
    <img src="../images/logo%201.png" alt="Ridek Logo" style="width: 120px; height: auto; border-radius: 8px;" />
</div>
<br>
    <ul>
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="cabs.html"><i class="fas fa-car"></i> Add Cabs</a></li>
        <li><a href="#"><i class="fas fa-user-tie"></i> Drivers</a></li>
        <li><a href="#" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>


<!-- Main Content -->
<div class="main-content">
    <div class="header">
        <h2>Admin Dashboard</h2>
    </div>

    <div class="dashboard-cards">
        <div class="card"><i class="fas fa-car"></i><h3>Total Rides</h3><p><?= $totalRides ?></p></div>
        <div class="card">
    <i class="fas fa-rupee-sign"></i> <!-- Indian Rupee icon -->
    <h3>Total Earnings</h3>
    <p>₹<?= number_format($totalEarnings, 2) ?></p> <!-- Display completed rides count as earnings with the Indian Rupee symbol -->
</div>

        <div class="card"><i class="fas fa-id-card"></i><h3>Active Drivers</h3><p><?= $activeDrivers ?></p></div>
        <div class="card"><i class="fas fa-exclamation-circle"></i><h3>Pending Requests</h3><p><?= $pendingRequests ?></p></div> <!-- Display confirmed rides as pending requests -->
    </div>

    <!-- Ride Statistics -->
    <div class="container py-4">
        <h2 class="mb-4">🚕 Ride Statistics</h2>

        <!-- Filters -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <input type="date" id="filterDate" class="form-control" placeholder="Journey Date">
            </div>
            <div class="col-md-3">
                <input type="text" id="filterPickup" class="form-control" placeholder="Pickup Location">
            </div>
            <div class="col-md-3">
                <input type="text" id="filterDrop" class="form-control" placeholder="Drop Location">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100" onclick="applyFilters()">Filter</button>
            </div>
        </div>

        <!-- Ride Table -->
        <div class="table-responsive">
            <table id="rideStatsTable" class="table table-striped table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Ride ID</th>
                        <th>Cab Name</th>
                        <th>Customer</th>
                        <th>Pickup</th>
                        <th>Drop</th>
                        <th>Journey Date</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['id']) ?></td>
                        <td><?= htmlspecialchars($booking['cab_name']) ?></td>
                        <td><?= htmlspecialchars($booking['customer_name']) ?></td>
                        <td><?= htmlspecialchars($booking['pickup']) ?></td>
                        <td><?= htmlspecialchars($booking['drop_location']) ?></td>
                        <td><?= htmlspecialchars($booking['journey_date']) ?></td>
                        <td>
                            <?php 
                            // Dynamically display the status
                            $status = strtolower($booking['status']);
                            if ($status === 'confirmed') {
                                echo '<span class="badge bg-success">Confirmed</span>';
                            } elseif ($status === 'cancelled') {
                                echo '<span class="badge bg-danger">Cancelled</span>';
                            } elseif ($status === 'completed') {
                                echo '<span class="badge bg-primary">Completed</span>';
                            } elseif ($status === 'enquiry') {
                                echo '<span class="badge bg-warning">Enquiry</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $booking['id'] ?>">Check</button>
                        </td>
                    </tr>


                   <!-- Modal -->


<!-- BOOKING MODALS -->
<?php foreach ($bookings as $booking): ?>
<div class="modal fade" id="bookingModal<?= $booking['id'] ?>" tabindex="-1" aria-labelledby="bookingModalLabel<?= $booking['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="bookingModalLabel<?= $booking['id'] ?>">
                    🚖 Ride Details — <span class="text-info">#<?= $booking['id'] ?></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="row g-3">
                    <!-- Customer Info -->
                    <div class="col-md-6">
                        <h6 class="text-secondary mb-2">Customer Info</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($booking['customer_name']) ?></li>
                            <li class="list-group-item"><strong>Phone:</strong> <?= htmlspecialchars($booking['customer_number']) ?></li>
                            <li class="list-group-item"><strong>Booked At:</strong> <?= htmlspecialchars($booking['booking_time']) ?></li>
                        </ul>
                    </div>

                    <!-- Ride Info -->
                    <div class="col-md-6">
                        <h6 class="text-secondary mb-2">Ride Info</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Pickup:</strong> <?= htmlspecialchars($booking['pickup']) ?></li>
                            <li class="list-group-item"><strong>Drop:</strong> <?= htmlspecialchars($booking['drop_location']) ?></li>
                            <li class="list-group-item"><strong>Distance:</strong> <?= htmlspecialchars($booking['distance']) ?> km</li>
                        </ul>
                    </div>

                    <!-- Schedule -->
                    <div class="col-md-6">
                        <h6 class="text-secondary mb-2">Schedule</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Date:</strong> <?= htmlspecialchars($booking['journey_date']) ?></li>
                            <li class="list-group-item"><strong>Time:</strong> <?= htmlspecialchars($booking['journey_time']) ?></li>
                        </ul>
                    </div>

                    <!-- Cab Details -->
                    <div class="col-md-6">
                        <h6 class="text-secondary mb-2">Cab Details</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Cab Name:</strong> <?= htmlspecialchars($booking['cab_name']) ?></li>
                            <li class="list-group-item"><strong>Price:</strong> ₹<?= htmlspecialchars($booking['price']) ?></li>
                            <li class="list-group-item"><strong>AC Type:</strong> <?= htmlspecialchars($booking['ac_type']) ?></li>
                        </ul>
                    </div>

                    <!-- Ride Status -->
                    <div class="col-md-12">
                        <h6 class="text-secondary mb-2 mt-3">Ride Status</h6>
                        <div id="statusBox<?= $booking['id'] ?>" class="alert alert-<?= strtolower($booking['status']) === 'completed' ? 'success' : 'warning' ?>">
                            Current Status: <strong id="statusText<?= $booking['id'] ?>"><?= ucfirst($booking['status']) ?></strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button class="btn btn-outline-primary" onclick="shareBookingDetails(<?= $booking['id'] ?>)">
    <i class="fas fa-share-alt"></i> Share
</button> -->
<button class="btn btn-outline-primary"
    onclick='handleShareClick(<?= json_encode([
        "id" => $booking["id"],
        "customer_name" => $booking["customer_name"],
        "customer_number" => $booking["customer_number"],
        "pickup" => $booking["pickup"],
        "drop_location" => $booking["drop_location"],
        "journey_date" => $booking["journey_date"],
        "journey_time" => $booking["journey_time"],
        "distance" => $booking["distance"],
        "cab_name" => $booking["cab_name"],
        "price" => $booking["price"],
        "ac_type" => $booking["ac_type"],
        "booking_time" => $booking["booking_time"],
        "status" => $booking["status"]
    ]) ?>)'>
    <i class="fas fa-share-alt"></i> Share
</button>




                <?php if (strtolower($booking['status']) !== 'completed'): ?>
                    <button type="button" class="btn btn-success" onclick="markAsCompleted(<?= $booking['id'] ?>)">
                        <i class="fas fa-check-circle"></i> Mark as Completed
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function markAsCompleted(bookingId) {
    fetch('update_status.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `booking_id=${bookingId}&new_status=Completed`
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') {
            const statusBox = document.getElementById('statusBox' + bookingId);
            const statusText = document.getElementById('statusText' + bookingId);
            statusText.textContent = 'Completed';
            statusBox.classList.remove('alert-warning');
            statusBox.classList.add('alert-success');
            const btn = event.target.closest('button');
            btn.remove();
        } else {
            alert(data);
        }
    })
    .catch(error => alert('Request failed: ' + error));
}
</script>
<?php endforeach; ?>
<!-- Suucess message for shareing -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div id="shareSuccessToast<?= $booking['id'] ?>" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">✅ Booking shared successfully!</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
function handleShareClick(data) {
    if (data.status && data.status.toLowerCase() === "confirmed") {
        shareBookingDetails(data);
    } else {
        alert("❌ Could not share. Ride is Completed.");
    }
}

function shareBookingDetails(data) {
    const message = `🚖 *Salma Cabs - Booking Details* 🚖

📄 *Booking ID:* ${data.id}
👤 *Customer:* ${data.customer_name}
📞 *Phone Number:* ${data.customer_number}
📍 *Pickup:* ${data.pickup}
📍 *Drop:* ${data.drop_location}
🗓️ *Date:* ${data.journey_date}
🕒 *Time:* ${data.journey_time}
📏 *Distance:* ${data.distance} km
🚗 *Cab:* ${data.cab_name}
💰 *Price:* ₹${data.price}
❄️ *AC Type:* ${data.ac_type}
📅 *Booked At:* ${data.booking_time}

Thank you for choosing Salma Cabs! 🚕`;

    if (navigator.share) {
        navigator.share({
            title: 'Salma Cabs',
            text: message
        }).then(() => {
            showSuccessToast(data.id);
        }).catch(err => {
            console.warn("Native share failed. Trying clipboard...", err);
            fallbackToClipboard(message, data.id);
        });
    } else {
        fallbackToClipboard(message, data.id);
    }
}

function fallbackToClipboard(text, id) {
    navigator.clipboard.writeText(text).then(() => {
        showSuccessToast(id);
    }).catch(err => {
        alert("Failed to copy: " + err);
    });
}

function showSuccessToast(id) {
    const toastElement = document.getElementById("shareSuccessToast" + id);
    if (toastElement) {
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    }
}
</script>



                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Filter script -->
<script>
function applyFilters() {
    // Get filter values
    const date = document.getElementById('filterDate').value.toLowerCase();
    const pickup = document.getElementById('filterPickup').value.toLowerCase();
    const drop = document.getElementById('filterDrop').value.toLowerCase();

    const rows = document.querySelectorAll('#rideStatsTable tbody tr');

    rows.forEach(row => {
        // Correct cell indexes:
        const journeyDate = row.cells[5].textContent.toLowerCase(); // 6th column = Journey Date
        const pickupText = row.cells[3].textContent.toLowerCase(); // 4th column = Pickup
        const dropText = row.cells[4].textContent.toLowerCase();   // 5th column = Drop

        // Match each filter (empty fields are ignored)
        const showRow =
            (date === "" || journeyDate.includes(date)) &&
            (pickup === "" || pickupText.includes(pickup)) &&
            (drop === "" || dropText.includes(drop));

        row.style.display = showRow ? "" : "none";
    });

    // Optional: Clear inputs after filtering (comment this out if you prefer to keep them filled)
    document.getElementById('filterDate').value = "";
    document.getElementById('filterPickup').value = "";
    document.getElementById('filterDrop').value = "";
}

</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl5izG4jIpLhu9KF6fGznD0fEUdtvjpK8&libraries=places"></script>

<!-- Autocomplete place  -->
<script>
  function initAutocomplete() {
    const pickupInput = document.getElementById("filterPickup");
    const dropInput = document.getElementById("filterDrop");

    // Create autocomplete objects
    const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, {
      types: ["geocode"],
      componentRestrictions: { country: "in" } // Optional: Restrict to India
    });

    const dropAutocomplete = new google.maps.places.Autocomplete(dropInput, {
      types: ["geocode"],
      componentRestrictions: { country: "in" } // Optional: Restrict to India
    });

    // Optionally, add listeners if you want to access place details
    pickupAutocomplete.addListener("place_changed", () => {
      const place = pickupAutocomplete.getPlace();
      console.log("Pickup selected:", place.formatted_address);
    });

    dropAutocomplete.addListener("place_changed", () => {
      const place = dropAutocomplete.getPlace();
      console.log("Drop selected:", place.formatted_address);
    });
  }

  // Call this after Google Maps script loads
  window.onload = initAutocomplete;
</script>

<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
  import { getAuth, signOut } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-auth.js";

  const firebaseConfig = {
    apiKey: "AIzaSyDfKXl0T4iKi_ar6K1lvEghLmuAjitq3Tk",
    authDomain: "otp-project-4792f.firebaseapp.com",
    projectId: "otp-project-4792f",
    storageBucket: "otp-project-4792f.firebasestorage.app",
    messagingSenderId: "722844563831",
    appId: "1:722844563831:web:79a3d4a494b97474038972",
    measurementId: "G-JD6V4SQCMH"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const auth = getAuth(app);

  // Handle logout
  document.getElementById("logoutLink").addEventListener("click", (e) => {
    e.preventDefault(); // prevent default anchor behavior
    signOut(auth)
      .then(() => {
        // Redirect to login page
        window.location.href = "../index.html"; // update path if needed
      })
      .catch((error) => {
        console.error("Logout failed:", error);
        alert("Logout failed: " + error.message);
      });
  });
</script>



</body>
</html>

<?php $conn->close(); ?>
