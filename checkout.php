<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User is not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id'];  // Use the actual user ID from the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if items are provided in the POST request
    if (!isset($_POST['items']) || !is_array($_POST['items'])) {
        echo json_encode(['success' => false, 'error' => 'No items provided.']);
        exit;
    }

    $payment_method = $_POST['payment_method'];
    $total_amount = floatval($_POST['total_amount']);
    $order_status = 'Pending';

    $placed_on = date('Y-m-d'); // Current date in YYYY-MM-DD format

    // Insert order into orders table
    foreach ($_POST['items'] as $item_id) {
        $stmt = $conn->prepare("
            SELECT ci.*, p.name, p.price, p.img 
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.id = ? AND ci.user_id = ?
        ");
        $stmt->bind_param("ii", $item_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();

            $stmt_insert = $conn->prepare("
                INSERT INTO orders (user_id, name, size, flavor, quantity, total, payment, status, id, placed_on)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt_insert->bind_param("isssidssis", $user_id, $item['name'], $item['size'], $item['flavor'], $item['quantity'], $total_amount, $payment_method, $order_status, $item['product_id'], $placed_on);
            $stmt_insert->execute();
            $stmt_insert->close();

            // Optionally, remove the item from the cart
            $stmt_delete = $conn->prepare("DELETE FROM cart_items WHERE id = ? AND user_id = ?");
            $stmt_delete->bind_param("ii", $item_id, $user_id);
            $stmt_delete->execute();
            $stmt_delete->close();
        }
        $stmt->close();
    }

    $conn->close();
$message = "Thank you for buying! Checkout Successfully.";
    echo "<script type='text/javascript'>
            alert('$message');
            window.location.href = 'addtocart.php';
          </script>";
    exit;
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
