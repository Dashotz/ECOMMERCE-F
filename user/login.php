<?php
session_start();
include 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT id, username, password, user_level FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $user_level);
        $stmt->fetch();
        
        // Debug: Check hashed password
        error_log("Hashed password from database: " . $hashed_password);
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['user_level'] = $user_level;
            
            if ($user_level == 1) {
                header("Location: admin/dashboard.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            echo "Incorrect password.";
            error_log("Password verification failed for email: " . $email);
        }
    } else {
        echo "No user found with that email.";
        error_log("No user found with email: " . $email);
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
<header>
    <section class="header">
        <?php include("inc/nav.php"); ?>     
    </section>
</header>
<main>
    <div class="login-container">
        <h2>Log In</h2>
        <form method="POST" action="">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span class="toggle-password">👁️</span>
            </div>
            
            <div class="forgot-password">
                <a href="forgotpass.php">Forgot password?</a>
            </div>
            
            <button type="submit">Log In</button>
        </form>
        <p>Still don't have an account? <a href="register.php">Register here</a></p>
    </div>
</main>
<footer>
    <div class="footer-content">
        <p>Questions? We're here 24 hours a day:</p>
        <p>Shop.co © 2000-2023, All Rights Reserved</p>
        <div class="footer-links">
            <a href="#">Terms & Conditions</a>
            <a href="#">Privacy Policy</a>
        </div>
    </div>
</footer>
</body>
</html>
