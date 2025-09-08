<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Set username from session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Three-Wheel Services - Vithana Motors Garage</title>
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
            margin: 0;
            font-size: 32px;
            color: #ffcc00;
        }

        nav {
            background-color: #12395c;
            display: flex;
            justify-content: center;
            gap: 25px;
            padding: 15px 0;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
        }

        nav a:hover {
            color: #ffcc00;
        }

        .container {
            padding: 40px 20px;
        }

        .welcome {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
        }

        .section-title {
            font-size: 26px;
            color: #ffcc00;
            margin-bottom: 20px;
            text-align: center;
        }

        .service-card {
            background-color: #0d2c54;
            padding: 20px;
            border-radius: 12px;
            margin: 20px auto;
            max-width: 700px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .service-card h3 {
            margin-bottom: 10px;
            color: #ffffff;
        }

        .service-card p {
            color: #ddd;
            line-height: 1.6;
        }

        .btn-contact {
            display: block;
            width: fit-content;
            margin: 30px auto;
            background-color: #ffcc00;
            color: #0d2c54;
            padding: 12px 24px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .btn-contact:hover {
            background-color: #e6b800;
        }

        footer {
            background-color: #0d2c54;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
            color: #ccc;
        }
    </style>
</head>
<body>

<header>
    <h1>Vithana Motors Garage</h1>
</header>

<nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="threewheel_service.php">Services</a>
    <a href="feedback.php">Service Feedback</a>
    <a href="staff_status_dashboard.php">Staff Availability</a>
    <a href="notification.php">Notifications</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <div class="welcome">Welcome, <?php echo htmlspecialchars($username); ?> 👋</div>

    <div class="section-title">Three-Wheel Vehicle Services</div>

    <p style="text-align:center; max-width: 700px; margin: 0 auto 30px;">
        At <strong>Vithana Motors Garage</strong>, we specialize in the care and maintenance of three-wheel vehicles (tuk-tuks). Our dedicated service team ensures your three-wheeler stays reliable, efficient, and road-safe.
    </p>

    <div class="service-card">
        <h3>🛠️ General Maintenance</h3>
        <p>Includes oil change, brake check, fluid top-up, tire inspection, and basic tune-up to keep your three-wheeler running smoothly.</p>
    </div>

    <div class="service-card">
        <h3>🔧 Engine Repair & Tuning</h3>
        <p>From spark plug replacements to full engine diagnostics and repairs, we ensure optimal engine performance and fuel efficiency.</p>
    </div>

    <div class="service-card">
        <h3>🧰 Electrical System Check</h3>
        <p>Inspection and repair of wiring, battery systems, headlamps, turn signals, horns, and other vital electric parts.</p>
    </div>

    <div class="service-card">
        <h3>🚿 Full Body Wash & Paint Touch-Up</h3>
        <p>Professional washing, polishing, and touch-up painting for a showroom finish.</p>
    </div>

    <div class="service-card">
        <h3>📋 Roadworthiness Inspection</h3>
        <p>Comprehensive safety check to ensure your tuk-tuk is compliant with national transport regulations.</p>
    </div>

    <a href="contact.php" class="btn-contact">Book a Service</a>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html>
