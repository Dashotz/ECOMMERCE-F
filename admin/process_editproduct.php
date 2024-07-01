<?php
include '../inc/db.php';

// Initialize variables
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$product_name = $_POST['product_name'] ?? '';
$description = $_POST['description'] ?? '';
$base_price = $_POST['base_price'] ?? '';
$sku = $_POST['sku'] ?? '';
$stock = $_POST['stock'] ?? '';
$variation_type = $_POST['variation_type'] ?? '';
$variation = $_POST['variation'] ?? '';
$weight = $_POST['weight'] ?? 0;
$height = $_POST['height'] ?? 0;
$length = $_POST['length'] ?? 0;
$width = $_POST['width'] ?? 0;

// Handle file upload if a new image is provided
$img_filename = ''; // Initialize empty string for img filename

if ($_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
    $target_directory = "../productimg/";
    $target_file = $target_directory . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check !== false) {
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            // Upload file
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                // File uploaded successfully
                $img_filename = basename($_FILES["product_image"]["name"]);
                echo "File uploaded successfully: " . $img_filename; // Debug output
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "File is not an image.";
    }
}

// Prepare SQL update statement
if (!empty($img_filename)) {
    $sql = "UPDATE products SET name=?, description=?, price=?, sku=?, stock=?, variation_type=?, variation=?, weight=?, height=?, length=?, width=?, img=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdissssiiisi', $product_name, $description, $base_price, $sku, $stock, $variation_type, $variation, $weight, $height, $length, $width, $img_filename, $product_id);
} else {
    $sql = "UPDATE products SET name=?, description=?, price=?, sku=?, stock=?, variation_type=?, variation=?, weight=?, height=?, length=?, width=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdissssiiii', $product_name, $description, $base_price, $sku, $stock, $variation_type, $variation, $weight, $height, $length, $width, $product_id);
}

// Execute update query
if ($stmt->execute()) {   
    $message = "Product Updated Succesfully!";
    echo "<script type='text/javascript'>alert('$message'); window.location.href = 'products.php';</script>";
    
    exit;
} else {
    echo "Error updating product: " . $stmt->error;
}

$stmt->close();
$conn->close();

    
?>
