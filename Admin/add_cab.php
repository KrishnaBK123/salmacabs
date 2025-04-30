<?php
include 'connect_db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $seats = intval($_POST['seats']);
    $ac_type = $_POST['ac_type'];
    $rate_per_km = floatval($_POST['rate_per_km']);
    $base_fare = floatval($_POST['base_fare']);
    $availability = !empty($_POST['availability']) ? $_POST['availability'] : null;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        die("Image upload failed. Please try again.");
    }

    // Prepare SQL insert statement
    $stmt = $conn->prepare("INSERT INTO cabs (name, image, seats, ac_type, rate_per_km, base_fare, availability, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

    $stmt->bind_param("sbisdds", $name, $null, $seats, $ac_type, $rate_per_km, $base_fare, $availability);

    // Bind image data as blob
    $stmt->send_long_data(1, $imageData);

    if ($stmt->execute()) {
        echo "✅ Cab added successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
