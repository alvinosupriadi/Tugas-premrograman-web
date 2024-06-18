<?php
include 'config.php'; // File ini harus mengandung koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan pengguna baru
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "Pendaftaran berhasil. Silakan <a href='login.php'>login</a>.";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }
}
?>
