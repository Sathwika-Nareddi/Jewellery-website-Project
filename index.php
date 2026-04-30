<?php
session_start();
include("config/db.php");
// CART COUNT (from session)
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    $cart_count = array_sum($_SESSION['cart']); // total quantity, not just items
}

// WISHLIST COUNT (from database)
$wishlist_count = 0;
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM wishlist WHERE user_id = $uid");
    if ($row = mysqli_fetch_assoc($res)) {
        $wishlist_count = $row['total'];
    }
}

?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewellery Store</title>
    <link rel="stylesheet" href="/jewellery_store/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<div class="navbar">

    <!-- LEFT: LOGO + HOME -->
    <div class="nav-left">
        <div class="logo-circle">
            <img src="/jewellery_store/assets/images/logo.png" alt="logo">
        </div>
        <span class ="brand-text">𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊</span>
        <a href="index.php" class="nav-home">Home</a>
        

        <!-- SHOP DROPDOWN -->
        <div class="dropdown">
            <a class="nav-shop">Shop</a>

            <div class="dropdown-menu">

                <div class="dropdown-section">
                    <span class="section-title"> by Gender</span>
                   <a href="products.php?gender=Women">Women</a>
                   <a href="products.php?gender=Men">Men</a>
                </div>

                <div class="dropdown-section">
                    <span class="section-title">Category</span>
                    <a href="products.php?category=Rings">Rings</a>
                    <a href="products.php?category=Bracelets">Bracelets</a>
                    <a href="products.php?category=Chains">Chains</a>
                </div>

                <div class="dropdown-section">
                    <span class="section-title">By Metal</span>
                    <a href="products.php?metal=Silver">Silver</a>
                    <a href="products.php?metal=Gold">Gold</a>
                    <a href="products.php?metal=Diamond">Diamond</a>
                </div>

            </div>
        </div>
    </div>

    <!-- CENTER: SEARCH -->
<form class="nav-search" action="products.php" method="GET">
    <input 
        type="text" 
        name="search" 
        placeholder='Search "Rings"' 
        required
    >
    <button type="submit" style="border:none; background:none; cursor:pointer;">
        <i class="fa fa-search"></i>
    </button>
</form>



    <!-- RIGHT: ICONS -->
  <div class="nav-icons">

    <!-- ACCOUNT always visible -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/jewellery_store/account/index.php" class="icon-label" title="My Account">
            <i class="fas fa-user"></i>
            <span>ACCOUNT</span>
        </a>
    <?php else: ?>
        <a href="/jewellery_store/auth/login.php" class="icon-label" title="Login">
            <i class="fas fa-user"></i>
            <span>ACCOUNT</span>
        </a>
    <?php endif; ?>

    <!-- LOGOUT only if logged in -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/jewellery_store/auth/logout.php" class="icon-label" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>LOGOUT</span>
        </a>
    <?php endif; ?>

    <a href="/jewellery_store/wishlist.php" class="icon-label" title="Wishlist" style="position:relative;">
    <i class="fas fa-heart"></i>

    <?php if ($wishlist_count > 0): ?>
        <span class="icon-badge"><?php echo $wishlist_count; ?></span>
    <?php endif; ?>

    <span>WISHLIST</span>
   </a>

    <a href="/jewellery_store/cart.php" class="icon-label" title="Cart" style="position:relative;">
    <i class="fas fa-shopping-cart"></i>

    <?php if ($cart_count > 0): ?>
        <span class="icon-badge"><?php echo $cart_count; ?></span>
    <?php endif; ?>

    <span>CART</span>
  </a>


</div>

</div>
</div>
<!-- HERO SECTION -->
<section class="home-hero">
       <div class="hero-images">
            <div class="hero-img img1"></div>
            <div class="hero-img img2"></div>
            <div class="hero-img img3"></div>
         </div>
        <div class="hero-text">
            <h1>Timeless Jewellery for Every Moment</h1>
            <p>Explore elegant rings, chains, bracelets & more</p>
            <a href="products.php" class="hero-btn">Shop Now</a>
         </div> 
         
    </div>
</section>
<!-- SHOP BY GENDER SECTION -->
<section class="shop-gender">

    <h2 class="section-heading">Shop by Gender</h2>

    <div class="gender-container">

        <!-- WOMEN -->
        <a href="products.php?gender=Women" class="gender-box">
            <img src="/jewellery_store/assets/images/womenbg.jpg" alt="Women Jewellery">
            <div class="gender-label">Women</div>
        </a>

        <!-- MEN -->
        <a href="products.php?gender=Men" class="gender-box">
            <img src="/jewellery_store/assets/images/menbgimg.jpg" alt="Men Jewellery">
            <div class="gender-label">Men</div>
        </a>

    </div>

</section>

<!-- SCROLLABLE CATEGORY SECTION -->
<section class="category-scroll">

    <h2 class="section-heading">Shop by Category</h2>

    <div class="scroll-container">

        <a href="products.php?category=Rings" class="category-item">
           <img src="/jewellery_store/assets/images/ringsbg.webp" alt="Rings">
           <span>Rings</span> 
        </a>


        <a href="products.php?category=Pendants" class="category-item">
            <img src="/jewellery_store/assets/images/pendantbg.webp" alt="Pendants">
            <span>Pendants</span>
        </a>

        <a href="products.php?category=Earrings" class="category-item">
            <img src="/jewellery_store/assets/images/earringbg.jpg" alt="Earrings">
            <span>Earrings</span>
        </a>

        <a href="products.php?category=Bracelets" class="category-item">
            <img src="/jewellery_store/assets/images/bra.jpg" alt="Bracelets">
            <span>Bracelets</span>
       </a>

        <a href="products.php?category=Anklets" class="category-item">
            <img src="/jewellery_store/assets/images/ankletsbg.webp" alt="Anklets">
            <span>Anklets</span>
       </a>

        <a href="products.php?category=Bangles" class="category-item">
            <img src="/jewellery_store/assets/images/banglesbg.jpg" alt="Bangles">
            <span>Bangles</span>
        </a>
    </div>
</section>
<!-- SHOP BY METAL SECTION -->
<section class="shop-metal">

    <h2 class="section-heading">Shop by Metal</h2>

    <div class="metal-container">

        <!-- GOLD -->
        <a href="products.php?metal=Gold" class="metal-box">
            <img src="/jewellery_store/assets/images/goldbg.jpg" alt="Gold Jewellery">
            <div class="metal-label">Gold</div>
        </a>

        <!-- SILVER -->
        <a href="products.php?metal=Silver" class="metal-box">
            <img src="/jewellery_store/assets/images/silverbg.jpg" alt="Silver Jewellery">
            <div class="metal-label">Silver</div>
        </a>

        <!-- DIAMOND -->
        <a href="products.php?metal=Diamond" class="metal-box">
            <img src="/jewellery_store/assets/images/diamondbg.jpg" alt="Diamond Jewellery">
            <div class="metal-label">Diamond</div>
        </a>

    </div>

</section>

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
                <li><a href="track_order.php">Track My Order</a></li>
                <li><a href="help.php">Help</a></li>
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
