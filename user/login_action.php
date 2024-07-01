<?php
session_start();
include 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Fetch user from database
    $stmt = $conn->prepare("SELECT id, username, password, user_level FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $user_level);
        $stmt->fetch();
        
        // Verify password using password_verify
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['user_level'] = $user_level;
            
            if ($user_level == 1) {
                // Redirect to admin dashboard
                header("Location: admin/dashboard.php");
                exit; // Ensure no further output is sent
            } else {
                // Redirect to home page
                header("Location: index.php");
                exit; // Ensure no further output is sent
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email address.";
    }
    
    
    $stmt->close();
    $conn->close();
}
?>
