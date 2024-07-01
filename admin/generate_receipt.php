<?php
require_once("../inc/db.php");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details from the database including customer's full name from addresses table
    $stmt = $conn->prepare("
        SELECT o.*, p.name AS product_name, p.price, a.full_name AS customer_name
        FROM orders o
        JOIN products p ON o.id = p.id
        JOIN addresses a ON o.user_id = a.user_id
        WHERE o.id = ?
    ");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        // Prepare HTML content for the receipt
        $html = '
        <html>
        <head>
            <style>
                /* CSS styles for the receipt */
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }
                .receipt-container {
                    max-width: 600px;
                    margin: 0 auto;
                    border: 1px solid #ccc;
                    padding: 20px;
                }
                .receipt-header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .order-details {
                    margin-bottom: 20px;
                }
                .product-item {
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <body>
            <div class="receipt-container">
                <div class="receipt-header">
                    <h2>Order Receipt</h2>
                    <p>Order ID: ' . $order['id'] . '</p>
                </div>
                <div class="order-details">
                    <p><strong>Customer Name:</strong> ' . htmlspecialchars($order['customer_name']) . '</p>
                    <p><strong>Date:</strong> ' . $order['placed_on'] . '</p>
                    <p><strong>Status:</strong> ' . htmlspecialchars($order['status']) . '</p>
                </div>
                <div class="products-list">
                    <h3>Products Ordered</h3>';
        
        // Loop through order items
        do {
            $html .= '
                    <div class="product-item">
                        <p><strong>Product:</strong> ' . htmlspecialchars($order['product_name']) . '</p>
                        <p><strong>Price:</strong> $' . number_format($order['price'], 2) . '</p>
                        <p><strong>Quantity:</strong> ' . $order['quantity'] . '</p>
                    </div>';
        } while ($order = $result->fetch_assoc());

        // Closing HTML tags
        $html .= '
                </div>
            </div>
        </body>
        </html>';

        // Output the HTML content as a printable receipt
        echo $html;
    } else {
        echo "No order found with ID: " . $order_id;
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    echo "Order ID not provided.";
}
?>
