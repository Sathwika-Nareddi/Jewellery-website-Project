<?php
session_start();
include("../config/db.php");

// Only admin allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

if (!isset($_GET['id'])) {
    die("Order ID missing.");
}

$order_id = (int) $_GET['id'];

// Get order info
$orderResult = mysqli_query($conn, "SELECT * FROM orders WHERE id = $order_id");
$order = mysqli_fetch_assoc($orderResult);
// Update status
if (isset($_POST['update_status'])) {
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);

    mysqli_query($conn, "UPDATE orders SET status = '$new_status' WHERE id = $order_id");

    // Refresh page
    header("Location: order_details.php?id=" . $order_id);
    exit();
}


// Get order items + product info
$sql = "SELECT order_items.*, products.name 
        FROM order_items 
        JOIN products ON order_items.product_id = products.id
        WHERE order_items.order_id = $order_id";

$itemsResult = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body style="margin:0;min-height:100vh; display:flex; flex-direction:column;">
<div style="flex:1;">
 <div class="order-details-container">

    <div class="order-details-header">
        <h2>Order #<?php echo $order_id; ?> Details</h2>
    </div>

    <div class="order-summary">
        <strong>Status:</strong> €<?php echo htmlspecialchars($order['status']); ?> <br>
        <strong>Total:</strong> €<?php echo $order['total']; ?>
    </div>


 <div class="order-status-form">
    <form method="POST">
        <label><strong>Change Order Status:</strong></label>
        <select name="status">
            <option value="Placed" <?php if ($order['status']=="Placed") echo "selected"; ?>>Placed</option>
            <option value="Shipped" <?php if ($order['status']=="Shipped") echo "selected"; ?>>Shipped</option>
            <option value="Delivered" <?php if ($order['status']=="Delivered") echo "selected"; ?>>Delivered</option>
            <option value="Cancelled" <?php if ($order['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>
        </select>
        <button type="submit" name="update_status">Update</button>
    </form>
 </div>





 <table class="order-items-table">

    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>

    <?php while ($item = mysqli_fetch_assoc($itemsResult)): 
        $subtotal = $item['price'] * $item['quantity'];
    ?>
    <tr>
        <td><?php echo htmlspecialchars($item['name']); ?></td>
        <td>€<?php echo $item['price']; ?></td>
        <td><?php echo $item['quantity']; ?></td>
        <td>€<?php echo $subtotal; ?></td>
    </tr>
    <?php endwhile; ?>
 </table>

 <a href="orders.php" class="back-link">⬅ Back to Orders</a>
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
