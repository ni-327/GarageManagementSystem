<?php
session_start();
include("config.php");

$customer_id = $_SESSION['user_id']; // Ensure user is logged in

$stmt = $conn->prepare("SELECT message, status, created_at FROM notifications WHERE customer_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications - Vithana Motors Garage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #0a1d37;
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background-color: #0d2c54;
            text-align: center;
            padding: 20px;
        }

        header h1, footer p {
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
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffcc00;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #0d2c54;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.05);
        }

        h2 {
            color: #ffcc00;
            text-align: center;
            margin-bottom: 25px;
        }

        ul.notification-list {
            list-style: none;
            padding: 0;
        }

        ul.notification-list li {
            background-color: #12395c;
            padding: 18px 20px;
            margin-bottom: 15px;
            border-left: 5px solid #ffcc00;
            border-radius: 6px;
            transition: background 0.3s;
        }

        ul.notification-list li:hover {
            background-color: #1c4b75;
        }

        .new-badge {
            color: #ffcc00;
            font-weight: bold;
            margin-right: 10px;
        }

        small.timestamp {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: #bbb;
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
    <h2>Your Notifications</h2>
    <ul class="notification-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <?php if ($row['status'] === 'unread'): ?>
                        <span class="new-badge">[NEW]</span>
                    <?php endif; ?>
                    <?php echo htmlspecialchars($row['message']); ?>
                    <small class="timestamp"><?php echo $row['created_at']; ?></small>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No notifications found.</li>
        <?php endif; ?>
    </ul>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.</p>
</footer>

</body>
</html>
