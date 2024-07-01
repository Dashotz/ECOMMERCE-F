<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Add Product</title>
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
                <li class="active"><a href="products.php">Product</a>
                    <ul>
                        <li class="active"><a href="addproducts.php">Add products</a></li>
                    </ul>
                </li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>                
                <li><a href="analytics.php">Analytics</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                </div>
                <div class="user-info">
                    <span>Moni Roy</span>
                    <span>Admin</span>
                    <i class="fa-solid fa-right-from-bracket"></i><li><a href="../logout.php">Logout</a></li>
                </div>                
            </header>
            <section class="add-product">
                <div class="header-bar">
                  
                    <h2>Add Product</h2>
                    
                </div>
                <form class="product-form" id="product-form" method="post" enctype="multipart/form-data" action="process_addproduct.php">
                    <div class="section">
                        <h3>General Information</h3>
                        <label>Product Name</label>
                        <input type="text" name="product_name" placeholder="Type product name here...">
                        <label>Description</label>
                        <textarea name="description" placeholder="Type product description here..."></textarea>
                    </div>

                    <div class="section">
                        <h3>Media</h3>
                        <div class="upload-box">
                            <input type="file" id="file-upload" name="product_image">
                            <label for="file-upload">Drag and drop image here, or click add image</label>
                        </div>
                    </div>

                    <div class="section">
                        <h3>Pricing</h3>
                        <label>Base Price</label>
                        <input type="text" name="base_price" placeholder="Type base price here...">
                        <!-- Other pricing fields can be added here -->
                    </div>

                    <div class="section">
                        <h3>Inventory</h3>
                        <label>SKU</label>
                        <input type="text" name="sku" placeholder="Type product SKU here...">
                        <label>Quantity</label>
                        <input type="text" name="stock" id="stock" placeholder="Type product quantity here...">
                    </div>

                    <div class="section">
                        <h3>Variation</h3>
                        <label>Variation Type</label>
                        <input type="text" name="variation_type" placeholder="Type variation type here...">
                        <label>Variation</label>
                        <input type="text" name="variation" placeholder="Variation...">
                        <button type="button" class="add-variant" onclick="addVariant()">+ Add Variant</button>
                    </div>

                    <div class="section">
                        <h3>Shipping</h3>
                        <label><input type="checkbox" name="physical_product"> This is a physical product</label>
                        <label>Weight</label>
                        <input type="text" name="weight" placeholder="Product weight...">
                        <label>Height</label>
                        <input type="text" name="height" placeholder="Height (cm)...">
                        <label>Length</label>
                        <input type="text" name="length" placeholder="Length (cm)...">
                        <label>Width</label>
                        <input type="text" name="width" placeholder="Width (cm)...">
                        <button class="cancel-button" onclick="location.href='address.php';">Cancel</button>
                        <button class="add-button" onclick="document.getElementById('product-form').submit();">Save Changes</button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <script>
    function addVariant() {
        // Create new variant input fields
        const variantSection = document.querySelector('.section h3:contains("Variation")').parentElement;
        const newVariantType = document.createElement('input');
        newVariantType.type = 'text';
        newVariantType.name = 'variation_type';
        newVariantType.placeholder = 'Type variation type here...';
        
        const newVariant = document.createElement('input');
        newVariant.type = 'text';
        newVariant.name = 'variation';
        newVariant.placeholder = 'Variation...';

        variantSection.appendChild(newVariantType);
        variantSection.appendChild(newVariant);
    }
</script>

</body>
</html>
