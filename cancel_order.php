<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Order ID missing.");
}

$order_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

// Make sure this order belongs to user and is still Placed
$result = mysqli_query($conn, "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id AND status = 'Placed'");

if (mysqli_num_rows($result) == 0) {
    die("You cannot cancel this order.");
}

// Update status to Cancelled
mysqli_query($conn, "UPDATE orders SET status = 'Cancelled' WHERE id = $order_id");

header("Location: orders.php");
exit();
