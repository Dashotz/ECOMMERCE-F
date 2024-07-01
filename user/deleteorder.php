<?php
include '../inc/db.php';

// Check if order_id is set and valid
$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($order_id > 0) {
    // Prepare SQL statement to delete order
    $sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters and execute deletion
        $stmt->bind_param('i', $order_id);
        if ($stmt->execute()) {
            // Redirect back to orders.php after successful deletion
            header('Location: orders.php');
            exit;
        } else {
            // Handle execution errors
            echo "Error executing deletion: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Handle prepare statement error
        echo "Prepare statement error: " . $conn->error;
    }
} else {
    // Handle invalid order ID
    echo "Invalid order ID: " . $_GET['id']; // Output the received order ID for debugging
}

$conn->close();
?>
