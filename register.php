<!-- register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <header>
        <section class="header">
            <?php include("inc/nav.php"); ?>
        </section>
    </header>
    <main>
        <div class="signup-container">
            <h2>Sign Up</h2>
            <form id="signupForm" class="signup-form" action="register_action.php" method="POST">
                <!-- Form Fields -->
                <!-- Ensure each input has a name attribute corresponding to the column names in your database -->
                <div class="form-group">
                    <div>
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first_name" required>
                    </div>
                    <div>
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="number" required>
                    </div>
                </div>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
                <div class="form-group">
                    <div>
                        <label for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" required>
                            <span class="toggle-password">👁️</span>
                        </div>
                    </div>
                    <div>
                        <label for="confirm-password">Confirm Password</label>
                        <div class="password-container">
                            <input type="password" id="confirm-password" name="confirm_password" required>
                            <span class="toggle-password">👁️</span>
                        </div>
                    </div>
                </div>
                <button type="submit">Sign up</button>
            </form>
            <p>Already have an account? <a href="login.php">Log in here</a></p>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <p>Questions? We're here 24 hours a day:</p>
            <p>Shop.co © 2000-2023, All
