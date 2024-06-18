<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
$host = 'localhost';
$dbname = 'toko_laptop';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'user'");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px 20px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between; 
            align-items: center;
            position: relative;
            z-index: 999; 
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

        .sidebar {
            width: 250px;
            background: #34495e; 
            color: #f2f2f2;
            height: 100vh;
            position: fixed;
            left: -250px; 
            top: 60px; 
            transition: left 0.3s ease;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar a {
            display: block;
            color: #f2f2f2;
            padding: 15px 20px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin: 10px 0;
        }

        .sidebar a:hover {
            background-color: #1abc9c;
        }

        .sidebar .logo {
            text-align: center;
            padding: 20px 0;
            font-size: 1.8rem;
            font-weight: bold;
            border-bottom: 1px solid #4a627a;
            margin-bottom: 20px;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            margin-top: 60px; 
            padding: 20px;
            flex: 1; 
            transition: margin-left 0.3s ease;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            width: 100%;
            margin-top: auto;
        }

        .toggle-btn {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .toggle-btn:hover {
            background-color: #1abc9c;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                left: 0;
                top: 0;
            }

            .content {
                margin-left: 0;
                margin-top: 0;
                width: 100%;
                padding: 10px; 
                box-sizing: border-box;
            }

            .header {
                padding-left: 10px; 
                padding-right: 10px; 
            }

            .toggle-btn {
                display: block;
                margin-right: 10px; 
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <button class="toggle-btn" onclick="toggleSidebar()">&#9776;</button>
        <a href="#" class="logo">Admin Dashboard</a>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="logo">Admin</div>
        <a href="admin_dashboard.php">Home</a>
        <a href="../../landingpage.php">Homepage</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_product.php">Manage Products</a>
        <a href="manage_sales.php" class="active">Manage Sales</a>
        <a href="view_messages.php" class="active">lihat pesan</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Manage Users</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a> | 
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p><a href="add_user.php">Add New User</a></p>
    </div>

    <div class="footer">
        <p>Admin Dashboard with Styled Sidebar - &copy; 2024</p>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
