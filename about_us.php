<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - TARA Jewellery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .about-container {
            max-width: 900px;
            margin: 60px auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .about-container h1 {
            text-align: center;
            color: #912c3d;
            margin-bottom: 10px;
        }

        .about-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .about-container p {
            line-height: 1.7;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .about-highlight {
            background: #f9f1f3;
            padding: 20px;
            border-left: 5px solid #912c3d;
            margin: 25px 0;
            border-radius: 5px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #912c3d;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="about-container">
    <h1> 𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊</h1>
    <p class="about-subtitle">Timeless Jewellery for Every Moment</p>

    <p>
        Welcome to <strong>𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊</strong>, your destination for elegant and timeless jewellery.
        We offer a beautiful collection of rings, chains, bracelets, anklets, and more, designed to
        make every moment special.
    </p>

    <p>
        Our goal is to provide high-quality jewellery that combines style, beauty, and affordability.
        Whether you are shopping for yourself or for someone special, we believe jewellery should
        always feel meaningful and memorable.
    </p>

    <div class="about-highlight">
        <p>
            At 𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊, we focus on quality, customer satisfaction, and modern designs.
            We carefully select our collections to match different styles and occasions.
        </p>
    </div>

    <p>
        Thank you for choosing 𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊. We hope you enjoy your shopping experience with us!
    </p>

    <a href="index.php" class="back-link">← Back to Home</a>
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
                <li><a href="/jewellery_store/track_order.php"style="color:#ddd; text-decoration:none; font-size:14px;">Track My Order</a></li>
                <li><a href="/jewellery_store/help.php"style="color:#ddd; text-decoration:none; font-size:14px;">Help</a></li>
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
