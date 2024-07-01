<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Account</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <!-- Header Section -->
    <header>
    <section class="header">
     <?php include("inc/nav.php"); ?>     
    </section>
    </header>
    
    <!-- Main Content -->
    <main>
        <div class="account-container">
            <aside>
                <h2>Manage My Account</h2>
                <ul>
                    <li><a href="profile.html">My Profile</a></li>
                    <li><a href="address.html" class="active">Address Book</a></li>
                    <li><a href="payment.html">My Payment Options</a></li>
                </ul>
                <h2>My Orders</h2>
                <ul>
                    <li><a href="orders.html">My Orders</a></li>
                    <li><a href="returns.html">My Returns</a></li>
                    <li><a href="cancellations.html">My Cancellations</a></li>
                </ul>
            </aside>
            <section class="account-details">
                <h2>Welcome! Gretchen Mango</h2>
                <div class="account-info">
                    <div class="info-block">
                        <h3>Shipping Address</h3>
                        <p>Gretchen Stanton</p>
                        <p>gretchenstanton728@gmail.com</p>
                        <button>Edit</button>
                    </div>
                    <div class="info-block">
                        <h3>Shipping/Billing Address</h3>
                        <p>Gretchen Stanton</p>
                        <p>53 Taylor Court Rolfsonbury, South Australia, Australia</p>
                        <p>(483) 276-4082</p>
                        <button>Edit</button>
                    </div>
                </div>
                <h3>Recent Orders</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Place On</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody id="order-list">
                        <!-- Orders will be populated here by JavaScript -->
                    </tbody>
                </table>
            </section>
        </div>
    </main>

    <script src="js/profile.js"></script>
</body>
</html>
