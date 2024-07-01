<?php
// process_addproduct.php

// Database connection
include '../inc/db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $base_price = $_POST['base_price'];
    $sku = $_POST['sku'];
    $quantity = $_POST['stock'];
    $variation_type = $_POST['variation_type'];
    $variation = $_POST['variation'];    
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $length = $_POST['length'];
    $width = $_POST['width'];

    // Handle file upload
    $target_directory = "../productimg/";
    $target_file = $target_directory . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if($check !== false) {
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            // Upload file
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                // File uploaded successfully, insert data into database
                $img_filename = basename($_FILES["product_image"]["name"]);

                // Get current date and time
                $added = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

                // SQL query to insert product data into database
                $sql = "INSERT INTO products (name, description, img, price, sku, stock, variation_type, variation,  weight, height, length, width, added)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssssssssss", $product_name, $description, $img_filename, $base_price, $sku, $quantity, $variation_type, $variation, $weight, $height, $length, $width, $added);

                if ($stmt->execute()) {
                    echo "Product added successfully.";
                    // Redirect or handle success
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "File is not an image.";
    }

    $conn->close();
}
    $message = "Product Added Succesfully!";
    echo "<script type='text/javascript'>alert('$message'); window.location.href = 'products.php';</script>";
    exit();
    

?>
