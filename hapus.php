<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM appointments WHERE id='$id'";

if ($conn->query($query) === TRUE) {
    header("Location: tampil.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
