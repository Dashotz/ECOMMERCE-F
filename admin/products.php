<?php
include '../inc/db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Products</title>
    <link rel="stylesheet" href="css/products.css">
    <style>
        /* Floating card styles */
        .product-preview {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            z-index: 1000;
            width: 300px;
            text-align: center;
        }

        .product-preview h2 {
            margin-bottom: 5px;
        }

        .product-preview p {
            margin: 20px 0;
        }

        .product-preview img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .product-preview button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .product-preview button:hover {
            background-color: #0056b3;
        }

        /* Overlay styles */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
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
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                </div>
                <div class="user-info">
                    <span>Moni Roy</span>
                    <span>Admin</span>
                    <i class="fa-solid fa-right-from-bracket"></i><li><a href="../logout.php">Logout</a></li>
                </div>
            </header>
            <section class="product-management">
                <div class="header-bar">
                    <h2>Products</h2>
                    <a href="addproducts.php" class="add-button">+ Add Product</a>
                </div>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Sub-Category</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Added</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['sku']); ?></td>
                            <td><?php echo htmlspecialchars($row['variation']); ?></td>
                            <td><?php echo htmlspecialchars($row['variation_type']); ?></td>
                            <td><?php echo $row['stock']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td class="status <?php echo ($row['stock'] < 5) ? 'low-stock' : ''; ?>">
                                <?php echo ($row['stock'] < 5) ? 'Low Stock' : 'In Stock'; ?>
                            </td>
                            <td><?php echo $row['added']; ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
                                <a href="editproduct.php?id=<?php echo $row['id']; ?>" class="action-button edit">Edit</a>
                                <button class="action-button preview" onclick="previewProduct('<?php echo htmlspecialchars(addslashes($row['name'])); ?>', '<?php echo $row['price']; ?>', '<?php echo htmlspecialchars(addslashes($row['description'])); ?>', '<?php echo htmlspecialchars($row['img']); ?>')">Preview</button>
                                <a href="deleteproduct.php?id=<?php echo $row['id']; ?>" class="action-button delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <button class="page-button">1</button>
                    <button class="page-button">2</button>
                    <button class="page-button">3</button>
                    <button class="page-button">Next</button>
                </div>
            </section>
        </main>
    </div>

    <script>
        function previewProduct(name, price, description, img) {
            const overlay = document.createElement('div');
            overlay.className = 'overlay';
            overlay.onclick = closePreview;

            const previewCard = `
                <div class="product-preview">
                    <h2>${name}</h2>
                    <img src="productimg/${img}" alt="${name}">
                    <p>Price: ${price}</p>
                    <p>${description}</p>
                    <button onclick="closePreview()">Close</button>
                </div>
            `;

            document.body.appendChild(overlay);
            document.body.insertAdjacentHTML('beforeend', previewCard);
        }

        function closePreview() {
            const preview = document.querySelector('.product-preview');
            const overlay = document.querySelector('.overlay');
            if (preview) {
                preview.remove();
            }
            if (overlay) {
                overlay.remove();
            }
        }
    </script>
</body>
</html>
