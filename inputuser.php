<?php
include 'koneksi.php';

// Memastikan semua input telah diisi
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash password hanya jika password tidak kosong
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Menggunakan prepared statement untuk memasukkan data
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $email);

        if ($stmt->execute()) {
            echo "User berhasil ditambahkan!";
        } else {
            echo "Gagal menambahkan user: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Password tidak boleh kosong.";
    }
} else {
    echo "Pastikan semua data (username, password, email) telah diisi.";
}

$conn->close();
?>
