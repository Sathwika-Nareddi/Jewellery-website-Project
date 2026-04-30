<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($result);

// Handle update profile
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id=$user_id");

    header("Location: settings.php?success=1");
    exit();
}

// Handle password change  ← PLACE IT HERE
if (isset($_POST['change_password'])) {

    $old = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Fetch current password
    $res = mysqli_query($conn, "SELECT password FROM users WHERE id = $user_id");
    $row = mysqli_fetch_assoc($res);

    if (!password_verify($old, $row['password'])) {
        $error = "Old password is incorrect";
    }
    elseif ($new !== $confirm) {
        $error = "New passwords do not match";
    }
    else {
        $hashed = password_hash($new, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password='$hashed' WHERE id=$user_id");

        header("Location: settings.php?password_updated=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Settings</title>
    <link rel="stylesheet" href="/jewellery_store/assets/style.css">
    <link rel="stylesheet" href="/jewellery_store/assets/settings.css"> 
</head>
<body>

<div class="settings-container">

    <h2>Account Settings</h2>
    <p class="subtitle">Update your profile details</p>

    <?php if (isset($error)): ?>
       <p class="settings-error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['password_updated'])): ?>
       <p class="settings-success">Password updated successfully!</p>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <p class="settings-success">Profile updated successfully!</p>
    <?php endif; ?>

    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <button type="submit" name="update_profile">Update Profile</button>
    </form>
    <hr style="margin:30px 0;">

    <h3 class="password-title">Change Password</h3>

    <form method="POST">
      <label>Old Password</label>
      <input type="password" name="old_password" required>

      <label>New Password</label>
      <input type="password" name="new_password" required>

      <label>Confirm New Password</label>
      <input type="password" name="confirm_password" required>

      <button type="submit" name="change_password">Update Password</button>
    </form>
    <div class="back-link">
        <a href="index.php">⬅ Back to Account</a>
    </div>

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