<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5em;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        .nav {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
            margin: 0 10px;
        }

        .nav a:hover,
        .nav a.active {
            background-color: #1abc9c;
            color: #fff;
        }

        /* Content */
        .content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Widget */
        .widget {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-basis: calc(50% - 20px);
            box-sizing: border-box;
        }

        .widget h2 {
            margin-top: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .widget p {
            color: #666;
        }

        /* Footer */
        .footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="#" class="logo">User Dashboard</a>
        <div class="nav">
        <a href="../../landingpage.php" class="active">HOME</a>
            <a href="user_dashboard.php" class="active">Dashboard</a>
            <a href="profile.php">Profile</a>
            <a href="purchase_history.php">riwayat pembelian</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="content">
        <div class="widget">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
            <p>This is your user dashboard. You can view your profile, settings, and more.</p>
        </div>

        <div class="widget">
            <h2>Recent Activities</h2>
            <p>No recent activities.</p>
        </div>

        <div class="widget">
            <h2>Notifications</h2>
            <p>No notifications available.</p>
        </div>
    </div>

    <div class="footer">
        <p>User Dashboard - &copy; 2024</p>
    </div>
</body>
</html>
