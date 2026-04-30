<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_GET['id'])) {
    
    die("No product selected");
}

$id = (int) $_GET['id'];

// Add or increase quantity
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]++;
} else {
    $_SESSION['cart'][$id] = 1;
}

// Redirect back to cart
header("Location: cart.php");
exit();
