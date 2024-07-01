<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Management</title>
    <link rel="stylesheet" href="css/seller.css">
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
                <li><a href="products.php">Product</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li class="active"><a href="seller.php">Seller</a></li>
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
                </div>
            </header>

            <section class="seller-management">
                <h2>Sellers</h2>
                <table class="seller-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Seller ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Shop Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example rows -->
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>#2001</td>
                            <td>Alice Johnson</td>
                            <td>alicej@example.com</td>
                            <td>+1-202-555-0111</td>
                            <td>Alice's Apparel</td>
                            <td><span class="status active">Active</span></td>
                            <td>
                                <button class="action-button preview">Preview</button>
                                <button class="action-button edit">Edit</button>
                                <button class="action-button delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>#2002</td>
                            <td>Bob Smith</td>
                            <td>bobs@example.com</td>
                            <td>+1-202-555-0222</td>
                            <td>Bob's Gadgets</td>
                            <td><span class="status inactive">Inactive</span></td>
                            <td>
                                <button class="action-button preview">Preview</button>
                                <button class="action-button edit">Edit</button>
                                <button class="action-button delete">Delete</button>
                            </td>
                        </tr>
                        <!-- Repeat rows as needed -->
                    </tbody>
                </table>
                <div class="pagination">
                    <button class="page-button">&laquo;</button>
                    <button class="page-button active">1</button>
                    <button class="page-button">2</button>
                    <button class="page-button">3</button>
                    <button class="page-button">4</button>
                    <button class="page-button">5</button>
                    <button class="page-button">6</button>
                    <button class="page-button">7</button>
                    <button class="page-button">&raquo;</button>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
