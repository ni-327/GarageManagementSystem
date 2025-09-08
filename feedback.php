<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "garage_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert feedback
if (isset($_POST['submit'])) {
    $name = $_POST['customer_name'];
    $service = $_POST['service_received'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    $stmt = $conn->prepare("INSERT INTO feedback (customer_name, service_received, rating, comments) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $service, $rating, $comments);
    $stmt->execute();
    $stmt->close();
}

// Delete feedback
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM feedback WHERE id = $id");
}

// Username
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Feedback - Vithana Motors Garage</title>
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
            color: #00bcd4;
            margin-bottom: 15px;
        }

        form {
            background-color: #12263a;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        button {
            background-color: #00bcd4;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #12263a;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #1f3b5c;
            text-align: left;
        }

        th {
            background-color: #0f2a44;
        }

        a.delete-btn {
            color: #f44336;
            text-decoration: none;
        }

        a.delete-btn:hover {
            text-decoration: underline;
        }

        .welcome {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
            color: #ffffff;
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

    <h2>Leave Feedback</h2>
    <form method="post">
        <label for="customer_name">Your Name</label>
        <input type="text" name="customer_name" required>

        <label for="service_received">Service Received</label>
        <input type="text" name="service_received" required>

        <label for="rating">Rating (1 - 5)</label>
        <select name="rating" required>
            <option value="">Select</option>
            <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
        </select>

        <label for="comments">Comments</label>
        <textarea name="comments" rows="4" required></textarea>

        <button type="submit" name="submit">Submit Feedback</button>
    </form>

    <h2>Customer Feedback</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Service</th>
            <th>Rating</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM feedback ORDER BY feedback_date DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['service_received']}</td>
                    <td>{$row['rating']}</td>
                    <td>{$row['comments']}</td>
                    <td>{$row['feedback_date']}</td>
                    <td><a class='delete-btn' href='?delete={$row['id']}' onclick=\"return confirm('Delete this feedback?')\">Delete</a></td>
                </tr>";
        }
        ?>
    </table>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Vithana Motors Garage. All rights reserved.
</footer>

</body>
</html>
