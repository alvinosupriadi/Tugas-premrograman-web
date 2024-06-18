<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli Produk - Toko Laptop</title>
    
    <link rel="stylesheet" href="css/header.css">
    
    <link rel="stylesheet" href="css/transaksi.css">
    <script>
        function showSuccess() {
            alert('Transaksi berhasil!');
            window.location.href = 'detail_transaksi.php?id=<?php echo htmlspecialchars($_GET['id']); ?>';
        }

        function submitForm() {
            document.getElementById('checkoutForm').submit();
        }
    </script>
</head>
<body>
    <header>
    <nav class="main-nav">
        <div class="logo">Toko Laptop</div>
           
           <ul class="nav">
               <?php
               session_start();
                   if (isset($_SESSION['username'])) {
                       echo '<li><a href="user/users/user_dashboard.php"><span class="username">' . $_SESSION['username'] . '</span></a></li>';
                       echo '<li><a href="user/logout.php">Log Out</a></li>';
                   } else {
                       echo '<li><a href="user/login.php">Log In</a></li>';
                   }
               ?>
               <li class="dropdown">
                   <a href="javascript:void(0)" class="dropbtn">MENU</a>
                   <div class="dropdown-content">
                       <ul>
                       <li ><a href="index.php">Home</a></li>
                            <li><a href="produk.php">Produk</a></li>
                            <li><a href="kontak.php">Kontak</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="chatboot/chatbot.html">bantuan</a></li>
                       </ul> 
                   </div>
               </li>
           </ul>      
       </nav>
    </header>
    <main>
        <h2>Detail Produk</h2>
        <div id="product-detail">
            <?php

            if (!isset($_SESSION['user_id'])) {
                header('Location: user/login.php');
                exit;
            }

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $host = 'localhost';
                $db = 'toko_laptop';
                $user = 'root';
                $pass = '';

                $conn = new mysqli($host, $user, $pass, $db);

                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM products WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="product-item">';
                    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                    echo '<p>Rp ' . number_format($row['price'], 0, ',', '.') . '</p>';
                    echo '<p>' . htmlspecialchars($row['spek']) . '</p>';
                    echo '</div>';
                    echo '<form id="checkoutForm" action="proses_pembelian.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($_SESSION['user_id']) . '">';
                    echo '<label for="name">Nama:</label>';
                    echo '<input type="text" id="name" name="name" required>';
                    echo '<label for="address">Alamat:</label>';
                    echo '<textarea id="address" name="address" required></textarea>';
                    echo '<label for="phone">Nomor Telepon:</label>';
                    echo '<input type="tel" id="phone" name="phone" required>';
                    echo '<button type="submit" class="btn">Lanjutkan Pembelian</button>';
                    echo '</form>';
                } else {
                    echo '<p>Produk tidak ditemukan.</p>';
                }

                $conn->close();
            } else {
                echo '<p>ID produk tidak disediakan.</p>';
            }
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Toko Laptop</p>
    </footer>
</body>
</html>
