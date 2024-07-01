<?php
session_start();
include 'inc/db.php';

$user_id = 1; // Replace with actual user ID or get dynamically if using sessions

// Fetch cart items for the current user from cart_items table
$stmt = $conn->prepare("
    SELECT ci.*, p.img 
    FROM cart_items ci
    LEFT JOIN products p ON ci.product_id = p.id
    WHERE ci.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = array();

while ($row = $result->fetch_assoc()) {
    $cartItems[] = array(
        'id' => $row['id'],
        'product_id' => $row['product_id'],
        'user_id' => $row['user_id'],
        'size' => $row['size'],
        'flavor' => $row['flavor'],
        'quantity' => $row['quantity'],
        'img' => $row['img'],
        'created_at' => $row['created_at'],
    );
}

$stmt->close();
$conn->close();

// Return cart items as JSON response
header('Content-Type: application/json');
echo json_encode($cartItems);
?>
