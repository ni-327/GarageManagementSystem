<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vithana Motors Garage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* styles remain unchanged */
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #0a1d37;
            color: #fff;
        }
        header {
            background-color: #0d2c54;
            padding: 20px;
            text-align: center;
        }
        header h1 {
            font-size: 36px;
            color: #ffffff;
            margin: 0;
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
        .hero {
            text-align: center;
            padding: 80px 20px;
        }
        .hero h2 {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ffcc00;
        }
        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #cccccc;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn {
            background-color: #ffcc00;
            color: #0a1d37;
            padding: 14px 28px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #e6b800;
        }
        .illustration {
            margin-top: 40px;
        }
        .illustration img {
            max-width: 600px;
            width: 90%;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
        footer {
            background-color: #0d2c54;
            text-align: center;
            padding: 15px;
            color: #ccc;
            margin-top: 60px;
        }
    </style>
</head>
<body>

<header>
    <h1>Vithana Motors Garage</h1>
</header>

<nav>
    <nav>
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="signup.php">Sign Up</a>
    <a href="features.php">Features</a>
    <a href="contact.php">Contact</a>
    <a href="admin/admin_login.php">Admin Panel</a>
    <a href="staff/login_staff.php">Staff Panel</a>
</nav>

    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <a href="admin/">Admin Panel</a>
    <?php endif; ?>
</nav>

<div class="hero">
    <h2>Reliable Auto Service Management</h2>
    <p>Manage customers, vehicles, job orders, staff, inventory, and invoices in one unified platform designed for your garage's efficiency and success.</p>
    <a href="login.php" class="btn">Get Started</a>

    <div class="illustration">
        <img src="assets/images/garage illustrations.jpg" alt="Garage Illustration">
    </div>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html> 