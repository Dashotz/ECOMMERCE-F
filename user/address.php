<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user address data
$stmt = $conn->prepare("SELECT * FROM addresses WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$addresses = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Address Book</title>
    <link rel="stylesheet" href="css/address.css">
    <link rel="stylesheet" href="css/nav.css">   
    <link rel="stylesheet" href="css/nav1.css">
    <script src="https://kit.fontawesome.com/249726be58.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header Section -->
    <header>
        <section class="header">
            <?php include("../inc/nav.php"); ?>   
            <?php include("../inc/nav1.php"); ?>   
        </section>
    </header>

    <!-- Main Content -->
    <main>
        <div class="account-container">
            <!-- Sidebar -->
            <aside>
                <h2>Manage My Account</h2>
                <ul>
                    <li><a href="profile.php">My Profile</a></li>
                    <li><a href="address.php" class="active">Address Book</a></li>
                    <li><a href="payments.php">My Payment Options</a></li>
                </ul>
                <h2>My Orders</h2>
                <ul>
                    <li><a href="orders.php">My Orders</a></li>
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
                        <span></span>
                    </div>
                    <div class="separator"></div>
                    <?php foreach ($addresses as $address): ?>
                        <div class="address-entry">
                            <span><?php echo htmlspecialchars($address['full_name']); ?></span>
                            <span><?php echo htmlspecialchars($address['address']); ?></span>
                            <span><?php echo htmlspecialchars($address['post_code']); ?></span>
                            <span><?php echo htmlspecialchars($address['contact_number']); ?></span>                           
                            <form method="POST" action="deleteaddress.php" style="display: inline;">
                            <a href="editaddress.php?id=<?php echo $address['id']; ?>"><button>Edit</button></a>
                                <input type="hidden" name="address_id" value="<?php echo $address['id']; ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this address?');" >Delete</button>
                            </form>
                        </div>
                        <div class="separator"></div>
                    <?php endforeach; ?>
                    <div class="add-new-address">
                        <a href="add_address.php"><button>+ Add New Address</button></a>
                    </div>
                </div>
            </section>
        </div>
    </main>    
</body>
</html>
