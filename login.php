<?php
session_start();
include("../config/db.php");

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        

        if (
            $user['password'] === $password || 
            password_verify($password, $user['password'])
        ) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
       
     // 🔁 Redirect back to previous page if exists (e.g., checkout)
           if (isset($_SESSION['redirect_after_login'])) {
               $redirect = $_SESSION['redirect_after_login'];
               unset($_SESSION['redirect_after_login']);
               header("Location: ../" . $redirect);
               exit();
            }

            if ($user['role'] === 'admin') {
                header("Location: ../admin/index.php");
                exit();
            } else {
                header("Location: ../index.php");
                exit();
            }

        } else {
            $error = "Incorrect password!";
        }

    } else {
        $error = "Email not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>
 
<div class="auth-container">
    <form method="POST" class="auth-card">

        <h2>Welcome Back</h2>
        <p class="auth-subtitle">Login to continue</p>

        <input type="email" name="email" placeholder="Email address" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

        <p class="auth-footer">
            Don’t have an account?
            <a href="register.php">Register</a>
        </p>

    </form>
</div>

   
</body>
</html>

