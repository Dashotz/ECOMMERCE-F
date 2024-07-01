<?php
session_start();
include("../inc/db.php"); // Include your database connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Fetch recent orders for display
$query = "SELECT orders.id, orders.name, orders.placed_on, orders.total, orders.payment, orders.status, users.first_name, users.last_name, users.email 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          ORDER BY orders.placed_on DESC 
          LIMIT 10"; // Adjust the limit as needed
$result = $conn->query($query);
$recent_orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
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
                <li class="active"><a href="dashboard.php">Dashboard</a></li>
                <li><a href="products.php">Product</a></li>
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
            
            <section class="dashboard-overview">
                <div class="overview-filters">
                    <button class="filter-button active">All Time</button>
                    <button class="filter-button">12 Months</button>
                    <button class="filter-button">30 Days</button>
                    <button class="filter-button">7 Days</button>
                    <button class="filter-button">24 Hour</button>
                </div>
                <div class="metrics">
                    <div class="metric-card">
                        <h3>Total Pending</h3>
                        <p class="metric-value">
                        <?php  $sql="SELECT count(id) AS total FROM orders WHERE status='pending'";  $result=mysqli_query($conn,$sql); $values=mysqli_fetch_assoc($result); $full=$values['total']; echo (number_format($full));?>
                        </p>
                        <p class="metric-change up"></p>
                    </div>
                    <div class="metric-card">
                        <h3>Total Sales</h3>
                        <p class="metric-value">
                        <?php  $sql="SELECT sum(total) AS totalsales FROM orders WHERE status='success'";  $results=mysqli_query($conn,$sql); $values=mysqli_fetch_assoc($results); $sales=$values['totalsales']; echo (number_format($sales,2));?>
                        </p>
                        <p class="metric-change down"></p>
                    </div>
                    <div class="metric-card">
                        <h3>Total Order</h3>
                        <p class="metric-value">
                        <?php  $sql="SELECT count(id) AS total FROM orders WHERE status='success'";  $result1=mysqli_query($conn,$sql); $values=mysqli_fetch_assoc($result1); $torder=$values['total']; echo (number_format($torder));?>
                        </p>
                        <p class="metric-change up"></p>
                    </div>
                    <div class="metric-card">
                        <h3>Total User</h3>
                        <p class="metric-value">
                        <?php  $sql="SELECT count(id) AS user FROM users";  $result2=mysqli_query($conn,$sql); $values=mysqli_fetch_assoc($result2); $users=$values['user']; echo (number_format($users));?>
                        </p>
                        <p class="metric-change up"></p>
                    </div>
                </div>
            </section>
            
            <section class="sales-details">
                <h2>Sales Details</h2>
                <div class="chart">
                    <!-- Placeholder for the sales chart -->
                    <canvas id="salesChart"></canvas>
                </div>
            </section>
            
            <section class="recent-orders">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['name']); ?></td>
                            <td><?php echo htmlspecialchars($order['placed_on']); ?></td>
                            <td><?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['total']); ?></td>
                            <td><?php echo htmlspecialchars($order['payment']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td>
                                <a href="delete_order.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="action-button delete" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <button class="page-button">&laquo;</button>
                    <button class="page-button active">1</button>
                    <button class="page-button">2</button>
                    <button class="page-button">3</button>
                    <button class="page-button">4</button>
                    <button class="page-button">&raquo;</button>
                </div>
            </section>
        </main>
    </div>
    <?php require_once("chart/sale_anlytics.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Sales',
                    data: [12000, 19000, 3000, 5000, 20000, 30000, 45000],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
