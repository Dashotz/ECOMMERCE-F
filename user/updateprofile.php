<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['contact-number'];

    // Check if password needs to be updated
    $current_password = $_POST['current-password'];
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];

    $password_update = '';
    if (!empty($current_password) && !empty($new_password) && $new_password === $confirm_password) {
        // Verify current password
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($current_password, $hashed_password)) {
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $password_update = ", password = '$new_hashed_password'";
        } else {
            // Handle incorrect current password
            echo "Incorrect current password.";
            exit();
        }
    }

    // Update user profile
    $stmt = $conn->prepare("
        UPDATE users
        SET first_name = ?, last_name = ?, email = ?, address = ?, number = ? $password_update
        WHERE id = ?
    ");
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $address, $number, $user_id);
    $stmt->execute();
    $stmt->close();

    $message = "Profile Updated Successfully!";
    echo "<script type='text/javascript'>
            alert('$message');
            window.location.href = 'editprofile.php';
          </script>";
    exit;
} else {
    header("Location: editprofile.php");
    exit();
}
?>
