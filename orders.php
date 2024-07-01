<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Pawfect Shoppe</title>
    <link rel="stylesheet" href="css/order.css">
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
                <h2>My Orders</h2>
                <nav class="order-nav">
                    <ul>
                        <li><a href="#">All</a></li>
                        <li><a href="#">To Pay</a></li>
                        <li><a href="#">To Ship</a></li>
                        <li><a href="#">To Receive</a></li>
                        <li><a href="#">Completed</a></li>
                        <li><a href="#">Cancelled</a></li>
                    </ul>
                </nav>
                <div class="search-bar">
                    <input type="text" placeholder="Search orders...">
                </div>
                <div class="orders-table">
                    <div class="order-item">
                        <div class="order-header">
                            <div class="order-status">Item Status</div>
                            <div class="order-status">Item Status</div>
                        </div>
                        <div class="order-details">
                            <div class="order-image">
                                <img src="path/to/image.jpg" alt="Product Image">
                            </div>
                            <div class="order-info">
                                <h3>Product Name</h3>
                                <p>Size: Medium</p>
                                <p>Flavor: Strawberry</p>
                                <p>Quantity: 2</p>
                            </div>
                            <div class="order-pricing-actions">
                                <div class="order-pricing">
                                    <p>Price: $180</p>
                                    <p>Delivery Fee: $10</p>
                                    <p>Order Price: $190</p>
                                </div>
                                <div class="order-actions">
                                    <button>Order Details</button>
                                    <button>Buy Again</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>
