<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include '../config.php';

$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan riwayat pembelian
$stmt = $conn->prepare("SELECT product_id, name, address, phone, order_date FROM orders WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
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

        .history-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
        }

        .history-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .history-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-container table th,
        .history-container table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .history-container table th {
            background-color: #f8f8f8;
        }

        .history-container .back-link {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        .history-container .back-link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .history-container .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="history-container">
    <h2>Purchase History</h2>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Order Date</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo htmlspecialchars($order['product_id']); ?></td>
            <td><?php echo htmlspecialchars($order['name']); ?></td>
            <td><?php echo htmlspecialchars($order['address']); ?></td>
            <td><?php echo htmlspecialchars($order['phone']); ?></td>
            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="back-link">
        <p><a href="user_dashboard.php">Back to Dashboard</a></p>
    </div>
</div>
</body>
</html>
