<?php
session_start();
include("../inc/db.php"); // Include your database connection file

if (!isset($_SESSION['user_id']) || $_SESSION['user_level'] != 1) {
    header("Location: login.php"); // Redirect to the login page if not logged in or not an admin
    exit();
}

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    // Delete customer record from the database
    $query = "DELETE FROM users WHERE id = ? AND user_level = 0"; // Ensure only customer records are deleted
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();

    header("Location: customers.php");
    exit();
} else {
    header("Location: customers.php");
    exit();
}
?>
