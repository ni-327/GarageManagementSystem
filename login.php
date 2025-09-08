<?php
session_start();
include("config.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "User not found!";
        }
    } else {
        $error = "Please enter email and password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Vithana Motors Garage</title>
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

        .login-box {
            background-color: #0d2c54;
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #ffcc00;
        }

        .login-box input[type="text"],
        .login-box input[type="email"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background: #ffffff;
            color: #000;
            font-size: 15px;
        }

        .login-box input[type="submit"] {
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

        .login-box input[type="submit"]:hover {
            background-color: #e6b800;
        }

        .error {
            color: #ff4c4c;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .signup-link a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link a:hover {
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
    <div class="login-box">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="email" name="email" placeholder="Enter your Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" value="Login">
        </form>

        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html> 