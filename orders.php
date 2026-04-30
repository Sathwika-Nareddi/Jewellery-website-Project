<?php
session_start();
include("../config/db.php");

// Only admin allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

// Fetch all orders with user info
$sql = "SELECT orders.*, users.name AS user_name 
        FROM orders 
        JOIN users ON orders.user_id = users.id 
        ORDER BY orders.created_at DESC";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body style="margin:0;min-height:100vh; display:flex; flex-direction:column;">
<div style="flex:1;">
 <h2 class="admin-title">All Orders (Admin)</h2>

 <div class="admin-table-container">
  <table class="admin-table">
    <tr>
        <th>Order ID</th>
        <th>User</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    <?php while ($order = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td>#<?php echo $order['id']; ?></td>
        <td><?php echo htmlspecialchars($order['user_name']); ?></td>
        <td>€<?php echo $order['total']; ?></td>
        <td>
            <span class="status <?php echo htmlspecialchars($order['status']); ?>">
                <?php echo htmlspecialchars($order['status']); ?>
            </span>
        </td>
        <td><?php echo $order['created_at']; ?></td>
        <td>
            <a class="admin-link" href="order_details.php?id=<?php echo $order['id']; ?>">
                View
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
  </table>
 </div>

 <div class="admin-back">
    <a class="admin-link" href="index.php">⬅ Back to Admin Dashboard</a>
 </div>
    </div>


<!-- FOOTER -->
<footer class="site-footer" style="margin-top:auto;">
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
