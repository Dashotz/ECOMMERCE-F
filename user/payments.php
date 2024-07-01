<?php
session_start(); 
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch payment data
$stmt = $conn->prepare("SELECT * FROM payments WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$payments = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Payment Options</title>
    <link rel="stylesheet" href="css/payments.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/nav1.css">
    <script src="https://kit.fontawesome.com/249726be58.js" crossorigin="anonymous"></script>
    <script>
        // Function to delete payment option via AJAX
        function deletePayment(paymentId) {
            if (confirm("Are you sure you want to delete this payment option?")) {
                // Send AJAX request
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "deletepayment.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Reload the page after successful deletion
                        window.location.reload();
                    }
                };
                xhr.send("payment_id=" + paymentId);
            }
        }
    </script>
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
            <!-- Sidebar -->
            <aside>
                <h2>Manage My Account</h2>
                <ul>
                    <li><a href="profile.php">My Profile</a></li>
                    <li><a href="address.php">Address Book</a></li>
                    <li><a href="payments.php" class="active">My Payment Options</a></li>
                </ul>
                <h2>My Orders</h2>
                <ul>
                    <li><a href="orders.php">My Orders</a></li>
                </ul>
            </aside>

            <!-- Payment Options Section -->
            <section class="payment-options">
                <h2>Payment Options</h2>
                <div class="payment-table">
                    <div class="payment-header">
                        <span>Card Number</span>
                        <span>Expiry Date</span>
                        <span></span>
                    </div>
                    <div class="separator"></div>
                    <?php foreach ($payments as $payment): ?>
                        <div class="payment-entry">
                            <span><?php echo formatCardNumber($payment['card_number']); ?></span>
                            <span><?php echo formatExpiryDate($payment['expiry_date']); ?></span>
                            <button class="delete-btn" onclick="deletePayment(<?php echo $payment['id']; ?>)">Delete</button>
                        </div>
                        <div class="separator"></div>
                    <?php endforeach; ?>
                    <div class="add-card">
                        <button class="add-card-btn" onclick="window.location.href='add_payments.php'">+ Add Card</button>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>

<?php
function formatCardNumber($cardNumber) {
    // Format card number as xxxx-xxxx-xxxx-xxxx
    return preg_replace('/(\d{4})(\d{4})(\d{4})(\d{4})/', '$1-$2-$3-$4', $cardNumber);
}

function formatExpiryDate($expiryDate) {
    // Format expiry date as MM/YY
    return preg_replace('/(\d{2})(\d{2})/', '$1/$2', $expiryDate);
}
?>
