<?php
include 'connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $bookingId = $_POST['booking_id'];
    $stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE id = ?");
    $stmt->bind_param("i", $bookingId);
    if ($stmt->execute()) {
        echo "Booking cancelled successfully.";
    } else {
        echo "Failed to cancel booking.";
    }
}
?>
