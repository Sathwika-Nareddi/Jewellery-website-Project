<?php
session_start();

// User must be logged in to track orders
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Track My Order - TARA Jewellery</title>
</head>
<body style="margin:0; min-height:100vh; display:flex; flex-direction:column; font-family: Arial, Helvetica, sans-serif; background-color:#f5f5f5;">

<div style="flex:1;">
    
<div style="max-width:800px; margin:40px auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

    <h1 style="text-align:center; color:#912c3d; margin-bottom:10px;">Track My Order</h1>
    <p style="text-align:center; color:#555; margin-bottom:30px;">
        Enter your Order ID to check the current status of your order.
    </p>

    <hr style="border:none; border-top:1px solid #ddd; margin-bottom:30px;">

    <!-- Track Form -->
    <form method="GET" action="account/order_details.php" style="max-width:400px; margin:0 auto;">

        <label style="display:block; margin-bottom:8px; color:#333; font-weight:bold;">
            Order ID
        </label>

        <input type="number" name="id" required
               placeholder="Enter your Order ID"
               style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:6px;">

        <button type="submit"
                style="width:100%; padding:12px; background:#912c3d; color:white; border:none; border-radius:6px; cursor:pointer; font-size:16px;">
            Track Order
        </button>
    </form>

    <!-- Info Section -->
    <div style="margin-top:40px; color:#555; line-height:1.6;">
        <h3 style="color:#333;">How tracking works?</h3>
        <p>
            • Enter your Order ID and click <strong>Track Order</strong>.<br>
            • You will be redirected to your order details page.<br>
            • There you can see your order status, items, and total amount.<br>
            • If your order is <strong>Placed</strong>, it is being processed.<br>
            • If it is <strong>Shipped</strong>, it is on the way to you.<br>
            • If it is <strong>Delivered</strong>, your order has arrived.
        </p>
    </div>

    <!-- Back Button -->
    <div style="text-align:center; margin-top:40px;">
        <a href="index.php"
           style="text-decoration:none; background:#333; color:white; padding:10px 20px; border-radius:6px;">
            ⬅ Back to Home
        </a>
    </div>
 </div>
</div>

<!-- FOOTER -->
<footer style="background:#111; color:#ddd; padding:40px 20px 20px;">

    <div style="max-width:1200px; margin:auto; display:grid; grid-template-columns:repeat(4,1fr); gap:30px;">


        <!-- CONTACT -->
        <div class="footer-col">
           <h4 style="color:#f5c26b; margin-bottom:15px;">Contact</h4>
            <p><strong>Address:</strong> 567 Begumbazar Road, </p>
            <p> Street 33,Hyderabad, India</p>
            <p><strong>Phone:</strong> +91 9876517044</p>
            <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Fri</p>
        </div>

        <!-- ABOUT -->
        <div class="footer-col">
         <h4 style="color:#f5c26b; margin-bottom:15px;">About</h4>

            <ul style="list-style:none; padding:0; margin:0;">

                <li><a href="about_us.php"style="color:#ddd; text-decoration:none; font-size:14px;">About Us</a></li>
                <li><a href="delivery_info.php" style="color:#ddd; text-decoration:none; font-size:14px;">Delivery Information</a></li>
                <li><a href="privacy.php" style="color:#ddd; text-decoration:none; font-size:14px;">Privacy Policy</a></li>
                <li><a href="terms.php"style="color:#ddd; text-decoration:none; font-size:14px;">Terms & Conditions</a></li>
                <li><a href="contact_us.php"style="color:#ddd; text-decoration:none; font-size:14px;">Contact Us</a></li>
            </ul>
        </div>

        <!-- MY ACCOUNT -->
        <div class="footer-col">
           <h4 style="color:#f5c26b; margin-bottom:15px;">My Account</h4>

            <ul style="list-style:none; padding:0; margin:0;">

                <li><a href="/jewellery_store/auth/login.php"style="color:#ddd; text-decoration:none; font-size:14px;">Sign In</a></li>
                <li><a href="/jewellery_store/cart.php" style="color:#ddd; text-decoration:none; font-size:14px;">View Cart</a></li>
                <li><a href="/jewellery_store/wishlist.php"style="color:#ddd; text-decoration:none; font-size:14px;">My Wishlist</a></li>
                <li><a href="track_order.php"style="color:#ddd; text-decoration:none; font-size:14px;">Track My Order</a></li>
                <li><a href="help.php"style="color:#ddd; text-decoration:none; font-size:14px;">Help</a></li>
            </ul>
        </div>

        <!-- INSTALL APP -->
        <div class="footer-col">
            <h4 style="color:#f5c26b; margin-bottom:15px;">Install App</h4>

            <p>From App Store or Google Play</p>
              <div style="display:flex; gap:10px; margin-top:10px;">

                <img style="height:38px;" src="/jewellery_store/assets/images/ins1.jpg" alt="App Store">
                <img style="height:38px;" src="/jewellery_store/assets/images/ins2.jpg" alt="Google Play">
            </div>
            <p class="secure-text">Secured Payment Gateways</p>
            <div class="payment-icons">
                <img src="/jewellery_store/assets/images/ins3.jpg" alt="Visa">
            
            </div>
        </div>

    </div>

 <div style="text-align:center; margin-top:30px; padding-top:15px; border-top:1px solid #333; color:#aaa; font-size:14px;">

        <p>© <?php echo date("Y"); ?> 𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
