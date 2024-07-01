<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Forbidden
    exit("Unauthorized access");
}

// Validate and sanitize input
if (isset($_POST['payment_id'])) {
    $payment_id = intval($_POST['payment_id']); // Cast to integer for security

    // Prepare and execute DELETE statement
    $stmt = $conn->prepare("DELETE FROM payments WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $payment_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        // Deletion successful
        echo "Payment option deleted successfully.";
    } else {
        // Deletion failed
        http_response_code(500); // Internal Server Error
        echo "Error deleting payment option.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle missing or invalid payment_id
    http_response_code(400); // Bad Request
    echo "Invalid request.";
}
?>
