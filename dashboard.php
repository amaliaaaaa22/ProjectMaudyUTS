<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: formlogin.php");
    exit();
}

// Mendapatkan jumlah pasien, dokter, dan janji temu dari database
$patientsCount = $conn->query("SELECT COUNT(*) as count FROM patients")->fetch_assoc()['count'];
$doctorsCount = $conn->query("SELECT COUNT(*) as count FROM doctors")->fetch_assoc()['count'];
$appointmentsCount = $conn->query("SELECT COUNT(*) as count FROM appointments")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome to the Dashboard, <?php echo $_SESSION['username']; ?>!</h1>
        <div class="stats">
            <div class="card">
                <h2>Patients</h2>
                <p><?php echo $patientsCount; ?></p>
            </div>
            <div class="card">
                <h2>Doctors</h2>
                <p><?php echo $doctorsCount; ?></p>
            </div>
            <div class="card">
                <h2>Appointments</h2>
                <p><?php echo $appointmentsCount; ?></p>
            </div>
        </div>
        <div class="actions">
            <a href="tampil.php">View Appointments</a> |
            <a href="tambah.php">Add Appointment</a> |
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>

<style>
    /* Inline CSS untuk desain dashboard, gunakan ini atau tambahkan ke file style.css */
    body {
        font-family: Arial, sans-serif;
        background-color: #ffe6f2;
        color: #333;
    }

    .dashboard-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        text-align: center;
    }

    h1 {
        color: #ff66b2;
    }

    .stats {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }

    .card {
        padding: 20px;
        background-color: #ffccf2;
        border-radius: 8px;
        width: 150px;
    }

    .card h2 {
        color: #ff66b2;
    }

    .actions {
        margin-top: 30px;
    }

    .actions a {
        color: #ff66b2;
        text-decoration: none;
        font-weight: bold;
        margin: 0 10px;
    }

    .actions a:hover {
        color: #ff4d94;
    }
</style>
