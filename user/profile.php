<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user profile data
$stmt = $conn->prepare("SELECT first_name, last_name, email, address, number FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch recent orders data
$orders_stmt = $conn->prepare("SELECT id, placed_on, name, total FROM orders WHERE user_id = ?");
$orders_stmt->bind_param("i", $user_id);
$orders_stmt->execute();
$orders_result = $orders_stmt->get_result();
$orders = [];
while ($order = $orders_result->fetch_assoc()) {
    $orders[] = $order;
}
$orders_stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Account</title>
    <link rel="stylesheet" href="css/profile.css">
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
                    <li><a href="profile.php" class="active">My Profile</a></li>
                    <li><a href="address.php">Address Book</a></li>
                    <li><a href="payments.php">My Payment Options</a></li>
                </ul>
                <h2>My Orders</h2>
                <ul>
                    <li><a href="orders.php">My Orders</a></li>                    
                </ul>
            </aside>
            <section class="account-details">
                <h2>Welcome! <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h2>
                <div class="account-info">
                    <div class="info-block">
                        <h3>Profile Information</h3>
                        <p>Name: <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></p>
                        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                        <p>Address: <?php echo htmlspecialchars($user['address']); ?></p>
                        <p>Phone: <?php echo htmlspecialchars($user['number']); ?></p>
                        <button onclick = "window.location.href='editprofile.php';">Edit</button>
                    </div>
                </div>
                <h3>Recent Orders</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Placed On</th>
                            <th>Items</th>
                            <th>Total</th>
                       
                        </tr>
                    </thead>
                    <tbody id="order-list">
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['id']); ?></td>
                                <td><?php echo htmlspecialchars($order['placed_on']); ?></td>
                                <td><?php echo htmlspecialchars($order['name']); ?></td>
                                <td>₱ <?php echo htmlspecialchars($order['total']); ?></td>
                               
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>

    <script src="js/profile.js"></script>
</body>
</html>
