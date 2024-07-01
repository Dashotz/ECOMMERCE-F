<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT first_name, last_name, email, address, number FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Pawfect Shoppe</title>
    <link rel="stylesheet" href="css/editprofile.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/nav1.css">
    <script src="https://kit.fontawesome.com/249726be58.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header Section -->
    <header>
        <section class="header">
            <?php include("../inc/nav.php"); ?>   
            <?php include("../inc/nav1.php"); ?>   
        </section>
    </header>
    
    <!-- Main Content -->
    <main>
        <div class="account-container">
            <aside>
                <h2>Manage My Account</h2>
                <ul>
                    <li><a href="profile.php">My Profile</a></li>
                    <li><a href="address.php" class="active">Address Book</a></li>
                    <li><a href="payments.php">My Payment Options</a></li>
                </ul>
                <h2>My Orders</h2>
                <ul>
                    <li><a href="orders.php">My Orders</a></li>
                </ul>
            </aside>
            <section class="account-details">
                <h2>Edit Your Profile</h2>
                <form id="edit-profile-form" method="POST" action="updateprofile.php">
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact-number" value="<?php echo htmlspecialchars($user['number']); ?>" required>
                    </div>
                    <div class="form-group">
                        <h3>Password Changes</h3>
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current-password" required>
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="cancel-button">Cancel</button>
                        <button type="submit" id="save-button">Save Changes</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>