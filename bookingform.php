<?php
include 'connect_db.php'; // your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customer_name'] ?? '';
    $number = $_POST['customer_number'] ?? '';
    $pickup = $_POST['pickup'] ?? '';
    $drop = $_POST['drop'] ?? '';
    $booking_date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $distance = $_POST['distance'] ?? '';
    $cab_name = $_POST['cab_name'] ?? '';
    $price = $_POST['price'] ?? '';
    $ac_type = $_POST['ac_type'] ?? '';

    if (empty($booking_date)) {
        header("Location: booking_success.php?status=error&message=Missing%20Date");
        exit();
    }

    $sql = "INSERT INTO bookings (pickup, drop_location, journey_date, journey_time, distance, cab_name, price, customer_name, customer_number, ac_type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $pickup, $drop, $booking_date, $time, $distance, $cab_name, $price, $name, $number, $ac_type);

    if ($stmt->execute()) {
        header("Location: booking_success.php?status=success");
    } else {
        $error = urlencode($stmt->error);
        header("Location: booking_success.php?status=error&message=$error");
    }

    $stmt->close();
    $conn->close();
    exit();
} else {
    // If accessed directly
    header("Location: booking_success.php?status=error&message=Invalid%20Access");
    exit();
}
?>
