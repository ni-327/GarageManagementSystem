<?php
// Handle form submission
$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "garage_db"); // update db name if needed

    if ($conn->connect_error) {
        $error = "Database connection failed!";
    } else {
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $message = $conn->real_escape_string($_POST["message"]);

        $sql = "INSERT INTO feature_requests (name, email, message) VALUES ('$name', '$email', '$message')";

        if ($conn->query($sql)) {
            $success = "Feature request submitted successfully!";
        } else {
            $error = "Error submitting request: " . $conn->error;
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Features – Vithana Motors Garage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #0a1d37;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        header {
            background-color: #0d2c54;
            padding: 20px;
            text-align: center;
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
        }

        nav a:hover {
            color: #ffcc00;
        }

        .container {
            padding: 40px 20px;
            max-width: 900px;
            margin: auto;
        }

        ul {
            list-style: none;
            padding-left: 0;
            line-height: 2;
        }

        li::before {
            content: "✔️ ";
        }

        .cart-button {
            background-color: #ffcc00;
            color: #0a1d37;
            font-weight: bold;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .cart-button:hover {
            background-color: #e6b800;
        }

        form {
            margin-top: 60px;
            background-color: #12395c;
            padding: 30px;
            border-radius: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            background-color: #0d2c54;
            border: none;
            color: #fff;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ffcc00;
            color: #0a1d37;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #e6b800;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .success {
            background-color: #28a745;
            color: #fff;
        }

        .error {
            background-color: #dc3545;
            color: #fff;
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
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="signup.php">Sign Up</a>
    <a href="features.php">Features</a>
    <a href="contact.php">Contact</a>
    <a href="admin/admin_login.php">Admin Panel</a>
    <a href="staff/login_staff.php">Staff Panel</a>
</nav>

<div class="container">
    <h2>System Features</h2>
    <ul>
        <li>Customer Management – Add, edit, delete customer details</li>
        <li>Vehicle Management – Track vehicle and job order history</li>
        <li>Job Orders – Assign, monitor and update job status</li>
        <li>Service Packages – Manage and track work progress</li>
        <li>Staff Management – Administer staff roles</li>
        <li>Invoices & Payments – Generate and print bills</li>
        <li>Spare Parts Inventory – Stock usage tracking</li>
        <li>Reports – Monthly and daily printable reports</li>
        <li>Secure Admin Panel – With access control</li>
    </ul>

    <a class="cart-button" href="#requestForm">🛒 Request a Feature</a>

    <?php if ($success): ?>
        <div class="message success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="message error"><?= $error ?></div>
    <?php endif; ?>

    <!-- Scroll target form -->
    <form id="requestForm" action="" method="POST">
        <h3>Feature Request Form</h3>
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" rows="5" placeholder="What feature would you like to see?" required></textarea>
        <input type="submit" value="Submit Request">
    </form>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html>
