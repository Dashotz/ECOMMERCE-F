<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Address Book</title>
    <link rel="stylesheet" href="css/address.css">
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

            <!-- Address Book Section -->
            <section class="address-book">
                <h2>Address Book</h2>
                <div class="address-table">
                    <div class="address-header">
                        <span>Full Name</span>
                        <span>Address</span>
                        <span>Post Code</span>
                        <span>Phone Number</span>
                        <span>Type</span>
                        <span> </span>                        
                    </div>
                    <div class="separator"></div>
                    <div class="address-entry">
                        <span>Jan Jan</span>
                        <span>Philippines</span>
                        <span>4103</span>
                        <span>09204512121</span>
                        <span>Shipping</span>
                        <button>Edit</button>
                    </div>
                    <div class="separator"></div>
                    <div class="address-entry">
                        <span>Jan Jan</span>
                        <span>Philippines</span>
                        <span>4103</span>
                        <span>09204512121</span>
                        <span>Billing</span>
                        <button>Edit</button>
                    </div>
                    <div class="add-new-address">
                        <button>+ Add New Address</button>
                    </div>
                </div>
            </section>
        </div>
    </main>    
</body>
</html>
