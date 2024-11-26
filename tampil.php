<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: formlogin.php");
    exit();
}

$query = "SELECT * FROM appointments";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments - Poliklinik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #FFB6C1; /* Light Pink */
            --secondary-color: #FFC0CB; /* Pink */
            --accent-color: #FF69B4; /* Hot Pink */
            --background-color: #FFF0F5; /* Lavender Blush */
            --text-color: #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing:  border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 20px;
            transition: background-color 0.3s;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            color: var(--text-color);
        }

        .logo i {
            margin-right: 10px;
            color: var(--accent-color);
        }

        .menu {
            list-style-type: none;
        }

        .menu li {
            margin-bottom: 15px;
        }

        .menu a {
            color: var(--text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .menu a:hover, .menu a.active {
            background-color: var(--secondary-color);
            color: var(--accent-color);
        }

        .menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            flex-grow: 1;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .welcome {
            font-size: 24px;
            font-weight: 600;
            color: var(--accent-color);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            margin-right: 10px;
        }

        .logout {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .logout:hover {
            color: var(--primary-color);
        }

        .appointments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-appointment {
            background-color: var(--accent-color);
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .add-appointment:hover {
            background-color: var(--secondary-color);
        }

        .add-appointment i {
            margin-right: 5px;
        }

        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .appointments-table th,
        .appointments-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--secondary-color);
        }

        .appointments-table th {
            background-color: var(--primary-color);
            color: var(--text-color);
            font-weight: 600;
        }

        .appointments-table tr:hover {
            background-color: var(--background-color);
        }

        .action-buttons a {
            text-decoration: none;
            color: var(--accent-color);
            margin-right: 10px;
            font-weight: 600;
            transition: color 0.3s;
        }

        .action-buttons a:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-hospital"></i>
                <span>Poliklinik</span>
            </div>
            <ul class="menu">
                <li><a href="#"><i class="fas fa-home"></i>Beranda</a></li>
                <li><a href="tampil.php"><i class="fas fa-calendar-check"></i>Janji Temu</a></li>
                <li><a href="#"><i class="fas fa-user-md"></i>Dokter</a></li>
                <li><a href="#"><i class="fas fa-users"></i>Pasien</a></li>
                <li><a href="#"><i class="fas fa-cog"></i>Pengaturan</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <div class="welcome">Appointments</div>
                <div class="user-info">
                    <div class="user-avatar"><?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?></div>
                    <a href="logout.php" class="logout">Logout</a>
                </div>
            </div>
            <div class="appointments-header">
                <h2>Daftar Janji Temu </h2>
                <a href="tambah_appointment.php" class="add-appointment">
                    <i class="fas fa-plus"></i> Tambah Janji Temu
                </a>
            </div>
            <table class="appointments-table">
                <tr>
                    <th>ID Pasien</th>
                    <th>ID Dokter</th>
                    <th>Tanggal Janji Temu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['patient_id']; ?></td>
                    <td><?php echo $row['doctor_id']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td class="action-buttons">
                        <a href="ubah.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>