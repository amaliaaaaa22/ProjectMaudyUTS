<?php
// Mulai session
session_start();

// Sertakan file koneksi
require_once 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: pasien.php");
    exit();
}

// Inisialisasi variabel untuk menyimpan error
$errors = [];

// Periksa apakah formulir sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir dengan pengecekan keamanan
    $id_dokter = isset($_POST['id_dokter']) ? htmlspecialchars(trim($_POST['id_dokter'])) : '';
    $nama = isset($_POST['nama']) ? htmlspecialchars(trim($_POST['nama'])) : '';
    $spesialisasi_id = isset($_POST['spesialisasi_id']) ? htmlspecialchars(trim($_POST['spesialisasi_id'])) : '';
    $no_telepon = isset($_POST['no_telepon']) ? htmlspecialchars(trim($_POST['no_telepon'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $alamat = isset($_POST['alamat']) ? htmlspecialchars(trim($_POST['alamat'])) : '';
    $status = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : '';

    // Validasi input
    if (empty($id_dokter)) {
        $errors[] = "ID Dokter harus diisi";
    }

    if (empty($nama)) {
        $errors[] = "Nama harus diisi";
    }

    if (empty($spesialisasi_id)) {
        $errors[] = "Spesialisasi harus diisi";
    }

    if (empty($no_telepon)) {
        $errors[] = "Nomor Telepon harus diisi";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid";
    }

    if (empty($alamat)) {
        $errors[] = "Alamat harus diisi";
    }

    // Jika tidak ada error, lanjutkan proses penyimpanan
    if (empty($errors)) {
        // Periksa koneksi database
        if (!$koneksi) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Gunakan prepared statement untuk mencegah SQL Injection
        $stmt = $koneksi->prepare("INSERT INTO dokter (id_dokter, nama, spesialisasi_id, no_telepon, email, alamat, status) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("Prepare failed: " . $koneksi->error);
        }

        // Bind parameter
        $stmt->bind_param("sssssss", 
            $id_dokter, 
            $nama, 
            $spesialisasi_id, 
            $no_telepon, 
            $email, 
            $alamat,
            $status
        );

        // Eksekusi statement
        if ($stmt->execute()) {
            // Redirect dengan pesan sukses
            $_SESSION['success_message'] = "Data dokter berhasil ditambahkan";
            header("Location: dokter.php");
            exit();
        } else {
            // Tangani error eksekusi
            $errors[] = "Gagal menyimpan data: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3 class="mt-4">Tambah Data Dokter</h3>
        <!-- Tampilkan pesan error jika ada -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label>ID Dokter</label>
                <input class="form-control" type="text" name="id_dokter" required placeholder="Masukkan ID Dokter">
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input class="form-control" type="text" name="nama" required placeholder="Masukkan nama dokter">
            </div>
            <div class="mb-3">
                <label>Spesialisasi</label>
                <input class="form-control" type="text" name="spesialisasi_id" required placeholder="Masukkan spesialisasi">
            </div>
            <div class="mb-3">
                <label>No Telepon</label>
                <input class="form-control" type="text" name="no_telepon" required placeholder="Masukkan no telepon">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input class="form-control" type="email" name="email" required placeholder="Masukkan alamat email">
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <input class="form-control" type="text" name="alamat" required placeholder="Masukkan alamat lengkap">
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select class="form-control" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="Active">Aktif</option>
                    <option value="Inactive">Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</body>
</html>