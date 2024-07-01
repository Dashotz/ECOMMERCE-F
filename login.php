<?php
session_start();
include 'inc/db.php'; // Your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_level'] = $user['user_level'];

            if ($user['user_level'] == 1) {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: user/index.php");
            }
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that email.";
    }
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
