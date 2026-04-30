<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - 𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .contact-container {
            max-width: 900px;
            margin: 60px auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .contact-container h1 {
            text-align: center;
            color: #912c3d;
            margin-bottom: 10px;
        }

        .contact-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .contact-container p {
            line-height: 1.7;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .contact-box {
            background: #f9f1f3;
            padding: 20px;
            border-left: 5px solid #912c3d;
            margin: 25px 0;
            border-radius: 5px;
        }

        .contact-item {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .contact-item strong {
            color: #912c3d;
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

<div class="contact-container">
    <h1>Contact Us</h1>
    <p class="contact-subtitle">We’d love to hear from you</p>

    <p>
        If you have any questions about our products, orders, or services, feel free to contact us.
        Our team at <strong>𝕋𝔸ℝ𝔸 𝕁𝔼𝕎𝔼𝕃𝕃𝔼ℝ𝕊</strong> is always happy to help you.
    </p>

    <div class="contact-box">
        <div class="contact-item">
            <strong>📍 Address:</strong>562 Begumbazar Road, street 32,Hyderabad, India
        </div>
        <div class="contact-item">
            <strong>📞 Phone:</strong> +91 9876517044
        </div>
        <div class="contact-item">
            <strong>📧 Email:</strong> support@tara.com
        </div>
        <div class="contact-item">
            <strong>⏰ Working Hours:</strong> 10:00 AM – 6:00 PM (Mon – Sat)
        </div>
    </div>

    <p>
        We try our best to respond to all queries as soon as possible. Thank you for shopping with us!
    </p>

    <a href="index.php" class="back-link">← Back to Home</a>
</div>

</body>
</html>
