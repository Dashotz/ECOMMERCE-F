<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if address_id is provided and is numeric
if (isset($_POST['address_id']) && is_numeric($_POST['address_id'])) {
    $address_id = $_POST['address_id'];

    // Prepare statement to delete the address
    $stmt = $conn->prepare("DELETE FROM addresses WHERE id = ?");
    $stmt->bind_param("i", $address_id);

    // Execute the deletion
    if ($stmt->execute()) {
        // Redirect back to address.php after successful deletion
        header("Location: address.php");
        exit();
    } else {
        // Handle deletion failure (optional)
        echo "Error deleting address. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>
