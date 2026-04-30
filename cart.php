<?php
session_start();
include("config/db.php");

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// Update quantity
if (isset($_GET['update'])) {
    $id = (int) $_GET['update'];
    $action = $_GET['action'];

    if (isset($_SESSION['cart'][$id])) {
        if ($action == 'plus') {
            $_SESSION['cart'][$id]++;
        } elseif ($action == 'minus') {
            $_SESSION['cart'][$id]--;
            if ($_SESSION['cart'][$id] <= 0) {
                unset($_SESSION['cart'][$id]); // remove if 0
            }
        }
    }
    header("Location: cart.php");
    exit();
}

// Remove item
if (isset($_GET['remove'])) {
    $id = (int) $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

// Fetch products in cart
$cartItems = $_SESSION['cart'];
$products = [];
$total = 0;

if (!empty($cartItems)) {
    $ids = implode(",", array_keys($cartItems));
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids)");

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="/jewellery_store/assets/style.css">
</head>
<body style="margin:0;min-height:100vh; display:flex; flex-direction:column;">
<div style="flex:1;">

 <h2 class="cart-title">Your Cart</h2>

 <?php if (empty($cartItems)) { ?>
     <p class="empty-cart">Your cart is empty.</p>
 <?php } else { ?>

 <div class="cart-container">

     <div class="cart-table">
         <div class="cart-header">
            <div>Product</div>
            <div>Price</div>
            <div>Qty</div>
            <div>Subtotal</div>
            <div>Action</div>
         </div>

         <?php foreach ($products as $product) {
            $id = $product['id'];
            $qty = $cartItems[$id];
            $subtotal = $product['price'] * $qty;
            $total += $subtotal;
         ?>
         <div class="cart-row">
            <!-- Product column: image + name -->
             <div class="cart-product">
                <img src="/jewellery_store/assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="">
                <span><?php echo htmlspecialchars($product['name']); ?></span>
             </div>

            <!-- Price -->
             <div>€<?php echo $product['price']; ?></div>

            <!-- Quantity -->
           <div class="qty-control">
             <a href="cart.php?update=<?php echo $id; ?>&action=minus" class="qty-btn">−</a>
             <span class="qty-number"><?php echo $qty; ?></span>
             <a href="cart.php?update=<?php echo $id; ?>&action=plus" class="qty-btn">+</a>
           </div>


            <!-- Subtotal -->
             <div>€<?php echo $subtotal; ?></div>

            <!-- Remove -->
             <div>
                 <a class="remove-btn" href="cart.php?remove=<?php echo $id; ?>">✖</a>
             </div>
         </div>
         <?php } ?>

        <!-- Total row -->
         <div class="cart-footer">
            <div></div>
            <div></div>
            <div><strong>Total</strong></div>
            <div><strong>€<?php echo $total; ?></strong></div>
            <div></div>
         </div>
     </div>

    <!-- Cart actions -->
     <div class="cart-actions">
        <a href="products.php" class="cart-btn secondary">⬅ Continue Shopping</a>
        <a href="checkout.php" class="cart-btn primary">Proceed to Checkout ➡</a>
     </div>

 </div>

 <?php } ?>

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
                <li><a href="/jewellery_Store/help.php">Help</a></li>
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
