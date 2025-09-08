<?php
include 'config.php';

// Fetch staff and their current jobs if in progress
$query = "
    SELECT 
        s.id AS staff_id,
        s.full_name,
        s.role,
        j.id AS job_id,
        v.vehicle_no,
        j.job_status,
        j.job_description
    FROM staff s
    LEFT JOIN job_orders j 
        ON s.id = j.staff_id AND j.job_status = 'In Progress'
    LEFT JOIN vehicles v
        ON j.vehicle_id = v.id
    ORDER BY s.full_name
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Staff Availability - Vithana Motors Garage</title>
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

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ffffff;
        }

        .staff-card {
            background-color: #112d5c;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(255,255,255,0.1);
        }

        .available {
            color: #00ff99;
            font-weight: bold;
        }

        .busy {
            color: #ff4444;
            font-weight: bold;
        }

        .label {
            font-weight: bold;
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
    <h2>Staff Availability & Current Jobs</h2>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="staff-card">
            <div><span class="label">Name:</span> <?= htmlspecialchars($row['full_name']) ?></div>
            <div><span class="label">Role:</span> <?= htmlspecialchars($row['role']) ?></div>

            <?php if ($row['job_id']): ?>
                <div class="busy">Status: Busy with Job #<?= $row['job_id'] ?></div>
                <div><span class="label">Vehicle:</span> <?= htmlspecialchars($row['vehicle_no']) ?></div>
                <div><span class="label">Job Description:</span> <?= htmlspecialchars($row['job_description']) ?></div>
            <?php else: ?>
                <div class="available">Status: Available</div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>

    <?php $conn->close(); ?>
</div>

<footer>
    &copy; <?= date("Y") ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html>
