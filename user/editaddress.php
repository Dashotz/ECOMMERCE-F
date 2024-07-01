<?php
session_start();
include 'inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $address_id = $_GET['id'];

    // Fetch address data
    $stmt = $conn->prepare("SELECT * FROM addresses WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $address_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $address = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "No address ID provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $house_unit = $_POST['house_unit'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $contact_number = $_POST['contact_number'];
    $post_code = $_POST['post_code'];
    $combined_address = $house_unit . ', ' . $city . ', ' . $province;

    // Update address data
    $stmt = $conn->prepare("UPDATE addresses SET full_name = ?, address = ?, contact_number = ?, post_code = ?, province = ?, city = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssssiiii", $full_name, $combined_address, $contact_number, $post_code, $province, $city, $address_id, $user_id);
    $stmt->execute();
    $stmt->close();

    header("Location: address.php");
    exit();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Edit Address</title>
    <link rel="stylesheet" href="css/editaddress.css">
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
                    <li><a href="profile.php" class="active">My Profile</a></li>
                    <li><a href="address.php">Address Book</a></li>
                    <li><a href="payments.php">My Payment Options</a></li>
                </ul>
                <h2>My Orders</h2>
                <ul>
                    <li><a href="orders.php">My Orders</a></li>
                </ul>
            </aside>

            <!-- Edit Address Section -->
            <section class="edit-profile">
                <h2>Edit Your Address</h2>
                <form method="POST">
                    <div class="profile-form">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" value="<?php echo htmlspecialchars($address['full_name']); ?>" placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label>House / Unit / Flr #, Bldg Name, Blk or Lot</label>
                            <input type="text" name="house_unit" value="<?php echo htmlspecialchars($address['address']); ?>" placeholder="Enter your address">
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" name="contact_number" value="<?php echo htmlspecialchars($address['contact_number']); ?>" placeholder="Enter your mobile number">
                        </div>                       
                        <div class="form-group">
                            <label>City/Municipality</label>
                            <input type="text" name="city" placeholder="Enter your city or municipality">
                        </div>
                        <div class="form-group">
                            <label>Post Code</label>
                            <input type="text" name="post_code" placeholder="Enter your post code">
                        </div>
                        <div class="form-group">
                            <label>Province</label>
                            <input type="text" name="province" placeholder="Enter your province">
                        </div> 
                        <div class="form-actions">
                        <button type="button" class="cancel-btn" onclick="location.href='address.php';">Cancel</button>
                            <button type="submit" class="save-btn">Save</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
