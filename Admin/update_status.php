<?php
include '../connect_db.php';  

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookingId = intval($_POST['booking_id']);
    $newStatus = trim($_POST['new_status']);
    $message = '';

    // Prevent changing status if already completed or cancelled
    $checkSql = "SELECT status FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentStatus = $result->fetch_assoc()['status'];

    if (strtolower($currentStatus) === 'completed' || strtolower($currentStatus) === 'cancelled') {
        $message = "This ride is already $currentStatus. Status cannot be changed.";
    } else {
        // Update status
        $updateSql = "UPDATE bookings SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("si", $newStatus, $bookingId);

        if ($stmt->execute()) {
            $message = "Ride status updated to $newStatus successfully!";
        } else {
            $message = "Failed to update status.";
        }
    }
    
    // Output message to the front-end with a popup
    echo "Status: $message";
}
?>
