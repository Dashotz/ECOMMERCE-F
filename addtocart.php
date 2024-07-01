<?php
session_start();
include 'inc/db.php';
$user_id = 1;  // Example user ID, replace with actual user ID if you have user authentication
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Cart</title>
    <link rel="stylesheet" href="css/addtocart.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <section class="header">
            <?php include("inc/nav.php"); ?>     
        </section>
    </header>
    
    <!-- Main Content -->
    <main>
        <div class="cart-container">
            <div class="cart-items">
                <h2>Cart Items</h2>
                <div id="cart-item-list">
                    <?php
                    $stmt = $conn->prepare("
                        SELECT ci.*, p.name, p.price, p.img 
                        FROM cart_items ci
                        JOIN products p ON ci.product_id = p.id
                        WHERE ci.user_id = ?
                    ");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($item = $result->fetch_assoc()) {
                            echo '
                            <div class="cart-item">
                                <input type="checkbox" class="cart-item-checkbox" data-price="' . htmlspecialchars($item['price']) . '" data-quantity="' . htmlspecialchars($item['quantity']) . '" onchange="calculateTotal()">
                                <img src="productimg/' . htmlspecialchars($item['img']) . '" alt="' . htmlspecialchars($item['name']) . '">
                                <div class="cart-item-details">
                                    <h4>' . htmlspecialchars($item['name']) . '</h4>
                                    <p>Size: ' . htmlspecialchars($item['size']) . '</p>
                                    <p>Flavor: ' . htmlspecialchars($item['flavor']) . '</p>
                                    <p>Price: $' . htmlspecialchars($item['price']) . '</p>
                                    <div class="quantity-selector">
                                        <button class="quantity-button" onclick="updateQuantity(' . $item['id'] . ', -1)">-</button>
                                        <input type="text" class="quantity-input" value="' . intval($item['quantity']) . '" readonly>
                                        <button class="quantity-button" onclick="updateQuantity(' . $item['id'] . ', 1)">+</button>
                                    </div>
                                </div>
                                <button class="delete-button" onclick="deleteCartItem(' . $item['id'] . ')">Delete</button>
                            </div>';
                        }
                    } else {
                        echo 'No items in cart.';
                    }

                    $stmt->close();
                    ?>
                </div>
            </div>
            <div class="order-summary">
                <h3>Order Summary</h3>
                <div id="order-summary-details">
                    <p>Subtotal: <span id="subtotal">$0.00</span></p>
                    <p>Shipping Fee: <span id="shipping-fee">$10.00</span></p>
                    <p>Total: <span id="total">$10.00</span></p>
                </div>
                <div class="payment-method">
                    <label for="payment">Payment Method:</label>
                    <select id="payment">
                        <option value="gcash">GCash</option>
                        <option value="paypal">PayPal</option>
                        <option value="mastercard">MasterCard</option>
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>
                <button class="checkout-button" onclick="checkout()">Checkout</button>
            </div>
        </div>
    </main>
  <script src="js/addtocart.js"></script>
</body>
</html>
