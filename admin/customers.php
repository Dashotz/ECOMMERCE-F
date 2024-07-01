<?php
session_start();
include("../inc/db.php"); // Include your database connection file

if (!isset($_SESSION['user_id']) || $_SESSION['user_level'] != 1) {
    header("Location: login.php"); // Redirect to the login page if not logged in or not an admin
    exit();
}

// Fetch customer data
$query = "SELECT id, first_name, last_name, email, number, address FROM users WHERE user_level = 0"; // Assuming user_level = 0 is for customers
$result = $conn->query($query);
$customers = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
    <link rel="stylesheet" href="css/customers.css">
    <script>
        function confirmDelete(customerId) {
            if (confirm("Are you sure you want to delete this customer?")) {
                window.location.href = "delete_customer.php?id=" + customerId;
            }
        }
    </script>
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
                <li class="active"><a href="customers.php">Customers</a></li>                
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

            <section class="customer-management">
                <h2>Customers</h2>
                <table class="customer-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($customers) > 0): ?>
                            <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><?php echo htmlspecialchars($customer['id']); ?></td>
                                <td><?php echo htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($customer['email']); ?></td>
                                <td><?php echo htmlspecialchars($customer['number']); ?></td>
                                <td><?php echo htmlspecialchars($customer['address']); ?></td>
                                <td>
                                    <button class="action-button delete" onclick="confirmDelete(<?php echo htmlspecialchars($customer['id']); ?>)">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No customers found.</td>
                            </tr>
                        <?php endif; ?>
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
