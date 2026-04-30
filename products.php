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

$where = [];
$pageTitleParts = [];
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

// Gender filter
if (isset($_GET['gender']) && $_GET['gender'] != '') {
    $gender = mysqli_real_escape_string($conn, $_GET['gender']);
    $where[] = "gender = '$gender'";
    $pageTitleParts[] = $gender;
}

// Category filter
if (isset($_GET['category']) && $_GET['category'] != '') {
    $category = mysqli_real_escape_string($conn, $_GET['category']);
    $where[] = "category = '$category'";
    $pageTitleParts[] = $category;
}

// Metal filter (your column is `type`)
if (isset($_GET['metal']) && $_GET['metal'] != '') {
    $metal = mysqli_real_escape_string($conn, $_GET['metal']);
    $where[] = "type = '$metal'";
    $pageTitleParts[] = $metal;
}
// Search filter
if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where[] = "(name LIKE '%$search%' 
              OR category LIKE '%$search%' 
              OR type LIKE '%$search%')";
    $pageTitleParts[] = 'Search: ' . htmlspecialchars($_GET['search']);
}


// Build query
if (!empty($where)) {
    $query = "SELECT * FROM products WHERE " . implode(" AND ", $where);
    $pageTitle = implode(" ", $pageTitleParts) . " Jewellery";
} else {
    $query = "SELECT * FROM products";
    $pageTitle = "All Jewellery";
}
// Get wishlist product IDs for logged-in user
$wishlist_ids = [];

if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $wres = mysqli_query($conn, "SELECT product_id FROM wishlist WHERE user_id = $uid");
    while ($w = mysqli_fetch_assoc($wres)) {
        $wishlist_ids[] = $w['product_id'];
    }
}


// Run query
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="/jewellery_store/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body style="margin:0;min-height:100vh; display:flex; flex-direction:column;">
<div style="flex:1;">
    
 <div class="navbar">

    <!-- LEFT: LOGO + HOME -->
    <div class="nav-left">
        <div class="logo-circle">
            <img src="/jewellery_store/assets/images/logo.png" alt="logo">
        </div>

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
                    <a href="products.php?category=Bangles">Bangles</a>
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
     <input type="text" name="search" placeholder='Search "Rings"' value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
     <button type="submit" style="border:none; background:none; cursor:pointer;">
         <i class="fa fa-search"></i>
     </button>
    </form>


    <!-- RIGHT: ICONS -->
     <div class="nav-icons">
       <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/jewellery_store/account/index.php" class="icon-label" title="My Account">
       <?php else: ?>
        <a href="/jewellery_store/auth/login.php" class="icon-label" title="Login">
       <?php endif; ?>
           <i class="fas fa-user"></i>
           <span>ACCOUNT</span>
        </a>


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



<!-- PRODUCTS LIST -->
 <section class="featured-products">
    <h2 class="products-page-title"><?php echo $pageTitle; ?></h2>

    <div class="product-grid">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
         <div class="product-card">

            <a href="product.php?id=<?php echo $row['id']; ?>">
                <img src="/jewellery_store/assets/images/<?php echo htmlspecialchars($row['image']); ?>" 
                    alt="<?php echo htmlspecialchars($row['name']); ?>">
            </a>

            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p class="price">€<?php echo htmlspecialchars($row['price']); ?></p>

        <div class="product-actions">
            <a href="add_to_wishlist.php?id=<?php echo $row['id']; ?>" class="wishlist-btn" title="Add to Wishlist">
                <i class="fas fa-heart"></i>
            </a>
            <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="add-to-cart-btn">
              Add to Cart
            </a>
        </div>

     </div>

        <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>

 </section>
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

<!-- POPUP BOX -->
<div id="popup" class="popup">Added!</div>

<!-- JAVASCRIPT -->
<script>
    document.querySelectorAll('.wishlist-btn i').forEach(icon => {
        icon.addEventListener('click', function(e) {
            this.classList.toggle('active');
            showPopup("Added to wishlist");
        });
    });

    function showPopup(message) {
        const popup = document.getElementById("popup");
        popup.textContent = message;
        popup.classList.add("show");

        setTimeout(() => {
            popup.classList.remove("show");
        }, 1500);
    }
</script>

</body>
</html>
