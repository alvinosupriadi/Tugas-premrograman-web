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

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query untuk menghapus pengguna berdasarkan ID
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $success_message = "User deleted successfully!";
        } else {
            $error_message = "Failed to delete user.";
        }
    }
} catch (PDOException $e) {
    // Tangani kesalahan koneksi
    echo "Error: " . $e->getMessage();
}

header("Location: manage_users.php"); // Redirect kembali ke halaman manage_users setelah menghapus pengguna
exit();
?>
