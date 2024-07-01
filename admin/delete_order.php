<?php
session_start();
include("../inc/db.php"); // Include your database connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM orders WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>
