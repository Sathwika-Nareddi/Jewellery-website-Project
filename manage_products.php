<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="admin-table-container">
    <h2>Manage Products</h2>

    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Category</th>
            <th>Type</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>

            <td>
                <img src="../assets/images/<?php echo htmlspecialchars($row['image']); ?>" 
                     class="admin-product-img" 
                     alt="product">
            </td>

            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['gender']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars($row['type']); ?></td>
            <td>€<?php echo htmlspecialchars($row['price']); ?></td>
            <td>
                <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
            </td>
        </tr>
        <?php } ?>

    </table>

    <p style="text-align:center; margin-top:20px;">
        <a href="index.php">⬅ Back to Dashboard</a>
    </p>
</div>

<!-- FOOTER -->
<footer class="site-footer">
    <div class="footer-container">

        <!-- CONTACT -->
        <div class="footer-col">
            <h4>Contact</h4>
            <p><strong>Address:</strong> 567 Begumbazar Road, </p>
            <p> Street 33,Hyderabad, India</p>
            <p><strong>Phone:</strong> +91 9876517044</p>
            <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Fri</p>
        </div>

        <!-- ABOUT -->
        <div class="footer-col">
            <h4>About</h4>
            <ul>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="delivery_info.php">Delivery Information</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="terms.php">Terms & Conditions</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
            </ul>
        </div>

        <!-- MY ACCOUNT -->
        <div class="footer-col">
            <h4>My Account</h4>
            <ul>
                <li><a href="/jewellery_store/auth/login.php">Sign In</a></li>
                <li><a href="/jewellery_store/cart.php">View Cart</a></li>
                <li><a href="/jewellery_store/wishlist.php">My Wishlist</a></li>
                <li><a href="/jewellery_store/track_order.php">Track My Order</a></li>
                <li><a href="/jewellery_store/help.php">Help</a></li>
            </ul>
        </div>

        <!-- INSTALL APP -->
        <div class="footer-col">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="app-buttons">
                <img src="/jewellery_store/assets/images/ins1.jpg" alt="App Store">
                <img src="/jewellery_store/assets/images/ins2.jpg" alt="Google Play">
            </div>
            <p class="secure-text">Secured Payment Gateways</p>
            <div class="payment-icons">
                <img src="/jewellery_store/assets/images/ins3.jpg" alt="Visa">
            
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© <?php echo date("Y"); ?> 𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
