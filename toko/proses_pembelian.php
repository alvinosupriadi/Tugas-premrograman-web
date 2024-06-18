<?php
session_start();

$host = 'localhost';
$db = 'toko_laptop';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("Anda harus login untuk melakukan pembelian.");
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO orders (user_id, product_id, name, address, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iisss', $user_id, $product_id, $name, $address, $phone);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        header("Location: detail_transaksi.php?id=$order_id");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
