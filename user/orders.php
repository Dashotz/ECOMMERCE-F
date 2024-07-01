<?php
include 'inc/db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Function to update order status
function cancelOrder($order_id, $reason) {
    global $conn;

    // Update order status to 'Cancelled' in the database
    $stmt = $conn->prepare("UPDATE orders SET status = 'Cancelled', cancel_reason = ? WHERE id = ?");
    $stmt->bind_param("si", $reason, $order_id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Check if cancel form is submitted
if (isset($_POST['cancel_submit'])) {
    $order_id = $_POST['order_id'];
    $cancel_reason = isset($_POST['cancel_reason']) ? $_POST['cancel_reason'] : '';

    // Check if the "Other" reason is selected and not empty
    if ($cancel_reason === 'Other' && !empty($_POST['other_reason'])) {
        $cancel_reason = $_POST['other_reason'];
    }

    // Call cancelOrder function
    if (cancelOrder($order_id, $cancel_reason)) {
        // Redirect or show success message
        $message = "Cancelled Order Successfully.";
        echo "<script type='text/javascript'>
                alert('$message');
                window.location.href = 'orders.php';
              </script>";
        exit;
    } else {
        // Handle error        
        $message = "Failed to cancel order.";
        echo "<script type='text/javascript'>
                alert('$message');
                window.location.href = 'orders.php';
              </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Pawfect Shoppe</title>
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/nav1.css">
    <link rel="stylesheet" href="css/cancel-card.css"> <!-- New CSS file for cancel card styling -->
    <link rel="stylesheet" href="css/qr-card.css"> <!-- New CSS file for QR card styling -->
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
                    <li><a href="address.php">Address Book</a></li>
                    <li><a href="payments.php">My Payment Options</a></li>
                </ul>
                <h2>My Orders</h2>
                <ul>
                    <li><a href="orders.php" class="active">My Orders</a></li>                   
                </ul>
            </aside>
            <section class="account-details">
                <h2>My Orders</h2>
                <nav class="order-nav">
                    <ul>
                        <li><a href="#" onclick="filterOrders('All')">All</a></li>
                        <li><a href="#" onclick="filterOrders('To Pay')">To Pay</a></li>
                        <li><a href="#" onclick="filterOrders('Completed')">Completed</a></li>
                        <li><a href="#" onclick="filterOrders('Cancelled')">Cancelled</a></li>
                        <li><a href="#" onclick="filterOrders('Refund')">Refund</a></li>
                    </ul>
                </nav>
                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="Search orders..." onkeyup="searchOrders()">
                </div>
                <div class="orders-table" id="orders-table">
                <?php
$stmt = $conn->prepare("
    SELECT o.*, p.img, p.price
    FROM orders o
    JOIN products p ON o.name = p.name 
    WHERE o.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        // Calculate total price including shipping fee
        $product_price = $order['price']; // Price from products table
        $delivery_fee = 10; // Example delivery fee
        $order_total = $product_price * $order['quantity'] + $delivery_fee;

        echo '
        <div class="order-item" data-status="' . htmlspecialchars($order['status']) . '" data-name="' . htmlspecialchars($order['name']) . '">
            <div class="order-header">
                <div class="order-status">' . htmlspecialchars($order['status']) . '</div>
            </div>
            <div class="order-details">
                <div class="order-image">
                    <img src="productimg/' . htmlspecialchars($order['img']) . '" alt="' . htmlspecialchars($order['name']) . '">
                </div>
                <div class="order-info">
                    <h3>' . htmlspecialchars($order['name']) . '</h3>
                    <p>Size: ' . htmlspecialchars($order['size']) . '</p>
                    <p>Flavor: ' . htmlspecialchars($order['flavor']) . '</p>
                    <p>Quantity: ' . htmlspecialchars($order['quantity']) . '</p>
                </div>
                <div class="order-pricing-actions">
                    <div class="order-pricing">
                        <p>Price: $' . number_format($product_price, 2) . '</p>
                        <p>Delivery Fee: $' . number_format($delivery_fee, 2) . '</p>
                        <p>Order Total: $' . number_format($order_total, 2) . '</p>
                    </div>
                    <div class="order-actions">';
        
        if ($order['status'] == 'Success') {
            echo '
                        <button onclick="showRefundForm(' . $order['id'] . ')">Refund Order</button>';
        } elseif ($order['status'] == 'Pending') {
            echo '
                        <button onclick="showCancelForm(' . $order['id'] . ')">Cancel Order</button>
                        <button onclick="showQrCard(' . htmlspecialchars($order_total) . ')">Pay Using QR</button>';
        } elseif ($order['status'] == 'Cancelled') {
            echo '
                        <button class="action-button delete" onclick="if(confirm(\'Are you sure you want to delete this order?\')) { window.location.href=\'deleteorder.php?id=' . htmlspecialchars($order['id']) . '\'; }">Delete</button>
                        <button onclick="window.location.href=\'productview.php?id=' . htmlspecialchars($order['id']) . '\'">Buy Again</button>';
        }
        
        echo '
                    </div>
                </div>
            </div>
        </div>';
    }
} else {
    echo 'No orders found.';
}

$stmt->close();
?>

                </div>
            </section>
        </div>
    </main>

    <div class="cancel-card" id="cancel-card">
        <div class="cancel-content">
            <form method="post" action="">
                <h2 id="cancel-header">Cancel Order</h2>
                <input type="hidden" name="order_id" id="order_id" value="">
                <div class="cancel-reason">
                    <p id="cancel-reason-label">Cancel Reason:</p>
                    <input type="radio" id="reason1" name="cancel_reason" value="Not needed anymore">
                    <label for="reason1">Not needed anymore</label><br>
                    <input type="radio" id="reason2" name="cancel_reason" value="Changed mind">
                    <label for="reason2">Changed mind</label><br>
                    <input type="radio" id="reason3" name="cancel_reason" value="Found a better deal">
                    <label for="reason3">Found a better deal</label><br>
                    <input type="radio" id="reason4" name="cancel_reason" value="Product issue">
                    <label for="reason4">Product issue</label><br>
                    <input type="radio" id="reason5" name="cancel_reason" value="Other">
                    <label for="reason5">Other</label><br>
                </div>
                <div class="other-reason">
                    <label for="other_reason">Other Reason:</label>
                    <input type="text" id="other_reason" name="other_reason">
                </div>
                <div class="action-buttons">
                    <button type="button" onclick="hideCancelForm()">Close</button>
                    <button type="submit" name="cancel_submit" id="cancel-submit-btn">Cancel Order</button>
                </div>
            </form>
        </div>
    </div>

    <div class="qr-card" id="qr-card">
        <div class="qr-content">
            <img src="" alt="QR Code" id="qr-image">
            <button type="button" onclick="hideQrCard()">Close</button>
        </div>
    </div>

    <script>
        function showCancelForm(order_id) {
            document.getElementById("order_id").value = order_id;
            document.getElementById("cancel-card").style.display = "block";
        }

        function hideCancelForm() {
            document.getElementById("cancel-card").style.display = "none";
        }

        function filterOrders(status) {
            const orders = document.querySelectorAll('.order-item');
            orders.forEach(order => {
                const orderStatus = order.getAttribute('data-status');
                if (status === 'All' || orderStatus === status || (status === 'To Pay' && orderStatus === 'Pending') || (status === 'Completed' && orderStatus === 'Success') || (status === 'Cancelled' && orderStatus === 'Cancelled') || (status === 'Refund' && orderStatus === 'Cancelled')) {
                    order.style.display = 'block';
                } else {
                    order.style.display = 'none';
                }
            });
        }

        function searchOrders() {
            const input = document.getElementById('search-input');
            const filter = input.value.toLowerCase();
            const orders = document.querySelectorAll('.order-item');

            orders.forEach(order => {
                const name = order.getAttribute('data-name').toLowerCase();
                if (name.includes(filter)) {
                    order.style.display = 'block';
                } else {
                    order.style.display = 'none';
                }
            });
        }

        function showQrCard(total) {
            const qrImage = document.getElementById("qr-image");
            qrImage.src = 'qrcode/' + total + '.jpg';
            document.getElementById("qr-card").style.display = "block";
        }

        function hideQrCard() {
            document.getElementById("qr-card").style.display = "none";
        }

        function showRefundForm(order_id) {
            document.getElementById("order_id").value = order_id;
            document.getElementById("cancel-header").innerText = "Refund Order";
            document.getElementById("cancel-reason-label").innerText = "Refund Reason:";
            document.getElementById("cancel-submit-btn").innerText = "Refund Order";
            document.getElementById("cancel-card").style.display = "block";
        }
    </script>
</body>
</html>
