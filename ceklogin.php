<?php
include 'koneksi.php';

session_start();

// Pastikan 'username' dan 'password' ada dalam data POST
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    echo "Username atau password tidak tersedia.";
    exit();
}

// Mendapatkan username dan password dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Menggunakan prepared statements untuk keamanan dari SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Memeriksa apakah user ditemukan
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: indexlogin.php");
        exit();
    } else {
        echo "Password salah.";
    }
} else {
    echo "User tidak ditemukan.";
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>
