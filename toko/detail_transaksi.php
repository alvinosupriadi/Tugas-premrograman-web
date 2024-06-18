<?php
$host = 'localhost';
$db = 'toko_laptop';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_id = $row['product_id'];

        $sql_product = "SELECT * FROM products WHERE id = ?";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->bind_param('i', $product_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();
        $product = $result_product->fetch_assoc();

        // Escape output untuk mencegah XSS
        $productName = htmlspecialchars($product['name']);
        $productImage = htmlspecialchars($product['image']);
        $productPrice = number_format($product['price'], 0, ',', '.');
        $customerName = htmlspecialchars($row['name']);
        $customerAddress = htmlspecialchars($row['address']);
        $customerPhone = htmlspecialchars($row['phone']);
        $orderDate = htmlspecialchars($row['order_date']);

        // Bagian HTML terpisah dari kode PHP untuk meningkatkan keterbacaan
        ?>
       <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Toko Laptop</title>
    
    <link rel="stylesheet" href="css/header.css">
    
    <link rel="stylesheet" href="css/transaksi.css">
    <style>
        main h2 {
            text-align: center;
        }
        .btn {
            margin-top: 20px;
            display: block;
            text-align: center;
        }
    </style>
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
                       <li ><a href="landingpage.php">Home</a></li>
                            <li><a href="produk.php">Produk</a></li>
                            <li><a href="kontak.php">Kontak</a></li>
                            <li><a href="about.html">About</a></li>
                       </ul> 
                   </div>
               </li>
           </ul>      
       </nav>
    </header>
    <main>
        <h2>Terima Kasih Telah Membeli di Toko Kami!</h2>
        <h2>Detail Transaksi</h2>
        <div id="transaction-detail">
            <div class="product-item">
                <img src="<?= $productImage ?>" alt="<?= $productName ?>">
                <h3><?= $productName ?></h3>
                <p>Rp <?= $productPrice ?></p>
            </div>
            <div class="customer-info">
                <h3>Informasi Pembeli</h3>
                <p><strong>Nama:</strong> <?= $customerName ?></p>
                <p><strong>Alamat:</strong> <?= $customerAddress ?></p>
                <p><strong>Nomor Telepon:</strong> <?= $customerPhone ?></p>
                <p><strong>Tanggal Pembelian:</strong> <?= $orderDate ?></p>
            </div>
        </div>
        <a href="landingpage.php" class="btn">Kembali ke Halaman Utama</a>
    </main>
    <footer>
        <p>&copy; 2024 Toko Laptop</p>
    </footer>
</body>
</html>

        <?php
    } else {
        echo '<p>Transaksi tidak ditemukan.</p>';
    }
}

$conn->close();
?>
