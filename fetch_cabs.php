<?php
include 'connect_db.php';

// Get form data
$pickup = $_POST['pickup'];
$drop = $_POST['drop'];
$date = $_POST['date'];
$time = $_POST['time'];
$distance = $_POST['distance'];
$duration = $_POST['duration'];

$formatted_date = date('d M Y', strtotime($date));
$formatted_time = date('h:i A', strtotime($time));

// Booking Summary
echo "<div class='booking-summary'>
        <h2>Booking Summary</h2>
        <div class='summary-details'>
            <div class='detail-item'><i class='fas fa-map-marker-alt'></i><span>From: $pickup</span></div>
            <div class='detail-item'><i class='fas fa-map-marker'></i><span>To: $drop</span></div>
            <div class='detail-item'><i class='fas fa-calendar'></i><span>Date: $formatted_date</span></div>
            <div class='detail-item'><i class='fas fa-clock'></i><span>Time: $formatted_time</span></div>
            <div class='detail-item'><i class='fas fa-route'></i><span>Distance: $distance</span></div>
            <div class='detail-item'><i class='fas fa-hourglass-half'></i><span>Duration: $duration</span></div>
        </div>
    </div>";

// Fetch all cabs
$query = "SELECT name, image, seats, ac_type, rate_per_km FROM cabs";
$result = mysqli_query($conn, $query);

$ac_cars = [];
$non_ac_cars = [];

while ($cab = mysqli_fetch_assoc($result)) {
    if (strtolower($cab['ac_type']) === 'ac') {
        $ac_cars[] = $cab;
    } else {
        $non_ac_cars[] = $cab;
    }
}

// Function to render car table
function renderCarTable($cars, $typeLabel, $pickup, $drop, $date, $time, $distance, $duration) {
    if (count($cars) === 0) {
        echo "<h2 class='availability-heading'>$typeLabel</h2>";
        echo "<p class='no-cabs'>No $typeLabel available.</p>";
        return;
    }

    echo "<h2 class='availability-heading'>$typeLabel</h2>";
    echo "<div class='cabs-container'>
            <table class='cabs-table'>
                <thead>
                    <tr>
                        <th>Vehicle</th>
                        <th>Car Type</th>
                        <th>Total Fare</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($cars as $cab) {
        $distance_num = floatval(str_replace(['km', ','], '', $distance));
        $total_fare = $distance_num * $cab['rate_per_km'];

        $base64Image = base64_encode($cab['image']);
        $imageType = "jpeg";

        echo "<tr>";
        echo "<td class='car-details'>
                <img src='data:image/$imageType;base64,$base64Image' alt='Car Image'>
                <div class='car-info'>
                    <h4>" . htmlspecialchars($cab['name']) . "</h4>
                    <p><i class='fas fa-chair'></i> " . htmlspecialchars($cab['seats']) . " Seater</p>
                </div>
              </td>";
        echo "<td>" . htmlspecialchars($cab['ac_type']) . "</td>";
        echo "<td>
                <div class='fare-details'>
                    <span class='total-fare'>₹" . number_format($total_fare, 2) . "</span>
                    <span class='rate-per-km'>₹" . htmlspecialchars($cab['rate_per_km']) . "/km</span>
                </div>
              </td>";
        echo "<td>
                <button class='book-now-btn' onclick=\"window.location.href='confirm_booking.php?cab_name=" . urlencode($cab['name']) .
                "&pickup=" . urlencode($pickup) .
                "&drop=" . urlencode($drop) .
                "&date=" . urlencode($date) .
                "&time=" . urlencode($time) .
                "&distance=" . urlencode($distance) .
                "&duration=" . urlencode($duration) .
                "&total_fare=" . urlencode($total_fare) .
                "&ac_type=" . urlencode($cab['ac_type']) . "'\">Book Now</button>
              </td>";
        echo "</tr>";
    }

    echo "</tbody></table></div>";
}

// Render AC and Non-AC sections
renderCarTable($non_ac_cars, "Non-AC Cars", $pickup, $drop, $date, $time, $distance, $duration);
renderCarTable($ac_cars, "AC Cars", $pickup, $drop, $date, $time, $distance, $duration);

mysqli_close($conn);
?>








<style>
    :root {
        --primary-color: #ffd200;
        --secondary-color: #111;
        --text-color: #fff;
        --text-secondary: #777;
        --accent-color: #ffd200;
    }
    
    /* Booking Summary Styles */
    .booking-summary {
        background: var(--text-color);
        padding: 30px;
        border-radius: 15px;
        margin: 20px auto;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        max-width: 1200px;
    }
    
    .booking-summary h2 {
        color: var(--secondary-color);
        text-align: center;
        margin-bottom: 25px;
        font-size: 24px;
        font-weight: 600;
    }
    
    .summary-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 0 15px;
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 10px;
        background: #f8f8f8;
        border-radius: 10px;
    }
    
    .detail-item i {
        color: var(--primary-color);
        font-size: 20px;
        width: 24px;
        text-align: center;
    }
    
    .detail-item span {
        color: var(--secondary-color);
        font-size: 15px;
        font-weight: 500;
    }
    
    /* Available Cabs Table Styles */
    .availability-heading {
        text-align: center;
        color: var(--secondary-color);
        margin: 30px 0;
        font-size: 28px;
        font-weight: 600;
    }
    
    .cabs-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .cabs-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
        margin-bottom: 30px;
    }
    
    .cabs-table thead tr {
        background: var(--secondary-color);
    }
    
    .cabs-table th {
        color: var(--text-color);
        padding: 15px;
        text-align: left;
        font-weight: 500;
    }
    
    .cabs-table tbody tr {
        background:  #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }
    
    .cabs-table tbody tr:hover {
        transform: translateY(-2px);
    }
    
    .cabs-table td {
        padding: 35px;
        vertical-align: middle;
    }
    
    .car-details {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .car-details img {
        width: 200px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .car-info h4 {
        color: black;
        margin: 0 0 5px 0;
        font-size: 20px;
    }
    
    .car-info p {
        color: #111; 
        margin: 0;
        font-size: 16px;
    }
    
    .fare-details {
        display: flex;
        flex-direction: column;
    }
    
    .total-fare {
        color: var(--secondary-color);
        font-size: 18px;
        font-weight: 600;
    }
    
    .rate-per-km {
        color: var(--text-secondary);
        font-size: 13px;
        margin-top: 4px;
    }
    
    .book-now-btn {
        background: var(--primary-color);
        color: var(--secondary-color);
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .book-now-btn:hover {
        background: var(--secondary-color);
        color: var(--primary-color);
    }
    
    .no-cabs {
        text-align: center;
        color: var(--text-secondary);
        font-size: 18px;
        margin: 30px 0;
    }

   /* Add these media queries after your existing CSS */

/* Large Screens (1200px and above) */
@media screen and (min-width: 1200px) {
    .cabs-table td {
        padding: 25px;
    }
    
    .car-details img {
        width: 200px;
        height: 100px;
    }
}

/* Medium Screens (992px to 1199px) */
@media screen and (max-width: 1199px) {
    .cabs-table td {
        padding: 20px;
    }
    
    .car-details img {
        width: 150px;
        height: 80px;
    }
}

/* Tablet Screens (768px to 991px) */
@media screen and (max-width: 991px) {
    .booking-summary {
        padding: 20px;
    }
    
    .summary-details {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .cabs-table td {
        padding: 15px;
    }
    
    .car-details img {
        width: 120px;
        height: 70px;
    }
    
    .book-now-btn {
        padding: 8px 16px;
        font-size: 14px;
    }
}

/* Mobile Screens (below 768px) */
@media screen and (max-width: 767px) {
    .booking-summary {
        padding: 15px;
        margin: 10px;
    }
    
    .summary-details {
        grid-template-columns: 1fr;
    }
    
    /* Table to Cards conversion for mobile */
    .cabs-table thead {
        display: none;
    }
    
    .cabs-table tbody tr {
        display: block;
        margin-bottom: 20px;
        border-radius: 10px;
        padding: 15px;
    }
    
    .cabs-table td {
        display: block;
        padding: 10px 0;
        text-align: left;
        border: none;
    }
    
    .cabs-table td::before {
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
        color: var(--text-secondary);
    }
    
    .car-details {
        flex-direction: column;
    }
    
    .car-details img {
        width: 100%;
        height: 150px;
        margin-bottom: 10px;
    }
    
    .car-info {
        text-align: center;
    }
    
    .fare-details {
        text-align: right;
    }
    
    .book-now-btn {
        width: 100%;
        padding: 12px;
        font-size: 16px;
    }
}

/* Small Mobile Screens (below 480px) */
@media screen and (max-width: 480px) {
    .booking-summary h2 {
        font-size: 20px;
    }
    
    .detail-item {
        flex-direction: column;
        text-align: center;
        padding: 15px;
    }
    
    .detail-item i {
        margin-bottom: 5px;
    }
    
    .car-info h4 {
        font-size: 14px;
    }
    
    .car-info p {
        font-size: 12px;
    }
    
    .total-fare {
        font-size: 16px;
    }
    
    .rate-per-km {
        font-size: 11px;
    }
}



/* Print Styles */
@media print {
    .booking-summary {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .book-now-btn {
        display: none;
    }
    
    .cabs-table {
        border-collapse: collapse;
    }
    
    .cabs-table td,
    .cabs-table th {
        border: 1px solid #ddd;
    }
}

    /* popup form  */
    .popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.popup-content {
    background: var(--secondary-color);
    padding: 20px;
    border-radius: 12px;
    width: 90%;
    max-width: 400px;
    color: var(--text-color);
    position: relative;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 24px;
    color: var(--text-color);
    cursor: pointer;
}


    
    </style>
    
   