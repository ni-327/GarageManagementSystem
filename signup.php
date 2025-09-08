<?php
session_start();
include("config.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (!empty($name) && !empty($email) && !empty($password) && !empty($confirm_password)) {
        if ($password !== $confirm_password) {
            $error = "Passwords do not match!";
        } else {
            $checkEmail = "SELECT id FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $checkEmail);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $error = "Email is already registered!";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $insertQuery = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $insertQuery);
                mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);

                if (mysqli_stmt_execute($stmt)) {
                    $success = "Signup successful! You can now <a href='login.php'>Login</a>.";
                } else {
                    $error = "Something went wrong. Please try again.";
                }
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Vithana Motors Garage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background-color: #0a1d37;
            color: white;
        }

        header {
            background-color: #0d2c54;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 32px;
            margin: 0;
            color: #fff;
        }

        nav {
            background-color: #12395c;
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 15px 0;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
        }

        nav a:hover {
            color: #ffcc00;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 40px 20px;
        }

        .signup-box {
            background-color: #0d2c54;
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .signup-box h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #ffcc00;
        }

        .signup-box input[type="text"],
        .signup-box input[type="email"],
        .signup-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background: #ffffff;
            color: #000;
            font-size: 15px;
        }

        .signup-box input[type="submit"] {
            width: 100%;
            background-color: #ffcc00;
            color: #0a1d37;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .signup-box input[type="submit"]:hover {
            background-color: #e6b800;
        }

        .error, .success {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .error {
            color: #ff4c4c;
        }

        .success {
            color: #66ff66;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #0d2c54;
            text-align: center;
            padding: 15px;
            color: #ccc;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <h1>Vithana Motors Garage</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="signup.php">Sign Up</a>
    <a href="features.php">Features</a>
    <a href="contact.php">Contact</a>
    <a href="admin/admin_login.php">Admin Panel</a>
    <a href="staff/login_staff.php">Staff Panel</a>
</nav>

<div class="container">
    <div class="signup-box">
        <h2>Create Account</h2>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" value="Sign Up">
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html>
