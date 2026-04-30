<?php
include("../config/db.php");

$success = false;
$error = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Name validation (no numbers)
    if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        $error = "Name should contain only letters";
    }
    // 2. Email validation
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }
    // 3. Password length check
    else if (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    }
    else {
        // 4. PASSWORD HASHING
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $query = "INSERT INTO users (name, email, password)
                  VALUES ('$name', '$email', '$hashedPassword')";

        if (mysqli_query($conn, $query)) {
            $success = true;   // ✅ trigger popup
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="auth-container register-bg">

    <form method="POST" class="auth-card">

        <h2>Create Account</h2>
        <p class="auth-subtitle">Join us and explore jewellery</p>

        <?php if (!empty($error)): ?>
            <p style="color:red; text-align:center; margin-bottom:10px;">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
        
        <input type="text"
           name="name"
           placeholder="Full Name"
           pattern="[A-Za-z\s]+"
           title="Name should contain only letters"
           required>

        <input type="email"
           name="email"
           placeholder="Email address"
           required>

        <input type="password"
           name="password"
           placeholder="Password (min 6 characters)"
           minlength="6"
           required>

        <button type="submit" name="register">Register</button>

        <p class="auth-footer"> 
             Already have an account?
        <a href="login.php">Login</a>
        </p>

    </form>

</div>

<?php if ($success): ?>
<!-- SUCCESS POPUP -->
<div id="successPopup" style="
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
">
    <div style="
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: popIn 0.3s ease;
    ">
        <h2 style="color:#2e7d32; margin-bottom:10px;">✅ Registration Successful!</h2>
        <p style="color:#555; margin-bottom:20px;">
            Your account has been created. You can now login.
        </p>
        <button onclick="goLogin()" style="
            padding: 10px 20px;
            background: #912c3d;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        ">
            Go to Login
        </button>
    </div>
</div>

<style>
@keyframes popIn {
    from { transform: scale(0.8); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}
</style>

<script>
function goLogin() {
    window.location.href = "login.php";
}
</script>
<?php endif; ?>

</body>
</html>
