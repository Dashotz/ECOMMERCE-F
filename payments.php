<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Payment Options</title>
    <link rel="stylesheet" href="css/payments.css">
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
            <!-- Sidebar -->
            <aside>
                <h2>Manage My Account</h2>
                <ul>
                    <li><a href="profile.html">My Profile</a></li>
                    <li><a href="address.html">Address Book</a></li>
                    <li><a href="payment.html" class="active">My Payment Options</a></li>
                </ul>
                <h2>My Orders</h2>
                <ul>
                    <li><a href="orders.html">My Orders</a></li>
                    <li><a href="returns.html">My Returns</a></li>
                    <li><a href="cancellations.html">My Cancellations</a></li>
                </ul>
            </aside>

            <!-- Payment Options Section -->
            <section class="payment-options">
                <h2>Payment Options</h2>
                <div class="payment-table">
                    <div class="payment-header">
                        <span>Card Number</span>
                        <span>Expiry Date</span>
                        <span></span>
                    </div>
                    <div class="separator"></div>
                    <div class="payment-entry">
                        <span>0804 3328 1766 0961</span>
                        <span>07/30</span>
                        <button class="delete-btn">Delete</button>
                    </div>
                    <div class="separator"></div>
                    <div class="payment-entry">
                        <span>2599 7097 5206 3535</span>
                        <span>05/29</span>
                        <button class="delete-btn">Delete</button>
                    </div>
                    <div class="add-card">
                        <button class="add-card-btn">+ Add Card</button>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
