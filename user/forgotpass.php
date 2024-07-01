<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/forgotpass.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
<header>
    <section class="header">
    <?php include("../inc/nav.php"); ?>   
    </section>
    </header>
    <main>
        <div class="forgot-password-container">
            <h2>Forgot Password</h2>
            <form method="POST" action="">
                <p>If you forgot your password, follow the instructions below. After you complete the steps, a code will be sent to your email address. Please log in with your username and the verified code.</p>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Ex. Juandelacruz@gmail.com" required>
                <button type="submit" name="btnFor" onclick="return val();">Proceed</button>
                <div class="back-link">
                    <a href="login.php" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <p>Questions? We're here 24 hours a day:</p>
            <p>Shop.co © 2000-2023, All Rights Reserved</p>
            <div class="footer-links">
                <a href="#">Terms & Conditions</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>
    <script src="js/forgot_password.js"></script>
</body>
</html>
