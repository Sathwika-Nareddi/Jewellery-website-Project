<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help & Support - 𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .help-container {
            max-width: 900px;
            margin: 60px auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .help-container h1 {
            text-align: center;
            color: #912c3d;
            margin-bottom: 10px;
        }

        .help-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .faq {
            margin-bottom: 25px;
        }

        .faq h3 {
            color: #912c3d;
            margin-bottom: 5px;
        }

        .faq p {
            line-height: 1.6;
            margin: 0;
            color: #444;
        }

        .support-box {
            margin-top: 30px;
            padding: 20px;
            background: #f9f1f3;
            border-left: 5px solid #912c3d;
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

<div class="help-container">
    <h1>Help & Support</h1>
    <p class="help-subtitle">We are here to help you</p>

    <div class="faq">
        <h3>❓ How do I place an order?</h3>
        <p>
            Browse products, add them to your cart, and click on Checkout to place your order.
        </p>
    </div>

    <div class="faq">
        <h3>❓ How can I view my orders?</h3>
        <p>
            Go to your Account page and click on "My Orders" to see all your orders.
        </p>
    </div>

    <div class="faq">
        <h3>❓ Can I cancel my order?</h3>
        <p>
            You can cancel your order if it is not yet shipped. Please contact support for help.
        </p>
    </div>

    <div class="faq">
        <h3>❓ What payment methods are available?</h3>
        <p>
            Currently, we support Cash on Delivery and Card payment.
        </p>
    </div>

    <div class="support-box">
        <p>
            If you still need help, please visit our 
            <a href="contact_us.php" style="color:#912c3d; font-weight:bold;">Contact Us</a> page.
        </p>
    </div>

    <a href="index.php" class="back-link">← Back to Home</a>
</div>

</body>
</html>
