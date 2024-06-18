<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard with Toggle Sidebar (Styled)</title>
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

        /* Widget */
        .widget {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-basis: calc(50% - 20px); /* Layout dua kolom dengan jarak */
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

        /* Responsif */
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
                padding: 10px; /* Sesuaikan padding untuk layar kecil */
                box-sizing: border-box;
            }

            .header {
                padding-left: 10px; /* Padding kiri dikurangi untuk membuat ruang bagi toggle button */
                padding-right: 10px; /* Padding kanan disesuaikan dengan padding utama */
            }

            .toggle-btn {
                display: block;
                margin-right: 10px; /* Spasi kanan untuk toggle button */
            }

            .widget {
                flex-basis: 100%; /* Lebar penuh untuk satu kolom pada layar yang lebih kecil */
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
        <a href="manage_products.php">Manage Products</a>
        <a href="manage_sales.php" class="active">Manage Sales</a>
        <a href="logout.php">Logout</a>
    </div>


    <div class="content">
        <div class="widget">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
            <p>This is your admin dashboard. You can manage users, products, orders, and settings here.</p>
        </div>

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
