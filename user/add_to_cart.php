<?php
session_start();
include 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $product_id = intval($data['id']);
    $size = $data['size'];
    $flavor = $data['flavor'];
    $quantity = intval($data['quantity']);
    $img = $data['img'];

    // Fetch user_id from session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit;
    }

    // Add to session cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product already exists in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product_id && $item['size'] === $size && $item['flavor'] === $flavor) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'size' => $size,
            'flavor' => $flavor,
            'quantity' => $quantity,
            'img' => $img
        ];
    }

    // Store in database
    $stmt = $conn->prepare("INSERT INTO cart_items (product_id, user_id, size, flavor, quantity, img) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissis", $product_id, $user_id, $size, $flavor, $quantity, $img);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['status' => 'success']);
    exit;
}
?>
