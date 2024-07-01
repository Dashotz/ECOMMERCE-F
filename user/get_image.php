<?php
include 'inc/db.php';

// Example: get_image.php

// Assuming you have a directory named 'productimg' where images are stored
$product_img_dir = 'productimg/';

if (isset($_GET['product_name'])) {
    $product_name = $_GET['product_name'];

    // Sanitize the product name to prevent directory traversal attacks
    $product_name = basename($product_name);

    // Construct the image path based on the sanitized product name
    $image_path = $product_img_dir . $product_name . '.jpg'; // Adjust file extension as needed

    if (file_exists($image_path)) {
        $image_info = getimagesize($image_path);
        header("Content-type: {$image_info['mime']}");
        readfile($image_path);
    } else {
        // Handle case where image file does not exist
        header('Content-Type: image/png'); // Default content-type for placeholder image
        readfile('path_to_placeholder_image.png'); // Replace with your actual placeholder image path
    }
} else {
    // Handle case where product_name parameter is not provided
    echo 'Product name not provided.';
}
?>