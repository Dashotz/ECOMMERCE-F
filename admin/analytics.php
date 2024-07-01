<?php
session_start();
include("../inc/db.php"); // Include your database connection file

if (!isset($_SESSION['user_id']) || $_SESSION['user_level'] != 1) {
    header("Location: login.php"); // Redirect to the login page if not logged in or not an admin
    exit();
}

// Fetch orders data with join, only where status is Success
$query = "SELECT orders.id as order_id, orders.name, orders.quantity, orders.total, orders.payment, orders.status, orders.placed_on,
                 products.sku, products.variation as category, products.variation_type
          FROM orders
          JOIN products ON orders.name = products.name
          WHERE orders.status = 'Success'"; // Filter to include only successful orders
$result = $conn->query($query);
$orders = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard</title>
    <link rel="stylesheet" href="css/analytics.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <li class="active"><a href="analytics.php">Analytics</a></li>
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

            <section class="analytics-dashboard">
                <h2>Analytics Overview</h2>
                <p>Welcome to the analytics dashboard! Here you can view detailed insights into sales performance, user growth, and order statuses. Stay updated with the latest trends and make informed decisions for your business.</p>

                <div class="chart-wrapper">
                    <div class="chart-container">
                        <h3>Sales Performance</h3>
                        <p>Track your sales performance over the past months. Identify trends and peaks in your sales data to strategize effectively.</p>
                        <?php require("chart/sales_chart.php"); ?>
                    </div>

                    <div class="chart-container">
                        <h3>User Growth</h3>
                        <p>Analyze the growth in the number of users over time. Monitor new user registrations and retention rates.</p>
                       <?php require("chart/user_chart.php"); ?>
                    </div>

                    <div class="chart-container">
                        <h3>Order Status Distribution</h3>
                        <p>Understand the distribution of order statuses to optimize order management processes.</p>
                             <?php require("chart/order_chart.php"); ?>
                    </div>
                </div>


                <div class="sale-details">
                    <h3>Sale Details</h3>
                    <table class="sale-details-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($orders) > 0): ?>
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                                    <td><?php echo htmlspecialchars($order['sku']); ?></td>
                                    <td><?php echo htmlspecialchars($order['category']); ?></td>
                                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                    <td>₱<?php echo htmlspecialchars($order['total']); ?></td>
                                    <td>
                                        <span class="status-success"><?php echo htmlspecialchars($order['status']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($order['placed_on']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No successful orders found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <a href="#">&laquo;</a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">&raquo;</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="js/analytics.js"></script>
</body>
</html>
