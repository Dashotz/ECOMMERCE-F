<nav>
    <a href="index.php"><img src="img/logo.png"></a>
    <div class="nav-links">
        <ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                <i class="fa-solid fa-cart-shopping"></i><li><a href="addtocart.php">Cart</a></li>
                <i class="fa-solid fa-user"></i><li><a href="profile.php">Profile</a></li>
                <i class="fa-solid fa-right-from-bracket"></i><li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <i class="fa-solid fa-right-to-bracket"></i><li><a href="login.php">Login/Sign-up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
