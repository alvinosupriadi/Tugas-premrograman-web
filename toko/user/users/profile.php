<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include '../config.php';

$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan informasi pengguna
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$username = $user['username'];
$email = $user['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .profile-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .profile-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .profile-container p {
            font-size: 16px;
            color: #666;
        }

        .profile-container .back-link {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        .profile-container .back-link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .profile-container .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="profile-container">
    <h2>User Profile</h2>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
    <div class="back-link">
        <p><a href="user_dashboard.php">Back to Dashboard</a></p>
    </div>
</div>
</body>
</html>
