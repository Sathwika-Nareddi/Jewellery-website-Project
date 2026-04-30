<?php
session_start();
include("../config/db.php");

// Only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

$message = "";
$success = false;

if (isset($_POST['add_admin'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Hash password
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insert new admin
    $sql = "INSERT INTO users (name, email, password, role) 
            VALUES ('$name', '$email', '$hashed', 'admin')";

    if (mysqli_query($conn, $sql)) {
        $message = "✅ New admin added successfully!";
        $success = true;
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Admin</title>
</head>
<body style="
    margin:0;
    padding:0;
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg, #1a1a1a, #3a0f1a);
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
">

<div style="
    width:100%;
    max-width:420px;
    background:#fff;
    padding:25px 30px;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
">

    <h2 style="
        text-align:center;
        margin-bottom:20px;
        color:#912c3d;
    ">
        Add New Admin
    </h2>

    <?php if ($message): ?>
        <div style="
            margin-bottom:15px;
            padding:10px;
            border-radius:6px;
            font-size:14px;
            color: <?php echo $success ? '#155724' : '#721c24'; ?>;
            background-color: <?php echo $success ? '#d4edda' : '#f8d7da'; ?>;
            border:1px solid <?php echo $success ? '#c3e6cb' : '#f5c6cb'; ?>;
        ">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label style="display:block; margin-bottom:6px; font-weight:bold; color:#333;">
            Full Name
        </label>
        <input type="text" name="name" required
               placeholder="Enter full name"
               style="
                width:100%;
                padding:10px;
                margin-bottom:15px;
                border:1px solid #ccc;
                border-radius:6px;
                font-size:14px;
               ">

        <label style="display:block; margin-bottom:6px; font-weight:bold; color:#333;">
            Email
        </label>
        <input type="email" name="email" required
               placeholder="Enter email address"
               style="
                width:100%;
                padding:10px;
                margin-bottom:15px;
                border:1px solid #ccc;
                border-radius:6px;
                font-size:14px;
               ">

        <label style="display:block; margin-bottom:6px; font-weight:bold; color:#333;">
            Password
        </label>
        <input type="password" name="password" required
               placeholder="Enter password"
               style="
                width:100%;
                padding:10px;
                margin-bottom:10px;
                border:1px solid #ccc;
                border-radius:6px;
                font-size:14px;
               ">

        <button type="submit" name="add_admin"
                style="
                    width:100%;
                    padding:12px;
                    background:#912c3d;
                    color:#fff;
                    border:none;
                    border-radius:6px;
                    font-size:16px;
                    cursor:pointer;
                ">
            ➕ Add Admin
        </button>

    </form>

    <div style="text-align:center; margin-top:20px;">
        <a href="index.php" style="
            text-decoration:none;
            color:#333;
            font-size:14px;
        ">
            ⬅ Back to Admin Dashboard
        </a>
    </div>

</div>

</body>
</html>
