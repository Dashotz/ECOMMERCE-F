<?php
session_start();
include 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $delta = intval($_POST['delta']);

    $stmt = $conn->prepare("UPDATE cart_items SET quantity = GREATEST(1, quantity + ?) WHERE id = ?");
    $stmt->bind_param("ii", $delta, $id);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['status' => 'success']);
    exit;
}
?>
