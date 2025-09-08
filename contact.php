<?php
$feedback = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "garage_db"); 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name    = $conn->real_escape_string($_POST['name']);
    $email   = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        $feedback = "<p style='color: #00cc66;'>✅ Your message has been sent successfully.</p>";
    } else {
        $feedback = "<p style='color: #ff6666;'>❌ Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us – Vithana Motors Garage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #0a1d37;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
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
            max-width: 600px;
            margin: 50px auto;
            background-color: #12395c;
            padding: 30px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #ffcc00;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            background-color: #0d2c54;
            color: #fff;
            border-radius: 5px;
        }

        form input[type="submit"] {
            background-color: #ffcc00;
            color: #0a1d37;
            font-weight: bold;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #e6b800;
        }

        .feedback {
            text-align: center;
            margin-bottom: 15px;
        }

        footer {
            background-color: #0d2c54;
            text-align: center;
            padding: 15px;
            color: #ccc;
            margin-top: 60px;
        }

        .contact-details {
            text-align: center;
            margin-top: 30px;
            font-size: 15px;
            color: #ddd;
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
    <h2>Contact Us</h2>

    <div class="feedback"><?= $feedback ?></div>

    <form action="" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
        <input type="submit" value="Send Message">
    </form>

    <div class="contact-details">
        <p><strong>Phone:</strong> +94 77 123 4567</p>
        <p><strong>Email:</strong> info@vithanamotors.lk</p>
        <p><strong>Address:</strong> No. 45, Kandy Road, Nawalapitiya, Sri Lanka</p>
    </div>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html>
