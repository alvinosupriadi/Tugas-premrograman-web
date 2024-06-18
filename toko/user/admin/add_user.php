<?php
session_start();
// Cek apakah pengguna sudah login sebagai admin, jika tidak, redirect ke halaman login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$dbname = 'toko_laptop';
$username = 'root';
$password = '';

try {
    // Buat koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set mode error PDO ke mode error exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Jika form disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        // Query untuk menambahkan pengguna baru
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            $success_message = "User added successfully!";
        } else {
            $error_message = "Failed to add user.";
        }
    }
} catch (PDOException $e) {
    // Tangani kesalahan koneksi
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
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
            padding: 10px 20px; /* Adjust padding for toggle button */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between; /* Spasi antara logo dan item navigasi */
            align-items: center;
            position: relative;
            z-index: 999; /* Pastikan header berada di atas sidebar */
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

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #34495e; /* Latar belakang gelap */
            color: #f2f2f2;
            height: 100vh;
            position: fixed;
            left: -250px; /* Sidebar posisi default tersembunyi */
            top: 60px; /* Tinggi dari header */
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

        /* Content */
        .content {
            margin-left: 250px;
            margin-top: 60px; /* Tinggi dari header */
            padding: 20px;
            flex: 1; /* Mengisi ruang vertikal yang tersisa */
            transition: margin-left 0.3s ease;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .widget {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-basis: 100%;
            box-sizing: border-box;
        }

        .widget h2 {
            margin-top: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group button {
            padding: 10px 15px;
            background-color: #2ecc71;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #27ae60;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
        }

        .success {
            background-color: #2ecc71;
        }

        .error {
            background-color: #e74c3c;
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

        /* Toggle Button */
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
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="manage_sales.php">Manage Sales</a>
        <a href="view_messages.php">View Messages</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <div class="widget">
            <h2>Add New User</h2>
            <?php if (isset($success_message)): ?>
                <div class="message success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <div class="message error"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Add User</button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <p>Admin Dashboard - &copy; 2024</p>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
