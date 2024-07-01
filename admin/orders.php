<?php
require_once("../inc/db.php");

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch orders with customer details
$view_query = "SELECT o.id, o.date_order, o.total, o.payment, o.status, a.full_name
               FROM orders AS o
               LEFT JOIN addresses AS a ON o.user_id = a.user_id";

$result = mysqli_query($conn, $view_query);

if (!$result) {
    die("Error fetching orders: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="css/orders.css">
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
                <li class="active"><a href="orders.php">Orders</a></li>
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

            <section class="order-management">
                <h2>Orders</h2>
               
                <table class="order-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <!-- Example rows -->
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['full_name']) ?></td>
                            <td><?= $row['date_order'] ?></td>
                            <td>Php <?= number_format($row['total']) ?></td>
                            <td><?= $row['payment'] ?></td>
                            <td><span class="status processing"><?= $row['status'] ?></span></td>
                            <td>
                               <form method="POST">
                                   <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                   <button type="submit" name="approved" id="approved" class="action-button preview">Approved</button>
                                   <button type="submit" name="archive" id="archive" class="action-button delete">Archive</button>
                                   <!-- Print/Download Button -->
                                   <button type="button" class="action-button print" onclick="printReceipt(<?= $row['id'] ?>)">Print/Download</button>
                               </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
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

    <!-- JavaScript for Receipt Printing/Downloading -->
    <script>
        function printReceipt(orderId) {
            // You can implement receipt generation logic here
            // For simplicity, let's simulate downloading a PDF receipt
            window.open(`generate_receipt.php?order_id=${orderId}`, '_blank');
        }
    </script>
</body>
</html>

<?php 

if (isset($_POST['approved'])) {
    $id  = $_POST['id'];
    $select = "UPDATE orders SET status = 'Success' WHERE id = '$id'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        echo '<script>alert("Approved!"); window.location.href = "orders.php";</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['archive'])) {
    $id  = $_POST['id'];
    $select = "UPDATE orders SET status = 'Archived' WHERE id = '$id'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        echo '<script>alert("Archived!"); window.location.href = "orders.php";</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
