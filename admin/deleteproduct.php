<?php
include '../inc/db.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $product_id);

    if ($stmt->execute()) {
        header('Location: products.php');
    } else {
        echo "Error deleting product: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>
