<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];

    // Validate card number and expiry date
    if (preg_match('/^\d{16}$/', $card_number) && preg_match('/^\d{4}$/', $expiry_date)) {
        // Insert new payment data
        $stmt = $conn->prepare("INSERT INTO payments (user_id, card_number, expiry_date) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $card_number, $expiry_date);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        header("Location: payments.php");
        exit();
    } else {
        $error_message = "Invalid card number or expiry date format.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Add Payment</title>
    <link rel="stylesheet" href="css/addpayments.css">
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

            <!-- Add Payment Section -->
            <section class="edit-profile">
                <h2>Add Payment Method</h2>
                <?php if (isset($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <form method="POST" onsubmit="return validateForm()">
                    <div class="profile-form">
                        <div class="form-group">
                            <label>Card Number</label>
                            <input type="number" name="card_number" placeholder="Enter your card number" maxlength="16" oninput="this.value = this.value.slice(0, 16)" required>
                        </div>
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="number" name="expiry_date" placeholder="MMYY" oninput="this.value = this.value.slice(0, 4)" required>
                        </div>
                        <div class="form-actions">
                            <a href="payments.php"><button type="button" class="cancel-btn">Cancel</button></a>
                            <button type="submit" class="save-btn">Save</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <script>
         function formatCardNumber(cardNumber) {
        // Format card number as xxxx-xxxx-xxxx-xxxx
        return cardNumber.replace(/\D/g, '').replace(/(\d{4})(?=\d)/g, '$1-');
    }

    function formatExpiryDate(expiryDate) {
        // Format expiry date as MM/YY
        return expiryDate.replace(/\D/g, '').replace(/(\d{2})(?=\d)/g, '$1/');
    }

    function validateForm() {
        const cardNumberInput = document.querySelector('input[name="card_number"]');
        const expiryDateInput = document.querySelector('input[name="expiry_date"]');

        // Format inputs before submission
        cardNumberInput.value = formatCardNumber(cardNumberInput.value);
        expiryDateInput.value = formatExpiryDate(expiryDateInput.value);

        // Validate formatted inputs
        const cardNumber = cardNumberInput.value.replace(/\D/g, '');
        const expiryDate = expiryDateInput.value.replace(/\D/g, '');

        if (cardNumber.length !== 16 || expiryDate.length !== 4) {
            alert("Card number must be exactly 16 digits and expiry date must be exactly 4 digits in MMYY format.");
            return false;
        }

        return true;
    }
        function validateForm() {
            const cardNumber = document.querySelector('input[name="card_number"]').value;
            const expiryDate = document.querySelector('input[name="expiry_date"]').value;

            // Ensure only digits are entered
            if (!/^\d{16}$/.test(cardNumber)) {
                alert("Card number must be exactly 16 digits.");
                return false;
            }

            if (!/^\d{4}$/.test(expiryDate)) {
                alert("Expiry date must be exactly 4 digits in MMYY format.");
                return false;
            }

            return true;
        }
        
    </script>
</body>
</html>
