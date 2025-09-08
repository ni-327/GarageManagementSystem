<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
require_once("config.php"); // Make sure this file defines $conn properly

// Check if username is set
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';

// Fetch counts
$customer_count = 0;
$vehicle_count = 0;
$job_count = 0;
$staff_count = 0;

if ($conn) {
    $customer_count = $conn->query("SELECT COUNT(*) AS count FROM customers")->fetch_assoc()['count'] ?? 0;
    $vehicle_count = $conn->query("SELECT COUNT(*) AS count FROM vehicles")->fetch_assoc()['count'] ?? 0;
    $job_count = $conn->query("SELECT COUNT(*) AS count FROM job_orders")->fetch_assoc()['count'] ?? 0;
    $staff_count = $conn->query("SELECT COUNT(*) AS count FROM staff")->fetch_assoc()['count'] ?? 0;
    $sparepart_count = $conn->query("SELECT COUNT(*) AS count FROM spare_parts")->fetch_assoc()['count'] ?? 0;
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Vithana Motors Garage</title>
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
            margin-bottom: 40px;
            font-size: 24px;
            color: #ffffff;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            padding: 0 20px;
        }

        .card {
            background-color: #0d2c54;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

        .card h3 {
            margin-bottom: 10px;
            color: #ffcc00;
        }

        .card p {
            font-size: 14px;
            color: #ddd;
        }

        footer {
            background-color: #0d2c54;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
            color: #ccc;
        }

        .logout-link {
            text-align: center;
            margin-top: 30px;
        }

        .logout-link a {
            color: #ff4c4c;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-link a:hover {
            text-decoration: underline;
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

    <div class="cards">
        <div class="card">
            <h3>Total Customers</h3>
            <p><?= $customer_count ?></p>
        </div>
        <div class="card">
            <h3>Total Vehicles</h3>
            <p><?= $vehicle_count ?></p>
        </div>
        <div class="card">
            <h3>Job Orders</h3>
            <p><?= $job_count ?></p>
        </div>
        <div class="card">
            <h3>Staff Members</h3>
            <p><?= $staff_count ?></p>
        </div>
        <div class="card">
            <h3>Sparepart Stock</h3>
            <p><?= $sparepart_count ?></p>
        </div>
    </div>

    <div class="logout-link">
        <a href="logout.php">Logout</a>
    </div>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html>
