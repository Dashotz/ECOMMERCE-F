<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Pawfect Shoppe</title>
    <link rel="stylesheet" href="css/editprofile.css">
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
                <h2>Edit Your Profile</h2>
                <form id="edit-profile-form">
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" value="Md">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" value="Rimel">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="rimel1111@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="Kingston, 5236, United State">
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact-number" value="+639000000000">
                    </div>
                    <div class="form-group">
                        <h3>Password Changes</h3>
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" name="confirm-password">
                    </div>
                    <div class="form-actions">
                        <button type="button" id="cancel-button">Cancel</button>
                        <button type="submit" id="save-button">Save Changes</button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script src="js/editprofile.js"></script>
</body>
</html>
