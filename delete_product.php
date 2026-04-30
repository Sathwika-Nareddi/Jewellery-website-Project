<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

if (!isset($_GET['id'])) {
    die("No product ID");
}

$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM products WHERE id = $id");

header("Location: manage_products.php");
exit;
