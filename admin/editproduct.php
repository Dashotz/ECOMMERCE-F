<?php
include '../inc/db.php';

// Initialize variables
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;



if ($product_id > 0) {
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "No product found with ID: " . $product_id;
    }
    $stmt->close();
} else {
    echo "Invalid product ID: " . $product_id;
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edit Product</title>
    <link rel="stylesheet" href="css/addproducts.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li class="active"><a href="products.php">Product</a></li>                
                <li><a href="orders.php">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>                
                <li><a href="analytics.php">Analytics</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <!-- Header content -->
            </header>
            <section class="add-product">
                <div class="header-bar">
                    <h2>Edit Product</h2>
                </div>
                <form class="product-form" id="product-form" method="post" enctype="multipart/form-data" action="process_editproduct.php">

                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                    <div class="section">
                        <h3>General Information</h3>
                        <label>Product Name</label>
                        <input type="text" name="product_name" placeholder="Type product name here..." value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>">
                        <label>Description</label>
                        <textarea name="description" placeholder="Type product description here..."><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
                    </div>

                    <div class="section">
                          <h3>Media</h3>
                                <div class="upload-box">
                                       <input type="file" id="file-upload" name="product_image">
                                          <label for="file-upload">Drag and drop image here, or click add image</label>
                                     <?php if (!empty($product['img'])): ?>
                                       <img src="../productimg/<?php echo htmlspecialchars($product['img']); ?>" alt="Product Image" style="max-width: 200px;">
                                             <?php endif; ?>
                        </div>
                    </div>


                    <div class="section">
                        <h3>Pricing</h3>
                        <label>Base Price</label>
                        <input type="text" name="base_price" placeholder="Type base price here..." value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>">
                    </div>

                    <div class="section">
                        <h3>Inventory</h3>
                        <label>SKU</label>
                        <input type="text" name="sku" placeholder="Type product SKU here..." value="<?php echo htmlspecialchars($product['sku'] ?? ''); ?>">
                        <label>Quantity</label>
                        <input type="text" name="stock" id="stock" placeholder="Type product quantity here..." value="<?php echo htmlspecialchars($product['stock'] ?? ''); ?>">
                    </div>

                    <div class="section">
                        <h3>Variation</h3>
                        <label>Variation Type</label>
                        <input type="text" name="variation_type" placeholder="Type variation type here..." value="<?php echo htmlspecialchars($product['variation_type'] ?? ''); ?>">
                        <label>Variation</label>
                        <input type="text" name="variation" placeholder="Variation..." value="<?php echo htmlspecialchars($product['variation'] ?? ''); ?>">
                    </div>

                    <div class="section">
                        <h3>Shipping</h3>
                        <label><input type="checkbox" name="physical_product" <?php if (!empty($product['weight']) && $product['weight'] > 0) echo 'checked'; ?>> This is a physical product</label>
                        <label>Weight</label>
                        <input type="text" name="weight" placeholder="Product weight..." value="<?php echo htmlspecialchars($product['weight'] ?? ''); ?>">
                        <label>Height</label>
                        <input type="text" name="height" placeholder="Height (cm)..." value="<?php echo htmlspecialchars($product['height'] ?? ''); ?>">
                        <label>Length</label>
                        <input type="text" name="length" placeholder="Length (cm)..." value="<?php echo htmlspecialchars($product['length'] ?? ''); ?>">
                        <label>Width</label>
                        <input type="text" name="width" placeholder="Width (cm)..." value="<?php echo htmlspecialchars($product['width'] ?? ''); ?>">
                        <button class="cancel-button" onclick="location.href='address.php';">Cancel</button>
                        <button class="add-button" onclick="document.getElementById('product-form').submit();">Save Changes</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
