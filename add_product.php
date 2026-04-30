<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}


if (isset($_POST['add_product'])) {

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../assets/images/" . $image);

    $query = "INSERT INTO products 
    (name, gender, category, type, price, description, image)
    VALUES 
    ('$name', '$gender', '$category', '$type', '$price', '$description', '$image')";

    if (mysqli_query($conn, $query)) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Jewellery Product</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body style="margin:0;min-height:100vh; display:flex; flex-direction:column;">
<div style="flex:1;">
 <div class="admin-form-container">
    <h2>Add Jewellery Product</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="name" placeholder="Product Name" required>

        <!-- Gender -->
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Men">Men</option>
            <option value="Women">Women</option>
        </select>

        <!-- Category -->
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="Rings">Rings</option>
            <option value="Pendants">Pendants</option>
            <option value="Bracelets">Bracelets</option>
            <option value="Earrings">Earrings</option>
            <option value="Anklets">Anklets</option>
            <option value="Bangles">Bangles</option>
        </select>

        <!-- Material -->
        <select name="type" required>
            <option value="">Select Material</option>
            <option value="Gold">Gold</option>
            <option value="Silver">Silver</option>
            <option value="Diamond">Diamond</option>
        </select>

        <input type="number" name="price" placeholder="Price" required>

        <textarea name="description" placeholder="Add Product Description"></textarea>

        <input type="file" name="image" required>

        <button type="submit" name="add_product">Add Product</button>

    </form>
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
