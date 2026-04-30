<?php
session_start();
include("config/db.php");


if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = "checkout.php";
    header("Location: auth/login.php");
    exit();
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Your cart is empty.");
}

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];

// Fetch products
$ids = implode(",", array_keys($cart));
$result = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids)");

$total = 0;
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
    $total += $row['price'] * $cart[$row['id']];
}

// Place order

if (isset($_POST['place_order'])) {
   $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $house_no = mysqli_real_escape_string($conn, $_POST['house_no']);
   $street = mysqli_real_escape_string($conn, $_POST['street']);
   $city = mysqli_real_escape_string($conn, $_POST['city']); 
   $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
   $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // Insert into orders table
   mysqli_query($conn, "INSERT INTO orders 
   (user_id, total, status, full_name, phone, house_no, street, city, pincode, payment_method) 
   VALUES 
   ($user_id, $total, 'Placed', '$full_name', '$phone', '$house_no', '$street', '$city', '$pincode', '$payment_method')");
   

    $order_id = mysqli_insert_id($conn);

    // Insert order items
    foreach ($products as $product) {
        $pid = $product['id'];
        $price = $product['price'];
        $qty = $cart[$pid];

        mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, price, quantity)
                              VALUES ($order_id, $pid, $price, $qty)");
    }

    // Clear cart
    unset($_SESSION['cart']);

    // Redirect to My Orders
    header("Location: account/orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="/jewellery_store/assets/style.css">
</head>
<body>

<h2 class="checkout-title">Checkout</h2>


<table class="checkout-table">

    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>

    <?php foreach ($products as $product): 
        $qty = $cart[$product['id']];
        $subtotal = $product['price'] * $qty;
    ?>
    <tr>
        <td><?php echo htmlspecialchars($product['name']); ?></td>
        <td>€<?php echo $product['price']; ?></td>
        <td><?php echo $qty; ?></td>
        <td>€<?php echo $subtotal; ?></td>
    </tr>
    <?php endforeach; ?>

    <tr>
        <td colspan="3" align="right"><strong>Total</strong></td>
        <td><strong>€<?php echo $total; ?></strong></td>
    </tr>
</table>

<form method="POST" class="checkout-form">


    <h3>Delivery Details</h3>
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <input type="text" name="house_no" placeholder="House / Flat No" required>
    <input type="text" name="street" placeholder="Street" required>
    <input type="text" name="city" placeholder="City" required>
    <input type="text" name="pincode" placeholder="Pincode" required>

    <h3>Payment Method</h3>

    <label>
        <input type="radio" name="payment_method" value="COD" checked> Cash on Delivery
    </label><br>

    <label>
        <input type="radio" name="payment_method" value="CARD"> Card Payment
    </label><br><br>

   <div id="card-fields" class="card-fields">

        <input type="text" name="card_name" placeholder="Name on Card" style="width:100%; margin-bottom:10px;">
        <input type="text" name="card_number" placeholder="Card Number" style="width:100%; margin-bottom:10px;">
        <input type="text" name="expiry" placeholder="MM/YY" style="width:48%; margin-bottom:10px;">
        <input type="text" name="cvv" placeholder="CVV" style="width:48%; margin-bottom:10px;">
    </div>
<button type="submit" name="place_order" class="place-order-btn">Place Order</button>

</form>

<script>
const radios = document.querySelectorAll('input[name="payment_method"]');
const cardFields = document.getElementById('card-fields');

radios.forEach(radio => {
    radio.addEventListener('change', () => {
        if (radio.value === "CARD" && radio.checked) {
            cardFields.style.display = "block";
        } else if (radio.value === "COD" && radio.checked) {
            cardFields.style.display = "none";
        }
    });
});
</script>


</body>
</html>
