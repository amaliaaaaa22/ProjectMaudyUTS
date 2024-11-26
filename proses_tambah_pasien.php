<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda, kosong jika tidak ada
$dbname = "poliklinik"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form dan melakukan sanitasi
    $nama = htmlspecialchars(trim($_POST['nama']));
    $tanggal_lahir = htmlspecialchars(trim($_POST['tanggal_lahir']));
    $jenis_kelamin = htmlspecialchars(trim($_POST['jenis_kelamin']));
    $alamat = htmlspecialchars(trim($_POST['alamat']));
    $nomor_telepon = htmlspecialchars(trim($_POST['nomor_telepon']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Validasi input
    if (empty($nama) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($alamat) || empty($nomor_telepon) || empty($email)) {
        die("Semua field harus diisi.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Format email tidak valid.");
    }

    // SQL untuk menambah pasien menggunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO pasien (nama, tanggal_lahir, jenis_kelamin, alamat, nomor_telepon, email) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $nama, $tanggal_lahir, $jenis_kelamin, $alamat, $nomor_telepon, $email);

    // Eksekusi dan cek hasil
    if ($stmt->execute()) {
        // Redirect setelah berhasil menambahkan pasien dengan pesan sukses
        header("Location: pasien.php?message=Pasien+berhasil+ditambahkan");
        exit(); // Pastikan untuk menghentikan script setelah redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement dan koneksi
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>