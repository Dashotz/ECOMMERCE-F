<?php
session_start();
include 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $number = $conn->real_escape_string($_POST['number']);
    $address = $conn->real_escape_string($_POST['address']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    
    $stmt = $conn->prepare("INSERT INTO users (username, first_name, last_name, email, number, address, password, user_level) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("sssssss", $username, $first_name, $last_name, $email, $number, $address, $password);
    
    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
