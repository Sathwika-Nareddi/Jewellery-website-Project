<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "
    SELECT products.* 
    FROM wishlist 
    JOIN products ON wishlist.product_id = products.id 
    WHERE wishlist.user_id = $user_id
");

if (mysqli_num_rows($result) == 0) {
    echo "<h2 style='text-align:center'>Your wishlist is empty.</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Wishlist</title>
    <link rel="stylesheet" href="/jewellery_store/assets/style.css">
</head>
<body style="margin:0;min-height:100vh; display:flex; flex-direction:column;">
<div style="flex:1;">
 <h2 style="text-align:center; margin-top:30px;">My Wishlist</h2>

 <div class="wishlist-grid">
 <?php while ($row = mysqli_fetch_assoc($result)): ?>
   <div class="wishlist-card">

     <img src="/jewellery_store/assets/images/<?php echo htmlspecialchars($row['image']); ?>" 
         alt="<?php echo htmlspecialchars($row['name']); ?>">

     <h3><?php echo htmlspecialchars($row['name']); ?></h3>
     <p class="price">€<?php echo $row['price']; ?></p>

     <div class="wishlist-actions">
         <a class="move-to-cart-btn" href="add_to_cart.php?id=<?php echo $row['id']; ?>">
            Move to Cart
         </a>

         <a class="remove-btn" href="remove_from_wishlist.php?id=<?php echo $row['id']; ?>">
             ✖
         </a>
     </div>

   </div>
 <?php endwhile; ?>
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
