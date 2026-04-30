<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = (int) $_GET['id'];

// Check if already in wishlist
$check = mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id=$user_id AND product_id=$product_id");

if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn, "INSERT INTO wishlist (user_id, product_id) VALUES ($user_id, $product_id)");
}

// Go back to previous page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
